<?php 
    //konfiguracja i połączenie z bazą danych
    $host = 'localhost';
    $uzytkownik = 'root';
    $haslo = "";
    $nazwa_bazy = "konferencjomat";
    $conn = new mysqli($host, $uzytkownik, $haslo, $nazwa_bazy); 
    $conn->set_charset('utf8');
    ?>