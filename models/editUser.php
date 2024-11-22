<?php 
require 'db.php';

class editUser {

    public static function getUserData($user_id){
        global $db;

        $stmt = $db->prepare("select username, email, layout_id, about_me, interests from users where id =?");
       $stmt->execute([$user_id]);
       return $stmt->fetch(PDO::FETCH_ASSOC);


    }

    //actualizar la base ded atos
    public static function updateUserData($user_id, $username, $email, $about_me, $interests) {
        global $db;
    
        $stmt = $db->prepare("UPDATE users SET username=?, email=?, about_me=?, interests=? WHERE id=?");
    
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $about_me);
        $stmt->bindParam(4, $interests);
        $stmt->bindParam(5, $user_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            // Mostrar error detallado de la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . implode(" ", $stmt->errorInfo());
            return false;
        }
    }
    

    //guardar el codigo css del usuario o actualizarlo si ya exite
    public static function saveUserCss($user_id, $css_code){
        global $db;

        // Verificar si el usuario ya tiene un layout
        $stmt = $db->prepare("SELECT id FROM layouts WHERE author = ?");
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $layout = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($layout) {
            // Actualizar el código CSS si ya existe
            $stmt = $db->prepare("UPDATE layouts SET code = ? WHERE id = ?");
            $stmt->bindParam(1, $css_code);
            $stmt->bindParam(2, $layout['id']);
            return $stmt->execute();
        } else {
            // Crear un nuevo diseño si no existe
            $stmt = $db->prepare("INSERT INTO layouts (title, code, author) VALUES (?, ?, ?)");
            $title = "Diseño personalizado de usuario $user_id"; // Nombre genérico
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $css_code);
            $stmt->bindParam(3, $user_id);
            $stmt->execute();

            $layout_id = $db->lastInsertId();

            // Actualizar la tabla de usuarios con el ID del nuevo diseño
            $stmt = $db->prepare("UPDATE users SET layout_id = ? WHERE id = ?");
            $stmt->bindParam(1, $layout_id);
            $stmt->bindParam(2, $user_id);
            return $stmt->execute();
        }
    }

}

?>