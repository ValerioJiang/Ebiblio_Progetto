<?php
include('../main_partials/menu.php');
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
                <a class="btn btn-primary" role="button" href=<?php echo '"http://localhost/ebiblio/libro_prenot/ritiroLibro.php?codLibro=1&ritiroLibro=true&confBtn=true&Titolo='.$_GET['Titolo'].'&nomeBiblio='.$_GET['nomeBiblio'].'&scaffale='.$_GET['scaffale'].'"'?>>Conferma</input>
                <a class="btn btn-secondary" role="button" href="http://localhost/ebiblio">Annulla</a>
            
            </br>
            </br>
            <?php
                if(isset($_GET['confBtn'])){
                    $pres_con = new PrestitoController();
                    $pres_res = $pres_con -> createPrestito("ciao@gmail.com",$_GET['codLibro'],$_GET['nomeBiblio'], $_GET['scaffale'],date('Y-m-d',strtotime('+1 days'))); 
                }
            ?>
           

        </div>
    </div>


    <?php
    include('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>