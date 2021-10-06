<?php
jeprint_r($_FILES);
jeprint_r($_REQUEST);


// $fichierUpload = 'mon_fichier' ;
$fichierUpload = 'file' ;

/* Récupère le nom du fichier téléchargé */ 
$filename = $_FILES[$fichierUpload]['name'];
echo $filename ;

/* Choisissez où enregistrer le fichier téléchargé */ 
$location = "upload/".$filename;

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

if ( $error=$_FILES[$fichierUpload]["error"] ) {
    echo "<p style='color: red;'> Erreur de téléchargement ($error): $phpFileUploadErrors[$error]" ;
}

foreach($_FILES[$fichierUpload] as $key => $value) {
    echo "<p>$key = $value</p>";
}

/* Enregistrer le fichier téléchargé dans le système de fichiers local */ 
if ( move_uploaded_file($_FILES[$fichierUpload]['tmp_name'], $location) ) { 
  echo "<strong  style='color: green;'> Succès du Téléchargement </strong>"; 
} else { 
  echo "<strong  style='color: red;'> Échec </strong>"; 
}

?>