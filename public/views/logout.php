<?php
// Inicia la sesión o la continúa
session_start();

// Destruir toda la sesión
session_unset(); // Eliminar variables de la sesión
session_destroy(); // Destruir la sesión

// Opcional: Eliminar cookies relacionadas si las usas para la sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Verificar si la sesión se ha cerrado correctamente
if (!isset($_SESSION['user_id'])) {
    echo "No hay sesión activa.";
} else {
    echo "Sesión activa para user_id: " . $_SESSION['user_id'];
}

// Redirigir al login después de cerrar sesión
header("Location: ../public/views/login.php"); 
exit();
?>
