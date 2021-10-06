<footer class="footer mt-auto py-3 bg-dark">
  <div class="container">
    <span class="text-white">Le Bon Appart - &copy <?php echo date('Y')?>
    <?php
    echo " - ";
    setlocale(LC_ALL, 'fr_FR');
    echo strftime('%A %e %B %Y');
    echo " - ";
    date_default_timezone_set("Europe/Paris");
    echo date('H:i:s');
    ?>
</span>
  </div>
</footer>