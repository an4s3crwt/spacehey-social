<!-- /public/views/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SpaceHey Clone</title>

</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
       
        <!-- Formulario de login -->
        <form action="../../controllers/UserController.php?action=login" method="POST">

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>

        <p>¿No tienes una cuenta? <a href="../index.php?page=register">Regístrate aquí</a></p>

        <!-- Mostrar mensajes de error si los hay -->
        <?php
            if (isset($_GET['error'])) {
                echo "<p style='color: red;'>".$_GET['error']."</p>";
            }
        ?>
    </div>
</body>
</html>
