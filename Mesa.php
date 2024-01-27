<?php

    require_once "../BaseDeDatos.php";


    function existeMesa($id){

        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * FROM mesa WHERE id_mesa='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        mysqli_close($conexion);
        return true;
    }


    function numSiguenteMesa($idLocal)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * from mesa where id_local='$idLocal'");

        return $sql->num_rows+1;
    }


    function actulizarNumero($idLocal)
    {
        $conexion = conectar();
        $mesas = mysqli_query($conexion, "SELECT * from mesa where id_local='$idLocal'");
        $contador = 1;
        
        foreach($mesas as $mesa)
        {
            $mesa['num_mesa'] = $contador;
            $idMesa = $mesa['id_mesa'];
            $sql = "UPDATE mesa SET num_mesa='$contador' WHERE id_mesa='$idMesa'";
            mysqli_query($conexion, $sql); 
            $contador++;
        }
        mysqli_close($conexion);
    }

?>