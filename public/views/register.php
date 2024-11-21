<!-- /views/register.php -->
<?php include '../includes/header.php'; ?>

<h1>Registrarse</h1>

<form action="register_submit.php" method="POST">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Registrarse</button>
</form>

<p>¿Ya tienes cuenta? <a href="?page=login">Inicia sesión aquí</a></p>

<?php include '../includes/footer.php'; ?>
 <link rel="stylesheet" href="/entorno-SERVIDOR/hola-mundo/spacehey-clon/public/assets/css/style.css">