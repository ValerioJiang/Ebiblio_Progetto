<?php

    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');


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
            <input type="submit" name="ebookform_submitted" class="btn btn-primary" value="Ricerca"></input>
            <a name="nuovabiblio" class="btn btn-primary" href="/Ebiblio/admin/nuovo_ebook.php">Aggiungi</a>

        </form>

            
        </br>
        </br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Anno Pubblicazione</th>
                    <th>Edizione</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php


                if (isset($_POST['ebookform_submitted'])) {
                    $tit = trim($_POST['Titolo']);
                    
                    if (ctype_space($tit)||$tit=='') {
                        echo "Titolo libro nullo";
                    } else {
                        $ebook_like = $ebookCon->getLikeEbook($tit);
                        if (count($ebook_like) <= 0) {
                            echo "Nessun risultato corrispondente";
                        }
                        for ($i = 0; $i < count($ebook_like); $i++) {
                            echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/libro_prenot/libroinfo.php?Titolo=' . $ebook_like[$i]['Titolo'] .
                                '&codLibro=' . $ebook_like[$i]['Codice'] . '\');"' . '>';
                            echo '<td>' . $ebook_like[$i]['Titolo'] . '</td>';
                            echo '<td>' . $ebook_like[$i]['AnnoPubblicazione'] . '</td>';
                            echo '<td>'  . $ebook_like[$i]['Edizione'] . '</td>';
                            echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/modifica_libro.php?Titolo=' . $carta_like[$i]['Titolo'] . '&Cod='. $carta_like[$i]['Codice'] . '&Genere=' . $carta_like[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_like[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_like[$i]['Edizione'] .'&Pagine=' . $carta_like[$i]['NumeroPagine'] . '&Scaffale=' . $carta_like[$i]['Scaffale'].'"'.'>Modifica</a></td>';
                            echo '<td><a class="btn btn btn-danger" role="button" href="http://localhost/ebiblio/admin/elimina_libro.php?Titolo=' . $carta_like[$i]['Titolo'] .  '&Cod='. $carta_like[$i]['Codice'] . '&Genere=' . $carta_like[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_like[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_like[$i]['Edizione'] .'&Pagine=' . $carta_like[$i]['NumeroPagine'] . '&Scaffale=' . $carta_like[$i]['Scaffale'].'"'.'>Elimina</a></td>';
                            echo '</tr>';
                        }
                    }
                } 
                else {
                    for ($i = 0; $i < count($ebook_res); $i++) {
                        echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/libro_prenot/libroinfo.php?Titolo=' . $ebook_res[$i]['Titolo'] .
                            '&codLibro=' . $ebook_res[$i]['Codice'] . '\');"' . '>';
                        echo '<td>' . $ebook_res[$i]['Titolo'] . '</td>';
                        echo '<td>' . $ebook_res[$i]['AnnoPubblicazione'] . '</td>';
                        echo '<td>'  . $ebook_res[$i]['Edizione'] . '</td>';
                        
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/admin/modifica_libro.php?Titolo=' . $carta_res[$i]['Titolo'] .  '&Cod='. $carta_res[$i]['Codice'] . '&Genere=' . $carta_res[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_res[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_res[$i]['Edizione'] .'&Pagine=' . $carta_res[$i]['NumeroPagine'] . '&Scaffale=' . $carta_res[$i]['Scaffale'].'"'.'>Modifica</a></td>';
                        echo '<td><a class="btn btn-danger"role="button" href="http://localhost/ebiblio/admin/elimina_libro.php?Titolo=' . $carta_res[$i]['Titolo'] . '&Cod='. $carta_res[$i]['Codice'] . '&Genere=' . $carta_res[$i]['Genere'] .'&AnnoPubblicazione=' . $carta_res[$i]['AnnoPubblicazione'] . '&Edizione=' . $carta_res[$i]['Edizione'] .'&Pagine=' . $carta_res[$i]['NumeroPagine'] . '&Scaffale=' . $carta_res[$i]['Scaffale'].' &StatoConservazione=' . $carta_res[$i]['StatoConservazione'] . '"'.'>Elimina</a></td>';
                        echo '</tr>';
                    }
                }

                ?>

            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
?>