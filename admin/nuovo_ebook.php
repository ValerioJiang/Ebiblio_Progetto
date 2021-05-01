<?php

require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
$amministratoreCon = new AmministratoreController();
$cartaceo_Con = new CartaceoController();
$cartaceo_res = $cartaceo_Con->list();   
$biblio_res = $amministratoreCon->getLikeAmministratoreBiblio($_SESSION['email']);

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
                        <div  class ="text-center">

                            
                    </div>
            
                    <h1 class="font-weight-light">Inserimento nuovo Ebook</h1>
            
                    <form  action="/ebiblio/admin/nuovo_autori.php" method ="GET" class ="text-center"> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                               Titolo:
                                <br>
                                <input type="text" name="titolo" size="70" maxlength="50"placeholder="Titolo..."/><br>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                            Edizione:
:
                                <br>
                                <input type="text" name="edizione" size="70" maxlength="50"placeholder="Edizione..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-6">
                                Genere:
                                <br>
                                <input type="text" name="genere" size="30" maxlength="50"placeholder ="Genere..."/><br>
                            </div>
                            <div class="form-group col-md-6">
                                Anno pubblicazione:
                                <br>
                                <input type="text" name="anno" size="30" maxlength="50"placeholder="Anno pubblicazione..."/><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                               <!-- Dimensione:
                                <br>
                                <input type="text" name="pagine" size="30" maxlength="50"placeholder ="Numero pagine..."/><br>
                            </div>
                            <div class="form-group col-md-6">--->
                                Pdf:
                                <br>
                                <input type="text" name="scaffale" size="70" maxlength="50"placeholder ="Pdf..."/><br>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-danger" name="nuovoebook">Salva nuovo ebook</button>
                        <br></br>
                        <a href = "/ebiblio/admin/ebook_admin.php">Indietro</a>


                    </form>
                    
                   
                  
                </div>
                        
            </div>
        </div>
    </section>


    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
