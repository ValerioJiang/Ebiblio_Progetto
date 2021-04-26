<?php
require_once('/xampp/htdocs/ebiblio/utilizzatore/main_partials/menu.php');


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
                    <label>Da effettuare la consegna entro: <?php echo date('d-m-Y', strtotime("+ 1 days")); ?></label>
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
                    $pres_res = $pres_con -> createPrestito("jiangvalerio1998@gmail.com",$_GET['codLibro'],$_GET['nomeBiblio'], $_GET['scaffale'],date('Y-m-d',strtotime('+1 days'))); 
                    if($pres_res){
                        $message = "Ritiro con libro prenotato con successo";
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