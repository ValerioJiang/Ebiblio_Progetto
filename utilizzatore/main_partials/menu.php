<?php

require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');

$util_con = new UtilizzatoreController();

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $utili_res = $util_con->checkEsistenza($email, $password);
    //controllo riempimento di tutti i campi:
    $util_checkEsistenza = $util_con->checkEsistenza($email, $password);

    if (count($util_checkEsistenza) == 1) {
        session_start();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['esistenza'] = true;
    } else {
        header("Location: http://localhost/ebiblio?error=PiuUtilGetLike");
    }
}
else if(!isset($_SESSION['email'])){
    session_start();
}
else{
    echo "<script type='text/javascript'>alert('Accedere prima');
                    window.location = 'http://localhost/ebiblio'; 
                    </script>";
}


$utente_con = new UtilizzatoreController();
$utente_res = $utente_con->list();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Lib for leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>

    <title>Ebiblio</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
        <a href="/ebiblio" class="navbar-brand">
            <img src="http:\ebiblio\images\book-half.svg" height="28">
            EBIBLIOXUNIBO
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/ebiblio/utilizzatore" class="nav-item nav-link">Home</a>
                <a href="/ebiblio/utilizzatore/biblioteche.php" class="nav-item nav-link">Biblioteche</a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle nav-item nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Servizi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/ebiblio/utilizzatore/prenot_posto_let/biblio_scelta.php">Prenotazione Posto Lettura</a>
                        <a class="dropdown-item" href="/ebiblio/utilizzatore/Libro.php">Prenotazione Libri</a>
                        <a class="dropdown-item" href="/ebiblio/utilizzatore/Ebook.php">Accesso Ebook</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle nav-item nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Prenotazioni
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/ebiblio/utilizzatore/prenotazioni/posti_prenotati.php">Posti Lettura prenotati</a>
                        <a class="dropdown-item" href="/ebiblio/utilizzatore/prenotazioni/libri_prenotati.php">Libri prenotati</a>
                        
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle nav-item nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Statistiche
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/ebiblio/statistiche/postazione_statistiche.php">Postazione letture meno utilizzate</a>
                        <a class="dropdown-item" href="/ebiblio/statistiche/volontario_statistiche.php">Volontari che hanno effettuato più consegne</a>
                        <a class="dropdown-item" href="/ebiblio/statistiche/libro_statistiche.php">Libri più richiesti</a>
                        <a class="dropdown-item" href="/ebiblio/statistiche/ebook_statistiche.php">Ebook con più accessi</a>

                    </div>
                </div>
            </div>

            <div class="navbar-nav ml-auto">
            <?php
            //var_dump($_SESSION);
            if(isset($_SESSION["email"])){
                
               echo"<a href='/ebiblio/utilizzatore/logout.php' class='nav-item nav-link'>Logout</a></li>";
               
            }else{
               echo "<div class='dropdown'>
               <button class='btn btn-secondary dropdown-toggle nav-item nav-link' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                   Accesso
               </button>
               <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                   <a class='dropdown-item' href='/ebiblio/accesso/acc_volo.php'>Volontario</a>
                   <a class='dropdown-item' href='/ebiblio/accesso/acc_amm.php'>Amministratore</a>
                   <a class='dropdown-item' href='/ebiblio/accesso/acc_utiliz.php'>Utilizzatore</a>
               </div>
           </div>";
             
               echo"<a href='/ebiblio/registrazione.php' class='nav-item nav-link'>Registrati</a>";
               

            }
            
            ?>
            </div>
        </div>
    </nav>


