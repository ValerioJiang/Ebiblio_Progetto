<?php
require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');




?>

<div class="container-fluid " style="  
background: url('/ebiblio/images/bibliofull.jpg') no-repeat  ;

">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">
                <h1 class="font-weight-light">Benvenuto <?php echo $volon_getLike[0]['Nome'];?> </h1>
                <p class="lead">Il sistema di gestione consegne ufficiale per volontari</p>
                Nella sezione Consegna potrai consultare:
                <ul>
                    <li>Ricerca e informazione sulle consegne da tutte le biblioteche e utenti</li>
                    <li>Consegne prese in carico</li>
                    <li>Consegne passate</li>

                </ul>
            </div>

        </div>

    </div>

</div>


<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/footer.php');

?>