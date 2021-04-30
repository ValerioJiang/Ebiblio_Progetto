<?php
require_once('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');

$admin_con = new AmministratoreController();


?>

<div class="container-fluid " style="  
background: url('/ebiblio/images/bibliofull.jpg') no-repeat  ;

">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">
                <h1 class="font-weight-light">Benvenuto amministratore </h1>
                <p class="lead">Il sistema di gestione per amministratori</p>
                Nella sezione Consegna potrai:
                <ul>
                    <li>Inserire, cancellare, aggiornare qualsiasi libro presso la biblioteca gestita</li>
                    <li>Visualizzare le prenotazioni dei libri e dei posti a sedere presenti presso la biblioteca gestita</li>
                    <li>Segnalare un comportamento non corretto</li>
                    <li>Rimuovere tutte le segnalazioni di un utente, riportando lo stato ad Attivo</li>
                    <li>Inviare un messaggio ad un qualsiasi utente</li>

                </ul>
            </div>

        </div>

    </div>

</div>


<?php

require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');

?>