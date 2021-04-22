<?php




require_once('/xampp/htdocs/ebiblio/main_partials/menu.php');


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
                    <label>Biblioteca: <?php echo $_GET['nomeBiblio']; ?></label>
                    <br>
                    <label>Indirizzo: <?php $biblio_res = $biblio_con->getBiblioteca($_GET['nomeBiblio']);
                                        echo $biblio_res[0]['Indirizzo']; ?></label>
                    <br>
                    <label>Periodo Prestito: verrà inviata una notifica quando il verrà il consegnato il libro da uno dei nostri volontari</label>
                </div>
                <form method="post">
                    <input type="submit" name="confBtn" id="test" class="btn btn-primary" value="Conferma" /><br/>
                </form>
                <a class="btn btn-secondary" role="button" href="http://localhost/ebiblio">Annulla</a>
            
            </br>
            </br>
            <?php
                if(isset($_POST['confBtn'])){
                    $pres_con = new PrestitoController();
                    $pres_res = $pres_con -> createPrestito($_SESSION['email'], $_GET['codLibro'], $_GET['nomeBiblio'], $_GET['scaffale'], date('Y-m-d',strtotime('+1 days'))); 
                    
                    $pres_resGetLikeCodice = $pres_con -> getLikePrestito($_SESSION['email'], $_GET['codLibro'], $_GET['nomeBiblio']);


                    $cons_con = new ConsegnaController();
                    $cons_res = $cons_con -> createConsegna($pres_resGetLikeCodice[0]['Codice'],'Affidamento');


                    if($pres_res){
                        $message = "Consegna libro prenotato con successo";
                        echo "<script type='text/javascript'>alert('$message');
                        document.location.href = 'http://localhost/ebiblio';
                        </script>";
                        
                    }
                }
            ?>
           

        </div>
    </div>


    <?php
    require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>