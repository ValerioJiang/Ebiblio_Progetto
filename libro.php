<?php
session_start();
include('/xampp/htdocs/ebiblio/main_partials/menu.php');

$cartaCon = new CartaceoController();
$carta_res = $cartaCon->list();

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
                </tr>
            </thead>
            <tbody>

                <?php


                if (isset($_POST['cartaform_submitted'])) {
                    $tit = trim($_POST['Titolo']);
                    
                    if (ctype_space($tit)||$tit=='') {
                        echo "Titolo libro nullo";
                    } else {
                        $carta_like = $cartaCon->getLikeLibro($tit);
                        if (count($carta_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }
                        for ($i = 0; $i < count($carta_like); $i++) {
                            echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/cartainfo?Titolo=' . $carta_like[$i]['Titolo'] .
                                '&Codice=' . $carta_like[$i]['Titolo'] . '\');"' . '>';
                            echo '<td>' . $carta_like[$i]['Titolo'] . '</td>';
                            echo '<td>' . $carta_like[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  . $carta_like[$i]['Edizione'] . '</td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    for ($i = 0; $i < count($carta_res); $i++) {
                        echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/cartainfo?Titolo=' . $carta_res[$i]['Titolo'] .
                            '&Codice=' . $carta_res[$i]['Titolo'] . '\');"' . '>';
                        echo '<td>' . $carta_res[$i]['Titolo'] . '</td>';
                        echo '<td>' . $carta_res[$i]['AnnoPubblicazione'] . '</td>';
                        echo '<td>'  . $carta_res[$i]['Edizione'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>