<?php
require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');


$utente_con = new UtilizzatoreController();
$utente_res = $utente_con->list();
function infoBoxLogin($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>

<?php
//LOGIN
if (isset($_POST['accedi'])){
    //ottengo i dati inseriti dall'utilizzatore:
    $email =$_POST['email'];
    $password=$_POST['password'];
    $utente_check = $utente_con -> checkEsistenza($email,$password); //creo utente_check che contiene il risultato di checkesistenza tramite utente_con
    if(count($utente_check) == 1){
       infoBoxLogin("ACCESSO ESEGUITO");
     /*  $_SESSION['login']= "<div class ='success'>Login succesful.</div>";
       header('location:'.SITEURL.'C:\xampp\htdocs\EBIBLIO\biblioteche.php');*/
    }else{
       infoBoxLogin("ACCESSO NEGATO: email o password errata");
     
    }

}
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
                <a href="/ebiblio/admin/" class="nav-item nav-link">Home</a>
                <a href="/ebiblio/admin/biblioteche_admin.php" class="nav-item nav-link">Biblioteche</a>
                <a href="/ebiblio/admin/Libro.php" class="nav-item nav-link">Libro</a>
                <a href="/ebiblio/admin/Ebook.php" class="nav-item nav-link">Ebook</a>
                <a href="#" class="nav-item nav-link">Statistiche</a>

            </div>

            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link">Gestione Utenti</a>
                <a href="#" class="nav-item nav-link">Profilo</a>
                <a href="#" class="nav-item nav-link">Logout</a>

            </div>
        </div>
    </nav>
</body>
