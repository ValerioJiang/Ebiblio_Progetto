<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$volon_con = new VolontarioController();

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
            <em>volontari:</em><br><br>

            <form method="POST" action ="/ebiblio/volontario/index.php"  class="text-center">
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

            
            <div class="modal-footer m-3">
                <em>Utente non registrato? </em> <a href="registrazione.php">Registrati</a>
            </div>
        </div>
    </div>     
</body>
            
            
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>