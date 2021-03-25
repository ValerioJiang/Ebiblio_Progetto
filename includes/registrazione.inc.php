<?php

if(isset($_POST["iscriviti"])){
    $nome =$_POST['nome'];
    $cognome =$_POST['cognome'];
    $data =$_POST['datanascita'];
    $luogo =$_POST['luogonascita'];
    $telefono =$_POST['telefono'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $profesisone =$_POST['professione'];
    

}else{
    header("location: ../registrazione.php");
}

    


