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
                    <th>Affida restituzione</th>
                    <th>Note consegna</th>
                    


                </tr>
            </thead>
            <tbody>

                <?php

                        
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
                                $newDate = date('Y-m-d',strtotime('+15 day', strtotime($consUtil[$i]['DataConsegna'])));
                                echo '<td>'  . $newDate . '</td>';
                            }
                            
                            if($consUtil[$i]['Volontario'] == null){
                                echo '<td>'  . "In attesa della consegna di un volontario " . '</td>';
                            }
                            else{
                                echo '<td>'  . "Presa in carico da ".$consUtil[$i]['Volontario'] . '</td>';
                            }
                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/utilizzatore/libro_prenot/libro_restituzione.php?codLibro='.$consUtil[$i]['Codice'].'&consegnaLibro=true"'.'">Restituisci</a></td>';            
                            
                            if(!$consUtil[$i]['Note'] == null){
                                echo '<td>'  . $consUtil[$i]['Note'] . '</td>';
                            }
                            echo "</tr>";
                        }


                        $pres_res = $presCon -> getLikePrestitoUtenteNoConsegna($_SESSION['email']); 
                        for ($j = 0; $j < count($pres_res); $j++) {
                            $cartaRes = $cartaCon -> getById($pres_res[$j]['Libro']);
                            echo '<tr>';
                            echo '<td>' . $cartaRes[0]['Titolo'] . '</td>';
                            echo '<td>'  . $cartaRes[0]['Biblioteca'] . '</td>';
                            echo '<td>'  . $pres_res[$j]['DataInizio'] . '</td>';
                            echo '<td>'  . $pres_res[$j]['DataFine'] . '</td>';
                            echo '<td>'  . "Ritiro in biblioteca" . '</td>';
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