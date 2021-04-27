<?php

include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$utilizzatoreCon = new UtilizzatoreController();
$segnalaCon = new SegnalazioneController();
$email = $_GET['Email'];

?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col mb-2">
                      <h2> Elimina libro</h2>
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        <table class="table table-hover">
        

            <h6>Stato aggiornato ad attivo.<h6>
        
               
       
            <tbody>

                <?php
                   $attivo=$utilizzatoreCon->setStatoAttivo($email);                    
                   $elimina =$segnalaCon->deleteSegnalazione($email);

                
                ?>

                

                   
            </tbody>
        </table>
        <div style='text-align:right'>
        <br><br>
        <a href = '/ebiblio/admin/rubrica_messaggio.php' >Indietro</a>
        </div>
    </div>
</div>

<?php
  include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
  ?>