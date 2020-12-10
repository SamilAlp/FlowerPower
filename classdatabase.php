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