<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$mod_con = new cartaceoController();
//$mod_res = $mod_con->list();    

?>


    <?php
    require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
    $cartaceo_Con = new CartaceoController();
    ?>

    <section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                        <!--messaggi d'errore-->
                        <div  class ="text-center">
                        <?php
                            $titolo = $_GET['Titolo'];
                            $codice = $_GET['Cod'];
                            $autore = $_GET['Autore'];
                            $genere = $_GET['Genere'];
                            $anno = $_GET['AnnoPubblicazione'];
                            $edizione = $_GET['Edizione'];
                            $pagine = $_GET['Pagine'];
                            $scaffale = $_GET['Scaffale'];

                            echo  "<h1 class='font-weight-light'>Modifica libro esistente</h1>";
                            echo"<form  action=# method ='POST' class ='text-center'>"; 
                            echo"<div class='form-row'><div class='form-group col-md-6'>Titolo:<br><input type=text name=titolo size=70 maxlength=50 placeholder=Titolo... value= '$titolo'  /><br></div></div>";
                            echo"<div class='form-row'><div class='form-group col'>Autore:<br><input type='text' name='autore' size='70' maxlength='50'placeholder ='Autore...' value ='$autore'/><br></div></div>";
                            echo"<div class='form-row'><div class='form-group col'>Edizione:<br><input type='text' name='edizione' size='70' maxlength='50'placeholder ='Edizione...' value ='$edizione'/><br></div></div>";
                            echo "<div class='form-row'><div class='form-group col-md'>Genere:<br><input type='text' name='genere' size='30' maxlength='50' placeholder='Genere...' value ='$genere'/><br></div>";
                            echo "<div class='form-group col-md'>Anno di pubblicazione<br><input type='text' name='anno' size='30' maxlength='50'placeholder ='Anno di pubblicazione...'value = '$anno'/><br></div></div>";
                            echo "<div class='form-row'><div class='form-group col-md'>Numero di pagine:<br><input type='text' name='pagine' size='30' maxlength='50' placeholder='Numero di pagine...' value ='$pagine'/><br></div>";
                            echo "<div class='form-group col-md'>Scaffale<br><input type='text' name='scaffale' size='30' maxlength='50'placeholder ='Scaffale...'value = '$scaffale'/><br></div></div>";
                            
                          echo" <label for='statolibro'>Stato libro</label>
                            <select multiple class='form-control' name = 'statolibro' id='statolibro'>
                              <option>Ottimo</option>
                              <option>Buono</option>
                              <option>Non buono</option>
                              <option>Scadente</option>
                            </select>
                          </div>";


                            echo"  <br><div class='form-group col-md'> <button type='submit' class='btn btn-outline-danger' name='modificalibro'>Salva modifica </button>
                            <br></br>";

                            
                            if (isset($_POST['modificalibro'])) {
                                $titolotrim = trim($_POST['titolo']);
                                $autoretrim = trim($_POST['autore']);
                                $edizionetrim = trim($_POST['edizione']);
                                $generetrim = trim($_POST['genere']);
                                $annotrim = trim($_POST['anno']);
                                $scaffaletrim = trim($_POST['scaffale']);
                                $paginetrim = trim($_POST['pagine']);
                                $statotrim = trim($_POST['statolibro']);
                               

                                $mod_titolo=$mod_con->updateTitolo($codice,$titolotrim);
                                $mod_autore=$mod_con->updateAutore($codice,$autoretrim);
                                $mod_edizione=$mod_con->updateEdizione($codice,$edizionetrim);
                                $mod_genere=$mod_con->updateGenere($codice,$generetrim);
                                $mod_anno=$mod_con->updateAnno($codice,$annotrim);
                                $mod_pagine=$mod_con->updatePagine($codice,$paginetrim);
                                $mod_scaffale=$mod_con->updateScaffale($codice,$scaffaletrim);
                                $mod_stato=$mod_con->updateStato($codice,$statotrim);

                                echo "Libro aggiornato con successo!";
                                   
                                     
                                       
                                }
                            echo "<br><a href = '/ebiblio/admin/libro_admin.php'>Indietro</a>";
                            ?>
                      
                     </div>
                        
                    

                      
          
                  
                </div>
            </div>
        </div>
    </section>

    <?php
        include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
    ?>
