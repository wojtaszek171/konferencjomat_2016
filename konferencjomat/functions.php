<?php 
function changeAdmin($conn,$login,$password){   //funkcja zmieniająca dane administratora
    $query = "UPDATE `admini` SET `login`='".$login."', `haslo`='".md5($password)."' WHERE `id`=2";
    $result = $conn->query($query);
}
function checkAdmin($conn,$login,$password){    //funkcja sprawdzająca czy admin o takich danych logowania istnieje

    $_SESSION["zalogowany"]=0;
    $query = "SELECT * FROM admini";
    $result = $conn->query($query);
    if(isset($result) && $result!=""){
    foreach($result as $row){
        if($login==$row["login"] && md5($password)==$row["haslo"]){
            $_SESSION["zalogowany"]=1;
           

        }
    }
    }
    
    if($_SESSION["zalogowany"]==0){
       // echo "Złe dane logowania";
    }

}
function uczestnicy($conn){        //wyświetlanie uczestników
    $query = "SELECT * FROM uczestnicy ORDER BY `Nazwisko` ASC";
    $result = $conn->query($query);
    foreach($result as $row){
        
            echo $row["Imie"];
        
    }  
}
function wszyscyuczestnicy($conn){  //wyświetlanie wszystkich uczestników w tabeli (zakładka "Pokaż uczestników")
    $query = "SELECT * FROM uczestnicy ORDER BY `Nazwisko` ASC";
    $result = $conn->query($query);
    echo '<table class="tabelaadmin">';
    echo '<thead><tr><th></th><th>Imię</th><th>Nazwisko</th><th>Id zaproszenia</th><th>Zarządzaj</th></tr></thead>';
    $i=0;
    foreach($result as $row){
            $i++;
            echo '<tr><td>'.$i.'</td><td>'.$row["Imie"].'</td><td> '.$row["Nazwisko"].'</td><td>'.$row["unikalnyidentyfikator"].'</td><td> <div id="edit"><a href="index.php?editu=1&id='.$row["id"].'&name='.$row["Imie"].'&surname='.$row["Nazwisko"].'&identyfikator='.$row["unikalnyidentyfikator"].'"></a></div>&nbsp;&nbsp;<div id="delete"><a href="index.php?editu=1&deleteu=1&id='.$row["id"].'&name='.$row["Imie"].'&surname='.$row["Nazwisko"].'&identyfikator='.$row["unikalnyidentyfikator"].'" onclick="return confirm(\'Na pewno chcesz usunąć uczestnika '.$row["Imie"].' '.$row["Nazwisko"].'?\');"></a></div></td><tr>';
    }  
    echo '</table>';
}
function wszystkiekonkursy($conn){  //wyświetlanie wszystkich konkursów w menu nav
    $query = "SELECT * FROM konkursy";
    $result = $conn->query($query);
    echo '<table class="tabelanav">';
    echo '<thead><tr><th>KONKURSY:</th></tr></thead>';
    foreach($result as $row){
        
            echo '<tr><td><div id="listakonk"><a href="index.php?nazwakonkursu='.$row["nazwa"].'">&gt; '.$row["nazwa"].'</a></div></td><tr>';
        
    }  
    echo '</table>';
}
function uczestnicyKonkursy($conn,$nazwa){  //funkcja do wyświetlania w tabeli uczestników konkretnego wybranego konkursu
    $query = "SELECT a.`id_uczestnika`, a.`id_konkursu`, a.`id`, b.`nazwa` , b.`id`, c.`id`, c.`Imie`, c.`Nazwisko`, c.`unikalnyidentyfikator` FROM uczestnicykonkursow a LEFT JOIN konkursy b ON a.`id_konkursu` = b.`id` INNER JOIN uczestnicy c ON a.`id_uczestnika`= c.`id` WHERE b.`nazwa`='".$nazwa."' ORDER BY c.`Nazwisko` ASC";
    $result = $conn->query($query);
    echo '<table class="tabelaadmin">';
    echo '<thead><tr><th></th><th>Imię</th><th>Nazwisko</th><th>Id zaproszenia</th><th>Zarządzaj</th></tr></thead>';
    $i=0;
    foreach($result as $row){
            $i++;
            echo '<tr><td>'.$i.'</td><td>'.$row["Imie"].'</td><td> '.$row["Nazwisko"].'</td><td>'.$row["unikalnyidentyfikator"].'</td><td> <div id="edit"><a href="index.php?editu=1&id='.$row["id"].'&name='.$row["Imie"].'&surname='.$row["Nazwisko"].'&identyfikator='.$row["unikalnyidentyfikator"].'"></a></div>&nbsp;&nbsp;<div id="delete"><a href="index.php?editu=1&usunzkonkursu=1&id='.$row["id"].'&idkonkursu='.$row["id_konkursu"].'&name='.$row["Imie"].'&surname='.$row["Nazwisko"].'&identyfikator='.$row["unikalnyidentyfikator"].'&nazwak='.$row["nazwa"].'" onclick="return confirm(\'Na pewno chcesz usunąć uczestnika '.$row["Imie"].' '.$row["Nazwisko"].' z konkursu: '.$nazwa.'?\');"></a></div></td><tr>';
        
    }  
    echo '</table>';
}
function dodajUczestnika($conn,$name,$surname,$id){     //funkcja obsługująca dodawanie uczestnika
    $query = "SELECT * FROM uczestnicy";
    $result = $conn->query($query);
    if($id==""){
        $id=0;
    }
    foreach($result as $row){
        if($name==$row["Imie"] && $surname==$row["Nazwisko"] && $id==$row["unikalnyidentyfikator"]){
            $istnieje=1;
        }
    }  
    if(isset($istnieje) && $istnieje==1){
        echo '<p>Uczestnik o podanym Imieniu, Nazwisku oraz Identyfikatorze istnieje.</p>';
    }else
    if(isset($name) && $name!="" && $surname!=""){
    $query = "INSERT INTO `uczestnicy` (`id`, `imie`, `nazwisko`,`unikalnyidentyfikator`) VALUES ('', '".$name."', '".$surname."','".$id."')";
    $result = $conn->query($query);
    header('Location: index.php?echo=Dodano uczestnika: '.$name.' '.$surname.'!');
        
    }else{
        echo "<p>Wprowadź poprawne dane!</p>";
    }
}

