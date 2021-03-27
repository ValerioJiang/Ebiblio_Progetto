<?php

/*
*funzioni di registrazione.inc.php
*/


//controllo riempimento di tutti i campi:
function inserimentoVuoto($nome,$cognome,$data,$luogo,$telefono,$email,$password,$rptpassword,$professione){
    $result;
    if(empty($nome)||empty($cognome)||empty($data)||empty($luogo)||empty($telefono)||empty($email)||empty($password) ||empty($rptpassword)||empty($professione)){
         $result =true;
    }else{
        $result =false;
    }

    return $result; 
}

function emailInvalida($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "email non valida";
        $result = true;
    }else{
        $result = false;
    }

function controlloPassword($password,$rptpassword){
    $result;
    if($password!==$rptpassword){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}
