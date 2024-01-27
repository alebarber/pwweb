<?php
    // Coloca aquí tus datos de sesión de base de datos
    $host = "localhost";
    $usuario = "admin_restaurante";
    $contraseña = "";
    $nombre_bd = "restaurante_pw";

    function conectar()
    {
        global $host, $usuario, $contraseña, $nombre_bd;

        // Conectar con base de datos
        $conexion = mysqli_connect($host, $usuario, $contraseña, $nombre_bd);

        if($conexion->connect_error)
        {
            die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
        }

        return $conexion;
    }

?>