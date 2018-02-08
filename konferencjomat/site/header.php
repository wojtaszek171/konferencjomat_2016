<?php 
//HEADER TEMPLATE
?>

<header>
   <h1>Konferencjomat 2016</h1>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="../jquery-3.1.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"> </script>
    <script src="../bootstrap/js/bootstrap.min.js"> </script>
    <script>
    $( document ).ready(function() {
        
    $("#selectall").click(function () {
    $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
    $("#m2").click(function () {
    $("#wyklucz").prop('display', $(this).prop('inline'));
        });
        });
    </script>
       
</header>