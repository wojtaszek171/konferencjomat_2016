<?php 
//CONTENT TEMPLATE
?>
<script>
$( document ).ready(function() {
    $("#m2").click(function () {    //ukrywanie i pojawianie się kolumny wykluczeń
    if(
        this.checked){
    $("#wyklucz tr > *:nth-child(5)").css({"display":"inline"});
        
}
    else
        $("#wyklucz tr > *:nth-child(5)").css({"display":"none"});
    });
    

    show();
    
});
</script>
<script type = "text/javascript">


function show() {
    document.getElementById("myDiv").style.display="block";
    document.getElementById("winner").style.visibility="hidden";
    
    setTimeout("hide()", 5000);  // 5 seconds
}
                                                                                //obsługa animacji
function hide() {
    $('#myImage').removeAttr('src', '');
    document.getElementById("myDiv").style.display="none";
    document.getElementById("winner").style.visibility="visible";
}
</script>
<article>
  
    <?php if(isset($_GET["nazwakonkursu"]) || isset($_POST["nazwakonkursu"])){      //okno losowania
    if(isset($_GET["nazwakonkursu"])){ ?>
    <h1>LOSUJ : <?php echo $_GET["nazwakonkursu"] ?></h1>
    <?php   }else{ ?>
    <h1>LOSUJ : <?php echo $_POST["nazwakonkursu"] ?></h1>
    <?php }
    
    
    if(isset($_POST["losuj"]) && $_POST["losuj"]==1){       //losowanie w określonym konkursie
        $wykl[]="";
        if(isset($_POST["metoda1"]))    //wykluczanie wszystkich wygranych
        {
            $query = "SELECT a.id FROM `uczestnicy` a LEFT JOIN wygrane b ON a.id=b.`id_uczestnika` LEFT JOIN konkursy c ON c.id=b.id_konkursu  WHERE b.id_uczestnika!=0 ORDER BY c.nazwa ASC";
            $result = $conn ->query($query);
            foreach($result as $row){
                $wykl[$row["id"]]=$row["id"];
    
            }
           /* echo '<br>Wygrani w którymkolwiek:<br>';
            foreach($wykl as $bow){
                    echo $bow;
                }*/
        }
        if(isset($_POST["metoda2"])){   //wykluczanie wygranych konkretnego konkursu
            $query = "SELECT `id_uczestnika` FROM wygrane WHERE id_konkursu=(SELECT id FROM konkursy WHERE nazwa = '".$_POST["nazwakonkursu"]."')";
            $result = $conn ->query($query);
            //echo '<br>Wygrani w tym konkursie:<br>';
            foreach($result as $row){
                //echo $row["id_uczestnika"];
                $wykl[$row["id_uczestnika"]]= $row["id_uczestnika"];
            }
        }
        if(isset($_POST["metoda3"])){   //wykluczanie ręczne
            if(isset($_POST["wykluczeni"])){
            //echo '<br>Wykluczeni:<br>';
            foreach($_POST["wykluczeni"] as $row){
            //echo $row;
            $wykl[$row]=$row;
            }  
            /*echo '<br>Wykluczeniall:<br>';
            foreach($wykl as $bow){
                    echo $bow;
                }*/
        }}
       // echo '<img id="odliczanie" src="odliczanie-enter.gif">';
?>

    <?php
        echo losuj($conn,$_POST["nazwakonkursu"],$wykl);
        
    }else
    {           //okno przed losowaniem z listą uczestników
    echo '<form method="POST" action="index.php">';
    echo '<input type="hidden" name="nazwakonkursu" value="'.$_GET["nazwakonkursu"].'">';
    echo '<input type="hidden" name="losuj" value="1">';
    ?>
     <input type="checkbox" name="metoda1" id="m" > <label style="cursor:pointer" for="m">Nie losuj osób, które wygrały w którymkolwiek konkursie</label><br>
     <input type="checkbox" name="metoda2" id="m1" > <label style="cursor:pointer" for="m1">Nie losuj osób, które wygrały w tym konkursie</label>
     <br>
     <input type="checkbox" name="metoda3" id="m2" > <label style="cursor:pointer" for="m2">Wybierz osoby do wykluczenia</label><br>
    <?php
        echo '<div class="losujj"> <input type="submit" value="LOSUJ"></div>'; 
        echo pokaz($conn,$_GET["nazwakonkursu"]);
        echo '</form>';
    }
}else if((isset($_GET["wszyscy"]) && $_GET["wszyscy"]==1) || (isset($_POST["wszyscy"]) && $_POST["wszyscy"]==1)){       //losowanie wszystkich
    echo '<h1>LOSUJ : SPOŚRÓD WSZYSTKICH</h1>';

    if((isset($_GET["losuj"]) && $_GET["losuj"]==1) || (isset($_POST["losuj"]) && $_POST["losuj"]==1)){     //losowanie
        $wykl[]="";
        if(isset($_POST["metoda1"]))       //wykluczanie wszystkich wygranych
        {
            $query = "SELECT a.id FROM `uczestnicy` a LEFT JOIN wygrane b ON a.id=b.`id_uczestnika` LEFT JOIN konkursy c ON c.id=b.id_konkursu  WHERE b.id_uczestnika!=0 ORDER BY c.nazwa ASC";
            $result = $conn ->query($query);
            foreach($result as $row){
                $wykl[$row["id"]]=$row["id"];
    
            }
            /*foreach($wykl as $bow){
                    echo $bow;
                }*/
        }
        if(isset($_POST["metoda2"])){       //wykluczanie wygranych w losowaniu wszystkich uczestników
        $query = "SELECT `id_uczestnika` FROM wygrane WHERE id_konkursu=0";
            $result = $conn ->query($query);
            //echo '<br>Wygrani w tym konkursie:<br>';
            foreach($result as $row){
                //echo $row["id_uczestnika"];
                $wykl[$row["id_uczestnika"]]= $row["id_uczestnika"];
            }
        }
        if(isset($_POST["metoda3"])){       //wykluczanie ręczne
            if(isset($_POST["wykluczeni"])){
            foreach($_POST["wykluczeni"] as $row){
            $wykl[$row]=$row;
            }  
            /*foreach($wykl as $bow){
                    echo $bow;
                }*/
        }}
       // echo '<img id="odliczanie" src="odliczanie-enter.gif">';
        ?>



    <?php
        echo losujwszyscy($conn, $wykl);     
        
        
       
    }
    else
    {                                                       //okno przed losowaniem z uczestnikami konferencji
    echo '<form method="POST" action="index.php">';
    echo '<input type="hidden" name="wszyscy" value="1">';
    echo '<input type="hidden" name="losuj" value="1">';
    echo '<input type="checkbox" name="metoda1" id="m"> <label style="cursor:pointer" for="m">Nie losuj osób, które wygrały w którymkolwiek konkursie</label><br>
     <input type="checkbox" name="metoda2" id="m1" > <label style="cursor:pointer" for="m1">Nie losuj osób, które wygrały w losowaniu ze wszystkich uczestników</label>
     <br>
     <input type="checkbox" name="metoda3" id="m2"> <label style="cursor:pointer" for="m2">Wybierz osoby do wykluczenia</label><br>';
        echo '<div class="losujj"> <input type="submit" value="LOSUJ"></div>'; 
    echo pokazwszystkich($conn);
    }
    echo '</form>';
}
    ?>
  <p></p>
</article>