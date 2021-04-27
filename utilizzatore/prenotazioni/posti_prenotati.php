<?php

require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$prenoPosCon = new PrenotazionePostoLetturaController();

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
    <label for="titoloId">Posti lettura prenotati</label>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Posto</th>
                    <th>Biblioteca</th>
                    <th>Data Prenotazione</th>
                    <th>Inizio</th>
                    <th>Fine</th>
                </tr>
            </thead>
            <tbody>

                <?php

                    $posPrenot_res = $prenoPosCon -> getPostoLetturaUtil($_SESSION['email']);
                    for ($i = 0; $i < count($posPrenot_res); $i++) {
                            echo '<tr>';
                            echo '<td>' . $posPrenot_res[$i]['Posto'] . '</td>';
                            echo '<td>' . $posPrenot_res[$i]['Biblioteca'] . '</td>';
                            echo '<td>' . $posPrenot_res[$i]['DataPrenotazione'] . '</td>';
                            echo '<td>' . $posPrenot_res[$i]['Inizio'] . '</td>';
                            echo '<td>' . $posPrenot_res[$i]['Fine'] . '</td>';
                            echo '<tr>';
                            
                    }
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
  require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>