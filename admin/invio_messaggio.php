<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$cartaceo_Con = new CartaceoController();
$cartaceo_res = $cartaceo_Con->list();      
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

                        <?php
                                   
                            if (isset($_POST['invio'])) {
                                    
   
                                       
                                       
                            }
                                        
                                  
                        ?>



                            <h1 class="font-weight-light">Invia messaggio</h1>
                            Invia un messaggio a: #indirizzo email
                            
                            <div class="form-row">
                            <div class="form-group ">
                            <br>
                               Oggetto/Titolo messaggio:
                                <br>
                                <input type="text" name="titolo" size="50" maxlength="50"placeholder="Oggetto/Titolo..."/><br>
                            </div>
                        </div>
                            
                            <form  action=# method ="POST" class ="text-center"> 
                                <div class="form-group">
                                <label for="comment">Invia un messaggio a: #indirizzo email</label>
                                <textarea class="form-control" rows="5" id="messaggio" placeholder="Messaggio..."></textarea>
                            </div>
                                  
                            <button type="submit" class="btn btn-outline-danger" name="invio">Invio</button>
                            <br></br>
                            <a href = "#">Indietro</a>                        

                        </form>
            
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
