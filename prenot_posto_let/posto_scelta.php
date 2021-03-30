<?php
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$posto_con = new PostoLetturaController();
$nomeBiblio = $_GET['NomeBiblio'];
$posto_res = $posto_con->getPostoLettura($nomeBiblio);
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
            <input type="radio" class="form-check-input" name="optradio" value="9:00:00">9:00-13:00
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value="13:00:00">13:00-16:00
          </label>
        </div>
        <div class="form-check-inline disabled">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value="16:00:00">16:00-19:00
          </label>
        </div>
        </br>
        </br>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradioPrc" value="true">Presa corrente
          </label>
        </div>
        <div class="form-check-inline disabled">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradioPre" value="true">Presa Ethernet
          </label>
        </div>
        </br>
        </br>
        <input type="submit" name="datepick_submit" class="btn btn-primary" value="Ricerca"></input>
        </br>
        </br>
      </form>
      <?php
      echo $nomeBiblio;
      if(isset($_GET['datePicker'])){
        echo $_GET['datePicker'];
      }
      
      if(isset($_GET['optradio'])){
        echo $_GET['optradio'];
      }
      
      if(isset($_GET['optradioPrc'])){
        echo $_GET['optradioPrc'];
      }
      if(isset($_GET['optradioPre'])){
        echo $_GET['optradioPre'];
      }
      ?>

    </div>

  </div>
</div>

<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>