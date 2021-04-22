<?php

 /*On page1
$_SESSION['varname'] = $var_value;

//On page 2
$var_value = $_SESSION['varname'];*/


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
                            echo '<td>' . $utilizz_like[$i]['Nome'] . '</td>';
                            echo '<td>' . $utilizz_like[$i]['Cognome'] . '</td>';
                            echo '<td>' . $utilizz_like[$i]['Stato'] . '</td>';
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
                        //echo '<td>'  . $carta_res[$i]['Edizione'] . '</td>';
                        //echo '<td>'.'<input type="button" name="updateform_submitted" class="btn btn-primary" value="Modifica" onclick="window.location.assign(\'/Ebiblio/admin/modifica_libro.php\')" </input>'.'</td>';
                        //echo'<td>'.'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> Elimina</button>'.'</td>';

                        echo '</tr>';

                     }
                 }
                ?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Attenzione!</h5>
                        
                        </div>
                        <div class="modal-body">
                        Sicuro di voler eliminare questo libro?
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id ="eliminare" class="btn btn-danger">Elimina</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Indietro</button>
                            <?php
                            if(isset($_POST['eliminare'])){
                                $query = " DELETE FROM cartaceo WHERE codice = $Codice and LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%') and LOWER(Edizione) LIKE CONCAT"."('%',LOWER('$Edizione'),'%') and LOWER(Genere) LIKE CONCAT"."('%',LOWER('$Genere'),'%') and annopubblicazione = $AnnoPubblicazione";    
                                $stmt = Dbh::getInstance()
                                ->getDb()
                                ->prepare($query);
                                $stmt-> execute();
                                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            }
                    
                ?>
                        </div>
                        </div>
                    </div>
                </div>

                   
            </tbody>
        </table>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>