<?php
// controllers/UserController.php
require_once '../models/db.php';  // Incluir la conexión a la base de datos

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'register':
            registerUser();
            break;
        case 'login':
            loginUser();
            break;
        default:
            header('Location: ../index.php');
            break;
    }
}

function registerUser() {
    global $db;  // Hacer que la variable $db sea accesible

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validar si el correo ya está registrado
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);  // Usar bindParam() para los parámetros
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
                header("Location: ../public/views/login.php");  // Redirigir al login
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
}

function loginUser() {
    global $db;  // Hacer que la variable $db sea accesible

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verificar si el usuario existe
        $stmt = $db->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Verificar si la contraseña es correcta
            if (password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                header("Location: /entorno-SERVIDOR/hola-mundo/spacehey-clon/public/views/index.php"); // Redirigir al perfil
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "El correo electrónico no está registrado.";
        }
    }
}
?>
