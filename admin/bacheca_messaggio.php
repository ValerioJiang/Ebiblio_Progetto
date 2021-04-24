<?php

 /*On page1
$_SESSION['varname'] = $var_value;

//On page 2
$var_value = $_SESSION['varname'];*/


include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$messaggioCon = new MessaggioController();
$messaggio_res = $messaggioCon->list('amministratore@email.it'); //da cambiare con valore passato da sessione


?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
               <h5> Bacheca conversazioni</h5>
                <tr>
                    <th>Mittente</th>
                    <th>Destinatario</th>
                    <th>Data invio</th>
                    <th>Oggetto</th>
                    <th>Messaggio</th>

                </tr>
            </thead>
            <tbody>

                <?php
                
                    for ($i = 0; $i < count($messaggio_res); $i++) {
                        echo '<tr ' . $messaggio_res[$i]['Amministratore'] .
                            '&Codice=' . $messaggio_res[$i]['Amministratore'] . '\');"' . '>';
                            
                        echo '<td>' . $messaggio_res[$i]['Amministratore'] . '</td>';
                        echo '<td>' . $messaggio_res[$i]['Utilizzatore'] . '</td>';
                        echo '<td>' . $messaggio_res[$i]['DataInvio'] . '</td>';
                        echo '<td>' . $messaggio_res[$i]['Titolo'] . '</td>';
                        echo '<td>'  . $messaggio_res[$i]['Testo'] . '</td>';
                        
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