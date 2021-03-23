<?php
include('../main_partials/menu.php');

$biblio_con = new BibliotecaController();
$biblio_res = $biblio_con->getBiblioteca($_GET['Nome']);

$tel_con = new TelefonoController();
$tel_res = $tel_con->getTelefono($_GET['Nome']);

?>

<div class="container-fluid" style="width: 80%;">
    <h1><?php echo $_GET['Nome']; ?></h1>
    <div class="row justify-content-center">
        <div class="col mb-2">
            <h3>Contatti:</h3><br>
            <?php
            echo '<ul>';
            for ($i = 0; $i < count($tel_res); $i++) {
                echo '<li>' . ($tel_res[$i]['NumeroTelefono']) . '</li>';
            }
            echo '</ul><br>';
            ?>
            <p>Email:
                <?php
                $var_temp = $biblio_res[0]['Email'];
                echo '<a href = mailto:' . "$var_temp>" . "$var_temp" . "</a>"
                ?></p>

            <p>Sito Web:
                <?php
                $var_temp = $biblio_res[0]['SitoWeb'];
                echo '<a href = ' . "$var_temp>" . "$var_temp" . "</a>"
                ?></p>
            
        </div>

        <div class="col mb-2">
            <h3>Servizi: </h3><br>
            Prenotazione Posto Lettura(Max 4h per giorno):<br>



        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col mb-2">
            <h3>Note:</h3>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. At voluptatibus maxime mollitia repellendus minima officiis dicta assumenda quis, sit provident, rerum aperiam quasi libero eveniet sapiente tempore veniam iste reprehenderit.
        </div>
        <div class="col mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus ad assumenda, labore excepturi, blanditiis dolores ea impedit molestiae voluptatum beatae dignissimos, veniam deleniti ipsum? Officiis eius unde blanditiis dolor distinctio.</div>
    </div>
    <div class="row justify-content-center">
        <div class="col mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ab laboriosam quas omnis eveniet consequuntur tenetur incidunt blanditiis enim. Dolores quia perspiciatis delectus nesciunt error recusandae asperiores eius. Veritatis, commodi.</div>
        <div class="col mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus ad assumenda, labore excepturi, blanditiis dolores ea impedit molestiae voluptatum beatae dignissimos, veniam deleniti ipsum? Officiis eius unde blanditiis dolor distinctio.</div>
    </div>
</div>



<?php
include('../main_partials/footer.php');
?>