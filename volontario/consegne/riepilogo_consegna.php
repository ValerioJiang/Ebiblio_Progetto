<?php
require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');


?>


<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">
    <div class="container" style="background-color: white;">
        <br>
        <div class="container">
            <h2>Riepilogo Consegna</h2>
            </br>

            <div class="form-group">
                <label>Consegna effettuata <?php echo date('d-m-Y'); ?></label>
            
            <form method="post">
                <input type="text" name="note" placeholder="Inserire note es. messo dentro buca lettere"><br/>
                <br/>
                <input type="submit" name="confBtn" id="test" class="btn btn-primary" value="Conferma" /><br/>
                <br/>
            </form>
            <a class="btn btn-secondary" role="button" href="http://localhost/ebiblio">Annulla</a>
            <br/>
            </br>
            </br>
            <?php
            if (isset($_POST['confBtn'])) {
                $cons_con = new ConsegnaController();
                $cons_res = $cons_con->updateConsegnaEffettiva($_SESSION['email'], $_GET['codConsegna'],date('Y-m-d', strtotime('+1 days')),$_POST['note']);
                $cons_pi = $cons_con->createConsegnaRestituzione($_GET['codConsegna'],"Restituzione",date('Y-m-d', strtotime('+16 days')));
                
                $client = new MongoDB\Client("mongodb://localhost:27017");

                $companydb = $client->ebiblio;

                $log_events = $companydb->log_events;

                $insertOneResult = $log_events->insertOne(['Utente' => $_SESSION['email'], 'Evento' => 'Consegna effettuata', 'TipologiaUtente' => 'Volontario', 'Timestamp' => date("Y-m-d h:i:sa")]);


                $message = "Consegna effettuata con successo";
                echo "<script type='text/javascript'>alert('$message');
                        document.location.href = 'http://localhost/ebiblio/volontario';
                        </script>";
            }
            ?>


        </div>
    </div>


    <?php
    require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');
    ?>