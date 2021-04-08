<?php
//session_start();
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$posto_con = new PostoLetturaController();
$nomeBiblio = $_GET['NomeBiblio'];

$prenot_con = new PrenotazionePostoLetturaController();


?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
      <h3 class="mb-5">Data prenotazione</h3>
      <form method="GET">
        <?php echo "<input type='hidden' name='NomeBiblio' value ='$nomeBiblio'>"; ?>
        <input id="datepicker" type="date" name="datePicker" min=<?php $currdate = date("Y-m-d");
        echo date("Y-m-d"); ?> max=<?php echo date("Y-m-d", strtotime($currdate . ' + 14 days')); ?> width="100%" />
        </br>
        </br>
        
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value="9:00:00">9:00-12:00
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value="12:00:00">12:00-15:00
          </label>
        </div>
        <div class="form-check-inline disabled">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value="15:00:00">15:00-18:00
          </label>
        </div>
       
        </br>
        </br>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradioPrc" value=true>Presa corrente
          </label>
        </div>
        <div class="form-check-inline disabled">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradioPre" value=true>Presa Ethernet
          </label>
        </div>
        </br>
        </br>
        <input type="submit" name="datepick_submit" class="btn btn-primary" value="Ricerca"></input>
        </br>
        </br>
      </form>

      <table class="table table-hover">
        <thead>
          <tr>
            <th>Numero</th>
            <th>Presa Ethernet</th>
            <th>Presa Corrente</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['NomeBiblio'])) {
            if (isset($_GET['datepick_submit'])) {
              if (isset($_GET['datePicker'])) {
                if (isset($_GET['optradio'])) {
                  $posto_res = $posto_con->getPostoLettura( $nomeBiblio,  $_GET['datePicker'], "", "", $_GET['optradio']);
                  if (isset($_GET['optradioPre']) && isset($_GET['optradioPrc'])) {
                    $posto_res = $posto_con->getPostoLettura($nomeBiblio, $_GET['datePicker'], true, true, $_GET['optradio']);
                    for ($i = 0; $i < count($posto_res); $i++) {
                      echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?Prenotazione=' . $posto_res[$i]['Numero'] .
                        '&NomeBiblio=' .$nomeBiblio . '&oraInizio='.$_GET['optradio'].'&data='. $_GET['datePicker'] .
                        '\');"' . '>';
                      echo '<td>' . $posto_res[$i]['Numero'] . '</td>';

                      if ($posto_res[$i]['ReteEthernet'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['ReteEthernet'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }


                      if ($posto_res[$i]['PresaCorrente'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['PresaCorrente'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }
                    }
                  }
                  else if (isset($_GET['optradioPrc'])) {
                    $posto_res = $posto_con->getPostoLettura($nomeBiblio, $_GET['datePicker'], true, "", $_GET['optradio']);
                    for ($i = 0; $i < count($posto_res); $i++) {
                      echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?NomeBiblio=' . $nomeBiblio . '&Prenotazione=' . $posto_res[$i]['Numero'] .
                        '&NomeBiblio=' . $nomeBiblio .'&oraInizio='.$_GET['optradio']. '&data='. $_GET['datePicker'] .
                        '\');"' . '>';
                      echo '<td>' . $posto_res[$i]['Numero'] . '</td>';

                      if ($posto_res[$i]['ReteEthernet'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['ReteEthernet'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }


                      if ($posto_res[$i]['PresaCorrente'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['PresaCorrente'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }
                    }
                  } else if (isset($_GET['optradioPre'])) {
                    $posto_res = $posto_con->getPostoLettura($nomeBiblio, $_GET['datePicker'], "", true, $_GET['optradio']);
                    for ($i = 0; $i < count($posto_res); $i++) {
                      echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?NomeBiblio=' . $nomeBiblio . '&Prenotazione=' . $posto_res[$i]['Numero'] .
                        '&NomeBiblio=' . $nomeBiblio . '&oraInizio='.$_GET['optradio'] . '&data='. $_GET['datePicker'] .
                        '\');"' . '>';
                      echo '<td>' . $posto_res[$i]['Numero'] . '</td>';

                      if ($posto_res[$i]['ReteEthernet'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['ReteEthernet'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }


                      if ($posto_res[$i]['PresaCorrente'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['PresaCorrente'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }
                    }
                  } 
                  else {

                    for ($i = 0; $i < count($posto_res); $i++) {
                      echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/prenot_posto_let/posto_scelta.php?Prenotazione=' . $posto_res[$i]['Numero'] .
                      "&NomeBiblio=" .$nomeBiblio. '&oraInizio='.$_GET['optradio']. '&data='. $_GET['datePicker'] .'\');"' . '>';
                      echo '<td>' . $posto_res[$i]['Numero'] . '</td>';

                      if ($posto_res[$i]['ReteEthernet'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['ReteEthernet'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }


                      if ($posto_res[$i]['PresaCorrente'] == "1") {
                        echo '<td>'  . 'Presente' . '</td>';
                      } else if ($posto_res[$i]['PresaCorrente'] == "0") {
                        echo '<td>'  . 'Non Presente' . '</td>';
                      } else {
                        echo '<td>'  . 'Dato non disponibile' . '</td>';
                      }
                    }
                  }
                } else {
                  echo "Scegliere fascia oraria";
                }
              } else {
                echo "Scegliere data";
              }
            }
          }

          if(isset($_GET['Prenotazione'])){
            $prenot_res = $prenot_con -> createPrenotazione($_GET['Prenotazione'],$_GET['NomeBiblio'], $_GET['data'] ,$_GET['oraInizio']);
            
          }


          ?>

        </tbody>
      </table>

    </div>

  </div>
</div>

<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>