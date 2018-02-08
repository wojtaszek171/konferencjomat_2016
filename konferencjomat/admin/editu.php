<?php 
//CONTENT TEMPLATE
?>

<article>
  <h1>Edytuj uczestnika</h1>
    <?php 
    if(isset($_GET["usunzkonkursu"])){
        usunUczestnikaZKonkursu($conn,$_GET["id"],$_GET["idkonkursu"]);
        header('Location: index.php?nazwakonkursu='.$_GET["nazwak"].'');
    }else
    if(isset($_GET["deleteu"])){
        usunUczestnika($conn,$_GET["id"]);
        header('Location: index.php?key=uczestnicy');
    }else
    {?>
<form action="index.php" method="post">
<span style="visibility:hidden; position:absolute"><label>Id(baza):</label><input type="text" name="ide" value="<?php echo $_GET["id"] ?>"  ></span>
<table>
    <tr><td><label>Imię:</label></td><td><input type="text" name="imie" value="<?php echo $_GET["name"] ?>"required></td></tr>
    <tr><td><label>Nazwisko:</label></td><td><input type="text" name="nazwisko" value="<?php echo $_GET["surname"] ?>"required></td></tr>
    <tr><td><label>Id zaproszenia(opcjonalne):<br></label></td><td><input type="text" name="identyfikator" value="<?php echo $_GET["identyfikator"] ?>"></td></tr>
    <tr><td colspan="2"><input type="submit" name="updateu" value="Aktualizuj"></td></tr>
</table>
</form>
<?php }?>
</article>

