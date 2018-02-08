<!DOCTYPE html>
<html>
 
<?php
session_start(); ?>

<?php
include '../database.php';
require('../functions.php');

//mysql_query("SET CHARSET utf8");
//mysql_query("SET NAMES 'utf8'");  
    ?>
    
    <?php 
    if(isset($_GET["logout"])){
        $_SESSION["zalogowany"]=0;  
        header('Location: ../index.php');
    }
    
    if(isset($_POST["login"])){
      echo checkAdmin($conn,$_POST["login"],$_POST["password"]); 
    }
      if(isset($_SESSION["zalogowany"]) && $_SESSION["zalogowany"]==1){ 
?>

    <head>
    <title>KONFERENCJOMAT 2016 - ADMIN</title>
    </head>
<?php 
include "../site/header.php"; 
include 'nav.php';
  echo '<body>';        
if(isset($_GET["key"]) && $_GET["key"]=="zmienlogin"){     //zmiana danych logowania
    include 'editadmin.php';
}else
if(isset($_GET["key"]) && $_GET["key"]=="test"){            //test algorytmu
    include 'test.php';
}else
if(isset($_GET["key"]) && $_GET["key"]=="reset"){           //reset bazy
    echo resetujbaze($conn);
}else
if(isset($_GET["echo"])){             //wyświetlanie komunikatów
    echo $_GET["echo"];
}else
if(isset($_GET["usunkonkurs"])){       // usuwanie konkursu
    usunKonkurs($conn,$_GET["usunkonkurs"]);
}else
if(isset($_GET["nazwakonkursu"])){      //wyświetlenie szczegółów konkursu
    include 'konkursszczegoly.php';
}else
if(isset($_GET["editu"]) && $_GET["editu"]=="1"){ //strona edycyjna
    include 'editu.php';
}else
if(isset($_GET["key"]) && $_GET["key"]=="wyswietlkonkursy"){    //wyświetlenie konkursów
    echo wszystkiekonkursy($conn);
}else
if(isset($_GET["key"]) && $_GET["key"]=="dodajkonkurs"){        //dodawanie konkursów
    include 'dodajkonkurs.php';
}else
if(isset($_GET["key"]) && $_GET["key"]=="uczestnicy"){          //wyświetlenie uczestników
    echo '<ul style="padding-left:0px; margin:0;">';
include 'wszyscyuczestnicy.php';
    echo "</ul>";
}else
if(isset($_GET["key"]) && $_GET["key"]=="dodajosobe"){          //dodawanie uczestników
include 'dodajuczestnik.php';
}else
if(isset($_POST["dodajk"])){                    //wpisywanie nowego konkursu do bazy
    echo dodajKonkurs($conn,$_POST["nazwa"]);
}else
if(isset($_POST["dodaju"])){                    //dodawanie uczestnika
    echo dodajUczestnika($conn,$_POST["imie"],$_POST["nazwisko"],$_POST["identyfikator"]);
}else
if(isset($_POST["updateu"])){               //aktualizacja uczestnika
    echo aktualizujUczestnika($conn,$_POST["ide"],$_POST["imie"],$_POST["nazwisko"],$_POST["identyfikator"]);
}else
{   
include 'content.php';      //treść alternatywna
}
          echo '</body>';
include '../site/footer.php';   //stopka 
    ?>    
</html>

<?php }else{                    //wyświetlenie okna logowania
include "../site/header.php"; 
          ?>
<a style="margin:10px" href="../index.php">WRÓĆ</a>
<center>
    ZALOGUJ SIĘ
    <form action='index.php' method="post">
    <input type="text" name="login" id="login"><br>
    <input type="password" name="password" id="password"><br>
    <input type="submit">
    </form>
    </center>
    <?php
include '../site/footer.php';
    }?>


