<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Ebiblio-Registrazione</title>
</head>
<body>

    <div class="container-fluid " style="  
    background: url('./images/bibliofull.jpg') no-repeat  ;

    ">
        <div class="row justify-content-center">
            <div class="card" style="width: 60%;">
                <div class="card-body p-5 align-self-center">
                    <h1 class="font-weight-light">Registrazione</h1>
                    Nome:
                    <br>
                    <input type="text" name="nome" size="20" maxlength="50"/><br>
                    Cognome:
                    <br>
                    <input type="text" name="cognome" size="20" maxlength="50"/><br>
                    Data di nascita:
                    <br>
                    <input type="text" name="datanascita" size="20" maxlength="50"/><br>
                    Luogo di nascita:
                    <br>
                    <input type="text" name="luogonascita" size="20" maxlength="50"/><br>
                    Email:
                    <br>
                    <input type="text" name="email" size="20" maxlength="50"/><br>
                    Password:
                    <br>
                    <input type="text" name="password" size="20" maxlength="50"/><br>
                    Telefono:
                    <br>
                    <input type="text" name="telefono" size="20" maxlength="50"/><br>
                    Professione:
                    <br>
                    <input type="text" name="professione" size="20" maxlength="50"/><br>

                    <div style="height: 750px"></div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('./main_partials/footer.php');
    ?>


</body>