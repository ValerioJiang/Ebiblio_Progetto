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

                <!--messaggi d'errore-->
                <div  class ="text-center">
                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"]== "emptyinput"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Riempire tutti i campi</em></p>";
                            }else if($_GET["error"]== "invalidemail"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email inserita non valida</p>";
                            }else if($_GET["error"]== "passwordsdontmatch"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Le password inserite non coincidono</p>";
                            }else if($_GET["error"]== "stmtfailed"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Qualcosa è andato storto, prova ancora</p>";
                            }else if($_GET["error"]== "emailtaken"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email inserità già in utilizzo.</p>";
                            }else if($_GET["error"]== "null"){
                                echo "<p class= 'bg-success text-white h5'><em>Iscrizione eseguita con successo!</p>";
                                echo"<p><a href='accesso.php'>Esegui accesso</a></p>";
                            }
                        } 
                    ?>
                </div>
                <h1 class="font-weight-light">Registrazione</h1>
            
                <form  action="includes/registrazione.inc.php" method ="POST" class ="text-center"> 

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
                            <br>
                            <input type="text" name="datanascita" size="20" maxlength="50" placeholder="Data nascita..."/><br>
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