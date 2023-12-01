<?php
class Database
{
    public $pdo;

    public function __construct($db = "test", $user = "root", $pass = "", $host = "localhost:3307")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully to $db" . "<br />\n";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function InsertUser($email, $password)
    {
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$email, $password]);
    }


    // public function selectOneUSer($email){
    //     $stmt = $this->pdo->query("SELECT * FROM user WhERE email = ?");
    //     $stmt->execute([$email]);
    //     $result = $stmt->fetchAll();
    //     return $result;
    // }

    public function SelectOneUser($ID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE ID = ?");
        $stmt->execute([$ID]);
        $result = $stmt->fetch();
        return $result;
    }

    public function select()
    {
        $stmt = $this->pdo->query("SELECT * FROM user");
        $result = $stmt->fetchAll();
        return $result;
    }

    public function SelectIf($ID = null){
        
        if ($ID !== null) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE ID = ?");
            $stmt->execute([$ID]);
            $result = $stmt->fetch();
            return $result;
        } else {
            $stmt = $this->pdo->query("SELECT * FROM user");
            $result = $stmt->fetchAll();
            return $result;
        }

    }


}
