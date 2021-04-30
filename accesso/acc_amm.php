<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$amm_con = new AmministratoreController();

?>


<body>

    <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
        <div class="container" style="background-color: white;">
        <h2 class="modal-title" id="login">Accesso</h2>
            <em>Amministratore:</em><br><br>

            <!--messaggi d'errore-->
            <div  class ="text-center">
                <?php
                
                if (isset($_POST['accedi'])){
                    $emailtrim = $_POST['email'];
                    $passwordtrim = $_POST['password'];
                    $amm_res=$amm_con->checkEsistenza($emailtrim,$passwordtrim);
                    
                    if((ctype_space($emailtrim)||$emailtrim=='')||(ctype_space($passwordtrim)||$passwordtrim=='')){
                        echo"Per favore riempire tutti i campi";
                
                    }else if(count($amm_res)<1){
                        echo"Password/email errata";

                    } else{
                        echo"Dati inseriti correttamente.";
                        
                        echo"<br><a  href=/ebiblio/admin/index.php>Entra sul tuo profilo.</a>";
                    }
                
                    }   

                ?>
            </div>
           

            <form method="POST" action ="#"  class="text-center">
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
             
            </div>
        </div>
    </div>     
</body>
            
            
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>