function aktualizujUczestnika($conn,$id,$name,$surname,$idu){      //funkcja aktualizująca dane uczestnika
    $query = "SELECT * FROM uczestnicy";
    $result = $conn->query($query);
    if($idu==""){
        $idu=0;
    }
    foreach($result as $row){
        if($name==$row["Imie"] && $surname==$row["Nazwisko"] && $idu==$row["unikalnyidentyfikator"]){
            $istnieje=1;
        }
    }  
    if(isset($istnieje) && $istnieje==1){
        echo '<p>Uczestnik o podanym Imieniu, Nazwisku oraz Identyfikatorze istnieje.</p>';
    }else
    if(isset($name) && $name!="" && $surname!=""){
    $query = "UPDATE `uczestnicy` SET Imie='".$name."',Nazwisko='".$surname."',unikalnyidentyfikator='".$idu."' WHERE id=".$id."";
    $result = $conn->query($query);
    echo"Zaktualizowano uczestnika: ".$name." ".$surname."!";
        header('Location: index.php?key=uczestnicy');
    }else{
        echo "<p>Wprowadź poprawne dane!</p>";
    }
}

function aktualizujKonkurs($conn,$nazwa,$nazwastara){       //funkcja aktualizująca nazwę konkursu
    $query = "SELECT * FROM konkursy";
    $result = $conn->query($query);
    $istnieje=0;
    foreach($result as $row){
         if($nazwa==$row["nazwa"]){
            $istnieje=1;
        }
    }
    if($istnieje==1){
        header('Location:index.php?echo=Konkurs o podanej nazwie istnieje');
    }else{
    $query2 = "UPDATE `konkursy` SET `nazwa`='".$nazwa."' WHERE `nazwa`='".$nazwastara."'";
    $result = $conn->query($query2);
    header('Location:index.php');
    }
}

