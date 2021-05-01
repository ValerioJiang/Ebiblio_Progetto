<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');


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
                  
               $biblio_res = $bibliotecaCon->list();

                  for ($i = 0; $i < count($biblio_res); $i++) {
                    $denominatore_res = $postoCon->getDenominatoreStatistica();                  
                  }
                
                  $prenotazione_res=$prenotazioneCon->createStatisticaPosto( $denominatore_res[0]['den'],$denominatore_res[0]['Biblioteca']);

                  for($i = 0; $i < count($prenotazione_res); $i++) {

                    echo '<tr>';   
                    echo '<td>' . $prenotazione_res[$i]['Biblioteca'] . '</td>';
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