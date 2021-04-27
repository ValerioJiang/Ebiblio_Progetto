<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');

$segnalazioneCon = new SegnalazioneController();
?>

<section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                    <div  class ="text-center">
                        <?php  

                            $email = $_GET['Email'];
                            if (isset($_POST['segnala'])) {
                                    
                                $notetrim = trim($_POST['note']);
                                $segnalazione=$segnalazioneCon->createSegnalazione($email,$_SESSION['email'],$notetrim);
                                echo"Segnalazione inserita.";
                                                    
                            }
                        ?>
                    </div>
            
                    <h1 class="font-weight-light">Segnala un comportamento errato</h1>
                    
            
                    <form  action=# method ="POST" class ="text-center"> 
                    <?php

                    $email = $_GET['Email'];
                    echo "<br>Segnala un comportamento errato di ". $email .':';
                    ?>

                        <form  action=# method ="POST"> 
                                <div class="form-group">
                                <br>
                                <label for="comment">Note (Facoltativo):</label>
                                <textarea class="form-control" rows="5" name="note" placeholder="Note..."></textarea>
                            </div>
                                  
                            <button type="submit" class="btn btn-outline-danger" name="segnala">Segnala</button>
                            <br></br>
                            <a href = "/ebiblio/admin/rubrica_messaggio.php">Indietro</a>                   

                        </form>


                    </form>
                    
                   
                  
                </div>
                        
            </div>
        </div>
    </section>




    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
