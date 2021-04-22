<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$biblio_con = new bibliotecaController();
$biblio_res = $biblio_con->list();    

session_start();
?>


    <?php
    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
    $biblioCon = new BibliotecaController();
    ?>

    <section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                        <!--messaggi d'errore-->
                        <div  class ="text-center">
                        
                            <?php
                            /*On page 1
                            $_SESSION['varname'] = $var_value;

                            //On page 2
                            $var_value = $_SESSION['varname'];*/
                                    
                            ?>
                    </div>
            
                    <h1 class="font-weight-light">Modifica libro esistente</h1>
            
            <form  action=# method ="POST" class ="text-center"> 

                <div class="form-row">
                    <div class="form-group col-md-6">
                       Titolo:
                        <br>
                        <input type="text" name="titolo" size="70" maxlength="50"placeholder="Titolo..."  /><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        Nome autore:
                        <br>
                        <input type="text" name="nome" size="30" maxlength="50"placeholder="Nome..."/><br>
                    </div>
                    <div class="form-group col-md-6">
                        Cognome autore:
                        <br>
                        <input type="text" name="cognome" size="30" maxlength="50"placeholder ="Cognome..."/><br>
                    </div>
                </div>

                
                <div class="form-row">
                    <div class="form-group col">
                        Edizione:
                        <br>
                        <input type="text" name="edizione" size="70" maxlength="50"placeholder ="Edizione..."/><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        Genere:
                        <br>
                        <input type="text" name="genere" size="30" maxlength="50" placeholder="Genere..."/><br>
                    </div>
                    
                    <div class="form-group col-md">
                    Anno di pubblicazione
                        <br>
                        <input type="text" name="anno" size="30" maxlength="50"placeholder ="Anno di pubblicazione..."/><br>
                    </div>
                
                </div>

        
                    <button type="submit" class="btn btn-outline-danger" name="modificalibro">Salva modifica </button>
                    <br></br>
                    <a href = "/ebiblio/admin/libro_admin.php">Indietro</a>


            </form>
            
           
          
        </div>
                
    </div>
</div>
</section>

    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
