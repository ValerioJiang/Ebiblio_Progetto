<?php


require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$consegnaCon = new ConsegnaController();
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
          <h5>Volontari	che	hanno effettuato più consegne</h5> 

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
    </div>
  </div>

  <?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>