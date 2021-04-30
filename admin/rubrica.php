<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$utilizzCon = new UtilizzatoreController();
$utilizz_res = $utilizzCon->list();

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col mb-2">
                        <label for="cercaUtilizzId">Ricerca utilizzatore</label>
                        <input type="text" class="form-control" name="cercaUtilizz" id="cercaUtilizzId" aria-describedby="emailHelp" placeholder="Utilizzatore...">
                    </div>
                </div>
            </div>
            <input type="submit" name="utilizz_submitted" class="btn btn-primary" value="Ricerca"></input>

        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Stato</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php   
                if (isset($_POST['utilizz_submitted'])) {
                    $utilizz = trim($_POST['cercaUtilizz']);
                    
                    if (ctype_space($utilizz)||$utilizz=='') {
                        echo "Nessun utente inserito";
                    } else {
                        $utilizz_like = $utilizzCon-> checkEsistenza_Admin($utilizz);
                        if (count($utilizz_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }
                        for ($i = 0; $i < count($utilizz_like); $i++) {
                            echo '<tr ' .
                                '&Codice=' . $utilizz_like[$i]['Email'] . '\');"' . '>';
                            echo '<td>' . $utilizz_like[$i]['Email'] . '</td>';
                            echo '<td>' . $utilizz_like[$i]['Nome'] . '</td>';
                            echo '<td>' . $utilizz_like[$i]['Cognome'] . '</td>';
                            echo '<td>' . $utilizz_like[$i]['Stato'] . '</td>';
                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/invio_messaggio.php?Destinatario='.$utilizz_like[$i]['Email'].'"'.'>Invia un messaggio</a></td>';
                            echo '<td><a class="btn btn-danger" role="button" href="http://localhost/ebiblio/admin/controllo_utente.php?Email='.$utilizz_like[$i]['Email'].' &Nome=' . $utilizz_like[$i]['Nome'] .'&Cognome=' . $utilizz_like[$i]['Cognome'].'&Stato=' . $utilizz_like[$i]['Stato'] .'"'.'>Segnala</a></td>';
                            echo '</tr>';

                          

                        }
                    }
                } else {
                    for ($i = 0; $i < count($utilizz_res); $i++) {
                        echo '<tr ' . $utilizz_res[$i]['Email'] .
                            '&Codice=' . $utilizz_res[$i]['Email'] . '\');"' . '>';
                                             
                        echo '<td>' . $utilizz_res[$i]['Email'] . '</td>';
                        echo '<td>' . $utilizz_res[$i]['Nome'] . '</td>';
                        echo '<td>' . $utilizz_res[$i]['Cognome'] . '</td>';
                        echo '<td>' . $utilizz_res[$i]['Stato'] . '</td>';
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/invio_messaggio.php?Destinatario='.$utilizz_res[$i]['Email'].'"'.'>Invia un messaggio</a></td>';
                        if($utilizz_res[$i]['Stato'] == 'Attivo'){
                            echo '<td><a class="btn btn-danger" role="button" href="http://localhost/ebiblio/admin/segnala_utente.php?Email='.$utilizz_res[$i]['Email'].' &Nome=' . $utilizz_res[$i]['Nome'] .'&Cognome=' .'"'.'>Segnala</a></td>';
                        }else{
                            echo '<td><a class="btn btn-danger" role="button" href="http://localhost/ebiblio/admin/riattiva_utente.php?Email='.$utilizz_res[$i]['Email'].' &Nome=' . $utilizz_res[$i]['Nome'] .'&Cognome=' . $utilizz_res[$i]['Cognome'].'&Stato=' . $utilizz_res[$i]['Stato'] .'"'.'>Riattiva Utente</a></td>';

                        }
                        echo '</tr>';

                     }
                 }
                ?>


                   
            </tbody>
        </table>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>