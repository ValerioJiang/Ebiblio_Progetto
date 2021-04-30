<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');

$consCon = new ConsegnaController();

?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <h3 class="mb-5">Scegliere le consegne da effettuare</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codice consegna</th>
                        <th>Riferimento codice prestito</th>
                        <th>Tipo Consegna</th>
                        <th>Data</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $cons_res = $consCon -> listConsInCaricoVolo($_SESSION['email']);

                    for ($i = 0; $i < count($cons_res); $i++) {

                        echo '<tr>';
                        echo '<td>' . $cons_res[$i]['Codice'] . '</td>';
                        echo '<td>' . $cons_res[$i]['CodicePrestito'] . '</td>';
                        echo '<td>' . $cons_res[$i]['TipoConsegna'] . '</td>';
                        echo '<td>' . $cons_res[$i]['DataConsegna'] . '</td>';
                        echo '<td>' . $cons_res[$i]['Note'] . '</td>';
                        echo '</tr>';
                    }
                    
                    ?>

                </tbody>
            </table>





        </div>

    </div>

</div>
</div>

<?php

require_once('/xampp/htdocs/ebiblio/main_partials/footer.php');

?>