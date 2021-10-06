<?php 
    require_once('inc/init.php');
?> 
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- font google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">

    <title>Le Bon Appart - Location et vente d'appartement en ligne</title>

    <!-- mes styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- LA NAVIGATION EN INCLUDE -->
    <?php
    require('inc/nav.inc.php')
    ?>
    <!-- JUMBOTRON -->
    <div class="jumbotron text-center">
        <h1>Accueil</h1>
    </div>
        

        <!-- ============================================================== -->
        <!-- Contenu principal -->
        <!-- ============================================================== -->
            <main class="container bg-white">

                <div class="row">
                    <hr>
                    <h2 class="col-sm-12 text-center" id="">Les 15 dernières annonces postées :</h2>
                    <div class="col-sm-12">
                    <?php
                        $requete = $pdoBonAppart->query("SELECT * FROM advert ORDER BY id DESC LIMIT 15");
                        tableau_annonces($requete) ;
                    ?>

                    <div class="mx-auto text-center">
                        <button class="m-2 btn btn-base"><a href="ajouter-annonce.php">Ajouter une annonce</a></button>
                        <button class="m-2 btn btn-base"><a href="consulter-annonce.php">Consulter toutes les annonces</a></button>
                    </div>
                    <br><br>
                </div><!-- fin col -->
            </main>
            <br><br>

    <!-- LE FOOTER EN REQUIRE -->
    <?php
        require("inc/footer.inc.php")
    ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>