<!-- /views/blogs.php -->
<?php include '../includes/header.php'; ?>

<h1>messages</h1>

<?php
// Asumiendo que ya tienes un controlador que recupera los blogs desde la base de datos
// Ejemplo de cómo mostrar blogs
foreach ($blogs as $blog): ?>
    <div class="blog-post">
        <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($blog['text'])); ?></p>
        <a href="?page=blog_detail&id=<?php echo $blog['id']; ?>">Leer más</a>
    </div>
<?php endforeach; ?>

<?php include '../includes/footer.php'; ?>
