<?php
include('./main_partials/menu.php')
?>

<div class="container-fluid " style="  
background: url('./images/bibliofull.jpg') no-repeat  ;

">
  <div class="row justify-content-center">
    <div class="card" style="width: 60%;">
      <div class="card-body p-5 align-self-center">
        <h1 class="font-weight-light">Benvenuti in Ebiblio</h1>
        <p class="lead">Il sistema di gestione biblioteche ufficiale UNIBO!</p>
        Nella sezione Biblioteche si potrà consultare:
        <ul>
          <li>Ricerca e informazione sulle biblioteche</li>
          <li>Ricerca e prenotazione posti lettura</li>
          <li>Ricerca Libri cartacei</li>
          <li>Ricerca Ebook</li>
        </ul>
        <div id="demo" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="http:\ebiblio\images\Biblioteca Universitaria di Bologna\1.jpeg" alt="Los Angeles" width="1100" height="500">
            </div>
            <div class="carousel-item">
              <img src="http:\ebiblio\images\Biblioteca Universitaria di Bologna\2.jpg" alt="Chicago" width="1100" height="500">
            </div>
            <div class="carousel-item">
              <img src="http:\ebiblio\images\Biblioteca Universitaria di Bologna\3.jpeg" alt="New York" width="1100" height="500">
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
      </div>

    </div>

  </div>

</div>







<?php
include('./main_partials/footer.php');
?>