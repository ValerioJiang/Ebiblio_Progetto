<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$segnalazioneCon = new SegnalazioneController();
$segnalazione_res = $segnalazioneCon->list($_SESSION['email']);


?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
               <h5> Bacheca segnalazioni</h5>
                <tr>
                    <th>Amministratore</th>
                    <th>Destinatario</th>
                    <th>Data segnalazione</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>

                <?php
                
                    for ($i = 0; $i < count($segnalazione_res); $i++) {
                        echo '<tr ' . $segnalazione_res[$i]['Amministratore'] .
                            '&Codice=' . $segnalazione_res[$i]['Amministratore'] . '\');"' . '>';
                            
                        echo '<td>' . $segnalazione_res[$i]['Amministratore'] . '</td>';
                        echo '<td>' . $segnalazione_res[$i]['Utilizzatore'] . '</td>';
                        echo '<td>' . $segnalazione_res[$i]['DataSegnalazione'] . '</td>';
                        echo '<td>' . $segnalazione_res[$i]['Note'] . '</td>';                        
                        echo '</tr>';
                    }
                ?>

          
                    

                   
            </tbody>
        </table>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>