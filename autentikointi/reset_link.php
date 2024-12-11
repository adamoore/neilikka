<?php
// Yhdistetään tietokantaan
include 'config.php';

// Tarkistetaan onko sähköposti rekisteröity
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Etsi käyttäjä tietokannasta
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->execute(['email' => $email]);
    $user = $query->fetch();

    if ($user) {
        // Luodaan salainen palautuskoodi
        $token = bin2hex(random_bytes(50));  // 50-bittinen satunnainen koodi
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));  // Aikaa palauttaa 1 tunti

        // Tallenna palautuskoodi ja sen vanhenemisaika tietokantaan
        $query = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires_at)");
        $query->execute(['email' => $email, 'token' => $token, 'expires_at' => $expires_at]);

        // Lähetä sähköposti palautuslinkin kanssa
        $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;

        // Käytä mail()-funktiota tai PHPMailer-kirjastoa
        $subject = "Salasanan palautus";
        $message = "Klikkaa linkkiä palauttaaksesi salasanasi: " . $reset_link;
        $headers = "From: no-reply@yourwebsite.com";

        mail($email, $subject, $message, $headers);

        echo "Palautuslinkki lähetetty sähköpostiin!";
    } else {
        echo "Sähköpostiosoitetta ei löytynyt.";
    }
}
?>
        