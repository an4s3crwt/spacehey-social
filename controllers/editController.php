<?php
require '../models/editUser.php';
require "../models/db.php";
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
    global $db;


    $user = editUser::getUserData($user_id);

     // Recuperar el código CSS personalizado del usuario
     $stmt = $db->prepare("SELECT code FROM layouts WHERE author = ?");
     $stmt->bindParam(1, $user_id);
     $stmt->execute();
     $layout = $stmt->fetch(PDO::FETCH_ASSOC);
 
     
     if ($layout) {
        $css_code = $layout['code'];//el de la base de datos
        
     } else {
         $css_code = "";  // No hay CSS personalizado
     }
 
     // Incluir la vista del formulario de edición
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