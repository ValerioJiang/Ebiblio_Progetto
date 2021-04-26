<?php
require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$cartaCon = new CartaceoController();

$presCon = new PrestitoController();
$pres_res = $presCon -> getLikePrestitoUtente($_SESSION['email']);

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

                        $pres_res = $presCon -> getLikePrestitoUtente($_SESSION['email']); 

                        for ($i = 0; $i < count($pres_res); $i++) {
                            $carta_res = $cartaCon -> getById($pres_res[$i]['Libro']);

                            $cons_res = $consCon -> getByPrestito($pres_res[$i]['Codice']); 
                            $pres_codPres = $presCon -> getById($pres_res[$i]['Codice']);

                            if(count($cons_res)==count($pres_codPres)){
                                if($cons_res[0]['TipoConsegna']=='Affidamento'){
                                    if(is_null($cons_res[0]['Volontario'])){
                                        $status = "Consegna in attesa di presa in carico da volontario";
                                        $dataInizio= "Parte dal giorno dell'avvenuta consegna";
                                        $dataFine= "Non ancora definita";
                                    }
                                    else{
                                        $status = "Consegna presa in carico da volontario: ".$cons_res[0]['Volontario'];
                                        $dataInizio= "Parte dal giorno dell'avvenuta consegna";
                                        $dataFine= "Non ancora definita";
                                    }
                                }
                                else if($cons_res[0]['TipoConsegna']=='Consegnato'){
                                    $status = "Consegnato in data ".$cons_res[0]['DataConsegna']." da volontario ".$cons_res[0]['Volontario'];
                                }
                                else{
                                    $status = "Riaffidamento da volontario ".$cons_res[0]['Volontario'];
                                    $dataInizio= $pres_res[$i]['DataInizio'];
                                    $dataFine= $pres_res[$i]['DataInizio'];
                                }
                            }
                            else{
                                $status="Ritiro in biblioteca";
                                $dataInizio= $pres_res[$i]['DataInizio'];
                                $dataFine= $pres_res[$i]['DataInizio'];
                            }


                            echo '<tr>';
                            echo '<td>' . $carta_res[0]['Titolo'] . '</td>';
                            echo '<td>'  . $carta_res[0]['Biblioteca'] . '</td>';
                            echo '<td>'  . $dataInizio . '</td>';
                            echo '<td>'  . $dataFine . '</td>';
                            echo '<td>'  . $status . '</td>';
                            if($cons_res[0]['Note'] != NULL){
                                echo '<td>'  . $cons_res[0]['Note'] . '</td>';
                            }
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