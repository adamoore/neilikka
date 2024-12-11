<?php
require 'config.php'; // Sisältää tietokantayhteyden tiedot

if (isset($_GET['token'])) {
    // Haetaan token osoiteriviltä
    $token = $_GET['token'];

    // Tarkistetaan, löytyykö tietokannasta vastaava aktivointitoken -- muutettu activation_token aktivointikoodiksi ja is_active aktiiviseksi vastaamaan tietokantaa
    $stmt = $conn->prepare("SELECT email FROM users WHERE aktivointikoodi = ? AND aktiivinen = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jos token löytyy ja käyttäjä ei ole vielä aktivoitu
        $user = $result->fetch_assoc();
        $email = $user['email'];

        // Päivitetään käyttäjän tila aktivoiduksi
        $stmt = $conn->prepare("UPDATE users SET aktiivinen = 1, aktivointikoodi = NULL WHERE email = ?");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            // Aktivointi onnistui
            echo "Tilisi on aktivoitu! Voit nyt <a href='login.php'>kirjautua sisään</a>.";
        } else {
            // Aktivointitilapäivitys epäonnistui
            echo "Aktivointi epäonnistui teknisen virheen takia. Yritä uudelleen.";
        }
    } else {
        // Tokenia ei löydy tai tili on jo aktivoitu
        echo "Virheellinen tai vanhentunut aktivointilinkki.";
    }
} else {
    // Jos tokenia ei ole
    echo "Aktivointitoken puuttuu.";
}
?>

