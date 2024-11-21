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
        //case 'profile':
          //  showUserProfile();
            //break;
        default:
            header('Location: ../index.php');
            break;
    }
}

function registerUser()
{
    global $db; // Hacer que la variable $db sea accesible

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
                header("Location: ../public/views/login.php");  // Redirigir al login
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
}
function loginUser()
{
    global $db;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['email'] = $result['email'];

                // Redirigir a la página principal después del login
                header("Location: /entorno-SERVIDOR/hola-mundo/spacehey-clon/public/views/index.php");
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "El correo electrónico no está registrado.";
        }
    }
}
/*
function showUserProfile()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/views/login.php");
        exit();
    }

    // Obtener datos de la sesión y sanitizarlos
    $username = htmlspecialchars($_SESSION['username']);
    $email = htmlspecialchars($_SESSION['email']);

    // Reemplazar los datos en la vista
    $profileDetails = [
        'username' => $username,
        'email' => $email
    ];


}
*/


?>
