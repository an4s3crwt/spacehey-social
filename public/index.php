<?php

require_once '../models/db.php';  // Conexión a la base de datos
require_once '../controllers/UserController.php';  // Controlador de usuario

// Controlar las rutas según el parámetro "page"
$page = isset($_GET['page']) ? $_GET['page'] : 'index';


switch ($page) {
    case 'profile':
        include '../public/views/index.php';
        break;
    case 'messages':
        include "../public/views/messages.php";
        break;
    case 'login':
        include '../public/views/login.php';
        break;
    case 'register':
        include '../public/views/register.php';
        break;
    case 'logout':
        include '../public/views/logout.php';

        break;
    default:
        include '../public/views/index.php';
        break;
}
?>
