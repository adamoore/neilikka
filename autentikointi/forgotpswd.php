<?php include 'header.php'; ?>

<main class="container mt-5">
    <h1>Unohtuiko salasana?</h1>
    <form action="send_reset_link.php" method="post" class="needs-validation" novalidate>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Sähköpostiosoite:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Syötä kelvollinen sähköpostiosoite.</div>
            </div>

            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary w-100">Lähetä palautuslinkki</button>
            </div>
        </div>
    </form>
</main>

<?php include 'footer.php'; ?>
