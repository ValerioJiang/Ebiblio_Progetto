<?php
    spl_autoload_register('myAutoLoader');

    function myAutoLoader($className){
        $path = "./controller/";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }
?>