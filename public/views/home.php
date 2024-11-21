<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="/entorno-SERVIDOR/hola-mundo/spacehey-clon/public/assets/css/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #001e29;
            color: white;
        }

        
        /* Sección de usuarios sugeridos */
        .sidebar {
            width: 250px;
            background-color: #002b38;
            height: calc(100vh - 60px); /* Ajuste para no cubrir el header */
            position: fixed;
            top: 60px; /* Debajo del header */
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 20px 10px;
            overflow-y: auto;
        }

        .sidebar h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #00aced;
        }

        .suggested-user {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: #003541;
            padding: 10px;
            border-radius: 10px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: #004d5a;
        }

        .user-info {
            flex: 1;
        }

        .user-info h4 {
            margin: 0;
            font-size: 16px;
        }

        .user-info p {
            margin: 2px 0;
            font-size: 12px;
            color: #a0d7e6;
        }

        .follow-btn {
            background-color: #00aced;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 12px;
            cursor: pointer;
        }

        .follow-btn:hover {
            background-color: #008bbd;
        }

        /* Contenedor principal */
        .container {
            margin-left: 270px; /* Espacio para la barra lateral */
            padding: 80px 20px 20px; /* Espacio superior para el header */
        }

        .menu-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .menu-top .explore {
            background-color: #00aced;
            border: none;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
        }

        /* Estilo de los posts */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Tres columnas */
            gap: 20px;
        }

        .post {
            background-color: #003541;
            border-radius: 10px;
            padding: 15px;
            overflow: hidden;
        }

        .post h4 {
            margin: 0 0 10px 0;
            color: #00aced;
        }

        .post img {
            width: 100%;
            border-radius: 5px;
            margin: 10px 0;
        }

        .post .tags {
            margin-top: 10px;
        }

        .tags span {
            background-color: #004d5a;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            margin-right: 5px;
            font-size: 12px;
        }

        /* Pie de página */
        footer {
            margin-top: 20px;
            text-align: center;
            color: gray;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr; /* Una columna en pantallas pequeñas */
            }

            .sidebar {
                display: none; /* Oculta la barra lateral en pantallas pequeñas */
            }

            .container {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav>
        <div class="top">
            <div class="left">
                <a href="#">
                    <img class="logo" src="https://static.spacehey.net/img/logo_optimized.svg" alt="Logo">
                </a>
            </div>
            <div class="right">
                <form action="/entorno-SERVIDOR/hola-mundo/spacehey-clon/controllers/UserController.php?action=logout" method="POST" class="logout-form">
                    <button class="logout-btn" type="submit" name="submit">LogOut</button>
                </form>
            </div>
        </div>
        <ul class="links">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Groups</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>

    <!-- Barra lateral -->
    <div class="sidebar">
        <h3>Usuarios sugeridos</h3>
        <div class="suggested-user">
            <div class="user-avatar"></div>
            <div class="user-info">
                <h4>grungequeen</h4>
                <p>@queen_grunge</p>
            </div>
            <button class="follow-btn">Seguir</button>
        </div>
        <!-- Más usuarios sugeridos -->
    </div>

    <!-- Contenido principal -->
    <div class="container">
        <div class="menu-top">
            <h2>Recientes</h2>
            <button class="explore">Populares</button>
        </div>
        <div class="grid">
            <!-- Publicaciones -->
            <div class="post">
                <h4>aroacebat</h4>
                <p>Anon ha preguntado...</p>
                <img src="https://via.placeholder.com/400x200" alt="Post Image">
            </div>
        </div>
        <footer>
            <p>&copy; 2024 TuSitio.com</p>
        </footer>
    </div>
</body>
</html>
