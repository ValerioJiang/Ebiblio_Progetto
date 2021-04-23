<?php

session_start();

require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$biblioCon = new BibliotecaController();

$cartaCon = new CartaceoController();
$carta_res = $cartaCon -> list();


?>

<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">


  <div class="container" style="background-color: white;">
    <br>
        <div class="container">
          <h2>Scegliere Biblioteca dove prenotare posto lettura</h2>
          </br>
          <form action="" method="POST">
            <div class="form-group">
              <label for="nomeId">Nome</label>
              <input type="text" class="form-control" name="Nome" id="nomeId" aria-describedby="emailHelp" placeholder="Inserire nome biblioteca">
            </div>
            <input type="submit" name="biblioform_submitted" class="btn btn-primary" value="Ricerca"></input>
          </form>
          </br>
          </br>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Indirizzo</th>
              </tr>
            </thead>
            <tbody>

              <?php

              if (isset($_POST['biblioform_submitted'])) {
                $nometrim = trim($_POST['Nome']);
                if (ctype_space($nometrim)||$nometrim=='') {
                  echo "Nome ricerca biblioteca vuoto";
                } else {
                  $res = $biblioCon->getLikeBiblioteca($_POST['Nome']);
                  if (count($res) <= 0) {
                    echo "Nessun risultato corrispondente";
                  }
                  for ($i = 0; $i < count($res); $i++) {
                    echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?NomeBiblio=' . $res[$i]['Nome'] . '\');"' . '>';
                    echo '<td>' . $res[$i]['Nome'] . '</td>';
                    echo '<td>'  . $res[$i]['Indirizzo'] . '</td>';
                    echo '</tr>';
                  }
                }
              } else {

                $res = $biblioCon->list();
                $param_biblio_info = '?Nome=';

                for ($i = 0; $i < count($res); $i++) {
                  echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?NomeBiblio=' . $res[$i]['Nome'] .'\');"' . '>';
                  echo '<td>' . $res[$i]['Nome'] . '</td>';
                  echo '<td>'  . $res[$i]['Indirizzo'] . '</td>';
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