<?php
//session_start();

include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$utente_con = new UtilizzatoreController();
$utente_res = $utente_con->list();
function infoBoxLogin($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>


<body>

    <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
        <div class="container" style="background-color: white;">

            <!--messaggi d'errore-->
            <div  class ="text-center">
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"]== "emptyinput"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Riempire tutti i campi</em></p>";
                        }else if($_GET["error"]== "emailorpasswordwrong"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email o Password errata.</p>";                        
                        }else if($_GET["error"]== "stmtfailed"){
                            echo "<p class='bg-warning text-white h5'>ERRORE: <em>Qualcosa è andato storto, prova ancora</p>";
                        }else if($_GET["error"]== "null"){
                            echo "<p class= 'bg-success text-white h5'><em>Accesso eseguito</p>";
 
                        }
                    } 
                ?>
                </div>
            <h2 class="modal-title" id="login">Accesso</h2>
            <em>Accedi al tuo profilo Ebiblio:</em><br><br>

            <form method="POST" action =""  class="text-center">
                E-mail:
                <br>
                <input type="text" name="email" size="20" maxlength="50" placeholder="Email..." />
                <br>
                Password:
                <br>
                <input type="password" name="password" size="20" maxlength="50" placeholder="Password..." /><br>
                <br>
                <button type="submit" class="btn btn-outline-danger" name="accedi">Accedi</button>
            </form>

            <?php
                $utilizzatore_con = new UtilizzatoreController();
                if(isset($_POST["accedi"])){
                    $email =$_POST['email'];
                    $password =$_POST['password'];
                    $utili_res = $utilizzatore_con->checkEsistenza($email,$password);
                  
                    //controllo riempimento di tutti i campi:
                    if((empty($email) || empty($password))!==false){
                        echo "Email o Password vuoti";
                    }
                
                    //controllo iscrizione al database o meno:
                    $utilizzatore_con = new UtilizzatoreController();
                    $utente_checkEsistenza= $utilizzatore_con->checkEsistenza($email,$password);
                
                    if(count($utente_checkEsistenza) == 0){
                        echo "utente non esiste";
                    }else{
                        session_start();
                        $_SESSION['Utente'] = $_POST['email'];
                        echo var_dump($_SESSION);
                
                    }
                }
            
            ?>
            <div class="modal-footer m-3">
                <em>Utente non registrato? </em> <a href="registrazione.php">Registrati</a>
            </div>
        </div>
    </div>     
</body>
            
            
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>