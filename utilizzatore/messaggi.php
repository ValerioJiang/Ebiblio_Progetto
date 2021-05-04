<?php

require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$mesCon = new MessaggioController();
?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
    <h2>Messaggi dai amministratori</h2>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Da</th>
                    <th>Data messaggio</th>
                    <th>Titolo</th>
                    <th>Testo</th>
                </tr>
            </thead>
            <tbody>

                <?php

                        $mesRes = $mesCon -> getMsgUtil($_SESSION['email']);
            
                        for ($i = 0; $i < count($mesRes); $i++) {
                            echo '<tr>';
                            echo '<td>' . $mesRes[$i]['Amministratore'] . '</td>';
                            echo '<td>' . $mesRes[$i]['DataInvio'] . '</td>';
                            echo '<td>'  . $mesRes[$i]['Titolo'] . '</td>';
                            echo '<td>'  . $mesRes[$i]['Testo'] . '</td>';
                        }
                
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
  require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>