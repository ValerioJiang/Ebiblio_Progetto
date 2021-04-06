<?php
//session_start();

require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$utente_con = new UtilizzatoreController();
$utente_res = $utente_con->list();
function infoBoxLogin($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>

<?php
/*
//LOGIN
if (isset($_POST['accedi'])) {
    //ottengo i dati inseriti dall'utilizzatore:
    $email = $_POST['email'];
    $password = $_POST['password'];
    $utente_check = $utente_con->checkEsistenza($email, $password); //creo utente_check che contiene il risultato di checkesistenza tramite utente_con
    if (count($utente_check) == 1) {
        infoBoxLogin("ACCESSO ESEGUITO");
         $_SESSION['login']= "<div class ='success'>Login succesful.</div>";
       //header('location:'.SITEURL.'C:\xampp\htdocs\EBIBLIO\biblioteche.php');
    } else {
        infoBoxLogin("ACCESSO NEGATO: email o password errata");
    }
}*/
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

    <title>Accesso</title>
</head>

<body>

    <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
        <div class="container" style="background-color: white;">

            <!--messaggi d'errore-->
            <div  class ="text-center">
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"]== "emptyinput"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Riempire tutti i campi</em></p>";
                        }else if($_GET["error"]== "emailorpasswordwrong"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email o Password errata.</p>";                        
                        }else if($_GET["error"]== "stmtfailed"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Qualcosa è andato storto, prova ancora</p>";
                        }/*else if($_GET["error"]== "null"){
                            echo "<p class= 'bg-success text-white h5'><em>Iscrizione eseguita con successo!</p>";
                        }*/
                    } 
                ?>
                </div>
            <h2 class="modal-title" id="login">Accesso</h2>
            <em>Accedi al tuo profilo Ebiblio:</em><br><br>

            <form method="POST" action ="includes/accesso.inc.php"  class="text-center">
                E-mail:
                <br>
                <input type="text" name="email" size="20" maxlength="50" placeholder="Email..." />
                <br>
                Password:
                <br>
                <input type="password" name="password" size="20" maxlength="50" placeholder="Password..." /><br>
                <br>
                <button type="submit" class="btn btn-outline-danger" name="accedi">Accedi</button>
            </form>

            <div class="modal-footer m-3">
                <em>Utente non registrato? </em> <a href="registrazione.php">Registrati</a>
            </div>
        </div>
    </div>     
</body>
            
            
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>