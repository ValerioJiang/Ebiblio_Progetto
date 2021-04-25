<?php
require_once('/xampp/htdocs/ebiblio/main_partials/menu.php');

$cartaCon = new CartaceoController();
$carta_res = $cartaCon->listUtil();

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
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Anno Pubblicazione</th>
                    <th>Edizione</th>
                    <th>Biblioteca</th>
                    <th>Disponibilita</th>
                    <th>Condizioni</th>
                    <th>Modalita</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php


                if (isset($_POST['cartaform_submitted'])) {
                    $tit = trim($_POST['Titolo']);

                    if (ctype_space($tit) || $tit == '') {
                        echo "Titolo libro nullo";
                    } else {
                        $carta_like = $cartaCon->getLikeLibroUtil($tit);
                        if (count($carta_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }
                        for ($i = 0; $i < count($carta_like); $i++) {
                            echo '<tr>';
                            echo '<td>' . $carta_like[$i]['Titolo'] . '</td>';
                            echo '<td>' . $carta_like[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['Edizione'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['Biblioteca'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['StatoDisponibilita'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['StatoConservazione'] . '</td>';
                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/ritiroLibro.php?codLibro='.$carta_like[$i]['Codice'].'&ritiroLibro=true&Titolo='.$carta_like[$i]['Titolo'].'&nomeBiblio='.$carta_like[$i]['Biblioteca'].'"'.'>Ritiro in biblioteca</a></td>';
                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/consegnaLibro.php?codLibro='.$carta_like[$i]['Codice'].'&consegnaLibro=true&Titolo='.$carta_like[$i]['Titolo'].'&nomeBiblio='.$carta_like[$i]['Biblioteca'].'">Consegna</a></td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    
                    for ($i = 0; $i < count($carta_res); $i++) {
                        echo '<tr>';
                        echo '<td>' . $carta_res[$i]['Titolo'] . '</td>';
                        echo '<td>' . $carta_res[$i]['AnnoPubblicazione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['Edizione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['Biblioteca'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['StatoDisponibilita'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['StatoConservazione'] . '</td>';
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/ritiroLibro.php?codLibro='.$carta_res[$i]['Codice'].'&ritiroLibro=true&Titolo='.$carta_res[$i]['Titolo'].'&nomeBiblio='.$carta_res[$i]['Biblioteca'].'"'.'>Ritiro in biblioteca</a></td>';
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/consegnaLibro.php?codLibro='.$carta_res[$i]['Codice'].'&consegnaLibro=true&Titolo='.$carta_res[$i]['Titolo'].'&nomeBiblio='.$carta_res[$i]['Biblioteca'].'"'.'">Consegna</a></td>';
                        echo '</tr>';
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php
require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>