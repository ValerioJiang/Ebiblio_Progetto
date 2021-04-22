<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$cartaceo_Con = new CartaceoController();
$cartaceo_res = $cartaceo_Con->list();      
?>


    <?php
    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
    $cartaceoCon = new cartaceoController();
    ?>

    <section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                        <!--messaggi d'errore-->
                        <div  class ="text-center">
                            <?php
                                if (isset($_POST['modificalibro'])) {
                                    $titolotrim = trim($_POST['titolo']);
                                    $nometrim = trim($_POST['nome']);
                                    $cognometrim = trim($_POST['cognome']);

                                    $edizionetrim = trim($_POST['edizione']);
                                    $generetrim = trim($_POST['genere']);
                                    $annotrim = trim($_POST['anno']);
            
                                    
                                    //imposto variabili per controllare che le info inserite siano già state utilizzate
                                    $res_Autore= $cartaceo_Con->getLikeAutoreCartaceo($_POST['nome'],$_POST['cognome']);
                                    $res_Libro= $cartaceo_Con->controlloLibro($_POST['titolo'],$_POST['nome'],$_POST['cognome'],$_POST['anno'],$_POST['edizione'],$_POST['genere']);
                                                           
                                    if ((ctype_space($titolotrim)||$titolotrim=='')||(ctype_space($nometrim)||$nometrim=='')||(ctype_space($cognometrim)||$cognometrim=='')|| (ctype_space($edizionetrim)||$edizionetrim=='')||(ctype_space($generetrim)||$generetrim=='')||(ctype_space($annotrim)||$annotrim=='')){
                                        echo "Per favore riempire tutti i campi";
                                    }else{

                                     if(count($res_Libro)==0){
                                        $cartaceo=$cartaceo_Con->createCartaceo($titolotrim,$edizionetrim,$generetrim,$annotrim);
                                        echo "Libro inserito con successo!";
                                    }
                                    if(count($res_Autore)==0){
                                        $cartace=$cartaceo_Con->createAutore($nometrim,$cognometrim); 
                                    }
                                    
                                    /*else if(count($res_Autore)==0){
                                        $cartace=$cartaceo_Con->createAutore($nometrim,$cognometrim); 
                                    }else{
                                       // $cartaceo=$cartaceo_Con->createCartaceo($titolotrim,$edizionetrim,$generetrim,$annotrim);
                                        $codAutore = $cartaceo_Con->getCodiceAutore($nometrim,$cognometrim); 
                                        $codLibro = $cartaceo_Con->getCodiceLibro($titolotrim,$edizionetrim);
                                        $autoreLibro = $cartaceo_Con->createAutore_libro($codLibro[0]['Codice'],$codAutore[0]['Codice']); 
                                        echo"Libro inserito con successo";
                                        echo"<br><a href ='Ebiblio/admin/libro_admin.php'</a>";
                                    }*/ 
                                
                                    }
                                }
                                     
                               
                            ?>
                    </div>
            
                    <h1 class="font-weight-light">Inserimento nuovo libro</h1>
            
                    <form  action=# method ="POST" class ="text-center"> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                               Titolo:
                                <br>
                                <input type="text" name="titolo" size="70" maxlength="50"placeholder="Titolo..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                Nome autore:
                                <br>
                                <input type="text" name="nome" size="30" maxlength="50"placeholder="Nome..."/><br>
                            </div>
                            <div class="form-group col-md-6">
                                Cognome autore:
                                <br>
                                <input type="text" name="cognome" size="30" maxlength="50"placeholder ="Cognome..."/><br>
                            </div>
                        </div>

                        
                        <div class="form-row">
                            <div class="form-group col">
                                Edizione:
                                <br>
                                <input type="text" name="edizione" size="70" maxlength="50"placeholder ="Edizione..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                Genere:
                                <br>
                                <input type="text" name="genere" size="30" maxlength="50" placeholder="Genere..."/><br>
                            </div>
                            
                            <div class="form-group col-md">
                            Anno di pubblicazione
                                <br>
                                <input type="text" name="anno" size="30" maxlength="50"placeholder ="Anno di pubblicazione..."/><br>
                            </div>
                        
                        </div>

                
                            <button type="submit" class="btn btn-outline-danger" name="modificalibro">Salva nuovo libro</button>
                            <br></br>
                            <a href = "/ebiblio/admin/libro_admin.php">Indietro</a>


                    </form>
                    
                   
                  
                </div>
                        
            </div>
        </div>
    </section>


    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
