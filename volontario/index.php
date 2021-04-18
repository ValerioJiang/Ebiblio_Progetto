<?php
require_once('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');
$volon_con = new VolontarioController();

if(isset($_POST["accedi"])){
    if(isset($_POST["email"])&&isset($_POST["password"])){
        $email =$_POST['email'];
        $password =$_POST['password'];
        $utili_res = $volon_con->checkEsistenza($email,$password);
        //controllo riempimento di tutti i campi:
        $volon_checkEsistenza = $volon_con->checkEsistenza($email,$password);

        if(count($volon_checkEsistenza) == 1){
            session_start();
            $_SESSION['email'] = $_POST['email'];
        
        }
    }
    
    else{
        header("Location: http://localhost/ebiblio?error=LoginError"); 
    }
}

else{
    header("Location: http://localhost/ebiblio?error=LoginError"); 
}

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');

?>

<div>

</div>



<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/footer.php');

?>


