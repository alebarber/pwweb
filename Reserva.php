<?php

    require_once "../BaseDeDatos.php";

    function agregar_reserva($fecha, $hora, $nper, $idUsuario)
    {
        $idReserva = uniqid();
        $fecha = str_replace ( "-", '', $fecha);
        $hora = str_replace ( ":", '', $hora);
        $hora = $hora . "00";
        
        $enlace = conectar();

        $sql = "INSERT INTO reserva (id_reserva, num_personas, fecha, hora, id_usuario) VALUES ('$idReserva', '$nper', '$fecha', '$hora', '$idUsuario')";
        
        mysqli_query($enlace, $sql);

        mysqli_close($enlace);
    }

    function modificarReserva($fecha, $hora, $nper, $idUsuario)
    {
        $fecha = str_replace ( "-", '', $fecha);
        $hora = str_replace ( ":", '', $hora);
        if(strlen($hora) < 6)  $hora = $hora . "00"; 

        $enlace = conectar();

        $sql = "UPDATE reserva SET num_personas = '$nper', fecha = '$fecha', hora = '$hora' WHERE id_usuario = '$idUsuario'";
        
        mysqli_query($enlace, $sql);

        mysqli_close($enlace);
    }

    function borrarReserva($idUsuario)
    {
        $enlace = conectar();

        $sql = "DELETE FROM reserva WHERE id_usuario = '$idUsuario'";
        
        mysqli_query($enlace, $sql);

        mysqli_close($enlace);
    }

    function existeReserva($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * from reserva WHERE id_reserva='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        mysqli_close($conexion);
        return true;
    }


    function existeReservaUsuario($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * from reserva WHERE id_usuario='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        mysqli_close($conexion);
        return true;

    }

?>