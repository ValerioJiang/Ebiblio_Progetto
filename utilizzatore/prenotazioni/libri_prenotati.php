<?php
require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$cartaCon = new CartaceoController();

$presCon = new PrestitoController();

$consCon = new ConsegnaController();

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
    <h2>Libri prenotati</h2>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Biblioteca</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Status</th>
                    <th>Note consegna</th>
                </tr>
            </thead>
            <tbody>

                <?php

                        $pres_res = $presCon -> getLikePrestitoUtenteNoConsegna($_SESSION['email']); 
                        //creare array con tutte le consegne relative a un particolare utente
                        $consUtil = $consCon -> consegnaUtil($_SESSION['email']);

                        for ($i = 0; $i < count($consUtil); $i++) {
                            $cartaRes = $cartaCon -> getLikeLibroConsegna($consUtil[$i]['CodicePrestito']);
                            echo '<tr>';
                            echo '<td>' . $cartaRes[0]['Titolo'] . '</td>';
                            echo '<td>'  . $cartaRes[0]['Biblioteca'] . '</td>';
                            if($consUtil[$i]['DataConsegna'] == null){
                                echo '<td>'  . "Inizia con la consegna effettiva del libro" . '</td>';
                                echo '<td>'  . "15 giorni dopo la data di inizio" . '</td>';    
                            }
                            else{
                                echo '<td>'  . $consUtil[$i]['DataConsegna'] . '</td>';
                                $newDate = strtotime('+15 days',$consUtil[$i]['DataConsegna']);
                                echo '<td>'  . $newDate . '</td>';
                            }
                            
                            if($consUtil[$i]['DataConsegna'] == null){
                                echo '<td>'  . "In attesa della consegna di un volontario " . '</td>';
                            }
                            else{
                                echo '<td>'  . "Presa in carico da ".$consUtil[$i]['Volontario'] . '</td>';
                            }
                            echo '</tr>';
                        }


                        for ($j = 0; $j < count($pres_res); $j++) {
                            $cartaRes = $cartaCon -> getLikeLibroConsegna($pres_res[$i]['CodicePrestito']);
                            echo '<tr>';
                            echo '<td>' . $cartaRes[0]['Titolo'] . '</td>';
                            echo '<td>'  . $cartaRes[0]['Biblioteca'] . '</td>';
                            echo '<td>'  . $$pres_res[$i]['DataInizio'] . '</td>';
                            echo '<td>'  . $$pres_res[$i]['DataFine'] . '</td>';
                            echo '</tr>';
                        }
                    
                ?>

            </tbody>
        </table>
    </div>
    
</div>

<?php
require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>