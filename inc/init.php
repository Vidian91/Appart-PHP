<?php 
    // fichier indispensable au fonctionnement du site 

    ///////////////////////////////////////////////
    ///////////// CONNEXION À LA BDD //////////////
    ///////////////////////////////////////////////

    ////// 1 - Connexion

    $pdoBonAppart = new PDO('mysql:host=localhost;dbname=wf3_php_intermediaire_justine',
    'root',
    // '',
    'root',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ));

    ////// 2 - ouverture de session
    session_start();

    ////// 3 - variable pour les contenus
    $contenu = '';

    ////// 4 - inclusion des fonctions
    require_once('functions.php');



?> 