<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$messaggio_con = new AmministratoreController();
$messaggio_res = $messaggio_con->list();      
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
                            if (isset($_POST['invio'])) {
                                    
                                $titolotrim = trim($_POST['titolo']);
                                $messaggiotrim= trim($_POST['messaggio']);
                                                    
                                if ((ctype_space($titolotrim)||$titolotrim=='')||(ctype_space($messaggiotrim)||$messaggiotrim=='')){
                                    echo "Per favore riempire tutti i campi";
                                }else{

                                    $nuovo_messaggio = $messaggio_con->invioMessaggio($titolotrim,$messaggiotrim,'amministratore@email.it','utente@email.it'); 
                                    echo"Messaggio inviato";
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

                        <form  action=# method ="POST" class ="text-center"> 
                                <div class="form-group">
                                <label for="comment">Invia un messaggio a: #indirizzo email</label>
                                <textarea class="form-control" rows="5" name="messaggio" placeholder="Messaggio..."></textarea>
                            </div>
                                  
                            <button type="submit" class="btn btn-outline-danger" name="invio">Invio</button>
                            <br></br>
                            <a href = "#">Indietro</a>                        

                        </form>


                    </form>
                    
                   
                  
                </div>
                        
            </div>
        </div>
    </section>




    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
