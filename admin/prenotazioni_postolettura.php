<?php


include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$postoCon = new PostoLetturaController();
$posto_res = $postoCon->getPrenotazioneAdmin('amministratore@gmail.com');

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
               <h5> Visualizzazione prenotazione posti lettura</h5>
                <tr>
                    <th>Posto</th>
                    <th>Biblioteca</th>
                    <th>Utilizzatore</th>
                    <th>DataPrenotazione</th>
                    <th>Orario inizio</th>  
                    <th>Orario Fine</th>


                </tr>
            </thead>
            <tbody>

                <?php

                
                for ($i = 0; $i < count($posto_res); $i++) {
                    echo '<tr ' . $posto_res[$i]['Posto'] .
                        '&Codice=' . $posto_res[$i]['Posto'] . '\');"' . '>';
                        
                    echo '<td>' . $posto_res[$i]['Posto'] . '</td>';
                    echo '<td>' . $posto_res[$i]['Biblioteca'] . '</td>';
                    echo '<td>' . $posto_res[$i]['Utilizzatore'] . '</td>';
                    echo '<td>' . $posto_res[$i]['DataPrenotazione'] . '</td>';
                    echo '<td>'  . $posto_res[$i]['Inizio'] . '</td>';
                    echo '<td>'  . $posto_res[$i]['Fine'] . '</td>';

                    
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