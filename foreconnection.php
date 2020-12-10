<?php
session_start();
include 'classdatabase.php';

// var_dump($_POST);

if(isset($_POST['submit'])){
  
    $pdo = new database("localhost", "flowerpower", "root", "", "utf8mb4");
    echo '<hr>';
  }

?>