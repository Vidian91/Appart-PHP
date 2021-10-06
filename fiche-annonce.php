<?php 
    require_once('inc/init.php');

    if (isset ($_GET['id'])) {
        $resultat = $pdoBonAppart->prepare("SELECT * FROM advert WHERE id = :id");
        $resultat->execute(array (':id' => $_GET['id'] ));
    
        if($resultat->rowCount() == 0) {
            header('location:consulter-annonces.php');
            exit();
        }
        $listPhotos = getPhotos($_GET['id']) ;
        if (count($listPhotos) == 0) $photo = "img/interieur.jpg" ;
        else $photo = "./upload/" . $listPhotos[0] ;
        // $id = "Id" . sprintf("%03d", $_GET['id']) ;
        // echo "id= $id, photo= $photo" ;
        $fiche = $resultat->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location:consulter-annonces.php');
        exit();
    }

    if(!empty($_POST['reservation_message'])) {
        $_POST['reservation_message'] = htmlspecialchars($_POST['reservation_message']);
        $requete = $pdoBonAppart->prepare("UPDATE advert SET reservation_message = :reservation_message WHERE id = :id");
        $requete->execute(array (
          ':reservation_message' => $_POST['reservation_message'],
          ':id' => $_GET['id'],
      ));
      if($requete) {
        echo "<div class=\"alert alert-success\">Le bien est réservé ! <a href=\"consulter-annonces.php\">Retour aux annonces</a></div>";
      }else {
        echo "<div class=\"alert alert-danger\">Oups ! Une erreur est survenue, veuillez réessayer.</div>";
      }
    }


?> 
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- mon style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Produit #<?php echo $fiche['id']; ?></title>
</head>

<body>
      <!-- LA NAVIGATION EN INCLUDE -->
      <?php
    require('inc/nav.inc.php')
    ?>

    <!-- JUMBOTRON -->
    <div class="jumbotron text-center">
        <h1>Consulter une annonce</h1>
    </div>

    <!-- ============================================================== -->
    <!-- Contenu principal -->
    <!-- ============================================================== -->
    <main class="container bg-white m-4 mx-auto p-4">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Découvrez notre bien : #<?php echo $fiche['id'] ?>!</h2>

                <div class="card mx-auto" style="width: 50%">
                    <h5 class="card-title text-center"><?php echo $fiche['title']; ?></h5>
            
                    <div class="card-body d-flex flex-wrap align-items-center">
                        <?php 
                        if(count($listPhotos) != 0)
                            foreach ( $listPhotos as $photo) 
                                echo "<div class='flex-shrink-1 ms-3'><img  src='./upload/$photo' alt='$photo' ></div>" ;
                        else
                            echo "<img src='./$photo' alt='$photo' >" ;
                        
                        //   echo "<img src='./upload/$photo' alt='interieur/le bon appart' class='card-img-top'>" ;
                          ?>
                        <p class="card-text"><?php 
                        echo "<strong>Description</strong> : " .ucfirst($fiche['description']). "<br><strong> Ville</strong> : " .ucfirst($fiche['city']). "<br><strong>Code postal :</strong> " .$fiche['postal_code']. "<br><strong>Type de bien :</strong> ";
                        if($fiche['type'] == 'location') {
                            echo "À louer ";
                        }else{
                            echo "À acheter";
                        }
                        $fmt = new NumberFormatter( 'ru_RU', NumberFormatter::CURRENCY );
                        echo "<br><strong>Prix :</strong> " .$fmt->formatCurrency($fiche['price'], "EUR"); 
                        if(!empty($fiche['reservation_message'])){
                            echo "<br><strong>Le message de réservation : </strong>" .$fiche['reservation_message'] ."</p>";
                        }?>  
                    </div> <!-- fin card body -->
                </div><!-- fin card -->
                <br><br>

                <?php 
                    if(!empty($fiche['reservation_message'])){
                        echo "<p class=\"alert alert-dispo w-50 text-center mx-auto\">Vous ne pouvez plus réserver ce bien, désolé !</p>";
                    } else {
                        echo "<div class=\"alert alert-dispo text-center\">Expliquez-nous les raisons pour lesquelles vous voulez réserver ce bien :
                        <form action=\"\" method=\"POST\" class=\"w-50 mx-auto\">

                        <textarea name=\"reservation_message\" id=\"\" cols=\"30\" rows=\"1\" class=\"form-control m-2\"></textarea>
    
                        <input type=\"submit\" class=\"btn btn-base text-center mx-auto\" value=\"Je réserve\">
    
                        </form></div>";
                    }
                ?> 
               

                <p>Retourner à <a href="consulter-annonces.php">tous nos biens</a></p>
                
            </div>
        </div>  <!-- fin de la rangée -->
    </main>

    <?php
        require("inc/footer.inc.php")
    ?>

     <!-- Optional JavaScript -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>