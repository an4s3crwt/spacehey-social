<?php
// /public/views/register.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/entorno-SERVIDOR/hola-mundo/spacehey-clon/public/assets/css/style.css">
</head>
<body>
    <h2> Registrer</h2>
    <form action="/entorno-SERVIDOR/hola-mundo/spacehey-clon/controllers/UserController.php?action=register" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="?page=login">Iniciar sesión</a></p>
</body>
</html>

