<?php
require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');
$volon_con = new VolontarioController();

if(isset($_POST["accedi"])){
    $email =$_POST['email'];
    $password =$_POST['password'];
    $utili_res = $volon_con->checkEsistenza($email,$password);
  
    //controllo riempimento di tutti i campi:
    if((empty($email) || empty($password))!==false){
        echo "Email o Password vuoti";
    }

  
    $volon_checkEsistenza = $volon_con->checkEsistenza($email,$password);

    if(count($volon_checkEsistenza) == 1){
        session_start();
        $_SESSION['Volontario'] = $_POST['email'];
        
    }
    else{
        header("Location: http://localhost/ebiblio/"); 
    }
}

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');

?>


<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/footer.php');

?>


