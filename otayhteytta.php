<?php include 'header.php'; ?> <!-- Sisällytä header -->
<br>
<h1>Ota yhteyttä</h1>
<div class="contact-info">
    <p>Voit ottaa meihin yhteyttä puhelimitse yksittäisiin myymälöihin, 
        sähköpostitse: <br>
    <a href="mailto:asiakaspalvelu@puutarhaliikeneilikka.fi">asiakaspalvelu@puutarhaliikeneilikka.fi</a>
        tai alla olevalla lomakkeella.</p>
</div> 
<main class="container">    
    <div class="contact-form col-md-6">
        <form class="contact-form" action="#" method="post">
            <h2>Yhteydenottolomake</h2>

            <div class="mb-3">
                <label for="name" class="form-label">Nimi:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Anna nimesi" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Sähköposti:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Anna sähköpostiosoitteesi" required>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Aihe:</label>
                <select id="subject" name="subject" class="form-select" required>
                    <option value="kysymys">Kysymys tuotteista</option>
                    <option value="tilaus">Tilaus</option>
                    <option value="yhteydenottopyynto">Yhteydenottopyyntö</option>
                    <option value="muu">Muu</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Viesti:</label>
                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Kirjoita viestisi tähän" required></textarea>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" value="yes">
                <label for="newsletter" class="form-check-label">
                    Haluan tilata uutiskirjeen
                </label>
            </div>

            <button type="submit"><strong>Lähetä</strong></button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?> <!-- Sisällytä footer -->
