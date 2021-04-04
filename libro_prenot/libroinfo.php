<?php
session_start();
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$rac_con = new RaccoltaController();



?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
      <h3 class="mb-5">Scegliere Biblioteca dove disponibile <?php echo '\'' . $_GET['Titolo'] . '\'' ?></h3>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Biblioteca</th>
            <th>Stato Conservazione</th>
            <th>Disponilità</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $rac_res = $rac_con -> getRaccolta($_GET['codLibro']);

          for ($i = 0; $i < count($rac_res); $i++) {
            echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/libro_prenot/libroinfo.php?prenLibro=true&Titolo=' . $_GET['Titolo'] .
              '&codLibro=' . $rac_res[$i]['Biblioteca'] . '\');"' . '>';
            echo '<td>' . $rac_res[$i]['Biblioteca'] . '</td>';
            echo '<td>' . $rac_res[$i]['StatoConservazione'] . '</td>';
            echo '<td>' . $rac_res[$i]['StatoDisponibilita'] . '</td>';
            echo '</tr>';
          }


          if(isset($_GET['prenLibro'])){
            
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