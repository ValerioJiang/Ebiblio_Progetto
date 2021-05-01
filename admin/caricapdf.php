<?php
require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$amministratoreCon = new AmministratoreController();
$autCon = new AutoreController();
$autLibCon = new AutoreLibroController();
$ebook_Con = new EbookController();

if (isset($_GET['insDef'])) {
    $titolotrim = trim($_GET['titolo']);
    $edizionetrim = trim($_GET['edizione']);
    $generetrim = trim($_GET['genere']);
    $annotrim = $_GET['anno'];
    $numAut = $_GET['numAut'];
}


?>
<div class="container-fluid " style="  
background: url('/ebiblio/images/bibliofull.jpg') no-repeat  ;

">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">
                <form method="POST" enctype="multipart/form-data">
                    <p><input type="file" name="coverimg" required="required" /></p>
                    <p><input type="submit" name="cover_up" style="background-color: rgb(255, 102, 0);" class="btn btn-warning" value="Upload" /></p>
                </form>
            </div>

        




        <?php
        if (isset($_POST['cover_up'])) {

            $imgFile = $_FILES['coverimg']['name'];
            $tmp_dir = $_FILES['coverimg']['tmp_name'];
            $imgSize = $_FILES['coverimg']['size'];


            $imgSize = floor($imgSize / 1000);

            if (!empty($imgFile)) {

                if (!is_dir("C:/xampp/htdocs/Ebiblio/pdf_ebook/")) {
                    mkdir("C:/xampp/htdocs/Ebiblio/pdf_ebook/");
                }

                $upload_dir = "C:/xampp/htdocs/Ebiblio/pdf_ebook/"; // upload directory

                $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

                // valid image extensions
                $valid_extensions = array('pdf'); // valid extensions

                // rename uploading image
                $coverpic = $imgFile;

                // allow valid image file formats
                if (in_array($imgExt, $valid_extensions)) {
                    // Check file size '5MB'


                    $creazioneebook = $ebook_Con->createEbook(basename($imgFile) , $edizionetrim, $generetrim, $annotrim, $imgSize);
                    

                    

                    $aut_list = array();

                    for ($i = 0; $i < $numAut; $i++) {
                        $autore_res = $autCon->getLikeAutoreCartaceo($_GET['nomaut' . $i], $_GET['cogaut' . $i]);

                        if (count($autore_res) < 1) {
                            $aut_crea = $autCon->createAutore($_GET['nomaut' . $i], $_GET['cogaut' . $i]);

                            $aut_cod = $autCon->getAutCod($_GET['nomaut' . $i], $_GET['cogaut' . $i]);
                            $aut_list[] = $aut_cod[0]['Codice'];
                        }
                    }
                    $ebook_cod = $ebook_Con->getLikeLibroUtil($imgFile);
                    $codLibro = $ebook_cod[0]['Codice'];
                    for ($j = 0; $j < count($aut_list); $j++) {

                        $autlib_res = $autLibCon->createAutLib($aut_list[$j], $codLibro);
                    }
                    echo "Libro inserito con successo";
                    echo "<br><a href=/ebiblio/admin/libro_admin.php>Indietro</a>";
                    move_uploaded_file($tmp_dir, $upload_dir . $coverpic);
                    echo "uploading Done";
                }
            } else {
                $errMSG = "Sorry, only PDF files are allowed.";
            }
        } else {
            echo "Not uploaded";
        }

        ?>
        </div>
    </div>

</div>


<?php

require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');

?>