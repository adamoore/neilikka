<?php
session_start();
require 'config.php'; // Tietokantayhteys????

// Jos lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $salasana = $_POST['salasana'];

    // Tarkistetaan sähköposti tietokannasta
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Tarkistetaan, onko tili aktivoitu ja salasana oikein
        if ($user['aktiivinen'] == 1 && password_verify($salasana, $user['salasana'])) {
            // Tallennetaan käyttäjän tiedot sessioon
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nimi'] = $user['nimi'];
            
            // Ohjataan käyttäjä kirjautumisen jälkeen
            header("Location: etusivu.php");
            exit();
        } else {
            $error = "Virheellinen sähköposti, salasana tai tili ei ole aktivoitu.";
        }
    } else {
        $error = "Virheellinen sähköposti tai salasana.";
    }
}
?>

<?php include 'header.php'; ?>

<main class="container mt-5">
    <h1>Kirjaudu sisään</h1>

    <form action="login.php" method="post" class="needs-validation" novalidate>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Sähköposti:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Syötä sähköpostiosoite.</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="salasana" class="form-label">Salasana:</label>
                <input type="password" class="form-control" id="salasana" name="salasana" required>
                <div class="invalid-feedback">Syötä salasana.</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary w-100">Kirjaudu</button>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <a href="forgot_password.php">Unohtuiko salasana?</a>
            </div>
        </div>
    </form>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
