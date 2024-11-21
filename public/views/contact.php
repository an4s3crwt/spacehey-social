<!-- /views/contact.php -->
<?php 
// Ruta al archivo header.php dentro de includes
require '../includes/header.php'; 
?>

<main>
    <h1>Contacto</h1>
    <p>¿Tienes alguna duda? ¡Contáctanos!</p>

    <form action="/controllers/contactController.php" method="POST">
        <div>
            <label for="name">Tu nombre:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Tu email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">Tu mensaje:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit">Enviar mensaje</button>
    </form>
</main>

<?php 
// Ruta al archivo footer.php dentro de includes
require '../includes/footer.php'; 
?>
