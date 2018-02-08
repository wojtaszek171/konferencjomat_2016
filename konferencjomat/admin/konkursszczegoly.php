<article>
  <h1>Konkurs <?php echo $_GET["nazwakonkursu"] ?></h1>
    <div class="lewa"><p>Akcje:</p></div>
    <div class="prawa">
    <div id="dodajdokonkursu"><a href="index.php?nazwakonkursu=<?php echo $_GET["nazwakonkursu"] ?>&dodajdokonkursu=1">&gt; Dodaj uczestników konkursu</a></div>
    <div><a href="index.php?nazwakonkursu=<?php echo $_GET["nazwakonkursu"] ?>&zmien=1">&gt; Zmień nazwę konkursu</a></div>
        <script>
        function confirm_active() {
            var retVal = confirm("Jesteś pewien, że chcesz usunąć ten konkurs?");
        if (retVal == true) {
            window.location.href = "index.php?usunkonkurs=<?php echo $_GET["nazwakonkursu"]?>";
        } else {
            window.location.href = "index.php?nazwakonkursu=<?php echo $_GET["nazwakonkursu"] ?>";
        }
        }
        </script>
    <div><a onclick='confirm_active()' >&gt; Usuń konkurs</a></div>
    </div>
        <br><br><br><br><br>
   <?php 
    if(isset($_GET["zmienk"])){
        echo aktualizujKonkurs($conn,$_GET["nazwa"],$_GET["nazwakonkursu"]);
    }else
    if(isset($_GET["zmien"]) && $_GET["zmien"]==1 ){
    ?>
        <form method="GET" action="index.php">
        <input type="text" name="nazwakonkursu" value="<?php echo $_GET["nazwakonkursu"] ?>" hidden="hidden">
        <label>Podaj nazwę:</label><input type="text" name="nazwa" value="<?php echo $_GET["nazwakonkursu"] ?>"><br>
        <input type="submit" name="zmienk" value="Aktualizuj">
    </form>    
    <?php
    }else
    if(isset($_GET["dodajdokonkursu"]) && $_GET["dodajdokonkursu"]==1 ){
         echo dodajUczestnikowDoKonkursu($conn,$_GET["nazwakonkursu"]);
    }else
    if(isset($_POST["dodajwkonkursie"])){
         echo dodajUczestnikow2($conn,$_GET["nazwakonkursu"],$_POST["dododania"]);
         header('Location: index.php?nazwakonkursu='.$_GET["nazwakonkursu"].'');
    }else{
    echo uczestnicyKonkursy($conn,$_GET["nazwakonkursu"]); 
    }?>
    

</article>