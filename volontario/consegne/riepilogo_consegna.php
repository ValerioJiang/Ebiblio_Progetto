<?php
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
            </div>
            <form method="post">
                <input type="text" name="note" placeholder="Inserire note es. messo dentro buca lettere"><br />
                <input type="submit" name="confBtn" id="test" class="btn btn-primary" value="Conferma" /><br />
            </form>
            <a class="btn btn-secondary" role="button" href="http://localhost/ebiblio">Annulla</a>

            </br>
            </br>
            <?php
            if (isset($_POST['confBtn'])) {
                $cons_con = new ConsegnaController();
                $cons_res = $cons_con->updateConsegnaEffettiva($_SESSION['email'], $_GET['codConsegna'],date('Y-m-d', strtotime('+1 days')),$_POST['note']);

                $message = "Consegna ";
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