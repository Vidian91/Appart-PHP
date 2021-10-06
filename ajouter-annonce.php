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

<?php 
    require_once('inc/init.php');

    // jeprint_r($_POST);
    // jeprint_r($_GET);
    // jeprint_r($_FILES);

    if ( !empty($_FILES))
        $filename = $_FILES['photo']['name'] ;

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
    //     $contenu .= '<div class="alert alert-dispo text-center">Une annonce avec le même titre existe déjà. Veuillez en choisir un autre</div>';
    // } else { 
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
                $id_inserted = $pdoBonAppart->lastInsertId() ;
                $listFiles = "" ;
                foreach ( $_FILES['photo']['name'] as $file )
                    $listFiles .= $file . ", " ;
                $contenu .= "<div class='alert alert-succes text-center'>Votre annonce a bien été enregistrée avec le numéro <b>$id_inserted</b>, 
                            et les photos <b>$listFiles</b>   
                            <br><a href='fiche-annonce.php?id=$id_inserted'>cliquez ici pour voir votre bien.</a></div>"; 
            } else {
                $contenu .= "<div class='alert alert-dispo'>Erreur lors de l\'enregistrement !</div>";
            }//fin du if if if ($succes)


            } // fin du if else => vérification du membre
        } //fin if(empty($contenu))

        
    }//fin if !empty

    if ( isset($_FILES) && isset($id_inserted)) {
    // if ( isset($_FILES) ) {
        /* Enregistrer le fichier téléchargé dans le système de fichiers local */ 
        // On renomme le fichier téléchargé sous la forme "IDxxx-nom_du_fichier" où xxx = n° de l'annonce (id)
        jeprint_r($_FILES) ;
        $list = $_FILES['photo'] ;
        $nbFiles = count($list['name']) ;
        for ( $i = 0 ; $i < $nbFiles ; $i++) {
            $filename = "Id" . sprintf("%03d", $id_inserted) . "-" . basename($list['name'][$i]);
            if ( move_uploaded_file($list['tmp_name'][$i], './upload/' . $filename) ) { 
                echo "<strong  style='color: green;'> Succès du Téléchargement, renommé en $filename </strong>"; 
            } else { 
                echo "<strong  style='color: red;'> Échec </strong>"; 
            }
            echo "<br>" ;
        }
    }
?> 


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
                    <form action="" method="POST" class="w-75 mx-auto" enctype="multipart/form-data">

                        <div class="frm-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control w-100" id="title" name="title" value="" placeholder="Titre de l'annonce..." required>
                        </div>
    ​
                        <div class="fom-group">
                            <label for="description">Description du bien immobilier</label>
                            <textarea type="text" class="form-control w-100" id="description" name="description" value="" placeholder="Description du bien..." required></textarea>
                        </div>
    ​
                        <div class="for-group">
                            <label for="ville" class="w-100">Code postal et ville </label>
                            <input type="number" class="fom-control w-25" id="postal_code" name="postal_code" value="" required placeholder="Code postal">
                            <input type="text" class="for-control w-75" id="city" name="city" value="" required placeholder="Ville">
                        </div>
    ​
                        <div class="form-roup">
                            <label for="type">Type de bien :</label>
                            <select id="type" class="fom-control" name="type">
                                <option selected>Sélectionnez le type de bien</option>
                                <option value="vente">Vente</option>
                                <option value="location">Location</option>
                            </select>
                        </div>
    ​
                        <div class="form-group">
                            <label for="price">Prix du bien</label>
                            <input type="number" class="fom-control" name="price" id="price" value="">
                        </div>

                        <div class="form-group">
                            <label for="photo">Ajouter une photo: </label>
                            <input type="file" accept="image/png, image/jpeg" name="photo[]" id="photo" multiple >
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