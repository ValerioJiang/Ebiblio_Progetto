
<?php


include('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');

$accessoCon = new EbookController();
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
          <h5>Classifica ebook con più accessi</h5> 

         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Titolo</th>
                <th>Edizione</th>
                <th>Genere</th>
                <th>Accessi totali</th>

                <?php
                   $accesso_res= $accessoCon->getClassificaEbook();
              

                  for ($i = 0; $i < count($accesso_res); $i++) {
                    echo '<tr>';
                    echo '<td>' . $accesso_res[$i]['Titolo'] . '</td>';
                    echo '<td>' . $accesso_res[$i]['Edizione'] . '</td>';
                    echo '<td>' . $accesso_res[$i]['Genere'] . '</td>';
                    echo '<td>' . $accesso_res[$i]['NumAccessi'] . '</td>';

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