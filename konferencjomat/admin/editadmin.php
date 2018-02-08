<article>
  <h1>ADMIN</h1>
  <?php 
    if(isset($_POST["zapisznowedane"])){        //zapis nowych danych admina
        changeAdmin($conn,$_POST["nowylogin"],$_POST["nowehaslo"]);
        header('Location: index.php?echo=Zmieniono dane logowania do panelu administracyjnego');
    }
    ?>
    <p>Zmień dane admina</p>            <!-- okno podawania nowego loginu i hasła -->
    <form method="post" action="index.php?key=zmienlogin">
    <input type="hidden" name="key" value="zmienlogin">
    <table>
    <tr><td><label>Nowy login:</label></td><td><input type="text" name="nowylogin"></td></tr>   
    <tr><td><label>Nowe hasło:</label></td><td><input type="text" name="nowehaslo"></td></tr>   
    </table>
        <input type="submit" name="zapisznowedane" value="zapisz">
    </form>
    <?php 

    ?>
  <p></p>
</article>