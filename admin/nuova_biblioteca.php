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
                    /*
                        if(isset($_GET["error"])){
                            if($_GET["error"]== "emptyinput"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Riempire tutti i campi</em></p>";
                            }else if($_GET["error"]== "invalidemail"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email inserita non valida</p>";
                            }else if($_GET["error"]== "passwordsdontmatch"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Le password inserite non coincidono</p>";
                            }else if($_GET["error"]== "stmtfailed"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Qualcosa è andato storto, prova ancora</p>";
                            }else if($_GET["error"]== "emailtaken"){
                                echo "<p class='bg-warning text-white h5'>ERRORE: <em>Email inserità già in utilizzo.</p>";
                            }else if($_GET["error"]== "null"){
                                echo "<p class= 'bg-success text-white h5'><em>Iscrizione eseguita con successo!</p>";
                                echo"<p><a href='accesso.php'>Esegui accesso</a></p>";
                            }
                        }*/ 
                    ?>
                </div>
                <h1 class="font-weight-light">Registrazione nuova biblioteca</h1>
            
                <form  action="includes/registrazione.inc.php" method ="POST" class ="text-center"> 

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
            </div>
                        
        </div>
    </div>
</section>

    <!--messaggi d'errore:-->
    <?php
include('/xampp/htdocs/ebiblio/admin/admin_partials/footer.php');
?>
</body>