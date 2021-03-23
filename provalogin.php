<!--LOGIN-->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="login">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        
                        <form action ="" method ="POST" class ="text-center"> <!--biblioteche.php-->
                            <p>Accedi al tuo profilo Ebiblio:<br><br>
                            E-mail:
                            <br>
                            <input type="text" name="email" size="20" maxlength="50" /><br>
                            Password:
                            <br>
                            <input type="password" name="password" size="20" maxlength="50"  /><br>
                            <br>

                            <!--<div class="form-check m-3 text-center">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value=""> Ricordami     
                                </label>
                                </div>-->

                            <button type="submit" name ="accedi" class="btn btn-outline-danger">Accedi</button>
                        </form>

                        <div class="modal-footer m-3">
                            <em>Utente non registrato? </em> <a href="registrazione.php">Registrati</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
//controllo bottone submit
if (isset($_POST['accedi'])){
    //process for login
    //get the data login from login form
    echo $email =$_POST['email'];
    echo $password=$_POST['password'];
}

?>