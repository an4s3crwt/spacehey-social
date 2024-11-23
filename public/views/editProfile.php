<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>

<body>
    <h2>Editar Perfil</h2>

    <form action="/entorno-SERVIDOR/hola-mundo/spacehey-clon/controllers/editController.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="about_me">Sobre mí:</label>
        <textarea id="about_me" name="about_me"><?php echo htmlspecialchars($user['about_me']); ?></textarea>

        <label for="interests">Intereses:</label>
        <textarea id="interests" name="interests"><?php echo htmlspecialchars($user['interests']); ?></textarea>

        <label for="css_code">Código CSS:</label>
        <textarea id="css_code" name="css_code"><?php echo $css_code ?? ''; ?></textarea>

        <button type="submit">Guardar Cambios</button>

    </form>
</body>

</html>