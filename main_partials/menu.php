<?php
    include '/xampp/htdocs/Ebiblio/includes/autoloader.inc.php';
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
    <title>Ebiblio</title>
</head>

<body>
    
    <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
        <a href="#" class="navbar-brand">
            <img src="http:\ebiblio\images\book-half.svg" height="28">
            EBIBLIOXUNIBO
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/ebiblio" class="nav-item nav-link">Home</a>
                <a href="/ebiblio/biblioteche.php" class="nav-item nav-link">Biblioteche</a>
                <a href="#" class="nav-item nav-link">Statistiche</a>

            </div>
    
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#modalLogin">Login</a>
                <a href="registrazione.php" class="nav-item nav-link">Registrati</a>
            </div>

            <!--LOGIN-->
            <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="login">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center ">
                            <p>Accedi al tuo profilo Ebiblio:<br><br>
                            E-mail:
                            <br>
                            <input type="text" name="e-mail" id ="email" size="20" maxlength="50" /><br>
                            Password:
                            <br>
                            <input type="text" name="password" id="password" size="20" maxlength="50"/><br>
                            <br>
                        </div>

                        <!--<div class="form-check m-3 text-center">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value=""> Ricordami 
                            </label>
                        <div>--->       


                        <div class="modal-footer" >
                           <form action="biblioteche.php">
                            <button type="submit" class="btn btn-outline-danger" name="accedi" id="accedi">Accedi</button> 
                            </form>
                        </div>
                        <div class="m-3">
                            <em>Utente non registrato? </em> <a href="registrazione.php">Registrati</a>
                        </div>
                    </div>
                </div>
            </div>
    </nav>

    <div>
    
    </div>

    
</body>