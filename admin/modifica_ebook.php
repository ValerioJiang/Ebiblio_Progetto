<?php
require_once('/xampp/htdocs/Ebiblio/admin/admin_partials/menu.php');

$ebook_con = new EbookController();

?>

    <section>
        <div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
            <div class="row justify-content-center">
                <div class="card" style="width: 60%;">
                    <div class="card-body p-5 align-self-center">

                        <div  class ="text-center">
                        <?php
                            $titolo = $_GET['Titolo'];
                            $codice = $_GET['Cod'];
                            $genere = $_GET['Genere'];
                            $anno = $_GET['AnnoPubblicazione'];
                            $edizione = $_GET['Edizione'];


                            echo  "<h1 class='font-weight-light'>Modifica libro esistente</h1>";
                            echo"<form  action=# method ='POST' class ='text-center'>"; 
                            echo"<div class='form-row'><div class='form-group col-md-6'>Titolo:<br><input type=text name=titolo size=70 maxlength=50 placeholder=Titolo... value= '$titolo'  /><br></div></div>";
                            echo"<div class='form-row'><div class='form-group col'>Edizione:<br><input type='text' name='edizione' size='70' maxlength='50'placeholder ='Edizione...' value ='$edizione'/><br></div></div>";
                            echo"<div class='form-row'><div class='form-group col'>Edizione:<br><input type='text' name='anno' size='70' maxlength='50'placeholder ='Anno...' value ='$anno'/><br></div></div>";
                            echo "<div class='form-row'><div class='form-group col-md'>Genere:<br><input type='text' name='genere' size='30' maxlength='50' placeholder='Genere...' value ='$genere'/><br></div>";

                            echo"  <br><div class='form-group col-md'> <button type='submit' class='btn btn-outline-danger' name='modificalibro'>Salva modifica </button>
                            <br></br>";

                            
                            if (isset($_POST['modificalibro'])) {
                                $titolotrim = trim($_POST['titolo']);
                                $edizionetrim = trim($_POST['edizione']);
                                $generetrim = trim($_POST['genere']);
                                $annotrim = trim($_POST['anno']);
 
                               
                        if ((ctype_space($titolotrim)||$titolotrim=='')||(ctype_space($edizionetrim)||$edizionetrim=='')|| (ctype_space($generetrim)||$generetrim=='')||(ctype_space($annotrim)||$annotrim=='')){
                            echo "Per favore riempire tutti i campi";
                        }else{
                                $mod_titolo=$ebook_con->updateTitolo($codice,$titolotrim);
                                $mod_edizione=$ebook_con->updateEdizione($codice,$edizionetrim);
                                $mod_genere=$ebook_con->updateGenere($codice,$generetrim);
                                $mod_anno=$ebook_con->updateAnno($codice,$annotrim);

                               
                                echo "Ebook aggiornato con successo!";

                            }
      
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
