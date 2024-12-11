<?php
// Tietokantayhteyden asetukset
$servername = "localhost";   // Palvelimen osoite, usein localhost
$username = "root";          // Tietokannan käyttäjätunnus
$password = "";              // Tietokannan salasana
$dbname = "neilikka";    // Tietokannan nimi

// Luodaan yhteys tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkistetaan yhteys
if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}
?>
