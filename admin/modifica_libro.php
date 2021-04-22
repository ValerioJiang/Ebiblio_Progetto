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

                            
                            /*
                                if (isset($_POST['nuovabiblio'])) {
                                    $nometrim = trim($_POST['nome']);
                                    $emailtrim = trim($_POST['email']);
                                    $sitotrim = trim($_POST['sito']);
                                    $indirizzotrim = trim($_POST['indirizzo']);
                                    $latitudinetrim = trim($_POST['latitudine']);
                                    $longitudinetrim = trim($_POST['longitudine']);
                                    $notetrim = trim($_POST['note']);*/

                                    /*
                                    //imposto variabili per controllare che le info inserite siano già state utilizzate
                                    //controllo email:
                                    $res_email = $biblioCon->getLikeEmail($_POST['email']);
                                    //controllo sitto:
                                    $res_sito = $biblioCon->getLikeSito($_POST['sito']);
                                    //controllo coordinate:
                                   // $res_coordinate = $biblioCon->getLikeCoordinate($_POST['latitudine'], $_POST['longitudine']);
                                    //controllo esistenza biblioteca:
                                    $res = $biblioCon->getLikeBiblioteca($_POST['nome']);*/
                                    /*
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
                                    }*/
                                //}
                
                            ?>
                    </div>
            
                    <h1 class="font-weight-light">Modifica libro esistente</h1>
            
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

        
                    <button type="submit" class="btn btn-outline-danger" name="modificalibro">Salva modifica </button>
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