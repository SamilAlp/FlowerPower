<?php  
class database{
    //properties = variabelen in een class
   private $host;
   private $database_name;
   private $user;
   private $password;
   private $charset; 
   private $pdo;     
 
  // constructor
    public function __construct($host, $database_name, $user, $password, $charset) {
     $this->host = $host;//127.0.0.1";
     $this->database_name = $database_name;//"test";
     $this->user =$user;//"root";
     $this->password = $password;//"";
     $this->charset = $charset;//"utf8mb4";

   try{
    $dsn = 'mysql:host='.$this->host.';dbname='.$this->database_name.';charset='.$this->charset;
    $this->pdo = new PDO($dsn,$this->user, $this->password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected";
   } catch (\PDOException $e) {
        echo "Database connection failed <br>". $e->getMessage();
    } 
  }

  public function InsertTabellen($email, $voornaam, $achternaam, $tussenvoegsel, $geboortedatum, $username, $password){
      try{
        $this->pdo->beginTransaction();

      $sql2 = "INSERT INTO account(id, usertype_id, username, email, password)
                      VALUES(NULL, 2, :username, :email, PASSWORD(:password));";

      $passwordhash = password_hash($password, PASSWORD_DEFAULT);
      // $passwordhash = md5($password);

        $stmt = $this->pdo->prepare($sql2);
        
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
            
            $id = $this->pdo->lastInsertId();
        
        $sqlpersoon = "INSERT INTO persoon(id, voornaam, achternaam, tussenvoegsel, geboortedatum, account_id) VALUES (NULL, :voornaam, :achternaam, :tussenvoegsel, :geboortedatum, :account_id);";  

        $stmt = $this->pdo->prepare($sqlpersoon);
      
      $stmt->execute(['voornaam' => $voornaam, 'achternaam' => $achternaam, 'tussenvoegsel' => $tussenvoegsel,     'geboortedatum' => $geboortedatum, 'account_id' => $id]);
      
      $this->pdo->commit();

        header("Location: loginCustomer.php");
    
      // echo "Commit succesfull";

      // echo "<hr>";

      // echo "voornaam = $voornaam | tussenvoegsel = $tussenvoegsel | achternaam = $achternaam | email =  $email | geboortedatum =  $geboortedatum | username =  $username | password = $password | passwordhash = 
      //          $passwordhash;";
      
      }catch(PDOException $e){
      $this->pdo->rollback();
        echo "failed: ". $e->getMessage();
      }
  }

  public function loginadmin($gebruikersnaam, $wachtwoord){
    try{
      $this->pdo->beginTransaction();
            //echo "Inside Login#1<br>";
      // echo "username: $username and password: $password<br>";
            
            // echo "password_hash: ".md5($password)."<br>";
           
        $stmt = $this->pdo->prepare("SELECT * FROM medewerker where gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
        // $password = md5($password);
        $stmt->bindParam(':gebruikersnaam',$gebruikersnaam);
        $stmt->bindParam(':wachtwoord',$wachtwoord);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
 
        if ($rowCount > 0)
        {   
            session_start();
            $_SESSION["gebruikersnaam"] = $_POST["gebruikersnaam"];
            header("Location: adminmainpage.php");
        }
        else
        {
            echo "Wrong username or password!";;
        }
    }catch(PDOException $e){
      $this->pdo->rollback();
        echo "failed: ". $e->getMessage();
    }
  }
}   
?>