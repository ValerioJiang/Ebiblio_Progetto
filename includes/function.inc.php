<?php

/*
*
*FUNZIONI REGISTRAZIONE:
*
*/

//controllo riempimento di tutti i campi:
function inserimentoVuotoRegistrazione($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione){
    $result;
    if(empty($nome)||empty($cognome)||empty($data)||empty($luogo)||empty($telefono)||empty($email)||empty($password) ||empty($rptpassword)||empty($professione)){
         $result =true;
    }else{
        $result =false;
    }

    return $result; 
}

//controllo validità formato email:
function emailInvalida($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "email non valida";
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

//controllo inserimento password corretta:
function controlloPasswordRegistrazione($password,$rptpassword){
    $result;
    if($password!==$rptpassword){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

/*
*
*FUNZIONI ACCESSO
*
*/

//controllo riempimento di tutti i campi:
function inserimentoVuotoAccesso($email,$password){
    $result;
    if(empty($email)||empty($password)){
         $result =true;
    }else{
        $result =false;
    }

    return $result; 
}




