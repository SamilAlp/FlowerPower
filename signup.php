<?php 

include 'classdatabase.php';

//var_dump($_POST);

if(isset($_POST['submit'])){
// instance van je database class

$fieldnames = array("voornaam", "achternaam","email", "geboortedatum", "username", "password");

$error = false;

  foreach ($fieldnames as $fieldname) {
    if (empty($_POST[$fieldname])) {
       $error = true;
    }

  //   if(!empty($_POST[$fieldnames])){
  //   echo "<br> Plz fill the required fields in!";
  // }
    
  }
   if (!$error) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $email = $_POST['email'];
    $geboortedatum =$_POST['geboortedatum'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = new database("localhost", "projectflowerpower", "root", "", "utf8mb4");
    $pdo->InsertTabellen($email, $voornaam, $achternaam, $tussenvoegsel, $geboortedatum, $username, $password);
    echo '<hr>';
   }else{
    echo "overgeslagen";
   }
 }

?>

<html>
 <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="main.css">
 </head>
   <body style="background:#5F6AFF">
    <nav>
    <ul>
      <li class="logo">FlowerPower</li>
      <li class="items"><a href="index.php">Website overview </a></li>
      <li class="items"><a href="#">Advise</a></li>
      <li class="items"><a href="#">Blogs</a></li>
      <li class="items"><a href="#">Contact</a></li>
      <li class="items"> <a href="loginCustomer.php"> <button class="btn btn-primary" type="submit"> Login </button></a><li>  
    </ul>
  </nav>
      <form action="" method="post">
        <label for="fname">Voor naam: </label> 
         <input type="text" id="fname" name="voornaam" required> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br> 

        <label for="lname">Achter naam:</label>
         <input type="text" id="lname" name="achternaam"> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br>

        <label for="fname"> Tussen voegsel:</label>
         <input type="text" id="fname" name="tussenvoegsel" placeholder="Optioneel" > <span class="col-xs-3">
        <br><br>

        <label for="fname">E-mail:</label>
         <input type="email" id="fname" name="email"> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br>

        <label for="fname">Geboortedatum:</label>
         <input type="text" id="fname" name="geboortedatum" placeholder="00/00/0000" > <span class="col-xs-3">(Verplicht invullen) <span>
        <br><br>

        <label for="fname">Gebruiksnaam:</label>
         <input type="text" id="fname" name="username"> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br>

        <label for="fname">Wachtwoord:</label>
         <input type="password" id="fname" name="password"> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br>

        <label for="fname">Herhaal wachtwoord:</label> 
         <input type="password" id="fname" name="repeatpassword"> <span class="col-xs-3">(Verplicht invullen)<span>
        <br><br>   
        <input type="submit" name="submit" class="btn btn-primary" value="Word gebruiker" required>  
      </form>
       <input type="submit" name="submit" class="btn btn-primary" value="Ik heb al een account Login!" required>  

    </body>
</html>

