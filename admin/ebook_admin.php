<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$ebookCon = new EbookController();
$ebook_res = $ebookCon->list();

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
                    <th>Codice Ebook</th>
                    <th>Titolo</th>
                    <th>Genere</th>
                    <th>Anno di pubblicazione</th>
                    <th>Edizione</th>
                    <th>Dimensione</th>
                    <th></th>



                </tr>
            </thead>
            <tbody>

                <?php

                if (isset($_POST['cartaform_submitted'])) {
                    $titolotrim = trim($_POST['Titolo']);

                    if (ctype_space($titolotrim)||$titolotrim=='') {
                        echo "Titolo libro nullo";
                    } else {
                        $ebook_like = $ebookCon->getLikeEbook($titolotrim);
                        if (count($ebook_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }

                        for ($i = 0; $i < count($ebook_like); $i++) {
                            echo '<tr ' . $ebook_like[$i]['Titolo'] .
                            '&Codice=' .  $ebook_like[$i]['Titolo'] . '\');"' . '>';
                            
                            echo '<td>' .  $ebook_like[$i]['Codice'] . '</td>';
                            echo '<td>' .  $ebook_like[$i]['Titolo'] . '</td>';
                            echo '<td>' .  $ebook_like[$i]['Genere'] . '</td>';
                            echo '<td>' .  $ebook_like[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  .  $ebook_like[$i]['Edizione'] . '</td>';
                            echo '<td>'  . $ebook_like[$i]['Dimensione'] . '</td>';

                            echo '<td><a class="btn btn-danger" role="button" href="http://localhost/ebiblio/admin/elimina_ebook.php?Titolo=' . $ebook_like[$i]['Titolo'] . '&Cod='. $ebook_like[$i]['Codice'] . '&Genere=' . $ebook_like[$i]['Genere'] .'&AnnoPubblicazione=' . $ebook_like[$i]['AnnoPubblicazione'] . '&Edizione=' . $ebook_like[$i]['Edizione'] .'&Pagine=' . $ebook_like[$i]['Dimensione'] . '"'.'>Elimina</a></td>';
    
                        }
                    }
                } else {
                    for ($i = 0; $i < count($ebook_res); $i++) {
                        echo '<tr ' . $ebook_res[$i]['Titolo'] .
                            '&Codice=' . $ebook_res[$i]['Titolo'] . '\');"' . '>';
                            
                        echo '<td>' . $ebook_res[$i]['Codice'] . '</td>';
                        echo '<td>' . $ebook_res[$i]['Titolo'] . '</td>';
                        echo '<td>' . $ebook_res[$i]['Genere'] . '</td>';
                        echo '<td>' . $ebook_res[$i]['AnnoPubblicazione'] . '</td>';
                        echo '<td>'  . $ebook_res[$i]['Edizione'] . '</td>';
                        echo '<td>'  . $ebook_res[$i]['Dimensione'] . '</td>';
                
                        echo '<td><a class="btn btn-danger" role="button" href="http://localhost/ebiblio/admin/elimina_ebook.php?Titolo=' . $ebook_res[$i]['Titolo'] . '&Cod='. $ebook_res[$i]['Codice'] . '&Genere=' . $ebook_res[$i]['Genere'] .'&AnnoPubblicazione=' . $ebook_res[$i]['AnnoPubblicazione'] . '&Edizione=' . $ebook_res[$i]['Edizione'] .'&Pagine=' . $ebook_res[$i]['Dimensione'] . '"'.'>Elimina</a></td>';

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