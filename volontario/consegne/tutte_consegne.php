<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');

$consCon = new ConsegnaController();

?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <h3 class="mb-5">Scegliere tra le consegne disponibili, 
            quelle in restituzione solo se la data di fine prestito è stata superata</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codice consegna</th>
                        <th>Riferimento codice prestito</th>
                        <th>Tipo Consegna</th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $cons_res = $consCon -> listNonConsegnate();

                    for ($i = 0; $i < count($cons_res); $i++) {

                        echo '<tr>';
                        echo '<td>' . $cons_res[$i]['Codice'] . '</td>';
                        echo '<td>' . $cons_res[$i]['CodicePrestito'] . '</td>';
                        echo '<td>' . $cons_res[$i]['TipoConsegna'] . '</td>';
                        
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/volontario/consegne/tutte_consegne.php?presaIncarico=true&codConsegna=' . $cons_res[$i]['Codice'] .'">Prendi in carico</a></td>';
                        echo '</tr>';
                    }

                    $restituzione_res = $consCon -> listDaRestituire();

                    for ($j = 0; $j < count($restituzione_res); $j++) {

                        echo '<tr>';
                        echo '<td>' . $restituzione_res[$j]['Codice'] . '</td>';
                        echo '<td>' . $restituzione_res[$j]['CodicePrestito'] . '</td>';
                        echo '<td>' . 'Restituzione' . '</td>';
                        
                        
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/volontario/consegne/tutte_consegne.php?restituisci=true&codPrestito=' . $restituzione_res[$j]['CodicePrestito'] .'">Restituisci</a></td>';
                        echo '</tr>';
                    }

                    if(isset($_GET['presaIncarico'])){
                        $cons_upd = $consCon -> updateVolontario($_SESSION['email'],$_GET['codConsegna']);
                        echo "<script type='text/javascript'>alert('Presa in carico effetuata con successo');
                                window.location = 'http://localhost/ebiblio/volontario'; 
                              </script>";
                    }

                    if(isset($_GET['restituisci'])){
                        $cons_rest = $consCon -> createConsegnaRestituzione($_GET['codPrestito'], $_SESSION['email']);
                        echo "<script type='text/javascript'>alert('Restituzione effetuata con successo');
                                window.location = 'http://localhost/ebiblio/volontario'; 
                              </script>";       
                    }

                    ?>

                </tbody>
            </table>





        </div>

    </div>

</div>
</div>

<?php

require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');

?>