<?php

require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');
$biblio_con = new BibliotecaController();

?>


<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">
    <div class="container" style="background-color: white;">
        <br>
        <div class="container">
            <h2>Riepilogo ritiro</h2>
            </br>
            
                <div class="form-group">
                    <label>Biblioteca: <?php echo $_GET['nomeBiblio']; ?></label>
                    <br>
                    <label>Indirizzo: <?php $biblio_res = $biblio_con->getBiblioteca($_GET['nomeBiblio']);
                                        echo $biblio_res[0]['Indirizzo']; ?></label>
                    <br>
                    <label>Periodo Prestito: <?php echo date('d-m-Y', strtotime("+ 1 days")); ?> <?php echo date('d-m-Y', strtotime(' + 16 days')); ?></label>
                </div>
                <form method="post">
                <br>
                    <input type="submit" name="confBtn" id="test" class="btn btn-primary" value="Conferma" /><br/>
                </form>
                <br>
                <a  href="http://localhost/ebiblio/utilizzatore/libro.php">Indietro</a>
            
            </br>
            </br>
            <?php
                if(isset($_POST['confBtn'])){
                    $pres_con = new PrestitoController();
                    $pres_res = $pres_con -> createPrestito($_SESSION['email'], $_GET['codLibro'],date('Y-m-d',strtotime('+1 days'))); 
                    
                    $client = new MongoDB\Client("mongodb://localhost:27017");
  
                    $companydb = $client -> ebiblio;
                    
                    $log_events = $companydb -> log_events;
                    
                    $insertOneResult = $log_events -> insertOne(['Utente' => $_SESSION['email'], 'Evento' => 'Ritiro Libro', 'TipologiaUtente' =>'Utilizzatore', 'Timestamp' => date("Y-m-d h:i:sa")]);
                    
                    if($pres_res){
                        echo "<h5>Prenotazione libro andata a buon fine</h5>";
                        
                    }

                }
            ?>
           

        </div>
    </div>


    <?php
    require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>