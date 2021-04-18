<?php
    if(!isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        
        header("Location: http://localhost/ebiblio?error=LogoutSuccessful");
        exit(); 
    }
    else{
        header("Location: http://localhost/ebiblio?error=LogoutError");
        exit();
    }
?>