function dodajKonkurs($conn,$nazwa){        //dodawanie nowego konkursu
    $query = "SELECT * FROM konkursy";
    $result = $conn->query($query);
    foreach($result as $row){
        if($nazwa==$row["nazwa"]){
            $istnieje=1;
        }
    }  
    if(isset($istnieje) && $istnieje==1){
        echo '<p>Konkurs o podanej nazwie już istnieje.</p>';
    }else
    if(isset($nazwa) && $nazwa!=""){
    $query = "INSERT INTO `konkursy` (`id`, `nazwa`) VALUES ('', '".$nazwa."')";
    $result = $conn->query($query);
    echo"Dodano nowy konkurs: ".$nazwa."!";
        header('Location: index.php?echo=Dodano konkurs '.$nazwa);
    }else{
        echo "<p>Wprowadź poprawne dane!</p>";
    }
}

function dodajUczestnikowDoKonkursu($conn,$nazwa){      //wyświetlanie uczestników do dodania
    $query = "SELECT a.`id_uczestnika`, a.`id_konkursu`, a.`id`, b.`nazwa`, b.`id`, c.`id` as 'idx', c.`Imie`, c.`Nazwisko`, c.`unikalnyidentyfikator` FROM uczestnicykonkursow a LEFT JOIN konkursy b ON a.`id_konkursu` = b.`id` INNER JOIN uczestnicy c ON a.`id_uczestnika`!= c.`id` WHERE b.`nazwa`='".$nazwa."' GROUP BY c.`id` ORDER BY `Nazwisko` ASC";
    $result = $conn->query($query);
    echo '<form method="post" action="index.php?nazwakonkursu='.$nazwa.'">';?>
<input type="checkbox" id="selectall" ><label for="selectall">Zaznacz wszystkich </label><br><br>
<?php
    $query1 = "SELECT a.`id_uczestnika`, a.`id_konkursu`, a.`id`, b.`nazwa`, b.`id`, c.`id`, c.`Imie`, c.`Nazwisko`, c.`unikalnyidentyfikator` FROM uczestnicykonkursow a LEFT JOIN konkursy b ON a.`id_konkursu` = b.`id` INNER JOIN uczestnicy c ON a.`id_uczestnika`= c.`id` WHERE b.`nazwa`='".$nazwa."'";
    $result1 = $conn->query($query1);
    
    $query2 = "SELECT COUNT(*) FROM uczestnicykonkursow WHERE id_konkursu = (SELECT id FROM konkursy WHERE nazwa= '$nazwa')";
    $result2 = $conn->query($query2);
    $query3 = "SELECT * FROM uczestnicy";
    $result3 = $conn->query($query3);
    foreach($result2 as $row){
        $data = $row["COUNT(*)"];
    }
    if($data == 0 ){
        foreach($result3 as $row){
            echo '<input type="checkbox" class="checkBoxClass" name="dododania[]" id="'.$row["id"].'" value="'.$row["id"].'"><label style="cursor:pointer" for="'.$row["id"].'">'.$row["Imie"].' '.$row["Nazwisko"].'</label></br>';
        }
    }else{
    foreach($result as $row){
        $istnieje=0;
        foreach($result1 as $bow){
            if($row["idx"]==$bow["id"]){
                $istnieje=1;
            }
            
        }
        if($istnieje==0){
                echo '<input type="checkbox" class="checkBoxClass" name="dododania[]" id="'.$row["idx"].'" value="'.$row["idx"].'"><label style="cursor:pointer" for="'.$row["idx"].'">'.$row["Imie"].' '.$row["Nazwisko"].'</label></br>';
        }
        
    }
    }
    
    
    echo '<br><input type="submit" value="Dodaj" name="dodajwkonkursie">';
    echo '</form>';
}


function dodajUczestnikow2($conn,$nazwa,$dododania){        //wrzucanie wybranych do dodania do konkursu uczestników do bazy danych
    $query='SELECT `id` FROM `konkursy` WHERE `nazwa`="'.$nazwa.'"';
    $result=$conn->query($query);
    foreach($result as $bow){
        $id=$bow['id'];
    }
    
    
    foreach($dododania as $row){
        $query1 = "INSERT INTO `uczestnicykonkursow` (`id`, `id_uczestnika`, `id_konkursu`) VALUES ('', '".$row."', '".$id."')";
        $conn->query($query1);
    }
}



