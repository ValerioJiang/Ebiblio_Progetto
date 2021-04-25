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
                                   
                                if (isset($_POST['nuovolibro'])) {
                                    $titolotrim = trim($_POST['titolo']);
                                    $autoretrim = trim($_POST['autore']);
                                    $edizionetrim = trim($_POST['edizione']);
                                    $generetrim = trim($_POST['genere']);
                                    $annotrim = trim($_POST['anno']);
                                    $paginetrim = trim($_POST['pagine']);  
                                    $conservazionetrim = trim($_POST['stato']);
                                    $scaffaletrim = trim($_POST['scaffale']);
                                    
                                    $bibliotecaadmin = $cartaceo_Con->getLikeBiblioteca("amministratore@gmail.com");//valore passato con sesisone

                                    if ((ctype_space($titolotrim)||$titolotrim=='')||(ctype_space($autoretrim)||$autoretrim=='')|| (ctype_space($edizionetrim)||$edizionetrim=='')||(ctype_space($generetrim)||$generetrim=='')||(ctype_space($annotrim)||$annotrim=='')||(ctype_space($paginetrim)||$paginetrim=='')||(ctype_space($conservazionetrim)||$conservazionetrim=='')||(ctype_space($scaffaletrim)||$scaffaletrim=='')){
                                        echo "Per favore riempire tutti i campi";
                                    }else{
                                        $creazionecartaceo = $cartaceo_Con->createCartaceo($titolotrim,$autoretrim,$edizionetrim,$generetrim,$annotrim,$paginetrim,$conservazionetrim,$scaffaletrim,$bibliotecaadmin);
                  
                                    
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
                            Autore:
:
                                <br>
                                <input type="text" name="autore" size="70" maxlength="50"placeholder="Autore..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            Edizione:
:
                                <br>
                                <input type="text" name="edizione" size="70" maxlength="50"placeholder="Edizione..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-6">
                                Genere:
                                <br>
                                <input type="text" name="genere" size="30" maxlength="50"placeholder ="Genere..."/><br>
                            </div>
                            <div class="form-group col-md-6">
                                Anno pubblicazione:
                                <br>
                                <input type="text" name="anno" size="30" maxlength="50"placeholder="Anno pubblicazione..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                Numero pagine:
                                <br>
                                <input type="text" name="pagine" size="30" maxlength="50"placeholder ="Numero pagine..."/><br>
                            </div>
                            <div class="form-group col-md-6">
                                Scaffale:
                                <br>
                                <input type="text" name="scaffale" size="30" maxlength="50"placeholder ="Scaffale..."/><br>
                            </div>
                        </div>

                            <div>
                                <label for='stato'>Stato libro</label>
                                    <select multiple class='form-control' name = 'stato' id='statolibro'>
                                    <option>Ottimo</option>
                                    <option>Buono</option>
                                    <option>Non buono</option>
                                    <option>Scadente</option>
                                    </select>
                                    <br>
                            </div>
                            
                        
                        

                
                            <button type="submit" class="btn btn-outline-danger" name="nuovolibro">Salva nuovo libro</button>
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
