<!-- /views/login.php -->
<?php include '../includes/header.php'; ?>

<h1>Iniciar Sesión</h1>

<form action="login_submit.php" method="POST">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Iniciar sesión</button>
</form>

<p>¿No tienes cuenta? <a href="?page=register">Regístrate aquí</a></p>

<?php include '../includes/footer.php'; ?>
