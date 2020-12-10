<?php
session_start();
include 'classdatabase.php';

// var_dump($_POST);

if(isset($_POST['submit'])){

$fieldnames = array("gebruikersnaam", "wachtwoord");

$error = false;

  foreach ($fieldnames as $fieldname) {
      if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
       $error = true;
    }
  }
  if ($error = true) {
    $gebruikersnaam = $_POST['user'];
    $wachtwoord = $_POST['wachtwoord'];

    $pdo = new database("localhost", "flowerpower", "root", "", "utf8mb4");
    $pdo->loginadmin($gebruikersnaam, $wachtwoord);
    echo '<hr>';
  }
  // else{
  //   echo "Not working";
  //  }
}
?>

<!DOCTYPE html>
<html>
  <head>
  <title></title>
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" type="text/css" href="styleadmin.css">
  <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
<body>
  <?php 
  if(isset($message))
  {
    echo '<label class="text-danger">'.$message.'</label>';
  }
  ?> 
   <header>
     <div class="container center-div shadow">
      <div style="font-size: 25px;" class="heading text-center mb-5 text-white"> ADMIN LOGIN PAGE </div>
      <div class="container row d-flex flex-row justify-content-center mb-5">
          <div class="admin-form shadow p-2">
              <form style="width: 410px" action="adminlogin.php" method="POST">
                <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="" class="form-control" autocomplete="off">
                </div>
                <input type="submit" class="btn btn-success"  value="submit" name="submit">
              </form>
          </div>  
      </div>     
      </div>
     </div>
   </header>
</body>
</html>