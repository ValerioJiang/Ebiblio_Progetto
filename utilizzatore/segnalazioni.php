<?php

require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$senCon = new SegnalazioneController();
?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
    <h2>Segnalazioni</h2>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Da</th>
                    <th>Data messaggio</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>

                <?php

                        $senRes = $senCon -> segnUtil($_SESSION['email']);
            
                        for ($i = 0; $i < count($senRes); $i++) {
                            echo '<tr>';
                            echo '<td>' . $senRes[$i]['Amministratore'] . '</td>';
                            echo '<td>' . $senRes[$i]['DataSegnalazione'] . '</td>';
                            echo '<td>'  . $senRes[$i]['Note'] . '</td>';
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