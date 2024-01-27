<?php

    require_once "../BaseDeDatos.php";


    function existeLocal($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * from local WHERE id_local='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        mysqli_close($conexion);
        return true;
    }


?>