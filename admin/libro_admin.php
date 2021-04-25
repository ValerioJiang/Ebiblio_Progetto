<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
/*
$cartaCon = new CartaceoController();
$carta_res = $cartaCon->list();
$raccoltaCon = new RaccoltaController();
$raccolta_res = $raccoltaCon ->list('amministratore@email.it');//da inserire valore passato con  sessione
*/
$cartaCon = new CartaceoController();
$carta_res = $cartaCon->list('amministratore@gmail.com')//da inserire valore passato con  sessione

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col mb-2">
                        <label for="titoloId">Titolo</label>
                        <input type="text" class="form-control" name="Titolo" id="titoloId" aria-describedby="emailHelp" placeholder="Inserire Titolo Libro">
                    </div>
                </div>
            </div>
            <input type="submit" name="cartaform_submitted" class="btn btn-primary" value="Ricerca"></input>
            <input  type="button" name="nuovabiblio" class="btn btn-primary" value="Aggiungi" onclick="window.open('/Ebiblio/admin/nuovo_libro.php')"/>

        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Codice libro</th>
                    <th>Titolo</th>
                    <th>Genere</th>
                    <th>Anno di pubblicazione</th>
                    <th>Edizione</th>
                    <th>Num.Pagine</th>
                    <th>Stato Conservazione</th>
                    <th>Scaffale</th>




                </tr>
            </thead>
            <tbody>

                <?php
                
                if (isset($_POST['cartaform_submitted'])) {
                    $titolotrim = trim($_POST['Titolo']);
                    
                    if (ctype_space($titolotrim)||$titolotrim=='') {
                        echo "Titolo libro nullo";
                    } else {
                        $carta_like = $cartaCon->getLikeLibro($titolotrim,"amministratore@gmail.com");//per ora vslore inserito manualmente(da fare con valore passato da session)
                        if (count($carta_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }

                        for ($i = 0; $i < count($carta_like); $i++) {
                            echo '<tr ' . $carta_like[$i]['Titolo'] .
                            '&Codice=' .  $carta_like[$i]['Titolo'] . '\');"' . '>';
                            
                            echo '<td>' .  $carta_like[$i]['Codice'] . '</td>';
                            echo '<td>' .  $carta_like[$i]['Titolo'] . '</td>';
                            echo '<td>' .  $carta_like[$i]['Genere'] . '</td>';
                            echo '<td>' .  $carta_like[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  .  $carta_like[$i]['Edizione'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['NumeroPagine'] . '</td>';
                            echo '<td>'  .  $carta_like[$i]['StatoConservazione'] . '</td>';
                            echo '<td>'  .  $carta_like[$i]['Scaffale'] . '</td>';

                            echo '<td>'.'<input type="button" name="updateform_submitted" class="btn btn-primary" value="Modifica" onclick="window.location.assign(\'/Ebiblio/admin/modifica_libro.php\')" </input>'.'</td>';
                            echo'<td>'.'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> Elimina</button>'.'</td>';
    
                        }
                    }
                } else {
                    for ($i = 0; $i < count($carta_res); $i++) {
                        echo '<tr ' . $carta_res[$i]['Titolo'] .
                            '&Codice=' . $carta_res[$i]['Titolo'] . '\');"' . '>';
                            
                        echo '<td>' . $carta_res[$i]['Codice'] . '</td>';
                        echo '<td>' . $carta_res[$i]['Titolo'] . '</td>';
                        echo '<td>' . $carta_res[$i]['Genere'] . '</td>';
                        echo '<td>' . $carta_res[$i]['AnnoPubblicazione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['Edizione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['NumeroPagine'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['StatoConservazione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['Scaffale'] . '</td>';

                        echo '<td>'.'<input type="button" name="updateform_submitted" class="btn btn-primary" value="Modifica" onclick="window.location.assign(\'/Ebiblio/admin/modifica_libro.php\')" </input>'.'</td>';
                        echo'<td>'.'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> Elimina</button>'.'</td>';

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