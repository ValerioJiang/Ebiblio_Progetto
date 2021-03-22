<?php
    spl_autoload_register('myAutoLoader');

    function myAutoLoader($className){
        $path = "C:\\xampp\\htdocs\\Ebiblio\\controller\\";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }
?>