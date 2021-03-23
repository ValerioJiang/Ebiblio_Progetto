<?php
include('../main_partials/menu.php');

$biblio_con = new BibliotecaController();
$biblio_res = $biblio_con->getBiblioteca($_GET['Nome']);

$tel_con = new TelefonoController();
$tel_res = $tel_con->getTelefono($_GET['Nome']);

$posLet_con = new PostoLetturaController();
$posLet_res = $posLet_con->getPostoLettura($_GET['Nome']);

?>

<div class="container-fluid" style="width: 80%;">
    <h1><?php echo $_GET['Nome']; ?></h1>
    <div class="row justify-content-center">
        <div class="col mb-2">
            <h3>Contatti:</h3><br>
            <?php
            echo '<ul>';
            for ($i = 0; $i < count($tel_res); $i++) {
                echo '<li>' . ($tel_res[$i]['NumeroTelefono']) . '</li>';
            }
            echo '</ul><br>';
            ?>
            <p>Email:
                <?php
                $var_temp = $biblio_res[0]['Email'];
                echo '<a href = mailto:' . "$var_temp>" . "$var_temp" . "</a>"
                ?></p>

            <p>Sito Web:
                <?php
                $var_temp = $biblio_res[0]['SitoWeb'];
                echo '<a href = ' . "$var_temp>" . "$var_temp" . "</a>"
                ?></p>

        </div>

        <div class="col mb-2">
            <h3>Servizi: </h3><br>
            Posti lettura totali: <?php echo count($posLet_res) ?><br>
            <input type="submit" value="Prenota Posto Lettura" name="prenot_pos_let"></input>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col mb-2">
            <h3>Note:</h3><br>
            <?php
            echo $biblio_res[0]['Note']
            ?>

        </div>
        <div class="col mb-2">
            <h3>Indirizzo:</h3><br>
            <?php echo $biblio_res[0]['Indirizzo']; ?><br>
            <div id="mapid" style="height: 300px;"></div>
            <script>
                var curr_url = new URLSearchParams(window.location.search);;
                var latitude = curr_url.get('Latitudine');
                var longitude = curr_url.get('Longitudine');
                var marker = new L.Marker([latitude, longitude]);
                marker.bindPopup(curr_url.get('Indirizzo')).openPopup();
                var mymap = L.map('mapid').setView([latitude, longitude], 30);
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: 'pk.eyJ1IjoidmFsZXJpb2ppYW5nIiwiYSI6ImNrbWx2d29kZDFlam0ycG56YTRwZWVpNGUifQ.3wTkMQABk_NTuVG5sLdrQw'
                }).addTo(mymap);
                marker.addTo(mymap);
            </script>
        </div>
    </div>
    
</div>




<?php
include('../main_partials/footer.php');
?>