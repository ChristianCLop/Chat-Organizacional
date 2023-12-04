<?php

// archivo: funciones.php

include_once "config.php";

function registrarUsuario($conn, $nombre, $apellido, $correo, $contrasena, $imagen)
{
    $respuesta = "";

    if (validarEntrada($nombre, $apellido, $correo, $contrasena)) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $usuarioExistente = verificarUsuarioExistente($conn, $correo);

            if (!$usuarioExistente) {
                $respuesta = procesarCargaDeImagen($imagen, $nombre, $apellido, $correo, $contrasena, $conn);
            } else {
                $respuesta = "$correo - Este correo electrónico ya existe.";
            }
        } else {
            $respuesta = "$correo no es un correo electrónico válido.";
        }
    } else {
        $respuesta = "Todos los campos son obligatorios.";
    }

    return $respuesta;
}

function validarEntrada($nombre, $apellido, $correo, $contrasena)
{
    return !empty($nombre) && !empty($apellido) && !empty($correo) && !empty($contrasena);
}

function verificarUsuarioExistente($conn, $correo)
{
    $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '{$correo}'");
    return mysqli_num_rows($sql) > 0;
}

function procesarCargaDeImagen($imagen, $nombre, $apellido, $correo, $contrasena, $conn)
{
    $respuesta = ""; // Inicializa la variable de respuesta

    if (isset($imagen)) {
        $img_name = $imagen['name'];
        $img_type = $imagen['type'];
        $tmp_name = $imagen['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if (in_array($img_ext, $extensions) === true) {
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time . $img_name;
                if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    $ran_id = rand(time(), 100000000);
                    $status = "Activo ahora";
                    $encrypt_pass = md5($contrasena);
                    $insert_query = mysqli_query($conn, "INSERT INTO usuarios (id, nombre, apellido, correo, contrasena, imagen, estado)
                        VALUES ({$ran_id}, '{$nombre}','{$apellido}', '{$correo}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                    if ($insert_query) {
                        $select_sql2 = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '{$correo}'");
                        if (mysqli_num_rows($select_sql2) > 0) {
                            $result = mysqli_fetch_assoc($select_sql2);
                            $_SESSION['id_usuario'] = $result['id'];
                            $respuesta = "success";
                        } else {
                            $respuesta = "Esta dirección de correo electrónico no existe.";
                        }
                    } else {
                        $respuesta = "Algo salió mal. Por favor, inténtalo de nuevo.";
                    }
                }
            } else {
                $respuesta = "Por favor, sube un archivo de imagen - jpeg, png, jpg";
            }
        } else {
            $respuesta = "Por favor, sube un archivo de imagen - jpeg, png, jpg";
        }
    }

    return $respuesta;
}

?>
