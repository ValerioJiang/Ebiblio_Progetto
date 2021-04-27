<?php


include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$prestitoCon = new PrestitoController();
$prestito_res = $prestitoCon->getLikePrestitoBiblioAdmin('amministratore@gmail.com');//da cambiare con valore passato in sessione

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
               <h5> Visualizzazione prestiti libri</h5>
                <tr>
                    <th>Codice Prenotazione</th>
                    <th>Utilizzatore</th>
                    <th>Codice libro</th>
                    <th>Data inizio</th>  
                    <th>Data Fine</th>
                </tr>
            </thead>
            <tbody>

                <?php

                
                for ($i = 0; $i < count($prestito_res); $i++) {
                    echo '<tr ' . $prestito_res[$i]['Codice'] .
                        '&Codice=' . $prestito_res[$i]['Codice'] . '\');"' . '>';
                        
                    echo '<td>' . $prestito_res[$i]['Codice'] . '</td>';
                    echo '<td>' . $prestito_res[$i]['Utilizzatore'] . '</td>';
                    echo '<td>' . $prestito_res[$i]['Libro'] . '</td>';
                    echo '<td>' . $prestito_res[$i]['DataInizio'] . '</td>';
                    echo '<td>'  . $prestito_res[$i]['DataFine'] . '</td>';

                    
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