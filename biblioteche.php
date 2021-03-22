<?php
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
?>

<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">


  <div class="container" style="background-color: white;">
    <br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Biblioteca</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1">Libro</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2">Ebook</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <div class="container">
          <h2>Ricerca</h2>
          </br>
          <p>Cerca una biblioteca</p>
          <input type="text" placeholder="Biblioteca...">
          <button type="button" class="btn btn-outline-danger" href ="#">Cerca</button> <!--cambiare size del bottone-->
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

              $biblioCon = new BibliotecaController();
              $res = $biblioCon->list();
              $param_biblio_info = '?Nome=';

              for ($i = 0; $i < count($res); $i++) {
                echo '<tr ' . 'onclick="window.location.assign(\'http://localhost/ebiblio/biblioinfo?Nome='.$res[$i]['Nome'].'\');"'.'>';
                echo '<td>' . $res[$i]['Nome'] . '</td>';
                echo '<td>'  .$res[$i]['Indirizzo'] . '</td>';
                echo '</tr>';
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
      <div id="menu1" class="container tab-pane fade"><br>
        <h3>Menu 1</h3>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      <div id="menu2" class="container tab-pane fade"><br>
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
    </div>
  </div>

  <?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>