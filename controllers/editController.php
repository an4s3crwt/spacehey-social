<?php
require '../models/editUser.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];



// Llamar a la función dependiendo de la acción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    saveProfile();
} else {
    showEditProfile();
}



//mostrar el form para editarperfil
function showEditProfile(){
    global $user_id;


    $user = editUser::getUserData($user_id);

    include '../public/views/editProfile.php';
}

function saveProfile(){
    global $user_id;

    //obtener datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $about_me = $_POST['about_me'];
    $interests = $_POST['interests'];
    $css_code = $_POST['css_code'];

    // Actualizar los datos del usuario
    $success = editUser::updateUserData($user_id, $username, $email, $about_me, $interests);
     // Guardar o actualizar el código CSS del usuario
     if (!empty($css_code)) {
        editUser::saveUserCss($user_id, $css_code);
    }


    if ($success) {
        header("Location: /entorno-SERVIDOR/hola-mundo/spacehey-clon/public/views/index.php");

    } else {
        // Mostrar mensaje de error si la actualización falla
        echo "Hubo un problema al guardar los cambios.";
    }
    
}


?>