<?php
// Yhdistä tietokantaan
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);  // Salataan salasana

    // Tarkistetaan tokenin voimassaolo
    $query = $pdo->prepare("SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW()");
    $query->execute(['token' => $token]);
    $reset_request = $query->fetch();

    if ($reset_request) {
        // Päivitä käyttäjän salasana
        $query = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
        $query->execute(['password' => $new_password, 'email' => $reset_request['email']]);

        // Poista token tietokannasta
        $query = $pdo->prepare("DELETE FROM password_resets WHERE email = :email");
        $query->execute(['email' => $reset_request['email']]);

        echo "Salasana vaihdettu onnistuneesti!";
    } else {
        echo "Virheellinen tai vanhentunut linkki.";
    }
}
?>
