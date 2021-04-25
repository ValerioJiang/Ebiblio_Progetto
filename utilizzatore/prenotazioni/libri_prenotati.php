<?php
require_once('/xampp/htdocs/ebiblio/main_partials/menu.php');

$cartaCon = new CartaceoController();
$carta_res = $cartaCon->listUtil();

$presCon = new PrestitoController();


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
                    <th>Modalita</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php

                        $pres_res = $presCon -> getLikePrestitoUtente($_SESSION['email']); 
                    
                        for ($i = 0; $i < count($pres_res); $i++) {
                            echo '<tr>';
                            echo '<td>' . $pres_res[$i]['Titolo'] . '</td>';
                            echo '<td>' . $pres_res[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  . $pres_res[$i]['Edizione'] . '</td>';
                            echo '<td>'  . $pres_res[$i]['Biblioteca'] . '</td>';
                            echo '<td>'  . $pres_res[$i]['StatoPrestito'] . '</td>';
                            echo '<td>'  . $pres_res[$i]['StatoConservazione'] . '</td>';
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