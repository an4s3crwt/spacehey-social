<?php
require 'db.php';

class editUser
{

    public static function getUserData($user_id)
    {
        global $db;

        $stmt = $db->prepare("select username, email, layout_id, about_me, interests from users where id =?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // Función para obtener el CSS personalizado de un usuario
    public static function getUserCss($user_id)
    {
        global $db;

        // Consulta SQL para obtener el código CSS
        $stmt = $db->prepare("SELECT code FROM layouts WHERE author = ?");
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica si se encontró un código CSS para el usuario
        $layout = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($layout) {
            return $layout['code'];  // Retorna el código CSS
        } else {
            return null;  // No hay CSS personalizado para este usuario
        }
    }
    //actualizar la base ded atos
    public static function updateUserData($user_id, $username, $email, $about_me, $interests)
    {
        global $db;

        $stmt = $db->prepare("UPDATE users SET username=?, email=?, about_me=?, interests=? WHERE id=?");

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $about_me);
        $stmt->bindParam(4, $interests);
        $stmt->bindParam(5, $user_id);

        if ($stmt->execute()) {
            // Actualizar los datos de la sesión con los nuevos valores
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['about_me'] = $about_me;
            $_SESSION['interests'] = $interests;

            return true;
        } else {
            // Mostrar error detallado de la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . implode(" ", $stmt->errorInfo());
            return false;
        }
    }


    //guardar el codigo css del usuario o actualizarlo si ya exite
    // Método para guardar o actualizar el CSS del usuario
    public static function saveUserCss($user_id, $css_code)
    {
        global $db;

        // Verificar si ya existe un registro para este usuario en la tabla layouts
        $stmt = $db->prepare("SELECT * FROM layouts WHERE author = ?");
        $stmt->bindParam(1, $user_id);
        $stmt->execute();

        // Si ya existe un registro, actualizamos el CSS
        if ($stmt->rowCount() > 0) {
            $stmt = $db->prepare("UPDATE layouts SET code = ? WHERE author = ?");
            $stmt->bindParam(1, $css_code);
            $stmt->bindParam(2, $user_id);
            $stmt->execute();
        } else {
            // Si no existe un registro, lo insertamos
            $stmt = $db->prepare("INSERT INTO layouts ( code, author) VALUES (?, ?)");
            $stmt->bindParam(1, $css_code);
            $stmt->bindParam(2, $user_id);

            $stmt->execute();
        }

            // Actualizar el CSS en la sesión
    $_SESSION['user_css'] = $css_code;
    }
}
