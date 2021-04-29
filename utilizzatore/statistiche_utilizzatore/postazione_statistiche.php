<?php


require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');


$bibliotecaCon = new BibliotecaController();
$postoCon = new PostoLetturaController();
$prenotazioneCon = new PrenotazionePostoLetturaController();



?>


<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">


  <div class="container" style="background-color: white;">
    <br>
        <div class="container">
          <h2>Classifiche</h2>
          </br>
          </br>
          <h5>Classifica posti lettura più usati</h5> 

         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Biblioteca</th>
                <th>Posti totali</th>
                <th>Percentuale posti usati</th>

                <?php
               $biblioteca_res = $bibliotecaCon->list();
               $denominatore_res = $postoCon->getDenominatoreStatistica();


                for ($i = 0; $i < count($biblioteca_res); $i++) {
                    $prenotazione_res=$prenotazioneCon->createStatisticaPosto( $denominatore_res[$i]['den'],$biblioteca_res[$i]['Nome']);
                   echo '<tr>';
                  echo '<td>' . $biblioteca_res[$i]['Nome'] . '</td>';
                  echo '<td>' . $denominatore_res[$i]['den'] . '</td>';
                  echo '<td>' . $prenotazione_res[$i]['percentuale'] . '%</td>';
                  echo '</tr>';
                }
              
              ?>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>





    </div>
  </div>

  <?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>