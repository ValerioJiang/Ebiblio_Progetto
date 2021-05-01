
<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');

$prestitoCon = new PrestitoController();
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
          <h5>Classifica libri più richiesti in prestito</h5> 

         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Titolo</th>
                <th>Edizione</th>
                <th>Genere</th>
                <th>Numero pagine</th>
                <th>Biblioteca</th>
                <th>Prestiti totali</th>

                <?php
                   $prestito_res= $prestitoCon->getClassificaPrestito();


                  for ($i = 0; $i < count($prestito_res); $i++) {
                    echo '<tr>';
                    echo '<td>' . $prestito_res[$i]['Titolo'] . '</td>';
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

    </div>
  </div>

  <?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>