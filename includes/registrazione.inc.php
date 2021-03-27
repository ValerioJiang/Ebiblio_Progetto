<?php
include_once("../includes/autoloader.inc.php");
//$conn; //???
//per operazioni che richiedono accesso al database:
$utilizzatore_con = new UtilizzatoreController();

if(isset($_POST["iscriviti"])){
    $nome =$_POST['nome'];
    $cognome =$_POST['cognome'];
    $data =$_POST['datanascita'];
    $luogo =$_POST['luogonascita'];
    $telefono =$_POST['telefono'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $rptpassword =$_POST['rptpassword'];
    $professione =$_POST['professione'];
    $utili_res = $utilizzatore_con->checkIscrizione($email);


    require_once("../controller/dbh.class.php");
    require_once("function.inc.php");

    /*$utilizzatore_con = new UtilizzatoreController();
    $utili_res = $utilizzatore_con -> checkEsistenza();*/
    //controllo riempimento di tutti i campi:
    if(inserimentoVuoto($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione)!==false){
        header("location: ../registrazione.php?error=emptyinput");
        exit();
    }
  
    //controllo validità formato email:
    if(emailInvalida($email)!==false){
        header("location: ../registrazione.php?error=invalidemail");
        exit();
    }



    //controllo se il campo "Password" e il campo "Ripeti Password" coincidono:
    if(controlloPassword($password,$rptpassword)!==false){
        header("location: ../registrazione.php?error=passwordsdontmatch");
        exit();
    }

    //controllo iscrizione riuscita o meno:
    $utilizzatore_con = new UtilizzatoreController();
    $utente_checkIscrizione= $utilizzatore_con->checkIscrizione($email);

    if(count($utente_checkIscrizione) == 0){
      echo"Iscrizione eseguita con successo";
    }else{
        header("location: ../registrazione.php?error=passwordsdontmatch") ;
    }



    //MANCA CREAZIONE UTENTE(DA FARE CON MONGODB)
}else{
    header("location: ../registrazione.php?error=passwordsdontmatch");
    exit();
}