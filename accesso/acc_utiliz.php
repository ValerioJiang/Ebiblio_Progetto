<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');
$utiliz_con = new UtilizzatoreController();

?>


<body>

    <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
        <div class="container" style="background-color: white;">
        <div  class ="text-center">
        </div>
            <h2 class="modal-title" id="login">Accesso</h2>
            <em>Utilizzatore:</em><br><br>

            <form method="POST" action ="/ebiblio/utilizzatore/index.php"  class="text-center">
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
                <em>Utente non registrato? </em> <a href="/ebiblio/registrazione.php">Registrati</a>
            </div>
        </div>
    </div>     
</body>
            
            
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>