function usunUczestnika($conn,$id){     //usuwanie uczestnika
    $query='DELETE FROM `uczestnicy` where `id`='.$id.'';
    $conn->query($query);
    $query='DELETE FROM `uczestnicykonkursow` where `id_uczestnika`='.$id.'';
    $conn->query($query);
    $query='DELETE FROM `wygrane` where `id_uczestnika`='.$id.'';
    $conn->query($query);
}
function usunUczestnikaZKonkursu($conn,$id,$id_konkursu){      //usuwanie uczestnika z wybranego konkursu
    $query='DELETE FROM `uczestnicykonkursow` where `id_uczestnika`='.$id.' AND `id_konkursu`="'.$id_konkursu.'"';
    $conn->query($query);
}
function usunKonkurs($conn,$nazwa){     //usuwanie konkursu z bazy
    $query2 = "DELETE FROM uczestnicykonkursow WHERE id_konkursu=(SELECT id FROM konkursy WHERE nazwa = '".$nazwa."')";
    $conn->query($query2);
    $query1 = "DELETE FROM konkursy WHERE nazwa='".$nazwa."'";
    $conn->query($query1);
    $query3 = "DELETE FROM wygrane WHERE id_konkursu='(SELECT id FROM konkursy WHERE nazwa=".$nazwa.")'";
    $conn->query($query3);
    header('Location: index.php');
    
}



function pokaz($conn,$nazwa){           //wyświetlenie tabeli uczestników wybranego konkursu przy losowaniu (dodana możliwość wykluczania)
    $query = "SELECT a.`id_uczestnika`, a.`id_konkursu`, a.`id`, b.`nazwa` , b.`id`, c.`id`, c.`Imie`, c.`Nazwisko`, c.`unikalnyidentyfikator` FROM uczestnicykonkursow a LEFT JOIN konkursy b ON a.`id_konkursu` = b.`id` INNER JOIN uczestnicy c ON a.`id_uczestnika`= c.`id` WHERE b.`nazwa`='".$nazwa."' ORDER BY c.`Nazwisko` ASC";
    $result = $conn->query($query);
    echo '<table id="wyklucz" class="tabelaadmin">';
    echo '<thead><tr><th></th><th>Imię</th><th>Nazwisko</th><th>Id zaproszenia</th><th>Wyklucz</th></tr></thead>';
    $i=0;
    foreach($result as $row){
            $i++;
            echo '<tr><td>'.$i.'</td><td>'.$row["Imie"].'</td><td> '.$row["Nazwisko"].'</td><td>'.$row["unikalnyidentyfikator"].'</td><td><input type="checkbox" name="wykluczeni[]" value="'.$row["id_uczestnika"].'"></td><tr>';
        
    }  
    echo '</table>';
}
function pokazwszystkich($conn){        //wyświetlenie tabeli wszystkich uczestników przy losowaniu (dodana możliwość wykluczania)
    $query = "SELECT * FROM uczestnicy ORDER BY `Nazwisko` ASC";
    $result = $conn->query($query);
    echo '<table id="wyklucz" class="tabelaadmin">';
    echo '<thead><tr><th></th><th>Imię</th><th>Nazwisko</th><th>Id zaproszenia</th><th>Wyklucz</th></tr></thead>';
    $i=0;
    foreach($result as $row){
        $i++;
            echo '<tr><td>'.$i.'</td><td>'.$row["Imie"].'</td><td> '.$row["Nazwisko"].'</td><td>'.$row["unikalnyidentyfikator"].'</td><td><input type="checkbox" name="wykluczeni[]" value="'.$row["id"].'"></td><tr>';
    }  
    echo '</table>';
}

