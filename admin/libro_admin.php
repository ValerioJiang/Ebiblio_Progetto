<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$cartaCon = new CartaceoController();
$carta_res = $cartaCon->list_admin($_SESSION['email']);

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
            <a name="nuovabiblio" class="btn btn-primary" href="/Ebiblio/admin/nuovo_libro.php">Aggiungi</a>
            
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
                        $carta_like = $cartaCon->getLikeLibro($titolotrim,$_SESSION['email']);
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

                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/modifica_libro.php?Titolo=' . $carta_like[$i]['Titolo'] . '&Cod='. $carta_like[$i]['Codice'] . '&Genere=' . $carta_like[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_like[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_like[$i]['Edizione'] .'&Pagine=' . $carta_like[$i]['NumeroPagine'] . '&Scaffale=' . $carta_like[$i]['Scaffale'].'"'.'>Modifica</a></td>';
                            echo '<td><a class="btn btn btn-danger" role="button" href="http://localhost/ebiblio/admin/elimina_libro.php?Titolo=' . $carta_like[$i]['Titolo'] .  '&Cod='. $carta_like[$i]['Codice'] . '&Genere=' . $carta_like[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_like[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_like[$i]['Edizione'] .'&Pagine=' . $carta_like[$i]['NumeroPagine'] . '&Scaffale=' . $carta_like[$i]['Scaffale'].'"'.'>Elimina</a></td>';
    
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
                        
                
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/modifica_libro.php?Titolo=' . $carta_res[$i]['Titolo'] .  '&Cod='. $carta_res[$i]['Codice'] . '&Genere=' . $carta_res[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_res[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_res[$i]['Edizione'] .'&Pagine=' . $carta_res[$i]['NumeroPagine'] . '&Scaffale=' . $carta_res[$i]['Scaffale'].'"'.'>Modifica</a></td>';
                        echo '<td><a class="btn btn-danger"role="button" href="http://localhost/ebiblio/admin/elimina_libro.php?Titolo=' . $carta_res[$i]['Titolo'] . '&Cod='. $carta_res[$i]['Codice'] . '&Genere=' . $carta_res[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_res[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_res[$i]['Edizione'] .'&Pagine=' . $carta_res[$i]['NumeroPagine'] . '&Scaffale=' . $carta_res[$i]['Scaffale'].' &StatoConservazione=' . $carta_res[$i]['StatoConservazione'] . '"'.'>Elimina</a></td>';

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