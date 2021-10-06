<footer class="footer mt-auto py-3 bg-dark">
  <div class="container text-white d-flex justify-content-between">
    <span>Le Bon Appart - &copy <?php echo date('Y')?></span>
    <span>
      <?php
      date_default_timezone_set("Europe/Paris");
      // Pour avoir la date en français, php prendra la 1ère définition installée sur le système
      // rajouter ".utf8" pour avoir la string renvoyée en UTF8
      setlocale(LC_ALL, ['fr.utf8', 'fra.utf8', 'fr_FR.utf8']);
      echo strftime('%A %d %B %Y - %H:%M') ;
      
      // Pour afficher la date d'il y a 1 mois
      // echo strftime('%A %d %B %Y - %H:%M', strtotime("-1 months")) ;
      
      // Pour afficher la date d'il y a 3 jours
      // echo strftime('%A %d %B %Y - %H:%M', strtotime("-3 day")) ;
      
      // Autre méthode pour encoder en UTF8 (si pb d'accent)
      // setlocale(LC_ALL, ['fr', 'fra', 'fr_FR']);    // pour avoir la date en français
      // echo utf8_encode(strftime('%A %d %B %Y, %H:%M'));
      ?>
    </span>

  </div>
</footer>