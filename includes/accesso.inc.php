<?php
include_once("../includes/autoloader.inc.php");
//$conn; //???
//per operazioni che richiedono accesso al database:
$utilizzatore_con = new UtilizzatoreController();
if(isset($_POST["accedi"])){
    $email =$_POST['email'];
    $password =$_POST['password'];
    $utili_res = $utilizzatore_con->checkEsistenza($email,$password);

    require_once("../controller/dbh.class.php");
    require_once("function.inc.php");

    //controllo riempimento di tutti i campi:
    if(inserimentoVuotoAccesso($email,$password)!==false){
        header("location: ../accesso.php?error=emptyinput");
        exit();
    }

    //controllo iscrizione al database o meno:
    $utilizzatore_con = new UtilizzatoreController();
    $utente_checkEsistenza= $utilizzatore_con->checkEsistenza($email,$password);

    if(count($utente_checkEsistenza) == 0){
        header("location: ../accesso.php?error=emailorpasswordwrong") ;
    }else{
        header("location: ../accesso.php?error=null");

    }
}else{
    header("location: ../registrazione.php?error=stmtfailed");
    exit();
}
  



