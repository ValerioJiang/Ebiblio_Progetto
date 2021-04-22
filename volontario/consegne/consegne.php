<?php

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');

session_start();

?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <h3 class="mb-5">Scegliere tra le consegne disponibili</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Prestito</th>
                        <th>Tipo Consegna</th>
                        <th>Note</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $codLibro = $_GET['codLibro'];
                    $rac_res = $rac_con->getRaccolta($codLibro);

                    for ($i = 0; $i < count($rac_res); $i++) {

                        echo '<tr>';
                        echo '<td>' . $rac_res[$i]['Biblioteca'] . '</td>';
                        echo '<td>' . $rac_res[$i]['Scaffale'] . '</td>';
                        echo '<td>' . $rac_res[$i]['StatoConservazione'] . '</td>';
                        echo '<td>' . $rac_res[$i]['StatoDisponibilita'] . '</td>';
                        echo '<td>' . '15 Giorni' . '</td>';
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/ritiroLibro.php?codLibro=' . $_GET['codLibro'] . '&ritiroLibro=true&Titolo=' . $_GET['Titolo'] . '&nomeBiblio=' . $rac_res[$i]['Biblioteca'] . '&scaffale=' . $rac_res[$i]['Scaffale'] . '"' . '>Ritiro in biblioteca</a></td>';
                        echo '<td><a class="btn btn-info" role="button" href="http://localhost/ebiblio/libro_prenot/consegnaLibro.php?codLibro=' . $_GET['codLibro'] . '&consegnaLibro=true&Titolo=' . $_GET['Titolo'] . '&nomeBiblio=' . $rac_res[$i]['Biblioteca'] . '&scaffale=' . $rac_res[$i]['Scaffale'] . '"' . '">Consegna</a></td>';
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

require_once('/xampp/htdocs/ebiblio/volontario/main_partials/footer.php');

?>