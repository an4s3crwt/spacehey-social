<?php
// /public/index.php

session_start();  // Iniciar sesión si es necesario

require_once '../models/db.php';  // Conexión a la base de datos
require_once '../controllers/UserController.php';  // Controlador de usuario
require_once '../controllers/BlogController.php';  // Controlador de blogs

// Controlar las rutas según el parámetro "page"
$page = isset($_GET['page']) ? $_GET['page'] : 'index';

switch ($page) {
    case 'profile':
        include '../public/views/profile.php';
        break;
    case 'contact':
        include '../public/views/contact.php';
        break;
    case 'blogs':
        include '../public/views/blogs.php';
        break;
    case 'groups':
        include '../public/views/groups.php';
        break;
    case 'create_blog':
        include '../public/views/create_blog.php';
        break;
    case 'create_group':
        include '../public/views/create_group.php';
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