<nav>
  <ul>
      <li><div><a href="../">Menu główne</a></div></li>
      <li><div><a href="index.php?wszyscy=1">Losuj spośród wszystkich uczestników</a></div></li>
      <li><div><a href="index.php?wygrani=1">Pokaż wygranych</a></div></li>
      <br><br><br> 
    <?php echo wszystkiekonkursy($conn) ?>
      
  </ul>
</nav>