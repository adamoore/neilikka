<?php include 'header.php'; ?>

<main class="container mt-5">
    <h1>Palauta salasana</h1>
    <form action="reset_password_handler.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="new_password" class="form-label">Uusi salasana:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required pattern=".{6,}" title="Salasanan on oltava vähintään 6 merkkiä pitkä">
                <div class="invalid-feedback">Syötä uusi salasana, vähintään 6 merkkiä.</div>
            </div>

            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary w-100">Vaihda salasana</button>
            </div>
        </div>
    </form>
</main>

<?php include 'footer.php'; ?>

