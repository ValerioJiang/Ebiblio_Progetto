<?php
    require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');
    $accEbook = new AccessoEbookController();
    $numEbook = new EbookController();

    if(isset($_GET['visiona'])&& isset($_GET['file'])){
        echo "<script>";
        echo 'window.open("http://localhost/ebiblio/pdf_ebook/'.$_GET['file'].'", "_blank").focus();';
        echo "</script>";
        $accCreate = $accEbook -> createAccessoEbook($_GET['codEbook'],$_SESSION['email']);
        $numacc= $numEbook ->getAccessi($_GET['codEbook']);
      
        if ($numacc[0]['NumAccessi'] ==NULL){
          $updatenumacc = $numEbook ->updateNumeroAccessi($_GET['codEbook'],0);
        }else{
        $updatenumacc = $numEbook ->updateNumeroAccessi($_GET['codEbook'],$numacc[0]['NumAccessi']);
        }
    }   
    else{

    }

?>