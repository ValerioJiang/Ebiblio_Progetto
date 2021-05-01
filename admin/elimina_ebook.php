<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');


$ebookCon = new EbookController();
$codice = $_GET['Cod'];
$titolo = $_GET['Titolo'];
$genere = $_GET['Genere'];
$anno = $_GET['AnnoPubblicazione'];
$edizione = $_GET['Edizione'];
$pagine = $_GET['Pagine'];
;

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col mb-2">
                      <h2> Elimina libro</h2>
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        <table class="table table-hover">
            <thead>

            <h6>Il seguente libro è stato eliminato:<h6>
        
                <tr>
                    <th>Codice libro</th>
                    <th>Titolo</th>
                    <th>Genere</th>
                    <th>Anno di pubblicazione</th>
                    <th>Edizione</th>
                    <th>Dimensione</th>
                   
                </tr>
            </thead>
            <tbody>

                <?php
                   $ebookCon->deleteEbook($codice);                    

                    echo '<td>' . $codice . '</td>';
                    echo '<td>' . $titolo . '</td>';
                    echo '<td>' . $genere. '</td>';
                    echo '<td>' . $anno . '</td>';
                    echo '<td>'  . $edizione . '</td>';
                    echo '<td>'  . $pagine . '</td>';
                    $path = "C:\\xampp\\htdocs\\Ebiblio\\pdf_ebook\\".$titolo;
                    unlink(realpath($path));
                
                ?>
         
            </tbody>
        </table>
        <div style='text-align:right'>
        <br><br>
        <a href = '/ebiblio/admin/ebook_admin.php' >Indietro</a>
        </div>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>