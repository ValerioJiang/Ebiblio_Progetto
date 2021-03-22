<?php
    include('../main_partials/menu.php');

    $biblio_con = new BibliotecaController();
    $biblio_res = $biblio_con -> getBiblioteca($_GET['Nome']);

    $tel_con = new TelefonoController();
    $tel_res = $tel_con -> getTelefono($_GET['Nome']);

?>

<div class="container-fluid" style="width: 80%;">
    <h1><?php echo $_GET['Nome']; ?></h1>
    <div class="row justify-content-center">
        <div class="col mb-2">
            Contatti: <br>
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
                echo'<a href = mailto:'. "$var_temp>"."$var_temp"."</a>"
                
            ?></p><br>
        </div>
        
        <div class="col mb-2">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ab laboriosam quas omnis eveniet consequuntur tenetur incidunt blanditiis enim. Dolores quia perspiciatis delectus nesciunt error recusandae asperiores eius. Veritatis, commodi.</div>
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