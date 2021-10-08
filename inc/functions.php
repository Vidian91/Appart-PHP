<?php

    ////// 1 - fonction print_r //////
    //pour afficher les array
    function jeprint_r($mavariable){
        echo "<small class=\"bg-primary text-white p-2\">print_r :</small><pre class=\"alert alert-primary w-75\">";
        print_r($mavariable);
        echo "</pre>";
    }

    ////// 2 - fonction pour exécuter les prepare() //////
    function executeRequete($requete, $parametres = array ()) { //pour toutes les requêtes du site
        foreach ($parametres as $indice => $valeur) {        
            $parametres[$indice] = htmlspecialchars($valeur); // on "vite les injections SQL
            global $pdoBonAppart; // global nous permet d'accéder à la variable $pdoSITE et de dire qu'elle devient globale
            $resultat = $pdoBonAppart->prepare($requete); // puis prepare le requête
            $succes = $resultat->execute($parametres);// puis exécute la requête
            if ($succes === false) {
                return false; // si la requête  n'a pas marché je renvoie false
            } else {
                return $resultat;
            }// fin if else 
        }
    }// fermeture fonction executeRequete

    // Modifié par Christian Maurence le 31/8/2021
    // On met le code dans une fonction car appelé depuis au moins 2 pages
    function tableau_annonces($requete) {
        echo "<table class=\"table table-striped\">";
        echo "<thead><tr><th scope=\"col\">#ID</th><th scope=\"col\">Titre</th><th scope=\"col\">Disponibilité</th><th scope=\"col\">Type</th><th scope=\"col\">Prix</th><th scope=\"col\" style=\"width:50px;\">Fiche</th></tr></thead>";
        while($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            
            echo "<tr>";
            echo "<td>#". $ligne['id']. "</td>";  

            $listPhotos = getPhotos($ligne['id']) ;
            if (count($listPhotos) == 0) 
                echo "<td><img src='img/interieur.jpg' style='height: 64px'></td>";
            else 
                echo "<td><img src='./upload/$listPhotos[0]' style='height: 64px'></td>";

            echo "<td>". strtoupper($ligne['title']) ."</td>"; 
            if($ligne['reservation_message'] != '') {
                echo "<td class=\"non-dispo\">INDISPONIBLE</td>"   ;     
            }else {
                echo "<td class=\"dispo\">DISPONIBLE</td>";
            }
            echo "<td>". $ligne['type']. "</td>";
            $fmt = new NumberFormatter( 'ru_RU', NumberFormatter::CURRENCY );
            echo "<td>" .$fmt->formatCurrency($ligne['price'], "EUR"). "</td>";
            echo "<td><a href=\"fiche-annonce.php?id=".$ligne['id']."\"><button class='btn btn-consult'>Consulter</button></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // récupère la liste des photos du répertoire $rep
    function getPhotos( $id, $rep="./upload") {
        $listFiles = array() ;
        $id = "Id" . sprintf("%03d", $id) ;
        $dir = opendir($rep);
        while ($file = readdir($dir)) {
            if($file == "." || $file == "..") continue ;
            // if( str_starts_with( $file, $id))    // PHP 8
            // if( strstr( $file, $id) ) {            // cherche $id n'importe où dans $file
                if( preg_match( "/^$id/", $file) ) {    // Regex: cherche $id au début de la chaine $file
                // echo "getPhotos -> $id - $rep/$file<br>" ;
                $listFiles[] = $file ;
            }
          }
        closedir($dir);
        return $listFiles ;
      };

?>