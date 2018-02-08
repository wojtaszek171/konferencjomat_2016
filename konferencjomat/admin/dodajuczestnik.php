<?php 
//CONTENT TEMPLATE
?>

<article>
  <h1>Dodaj uczestnika</h1>
<form action="index.php" method="post">
    <table>
        <tr><td><label>Imię:</label></td><td><input type="text" name="imie" required></td></tr>
        <tr><td><label>Nazwisko:</label></td><td><input type="text" name="nazwisko" required></td></tr>
        <tr><td><label>Id zaproszenia(opcjonalne):</label></td><td><input type="text" name="identyfikator"></td></tr>
        <tr><td colspan="2"><br><input type="submit" name="dodaju" value="Dodaj"></td></tr>
    </table>
        </form>

</article>

