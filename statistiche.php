<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');

$consegnaCon = new ConsegnaController();
$prestitoCon = new PrestitoController();
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
          <h5>Volontari	che	hanno	effettuato	più	consegne</h5> 

             <!--Classifica consegna volontario-->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Consegne effettuate</th>

                <?php
                $consegna_res= $consegnaCon->getClassificaConsegna();

                for ($i = 0; $i < count($consegna_res); $i++) {
                   // echo '<tr ' . '&Codice=' . $consegna_res[$i]['Nome'] . '\');"' . '>';
                   echo '<tr>';
                  echo '<td>' . $consegna_res[$i]['nome'] . '</td>';
                  echo '<td>' . $consegna_res[$i]['cognome'] . '</td>';
                  echo '<td>' . $consegna_res[$i]['Tot.Consegne'] . '</td>';
                  echo '</tr>';
                }
              
              ?>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <br><br><br>
          <h5>Classifica libri più richiesti in prestito</h5> 
          <table class="table table-hover">
            <thead>
              <tr>
              <th>Titolo</th>
                <th>Autore</th>
                <th>Edizione</th>
                <th>Genere</th>
                <th>Numero Pagine</th>
                <th>Biblioteca</th>
                <th>Prestiti totali</th>

                <?php
                $prestito_res= $prestitoCon->getClassificaPrestito();
    
                for ($i = 0; $i < count($prestito_res); $i++) {
                   
                  echo '<td>' . $prestito_res[$i]['Titolo'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['Autore'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['Edizione'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['Genere'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['NumeroPagine'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['Biblioteca'] . '</td>';
                  echo '<td>' . $prestito_res[$i]['Tot.Prestiti'] . '</td>';
                  echo '</tr>';
                }
              
              ?>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>


            <br><br><br>

          <h5>Classifica posti lettura più usati</h5> 
          <table class="table table-hover">
            <thead>
              <tr>
              <th>Biblioteca</th>
                <th>Posti totali</th>
                <th>Percentuale posti utilizzati</th>

                <?php
                  $biblioteca_res = $bibliotecaCon->list();
                  $denominatore_res = $postoCon->getDenominatoreStatistica();

                  $prenotazione_res;
                  for ($i = 0; $i < count($biblioteca_res); $i++) {
                    $prenotazione_res=$prenotazioneCon->createStatisticaPosto( $denominatore_res[$i]['den'],$biblioteca_res[$i]['Nome']);

                    echo '<td>' . $biblioteca_res[$i]['Nome'] . '</td>';
                    echo '<td>' . $denominatore_res[$i]['den'] . '</td>';
                    echo '<td>' . $prenotazione_res[$i]['percentuale'] . '</td>';                   
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