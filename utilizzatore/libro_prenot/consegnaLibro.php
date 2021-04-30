<?php



require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');



$biblio_con = new BibliotecaController();

?>


<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">
    <div class="container" style="background-color: white;">
        <br>
        <div class="container">
            <h2>Riepilogo Consegna</h2>
            </br>
            
                <div class="form-group">
                    <label>Biblioteca: <?php  $_GET['nomeBiblio']; ?></label>
                    <br>
                    <label>Indirizzo: <?php $biblio_res = $biblio_con->getBiblioteca($_GET['nomeBiblio']);
                                        echo $biblio_res[0]['Indirizzo']; ?></label>
                    <br>
                    <label>Periodo Prestito: Sarà comunicato non appena un nostro volontario effettuerà la consegna</label>
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
                    $pres_res = $pres_con -> createPrestitoConsegna($_SESSION['email'], $_GET['codLibro']); 

                    $pres_cod = $pres_con -> getLikePrestito($_SESSION['email'], $_GET['codLibro']);

                    $cons_con = new ConsegnaController();
                    $cons_res = $cons_con -> createConsegna($pres_cod[0]['Codice'],'Affidamento');
                    echo"<h5>Consegna libro prenotato con successo</h5>";

                   /* if($pres_res){
                        echo"<h5>Consegna libro prenotato con successo</h5>";
                    }*/
                }
            ?>
           

        </div>
    </div>


    <?php
    require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>