function losuj($conn,$nazwa,$wykl){     //funkcja obsługująca losowanie z konkretnego konkursu
    $query = "SELECT a.`id_uczestnika`, a.`id_konkursu`, a.`id`, b.`nazwa` , b.`id`, c.`id`, c.`Imie`, c.`Nazwisko`, c.`unikalnyidentyfikator` FROM uczestnicykonkursow a LEFT JOIN konkursy b ON a.`id_konkursu` = b.`id` INNER JOIN uczestnicy c ON a.`id_uczestnika`= c.`id` WHERE b.`nazwa`='".$nazwa."' ORDER BY c.`Nazwisko` ASC";
    $result = $conn->query($query);
    
    $i=0;
    $tab;
    foreach($result as $row){
            $i++;
            $tab[$row["id_uczestnika"]]=$row["id_uczestnika"];
            //echo $row["id_uczestnika"].',';
    } 
    if(isset($tab)){
    foreach($wykl as $row){
        unset($tab[$row]);
    }}
    if (isset($tab) && count($tab)>0){
    foreach($tab as $row){
        $tablica[] = $row; 
    }
        //echo $tablica[sizeof($tablica)-1];
    $randomized = $tablica[Random2(0,sizeof($tablica)-1)];  //losowanie zwycięzcy moim algorytmem losującym - Random2($min,$max);
    /*$shuffled = mojRandom($tablica);
    $randomized=$shuffled[sizeof($shuffled)/2];*/
    

    $query = "SELECT id, Imie, Nazwisko, unikalnyidentyfikator FROM uczestnicy WHERE id=".$randomized."";
    $result = $conn ->query($query);
    foreach ($result as $row){
        if($row["unikalnyidentyfikator"]==0){
            $row["unikalnyidentyfikator"]="";
        }
        $wygrany = $row["Imie"].' '.$row["Nazwisko"].' '.$row["unikalnyidentyfikator"];
        $query2 = "SELECT `id` FROM `konkursy` WHERE `nazwa` = '".$nazwa."' ";
        $res = $conn->query($query2);
        foreach($res as $bow){
            $id= $bow["id"];
        }
         $query1 = "INSERT INTO `wygrane` (`id`, `id_uczestnika`, `id_konkursu`) VALUES ('', '".$row["id"]."', '".$id."')";
        $conn->query($query1);
    }
    echo '<br><br>';?>
<?php
    echo '<div id = "myDiv" style="display:none"><img id = "myImage" src = "./odliczanie-enter.gif"></div><br>';
    echo "<p id='winner'>WYGRYWA : ".$wygrany."</p>";
   
    }else{
        echo "Aby losować musi być co najmniej 1 uczestnik" ;
        echo '<div id = "myDiv" style="display:none"><img id = "myImage" src = ""></div><br>';
    }

}
function losujwszyscy($conn,$wykl){     //funkcja obsługująca losowanie spośród wszystkich uczestników
    $query = "SELECT * FROM uczestnicy ORDER BY Nazwisko ASC";
    $result = $conn->query($query);
    
    $i=0;
    $tab;
    foreach($result as $row){
            $i++;
            $tab[$row["id"]]=$row["id"];
            //echo $row["id"].',';
    }  
    
    foreach($wykl as $row){
        unset($tab[$row]);
    }
    if (isset($tab) && count($tab)>0){
    foreach($tab as $row){
        $tablica[] = $row; 
    }
        //echo $tablica[sizeof($tablica)-1];
    $randomized = $tablica[Random2(0,sizeof($tablica)-1)];      //losowanie zwycięzcy moim algorytmem losującym - Random2($min,$max);
    /*$shuffled = mojRandom($tablica);
    $randomized=$shuffled[sizeof($shuffled)/2];*/
        
    $query = "SELECT id, Imie, Nazwisko, unikalnyidentyfikator FROM uczestnicy WHERE id=".$randomized."";
    $result = $conn ->query($query);
    foreach ($result as $row){
        if($row["unikalnyidentyfikator"]==0){
            $row["unikalnyidentyfikator"]="";
        }
        $wygrany = $row["Imie"].' '.$row["Nazwisko"].' '.$row["unikalnyidentyfikator"];
        $query1 = "INSERT INTO `wygrane` (`id`, `id_uczestnika`, `id_konkursu`) VALUES ('', '".$row["id"]."', '-')";
        $conn->query($query1);
    }
    echo '<br><br>';?>

<?php
    echo '<div id = "myDiv" style="display:none"><img id = "myImage" src = "./odliczanie-enter.gif"></div><br>';
    echo "<p id='winner'>WYGRYWA : ".$wygrany."</p>";
    }else{
        echo "Aby losować musi być co najmniej 1 uczestnik" ;
        echo '<div id = "myDiv" style="display:none"><img id = "myImage" src = ""></div><br>';
    }

}

