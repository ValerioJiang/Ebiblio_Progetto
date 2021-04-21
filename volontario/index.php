<?php
require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');

$volon_con = new VolontarioController();
session_start();
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $utili_res = $volon_con->checkEsistenza($email, $password);
    //controllo riempimento di tutti i campi:
    $volon_checkEsistenza = $volon_con->checkEsistenza($email, $password);

    if (count($volon_checkEsistenza) == 1) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['esistenza'] = true;
    }
}

$volon_getLike = $volon_con -> getLikeVolontario($_SESSION['email']);

if (count($volon_getLike) > 1) {
    header("Location: http://localhost/ebiblio?error=PiuVoloGetLike");
}



require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');




?>

<div class="container-fluid " style="  
background: url('/ebiblio/images/bibliofull.jpg') no-repeat  ;

">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">
                <h1 class="font-weight-light">Benvenuto <?php echo $volon_getLike[0]['Nome'];?> </h1>
                <p class="lead">Il sistema di gestione consegne ufficiale per volontari</p>
                Nella sezione Consegna potrai consultare:
                <ul>
                    <li>Ricerca e informazione sulle consegne da tutte le biblioteche e utenti</li>
                    <li>Consegne prese in carico</li>
                    <li>Consegne passate</li>

                </ul>
            </div>

        </div>

    </div>

</div>


<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/footer.php');

?>