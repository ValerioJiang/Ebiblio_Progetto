<?php
include('/xampp/htdocs/Ebiblio/includes/autoloader.inc.php');
//require_once ('/xampp/htdocs/Ebiblio/includes/registrazione.inc.php');

$biblio_con = new bibliotecaController();
$biblio_res = $biblio_con->list();      
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Ebiblio-Nuova biblioteca</title>
</head>
<body>

<?php
include('/xampp/htdocs/ebiblio/admin/admin_partials/menu.php');
?>

<section>
<div class="container-fluid " style="background: url('/ebiblio/images/scaffa.jpg') no-repeat;">
    <div class="row justify-content-center">
        <div class="card" style="width: 60%;">
            <div class="card-body p-5 align-self-center">

                <!--messaggi d'errore-->
                <div  class ="text-center">
                    <?php
                    if (isset($_POST['nuovabiblio'])) {
                        $nometrim = trim($_POST['nome']);
                        $emailtrim = trim($_POST['email']);
                        $sitotrim = trim($_POST['sito']);
                        $indirizzotrim = trim($_POST['indirizzo']);
                        $latitudinetrim = trim($_POST['latitudine']);
                        $longitudinetrim = trim($_POST['longitudine']);

                        if ((ctype_space($nometrim)||$nometrim=='')||(ctype_space($emailtrim)||$emailtrim=='')||(ctype_space($sitotrim)||$sitotrim=='')|| (ctype_space($indirizzotrim)||$indirizzotrim=='')(ctype_space($latitudinetrim)||$latitudinetrim=='')(ctype_space($longitudinetrim)||$longitudinetrim=='')){
                          echo "Per favore riempire tutti i campi";
                        } else {
                          $res = $biblioCon->getLikeBiblioteca($_POST['nome']);
                          if (count($res) >=1) {
                            echo "Biblioteca già esistente";
                          }
                        }
                    }
                    ?>
                </div>
                <h1 class="font-weight-light">Registrazione nuova biblioteca</h1>
            
                <form  action=# method ="POST" class ="text-center"> 

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            Nome biblioteca:
                            <br>
                            <input type="text" name="nome" size="30" maxlength="50"placeholder="Nome..."/><br>
                        </div>
                        <div class="form-group col-md-6">
                            Email biblioteca:
                            <br>
                            <input type="text" name="email" size="30" maxlength="50"placeholder ="Email..."/><br>
                        </div>
                    </div>

                    <div class="form-group">
                        Sito web biblioteca:
                            <br>
                            <input type="text" name="sito" size="70" maxlength="50" placeholder="Sito web..."/><br>
                    </div>            

                    <div class="form-row">
                    <div class="form-group col-md">
                        Indirizzo
                        <br>
                        <input type="text" name="indirizzo" size="20" maxlength="50" placeholder="indirizzo..."/><br>
                        </div>
                        <div class="form-group col-md">
                           Latitudine
                            <br>
                            <input type="text" name="latitudine" size="15" maxlength="50"placeholder ="Latitudine..."/><br>
                        </div>
                        <div class="form-group col-md">
                           Longitudine
                            <br>
                            <input type="text" name="longitudine" size="15" maxlength="50"placeholder ="Longitudine..."/><br>
                        </div>
                    </div>

               

                    <div class="form-row">
                        <div class="form-group col-md">
                            Note:
                            <br>
                            <input type="text" name="note" size="70" maxlength="200" placeholder="Note..."/><br>
                        </div>
                    </div>            
                    <br>
                        <button type="submit" class="btn btn-outline-danger" name="nuovabiblio">Salva nuova biblioteca</button>
                    <br></br>
                </form>

                <?php
                    
                ?>
            </div>
                        
        </div>
    </div>
</section>


    <?php
include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
?>
</body>