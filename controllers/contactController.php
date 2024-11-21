<?php
// /controllers/ContactController.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Procesar la información (guardar en la base de datos, enviar correo, etc.)
    // Aquí se podría agregar la lógica para procesar el mensaje, por ejemplo, enviarlo por correo.

    // Redirigir al usuario a una página de confirmación o mostrar un mensaje de éxito
    header('Location: /public/index.php?page=contact&status=success');
    exit;
}
?>
