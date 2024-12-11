<?php
// Liitetään config-tiedosto
require 'config.php';

// Lisätään PHPMailer-tiedostot
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan lomakkeen tiedot ja suodatetaan ne turvallisuuden vuoksi
    $nimi = htmlspecialchars($_POST['nimi']);
    $katuosoite = htmlspecialchars($_POST['katuosoite']);
    $postinumero = htmlspecialchars($_POST['postinumero']);
    $postitoimipaikka = htmlspecialchars($_POST['postitoimipaikka']);
    $puhelinnumero = htmlspecialchars($_POST['puhelinnumero']);
    $email = htmlspecialchars($_POST['email']);
    $salasana = password_hash($_POST['salasana'], PASSWORD_DEFAULT);  // Salasanan hash
    $aktivointikoodi = bin2hex(random_bytes(16)); // Generoidaan aktivointikoodi
    $aktiivinen = 0;  // Käyttäjä ei ole aktivoitu aluksi

    // Lisää käyttäjä tietokantaan
    $sql = "INSERT INTO users (nimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, email, salasana, aktivointikoodi, aktiivinen) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Tarkistetaan, onnistuiko valmistelu
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bindataan parametrit SQL-kyselyyn
    $stmt->bind_param("ssssssssi", $nimi, $katuosoite, $postinumero, $postitoimipaikka, $puhelinnumero, $email, $salasana, $aktivointikoodi, $aktiivinen);

    // Suoritetaan kysely
    if ($stmt->execute()) {
        // Rekisteröinti onnistui, nyt lähetetään aktivointiviesti
        try {
            $mail = new PHPMailer(true);
            // Gmailin SMTP-asetukset
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '@gmail.com'; 
            $mail->Password = '';  // Tämä kannattaa salata tai käyttää ympäristömuuttujaa
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Vastaanottajat
            $mail->setFrom('@gmail.com', 'Neilikka'); // Lähettäjän tiedot
            $mail->addAddress($email);  // Lähetetään sähköposti käyttäjälle

            // Sähköpostin sisältö
            $mail->isHTML(true);
            $mail->Subject = 'Vahvista sähköpostiosoitteesi';
            $mail->Body = "Kiitos rekisteröitymisestä! <br><br>Klikkaa alla olevaa linkkiä aktivoidaksesi tilisi: <br><br>
                <a href='http://localhost/koodit/neilikka/autentikointi/activation.php?token=$aktivointikoodi&email=$email'>Aktivoi tilisi tästä</a>";

            // Lähetetään sähköposti
            $mail->send();
            echo "Vahvistusviesti lähetetty, tarkista sähköpostisi.";

        } catch (Exception $e) {
            echo "Viestiä ei voitu lähettää. Virhe: {$mail->ErrorInfo}";
        }
    } else {
        echo "Käyttäjän rekisteröinti epäonnistui: " . $stmt->error;
    }

    // Suljetaan statement
    $stmt->close();
}
?>


