<?php
session_start();
session_destroy(); // Tuhoaa session
header("Location: etusivu.php"); // Ohjaa käyttäjän etusivulle kirjautumisen jälkeen
exit();
