<?php
require_once('/xampp/htdocs/ebiblio/main_partials/menu.php');
$utente_con = new UtilizzatoreController();
$utente_res = $utente_con->list();      
?>

<section>
<div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">

                <div  class ="text-center">
                    <?php
                      if (isset($_POST['iscriviti'])){
                        $nometrim= $_POST['nome'];
                        $cognometrim = $_POST['cognome'];
                        $datatrim = $_POST['data'];
                        $luogotrim = $_POST['luogonascita'];
                        $telefonotrim = $_POST['telefono'];
                        $professionetrim = $_POST['professione'];
                        $emailtrim = $_POST['email'];
                        $passwordtrim = $_POST['password'];
                        $rptpasswordtrim = $_POST['rptpassword'];

                        $email_res=$utente_con->checkIscrizione($emailtrim);
                       

                        if ((ctype_space($nometrim)||$nometrim=='')||(ctype_space($cognometrim)||$cognometrim=='')|| (ctype_space($datatrim)||$datatrim=='')||(ctype_space($telefonotrim)||$telefonotrim=='')||(ctype_space($professionetrim)||$professionetrim=='')||(ctype_space($emailtrim)||$emailtrim=='')||(ctype_space($passwordtrim)||$passwordtrim=='')||(ctype_space($rptpasswordtrim)||$rptpasswordtrim=='')){
                            echo "Per favore riempire tutti i campi";
                        }else if (!filter_var($emailtrim, FILTER_VALIDATE_EMAIL)) {
                            echo "Email non valida";
                        }else if(!strcasecmp($passwordtrim, $rptpasswordtrim) == 0){
                            echo 'Le password inserite non coincidono';
                        }else if (count($email_res)>0){
                            echo "Email inserita già in uso";

                        }else{
                            $utente_new = $utente_con->createUtilizzatore($nometrim,$cognometrim, $datatrim,$luogotrim,$telefonotrim,$professionetrim,$emailtrim,$passwordtrim);
                            echo "Iscrizione eseguita con successo!";
                        }
                        
                        } 
                    ?>
                </div>
                <h1 class="font-weight-light">Registrazione</h1>
            
                <form   method ="POST" class ="text-center"> 

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            Nome:
                            <br>
                            <input type="text" name="nome" size="20" maxlength="50"placeholder="Nome..."/><br>
                        </div>
                        <div class="form-group col-md-6">
                            Cognome:
                            <br>
                            <input type="text" name="cognome" size="20" maxlength="50"placeholder ="Cognome..."/><br>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                 
                         Data di nascita:                       
                        <input id="data" type="date" name="data" <?php
                         echo date("Y-m-d"); ?> 
                         width="100%" />
                        </br>
                        </br>
                        
                        </div>
                        <div class="form-group col-md-6">
                            Luogo di nascita:
                            <br>
                            <input type="text" name="luogonascita" size="20" maxlength="50"placeholder ="Luogo nascita..."/><br>
                        
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            Telefono:
                            <br>
                            <input type="text" name="telefono" size="20" maxlength="50" placeholder="Telefono..."/><br>
                        </div>
                            <div class="form-group col-md-6">
                            Professione:
                            <br>
                            <input type="text" name="professione" size="20" maxlength="50"placeholder ="Professione..."/><br>
                        </div>
                    </div>

                    <div class="form-group">
                        Email:
                            <br>
                            <input type="text" name="email" size="50" maxlength="50" placeholder="Email..."/><br>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        Password:
                            <br>
                            <input type="password" name="password" size="20" maxlength="50"placeholder ="Password..."/><br>
                        </div>
                        <div class="form-group col-md-6">
                        Ripeti password:
                            <br>
                            <input type="password" name="rptpassword" size="20" maxlength="50"placeholder ="Password..."/><br>
                        </div>
                    </div>

                    <br>
                        <button type="submit" class="btn btn-outline-danger" name="iscriviti">Iscriviti</button>
                    <br></br>
                </form>
            </div>
                        
        </div>
    </div>
</section>

    <?php
        require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>
</body>