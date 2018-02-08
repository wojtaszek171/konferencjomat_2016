<?php 
//CONTENT TEMPLATE
if(isset($_GET["czysc"]) && $_GET["czysc"]==1){
    echo czyscWygranych($conn);
}
if(isset($_GET["usun"]) && $_GET["usun"]!=""){
    echo usunWygranego($conn,$_GET["usun"]);
}
?>

<article>
    
  <h1>WYGRANE</h1>      <!-- okno wygranych -->
    <?php echo wylosowani($conn); ?>
    <br><br>
    <script>
        function confirmczysc() {
            var retVal = confirm("Jesteś pewien, że chcesz wyczyścić tabelę wygranych?");
        if (retVal == true) {
            window.location.href = "index.php?wygrani=1&czysc=1";
        } else {
            window.location.href = "index.php?wygrani=1";
        }
        }
    </script>
    <a class="wygranicz" onclick="confirmczysc()">Wyczyść tabelę</a>
  <p></p>
</article>

