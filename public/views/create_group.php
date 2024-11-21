<!-- /views/create_group.php -->
<?php include '../includes/header.php'; ?>

<h1>Crear un Nuevo Grupo</h1>

<form action="create_group_submit.php" method="POST">
    <label for="name">Nombre del Grupo:</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" required></textarea>

    <button type="submit">Crear Grupo</button>
</form>

<?php include '../includes/footer.php'; ?>
