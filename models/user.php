<?php 
require 'db.php';

class User {
    private $db;
    private $table = "users";

    public function __construct($db)
    {
        $this->db = $db;
        
    }

    //REGISTER
    public function register($username, $email, $password){
        $sql = "insert into {$this->table}(username,email,password) values (?,?,?)";
        $res = $this->db->prepare($sql); 

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $res->execute([
            $username,
            $email,
            $hashed
        ]);

    }


    //LOGIN
    public function login($username, $password){
        $sql = "select id, username, password from {$this->table} where username = ? limit 1";
        $res = $this->db->prepare($sql);

        $res->execute([$username]);
        if($res->rowCount() > 0){
            $row = $res->fetch();

            $userId = $row["id"];
            $storedUsername = $row['username'];
            $storedPassword = $row["password"];

            if(password_verify($password,$storedPassword)){
                return $userId;
            }else{
                return false;
            }

        }

        return false;
    }
}

?>