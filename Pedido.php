<?php

    require_once "../BaseDeDatos.php";
    
    function existePedido($id)
    {
        $conexion = conectar();
        $sql = mysqli_query($conexion, "SELECT * from pedido WHERE id_pedido='$id'");
        
        if($sql->num_rows == 0)
        {
            mysqli_close($conexion);
            return false;
        }

        mysqli_close($conexion);
        return true;
    }

    function generarPedido($idUsuario, $precioTotal, $idCarrito)
    {
        $conexion = conectar();

        $idPedido = uniqid();

        $sqlAddPedido = "INSERT INTO pedido(id_pedido, total_precio, id_usuario) 
                            VALUES ('$idPedido','$precioTotal','$idUsuario')";
        mysqli_query($conexion, $sqlAddPedido );

        $sqlPedido = "SELECT * FROM rel_car_prod WHERE id_carrito='$idCarrito'";
        $productos = mysqli_query($conexion, $sqlPedido);

        foreach($productos as $producto)
        {
            $idProducto = $producto['id_producto'];
            $cantidad = $producto['cantidad']; 

            $sqlAddPedido = "INSERT INTO rel_ped_prod(id_pedido, id_producto, cantidad)
                            VALUES ('$idPedido','$idProducto','$cantidad')";

            if (!mysqli_query($conexion, $sqlAddPedido)) 
            {
                echo "Error: " . $sqlAddPedido . "<br>" . mysqli_error($conexion);
            } 

            $sqlDeleteProducto = "DELETE FROM rel_car_prod WHERE id_carrito='$idCarrito' AND id_producto = '$idProducto'"; 

            if (!mysqli_query($conexion, $sqlDeleteProducto)) 
            {
                echo "Error: " . $sqlDeleteProducto . "<br>" . mysqli_error($conexion);
            } 
        }

        $sqlUpdate = "UPDATE carrito SET total_precio='0' WHERE id_carrito='$idCarrito'";
        if (!mysqli_query($conexion, $sqlUpdate)) 
        {
            echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($conexion);
        } 

        mysqli_close($conexion);
    }

?>