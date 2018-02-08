<nav>
  <ul>
      <li><p><div id="logout"><a href="index.php?logout=1">Wyloguj</a></div></p></li>
      <li><p><div id="mainmenu"><a href="../">Menu główne</a></div></p></li>
      <li><p><div id="dodajkonkurs"><a href="index.php?key=dodajkonkurs">Dodaj konkurs</a></div></p></li>
      <li><p><div id="dodajuczestnika"><a href="index.php?key=dodajosobe">Dodaj uczestnika</a></div></p></li>
      <li><p><div id="pokazucz"><a href="index.php?key=uczestnicy">Pokaż uczestników </a></div></p></li>
      <li><p><div id="pokazucz" ><a href="index.php?key=test">Test algorytmu</a></div></p></li>
      <li><p><div id="pokazucz" ><a href="index.php?key=zmienlogin">Zmień dane admina</a></div></p></li>
  </ul>
    <?php echo wszystkiekonkursy($conn); ?>
<br><br><br>
<script>
        function confirmresetb() {
            var retVal = confirm('Jesteś pewien, że chcesz wyczyścić bazę danych?(w tym usunąć uczestników i wszystkie konkursy)');
        if (retVal == true) {
            window.location.href = "index.php?key=reset";
        } else {
        }
        }
        </script>
<p><div><a onclick="confirmresetb()">RESETUJ BAZĘ DANYCH </a></div></p>
</nav>