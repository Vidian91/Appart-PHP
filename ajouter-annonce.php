<?php 
    require_once('inc/init.php');

    if ( !empty($_POST)) {

        if (!isset($_POST['title']) || strlen($_POST['title']) < 5 ||  strlen($_POST['title']) > 50) {
            $contenu .="<div class=\"alert alert-dispo\">Le titre doit contenir entre 5 et 50 caractères !</div>"; 
        } // fin title

        if (!isset($_POST['description']) || strlen($_POST['description']) < 10 ) {
            $contenu .="<div class=\"alert alert-dispo\">Veuillez décrire votre bien immobilier de façon précise</div>"; 
        } // fin description

        if (!isset($_POST['postal_code']) || !preg_match( '#^[0-9]{5}$#', $_POST['postal_code']) ) {
            $contenu .="<div class=\"alert alert-dispo\">Le code postal n'est pas valable</div>"; // est ce que le code postal correspond à l'expression régulière précisée, le regex 'regular rexpression'
        }// fin code_postal

        if (!isset($_POST['city']) || strlen($_POST['city']) < 1 ||  strlen($_POST['city']) > 20) {
            $contenu .="<div class=\"alert alert-dispo\">La ville doit contenir entre 1 et 20 caractères !</div>"; 
        }// fin ville

        if (!isset($_POST['type']) || $_POST['type'] !='location' && $_POST['type'] != 'vente' ) {
            $contenu .="<div class=\"alert alert-dispo\">Ce type de bien n'est pas valable.</div>";
        }// fin type

        if(empty($contenu)) { // si la variable est vide il n'y a pas d'erreur sur le formulaire
            $advert = executeRequete ( " SELECT * FROM advert WHERE title = :title ", array(':title' => $_POST['title']));
            if ($advert->rowCount() > 0) {
                $contenu .= '<div class="alert alert-dispo">Ce titre est indisponible veuillez en choisir un autre</div>';
            } else { 
                $succes = executeRequete( " INSERT INTO advert (title, description, postal_code, city, type, price, reservation_message) VALUES (:title, :description, :postal_code, :city, :type, :price, '') ",
                array (
                    ':title' => $_POST['title'],
                    ':description' => $_POST['description'],
                    ':postal_code' => $_POST['postal_code'],
                    ':city' => $_POST['city'],
                    ':type' => $_POST['type'],
                    ':price' => $_POST['price'],
                    
                ));

            if ($succes) {
                $contenu .= '<div class="alert alert-succes">Votre demande a bien été enregistrée, <a href="consulter-annonces.php">cliquez ici pour voir votre bien.</a></div>'; 
            } else {
                $contenu .= '<div class="alert alert-dispo">Erreur lors de l`\enregistrement !</div>';
            }//fin du if if if ($succes)


            } // fin du if else => vérification du membre
        } //fin if(empty($contenu))

        
    }//fin if !empty
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
        <h1>Ajouter une annonce</h1>
    </div>

        <!-- ============================================================== -->
        <!-- Contenu principal -->
        <!-- ============================================================== -->
        <main class="container bg-white">

            <div class="row">
                <h2 class="col-sm-8 mx-auto text-center">Ajouter une annonce</h2>
                   
                <div class="col-sm-12">
    ​
                    <?php 
                    echo $contenu;
                    ?> 
                    <form action="" method="POST" class="w-50 mx-auto">

                        <div class="frm-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" value="" required>
                        </div>
    ​
                        <div class="fom-group">
                            <label for="description">Description du bien immobilier</label>
                            <textarea type="text" class="form-control" id="description" name="description" value="" required></textarea>
                        </div>
    ​
                        <div class="for-group">
                            <label for="sexe">Code postal et ville </label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="" required placeholder="Ici, entrez le code postal de votre bien">
                            <input type="text" class="form-control" id="city" name="city" value="" required placeholder="Ici, entrez le nom de la ville">
                        </div>
    ​
                        <div class="form-roup">
                            <label for="type">Type de bien :</label>
                            <select id="type" class="form-control" name="type">
                                <option selected>Sélectionnez le type de bien</option>
                                <option value="vente">Vente</option>
                                <option value="location">Location</option>
                            </select>
                        </div>
    ​
                        <div class="form-group">
                            <label for="price">Prix du bien</label>
                            <input type="text" class="form-control" name="price" id="price" value="">
                        </div>
    ​
                        <button type="submit" class="btn btn-base">Envoyer</button>
                    </form>

                    </div><!-- fin de la colonne -->

                </div><!-- fin de la rangée -->

                <br><br>

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