<?php

    require_once "../BaseDeDatos.php";

    // ------------------- Usuario ----------------------- //

    function existeId($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where id_usuario='$id'");

        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }

    function existeCorreo($correo)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where correo='$correo'");

        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }


    function existeUsuario($nombre)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where nombre='$nombre'");

        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }


    function nombreDuplicado($nombre, $id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where nombre='$nombre' and id_usuario!='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }


    function correoDuplicado($correo, $id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where correo='$correo' and id_usuario!='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }


    function telefonoDuplicado($telefono, $id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from cliente where telefono='$telefono' and id_usuario!='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }


    function idUsuario($nombreUsuario)
    {
        $conexion = conectar();

        $sqlIdUsuario = "SELECT * FROM usuario WHERE nombre='$nombreUsuario'";
        $consultaID = mysqli_query($conexion, $sqlIdUsuario);
        $idRow = mysqli_fetch_array($consultaID);
        $idUsuario = $idRow['id_usuario'];

        return $idUsuario;
    }


    // ------------------- Cliente ----------------------- //

    function existeTelefono($telefono)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from cliente where telefono='$telefono'");

        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            mysqli_close($conexion);
            return true;
        } 
    }

    // ------------------- Admin ----------------------- //

    function esAdmin($nombre)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "select * from usuario where nombre='$nombre'");

        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }
        else
        {
            $usuario = mysqli_fetch_array($sql);
            $id = $usuario['id_usuario'];
            $sql2 = mysqli_query($conexion, "select * from admin where id_usuario='$id'");
            
            if($sql2->num_rows == 0)
            {
                mysqli_close($conexion);
                return false;
            }
            else
            {
                mysqli_close($conexion);
                return true;
            }
        } 
    }

?>