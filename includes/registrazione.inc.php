<?php
//include_once("../config/constants.php");
//$conn; //???


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

    require_once("../controller/dbh.class.php");
    require_once("function.inc.php");

    $utilizzatore_con = new UtilizzatoreController();
    $utili_res = $utilizzatore_con -> checkEsistenza();
    //controllo riempimento di tutti i campi:
    if(emptyInputUser($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione)!==false){
        header("location: ../registrazione.php?error=emptyinput");
        exit();
    }
   
    //controllo validità formato email:
    if(invalidEmail($email)!==false){
        header("location: ../registrazione.php?error=invalidemail");
        exit();
    }


    //controllo se il campo "Password" e il campo "Ripeti Password" coincidono:
    if(passwordMatch($password,$rptpassword)!==false){
        header("location: ../registrazione.php?error=passwordsdontmatch");
        exit();
    }

    //controllo utilizzo email inserita: 
    if(emailExists($conn,$email)!==false){
        header("location: ../registrazione.php?error=usernametaken");
        exit();
    }

    //creazione profilo:
   //createUser($conn,$nome,$cognome,$data,$luogo,$telefono,$email,$password,$professione);
}else{
    header("location: ../registrazione.php?error=passwordsdontmatch");
    exit();
}
