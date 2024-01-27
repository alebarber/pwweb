<?php

    require_once "../BaseDeDatos.php";


    function existeProductoNombre($nombre)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * FROM producto WHERE nombre='$nombre'");
         
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        return true;
        mysqli_close($conexion);
    }

    function existeProductoId($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * FROM producto WHERE id_producto='$id'");
         
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        return true;
        mysqli_close($conexion);
    }


?>