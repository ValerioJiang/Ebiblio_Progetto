<?php

require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
$autoreCon = new AutoreController();


if (!isset($_GET['nuovolibro'])) {
    echo "<script type='text/javascript'>alert('Errore ritornare home');
                    window.location = 'http://localhost/ebiblio/admin/'; 
                    </script>";
}
$amministratoreCon = new AmministratoreController();
$autCon = new AutoreController();
$autLibCon = new AutoreLibroController();
$ebook_Con = new EbookController();

$biblioteca = $amministratoreCon->getLikeAmministratoreBiblio($_SESSION['email']);
$titolotrim = trim($_GET['titolo']);
$edizionetrim = trim($_GET['edizione']);
$generetrim = trim($_GET['genere']);
$annotrim = trim($_GET['anno']);
?>

<div class="container" style="background-color: white;">
    <br>
    <div class="container">
        <form action="/ebiblio/admin/nuovi_autori_ebook.php?" method="GET">
            <div class="form-group">
                <div class="row">
                    <div class="col mb-2">
                        <div>
                            <label for='numAut'>Numero Autori</label>
                            <select multiple class='form-control' name='numAut' id='statolibro'>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="titolo" class="btn btn-primary" value="<?php echo $titolotrim; ?>"></input>
            <input type="hidden" name="edizione" class="btn btn-primary" value="<?php echo $edizionetrim; ?>"></input>
            <input type="hidden" name="genere" class="btn btn-primary" value="<?php echo $generetrim; ?>"></input>
            <input type="hidden" name="anno" class="btn btn-primary" value="<?php echo $annotrim; ?>"></input>
            <input type="hidden" name="nuovolibro" class="btn btn-primary" value="true"></input>

            <input type="submit" name="autform_submitted" class="btn btn-primary" value="Aggiungi Autori"></input>
            <br>
        </form>
        <br>
    </div>
    <br>
    <?php
    if (isset($_GET['autform_submitted']) && isset($_GET['numAut'])) {


        if ((ctype_space($titolotrim) || $titolotrim == '') || (ctype_space($edizionetrim) || $edizionetrim == '') || (ctype_space($generetrim) || $generetrim == '') || (ctype_space($annotrim) || $annotrim == '') ) {
            echo "Per favore riempire tutti i campi";
        } else {

            echo '<div class="container">';
            echo '<form action="/ebiblio/admin/caricapdf.php" method="GET">';
            echo '<div class="form-group">';
            echo '<input type="hidden" name="numAut" class="btn btn-primary" value="'. $_GET['numAut'] .'"></input>';

            echo '<input type="hidden" name="titolo" class="btn btn-primary" value="'.$_GET['titolo'].'"></input>';
            echo '<input type="hidden" name="edizione" class="btn btn-primary" value="'.$_GET['edizione'].'"></input>';
            echo '<input type="hidden" name="genere" class="btn btn-primary" value="'.$_GET['genere'].'"></input>';
            echo '<input type="hidden" name="anno" class="btn btn-primary" value="'.$_GET['anno'].'"></input>';
            echo '<input type="hidden" name="nuovolibro" class="btn btn-primary" value="true"></input>';

            for ($i = 0; $i < $_GET['numAut']; $i++) {
                echo "<div class='form-row'>";
                echo "<br>";
                echo "<input type='text' class='form-control' name='nomaut" . $i . "' id='titoloId' aria-describedby='emailHelp' placeholder='Inserire nome autore " . $i . "'>";
                echo "<br>";
                echo "<input type='text' class='form-control' name='cogaut" . $i . "' id='titoloId' aria-describedby='emailHelp' placeholder='Inserire cognome autore " . $i . "'>";
                echo "<br>";
                echo "</div>";
                echo "<br>";
            }
            echo "<br>";
            
            echo '<button type="submit" class="btn btn-outline-danger" name="insDef">Salva libro con autori</button>';
            
        }
    }
    ?>
</div>


<?php
include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
?>