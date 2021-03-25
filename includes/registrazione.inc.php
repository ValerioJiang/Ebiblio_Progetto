<?php

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
   /* CREARE FUNCTION.CLASS.PHP 
   require_once("function.class.php");
    */

    //controllo inserimento dei dati:
    if(emptyInputUser($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione)!==false){
        header("location: ../registrazione.php?error=emptyinput");
        exit();
    }

    //gestione vari possibili errori:
    if(invalidEmail($email)!==false){
        header("location: ../registrazione.php?error=invalidemail");
        exit();
    }

    if(passwordMatch($password,$rptpassword)!==false){
        header("location: ../registrazione.php?error=passwordsdontmatch");
        exit();
    }

    if(emailExists($conn,$email)!==false){
        header("location: ../registrazione.php?error=emailtaken");
        exit();
    }

    //creazione profilo:
     createUser($conn,$nome,$cognome,$data,$luogo,$telefono,$email,$password,$professione);
}

    


