<?php include 'header.php'; ?> 

<main class="container mt-5">
    <h1>Rekisteröidy</h1>
    
    <form action="autentikointi/rekisterointi.php" method="post" class="reklomake needs-validation" novalidate>
        <fieldset>
            <legend>Yhteystiedot</legend>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="nimi" class="form-label">Nimi:</label>
                    <input type="text" class="form-control" id="nimi" name="nimi" required pattern="[A-Za-zÅÄÖåäö\s]+" title="Nimi voi sisältää vain kirjaimia ja välilyöntejä">
                    <div class="invalid-feedback">Syötä kelvollinen nimi (vain kirjaimia ja välilyöntejä).</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="katuosoite" class="form-label">Katuosoite:</label>
                    <input type="text" class="form-control" id="katuosoite" name="katuosoite" required pattern="[A-Za-zÅÄÖåäö0-9\s]+" title="Katuosoite voi sisältää kirjaimia, numeroita ja välilyöntejä">
                    <div class="invalid-feedback">Syötä kelvollinen katuosoite.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="postinumero" class="form-label">Postinumero:</label>
                    <input type="text" class="form-control" id="postinumero" name="postinumero" required pattern="\d{5}" title="Postinumeron tulee olla 5 numeroa pitkä">
                    <div class="invalid-feedback">Syötä kelvollinen postinumero (5 numeroa).</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cities" class="form-label">Postitoimipaikka:</label>
                    <input list="cities" class="form-control" id="postitoimipaikka" name="postitoimipaikka" required pattern="[A-Za-zÅÄÖåäö\s]+" title="Postitoimipaikka voi sisältää vain kirjaimia ja välilyöntejä" placeholder="Kirjoita ja valitse kaupunki">
                        <datalist id="cities">
                        <?php
                        $json = file_get_contents('suomen_kaupungit.json');
                        $cities = json_decode($json, true);
                        foreach ($cities as $city) {
                            echo '<option value="' . htmlspecialchars($city['name'], ENT_QUOTES, 'UTF-8') . '">';
                        }
                        ?>
                        </datalist>
                    <div class="invalid-feedback">Syötä kelvollinen postitoimipaikka.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="puhelinnumero" class="form-label">Puhelinnumero:</label>
                    <input type="text" class="form-control" id="puhelinnumero" name="puhelinnumero" required pattern="(\+?\d{1,3}[- ]?)?(\d{1,4}[- ]?)?(\d{1,4}[- ]?)?(\d{1,4}){1,15}" title="Syötä puhelinnumero oikeassa muodossa, esimerkiksi +358 123 4567 tai 0123456789">
                    <div class="invalid-feedback">Syötä kelvollinen puhelinnumero.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Sähköpostiosoite:</label>
                    <input type="email" class="form-control" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Syötä kelvollinen sähköpostiosoite">
                    <div class="invalid-feedback">Syötä kelvollinen sähköpostiosoite.</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Salasana</legend>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="salasana" class="form-label">Salasana:</label>
                    <input type="password" class="form-control" id="salasana" name="salasana" required pattern=".{6,}" title="Salasanan on oltava vähintään 6 merkkiä pitkä">
                    <div class="invalid-feedback">Salasanan on oltava vähintään 6 merkkiä pitkä.</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Mistä osastoista olet kiinnostunut?</legend>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <input type="checkbox" id="muoti" name="osastot" value="Muoti" class="form-check-input">
                    <label for="muoti" class="form-check-label">Muoti</label><br>

                    <input type="checkbox" id="urheilu" name="osastot" value="Urheilu" class="form-check-input">
                    <label for="urheilu" class="form-check-label">Urheilu</label><br>

                    <input type="checkbox" id="sisustaminen" name="osastot" value="Sisustaminen" class="form-check-input">
                    <label for="sisustaminen" class="form-check-label">Sisustaminen</label><br>

                    <input type="checkbox" id="pelit" name="osastot" value="Pelit" class="form-check-input">
                    <label for="pelit" class="form-check-label">Pelit</label><br>

                    <input type="checkbox" id="elokuvat" name="osastot" value="Elokuvat" class="form-check-input">
                    <label for="elokuvat" class="form-check-label">Elokuvat</label><br>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Maksutapa</legend>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="maksutapa" class="form-label">Valitse maksutapa:</label>
                    <select id="maksutapa" name="maksutapa" class="form-select">
                        <option value="sampo">Danske</option>
                        <option value="nordea">Nordea</option>
                        <option value="osuuspankki">Osuuspankki</option>
                        <option value="aktia">Aktia</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Anna palautetta</legend>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="palaute" class="form-label">Palautteesi:</label>
                    <textarea id="palaute" name="palaute" rows="4" class="form-control"></textarea>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Toimitusehdot</legend>

            <p>Olen lukenut ja hyväksyn tuotteiden toimitusehdot:</p>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <div class="form-check needs-validation">
                        <input type="radio" id="kylla" name="toimitusehdot" value="kylla" required class="form-check-input" novalidate>
                        <label for="kylla" class="form-check-label">Kyllä</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" id="ei" name="toimitusehdot" value="ei" class="form-check-input">
                        <label for="ei" class="form-check-label">Ei</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="submit"><strong>Rekisteröidy</strong></button>
            </div>
        </div>
    </form>
</main>

<?php include 'footer.php'; ?> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Bootstrapin lomakkeen validointi
    (function () {
        'use strict'

        // Hakee kaikki lomakkeet, joihin tarvitaan validointi
        var forms = document.querySelectorAll('.needs-validation')

        // Estä lomakkeen lähetys, jos se ei ole kelvollinen
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
