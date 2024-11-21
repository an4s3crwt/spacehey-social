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
    function registerUser() {
        global $db;  // Hacer que la variable $db sea accesible
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Validar si el correo ya está registrado
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                echo "El correo electrónico ya está registrado.";
            } else {
                // Encriptar la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
                // Insertar el nuevo usuario en la base de datos
                $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $username);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $hashed_password);
    
                if ($stmt->execute()) {
                    // Loguear automáticamente al usuario después de registrarse
                    $user_id = $db->lastInsertId();  // Obtener el ID del nuevo usuario
                    session_start();
                    $_SESSION['user_id'] = $user_id;  // Guardar el ID del usuario en la sesión
                    header("Location: ../public/views/index.php");  // Redirigir al perfil
                    exit;
                } else {
                    echo "Error al registrar el usuario.";
                }
            }
        }
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