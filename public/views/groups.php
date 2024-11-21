<!-- /views/groups.php -->
<?php include '../includes/header.php'; ?>

<h1>Grupos</h1>

<?php
// Supongamos que has recuperado los grupos desde la base de datos
foreach ($groups as $group): ?>
    <div class="group">
        <h2><?php echo htmlspecialchars($group['name']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($group['description'])); ?></p>
        <a href="?page=group_detail&id=<?php echo $group['id']; ?>">Ver grupo</a>
    </div>
<?php endforeach; ?>

<?php include '../includes/footer.php'; ?>
