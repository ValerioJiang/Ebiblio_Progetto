<?php

/*
*funzioni di registrazione.inc.php
*/


//controllo riempimento di tutti i campi:
function emptyInputUser($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione){
    $result;
    if(empty($nome)||empty($cognome)||empty($data)||empty($luogo)||empty($telefono)||empty($email)||empty($password) ||empty($rptpassword)||empty($professione)){
         $result =true;
    }else{
        $result =false;
    }

    return $result; 
}

function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "email non valida";
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function passwordmatch($password,$rptpassword){
    $result;
    if($password!==$rptpassword){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function emailExists($conn,$email){
    $sql = "SELECT * FROM Utlizzatore where Email = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$conn)){
        header("location: ../registrazione.php?error=emailtaken");
        exit();
    }
   
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result();

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt)
}

function  createUser($conn,$email,$password,$nome,$cognome,$data,$luogo,$telefono,$professione){
    /*CAMBIARE IN MONGODB*/
    $sql = "INSERT INTO Utilizzatori(Email,Password,Nome,Cognome,DataNascita,LuogoNascita,Tel,Professione)VALUES(?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$conn)){
        header("location: ../registrazione.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   
    mysqli_stmt_bind_param($stmt,"sssssssss",,$email,$password,$nome,$cognome,$data,$luogo,$telefono,$professione,$hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../registrazione.php?error=none");
    exit()

}