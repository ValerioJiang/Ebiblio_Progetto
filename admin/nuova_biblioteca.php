<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$biblio_con = new bibliotecaController();
$biblio_res = $biblio_con->list();      
?>


    <?php
    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
    $biblioCon = new BibliotecaController();
    ?>

    <section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                        <!--messaggi d'errore-->
                        <div  class ="text-center">
                            <?php
                                if (isset($_POST['nuovabiblio'])) {
                                    $nometrim = trim($_POST['nome']);
                                    $emailtrim = trim($_POST['email']);
                                    $sitotrim = trim($_POST['sito']);
                                    $indirizzotrim = trim($_POST['indirizzo']);
                                    $latitudinetrim = trim($_POST['latitudine']);
                                    $longitudinetrim = trim($_POST['longitudine']);
                                    $notetrim = trim($_POST['note']);

                                    //imposto variabili per controllare che le info inserite siano già state utilizzate
                                    //controllo email:
                                    $res_email = $biblioCon->getLikeEmail($_POST['email']);
                                    //controllo sitto:
                                    $res_sito = $biblioCon->getLikeSito($_POST['sito']);
                                    //controllo coordinate:
                                   // $res_coordinate = $biblioCon->getLikeCoordinate($_POST['latitudine'], $_POST['longitudine']);
                                    //controllo esistenza biblioteca:
                                    $res = $biblioCon->getLikeBiblioteca($_POST['nome']);

                                    if (count($res_email)>=1){
                                        echo "Email inserita già in uso";
                                    }else if(count($res_sito)>=1){
                                        echo "Sito inserito già in uso";
                                    }else if ((ctype_space($nometrim)||$nometrim=='')||(ctype_space($emailtrim)||$emailtrim=='')||(ctype_space($sitotrim)||$sitotrim=='')|| (ctype_space($indirizzotrim)||$indirizzotrim=='')||(ctype_space($latitudinetrim)||$latitudinetrim=='')||(ctype_space($longitudinetrim)||$longitudinetrim=='')){
                                    echo "Per favore riempire tutti i campi";
                                    }else if (!filter_var($emailtrim, FILTER_VALIDATE_EMAIL)) {//controllo validità email
                                       echo "Email inserita non valida";

                                    }else{
                                        
                                        if (count($res) >=1) {
                                        echo "Biblioteca già esistente";
                                        }else{
                                        $biblio = $biblioCon->createBiblioteca($nometrim,$emailtrim,$sitotrim,$indirizzotrim,$latitudinetrim,$longitudinetrim,$notetrim);                                    
                                        echo "Biblioteca inserita con successo!";
                                        echo"<br>";
                                        echo'<a href = "/ebiblio/admin/biblioteche_admin.php">Torna indietro</a>';
                                    }
                                    }
                                }
                            ?>
                    </div>
            
                    <h1 class="font-weight-light">Registrazione nuova biblioteca</h1>
            
                    <form  action=# method ="POST" class ="text-center"> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                Nome biblioteca:
                                <br>
                                <input type="text" name="nome" size="30" maxlength="50"placeholder="Nome..."/><br>
                            </div>
                            <div class="form-group col-md-6">
                                Email biblioteca:
                                <br>
                                <input type="text" name="email" size="30" maxlength="50"placeholder ="Email..."/><br>
                            </div>
                        </div>

                        <div class="form-group">
                            Sito web biblioteca:
                            <br>
                            <input type="text" name="sito" size="70" maxlength="50" placeholder="Sito web..."/><br>
                        </div>            

                        <div class="form-row">
                            <div class="form-group col-md">
                                Indirizzo
                                <br>
                                <input type="text" name="indirizzo" size="20" maxlength="50" placeholder="indirizzo..."/><br>
                            </div>
                            
                            <div class="form-group col-md">
                            Latitudine
                                <br>
                                <input type="text" name="latitudine" size="15" maxlength="50"placeholder ="Latitudine..."/><br>
                            </div>
                            
                            <div class="form-group col-md">
                            Longitudine
                                <br>
                                <input type="text" name="longitudine" size="15" maxlength="50"placeholder ="Longitudine..."/><br>
                            </div>
                        </div>

                
                        <div class="form-row">
                            <div class="form-group col-md">
                                Note:
                                <br>
                                <input type="text" name="note" size="70" maxlength="200" placeholder="Note..."/><br>
                            </div>
                        </div>            
                        <br>
                            <button type="submit" class="btn btn-outline-danger" name="nuovabiblio">Salva nuova biblioteca</button>
                            <br></br>
                            <a href = "/ebiblio/admin/biblioteche_admin.php">Indietro</a>


                    </form>
                    
                   
                  
                </div>
                        
            </div>
        </div>
    </section>


    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