function wylosowani($conn){     //wyświetlenie tabeli już wylosowanych uczestników
    $query = "SELECT a.id, a.Imie, a.Nazwisko, a.unikalnyidentyfikator, b.`id_uczestnika`, c.nazwa, b.`id_konkursu`, b.id AS bid FROM `uczestnicy` a LEFT JOIN wygrane b ON a.id=b.`id_uczestnika` LEFT JOIN konkursy c ON c.id=b.id_konkursu  WHERE b.id_uczestnika!=0 ORDER BY c.nazwa ASC";
    $result = $conn ->query($query);
    echo '<table class="tabelawygrani">';
    echo '<thead><th></th><th>Imię</th><th>Nazwisko</th><th>Id zaproszenia</th><th>Konkurs</th><th></th>';
    $i=0;
    foreach($result as $row){
        $i++;
        if($row["nazwa"]==''){
            $row["nazwa"]="Spośród wszystkich";
        }
        echo '<tr><td>'.$i.'</td><td>'.$row["Imie"].'</td><td>'.$row["Nazwisko"].'</td><td>'.$row["unikalnyidentyfikator"].'</td><td>'.$row["nazwa"].'</td><td><a href="index.php?wygrani=1&usun='.$row["bid"].'">Usuń z wylosowanych</a></td></tr>';    
    }
    echo '</table>';
}
function czyscWygranych($conn){     //czyszczenie tabeli wylosowanych
    $query='TRUNCATE TABLE `wygrane`';
    $conn->query($query);
}
function resetujbaze($conn){        //reset bazy danych
    $query='TRUNCATE TABLE `konkursy`';
    $conn->query($query);
    $query='TRUNCATE TABLE `uczestnicykonkursow`';
    $conn->query($query);
    $query='TRUNCATE TABLE `uczestnicy`';
    $conn->query($query);
    $query='TRUNCATE TABLE `wygrane`';
    $conn->query($query);
    
    header('Location: index.php');
}
function usunWygranego($conn,$id){      //usuwanie jednego wygranego uczestnika
    $query='DELETE FROM wygrane WHERE id='.$id.'';
    $conn->query($query);
}

/*function mojRandom($array){     //funkcja tasująca tablicę uczestników przed losowaniem (nieuzywana po poprawkach)
    $i = count($array);

    while(--$i) {
        $j = mt_rand(0, $i);

        if ($i != $j) {
            // swap elements
            $tmp = $array[$j];
            $array[$j] = $array[$i];
            $array[$i] = $tmp;
        }
    }

    return $array;

}*/


function Random2($min,$max){    //napisana przeze mnie funkcja losująca - podczas pierwszego użycia pobierane są sekundy z bieżącego czasu, aby wypełnić                                   'seed' losową wartością, później odpowiednie obliczenia wprowadzone przeze mnie zmieniają 'seed' automatycznie
    if (isset($_SESSION["seed"])==false)
    {       //jeśli seed nie istnieje ustaw losową liczbę (mogłem wprowadzić liczbę na sztywno lecz stwierdziłem że zapewni mi to większą losowość na przyszłość)
        $czas= getdate();   //pobranie daty
        $_SESSION["seed"] = $czas["seconds"]; //jako wartość początkową wprowadzam bieżącą sekundę
    }
    if (isset($_SESSION["seed"]) && $_SESSION["seed"] != 0){    //czy w sesji jest ustawione seed i czy jest różne od 0?
    $_SESSION["seed"] = ($_SESSION["seed"] * 125) % 2796203;
    return $_SESSION["seed"] % ($max - $min + 1) + $min;        //zwróć losową wartość
    }
    
}

?>