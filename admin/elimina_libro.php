<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');


$cartaCon = new CartaceoController();
$codice = $_GET['Cod'];
$titolo = $_GET['Titolo'];
$autore = $_GET['Autore'];
$genere = $_GET['Genere'];
$anno = $_GET['AnnoPubblicazione'];
$edizione = $_GET['Edizione'];
$pagine = $_GET['Pagine'];
$conservazione = $_GET['StatoConservazione'];
$scaffale = $_GET['Scaffale'];

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
                    <th>Autore</th>
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
                   $cartaCon->deleteCartaceo($codice);                    

                    echo '<td>' . $codice . '</td>';
                    echo '<td>' . $titolo . '</td>';
                    echo '<td>' . $autore . '</td>';
                    echo '<td>' . $genere. '</td>';
                    echo '<td>' . $anno . '</td>';
                    echo '<td>'  . $edizione . '</td>';
                    echo '<td>'  . $pagine . '</td>';
                    echo '<td>'  . $conservazione. '</td>';
                    echo '<td>'  . $scaffale. '</td>';
            
                
                ?>

                

                   
            </tbody>
        </table>
        <div style='text-align:right'>
        <br><br>
        <a href = '/ebiblio/admin/libro_admin.php' >Indietro</a>
        </div>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>