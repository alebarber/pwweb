
<?php
    require_once "BaseDeDatos.php";

    $nombreUsuario = $_SESSION['nombre'];


    // Dado el id de usuario, obtiene el id del carrito.
    function idCarrito($idUsuario) 
    {
        // Conexion base de datos
        $conexion = conectar(); 

        // Obtener el carrito asociado a ese ID.
        $sqlCarrito = "SELECT * FROM carrito WHERE id_usuario='$idUsuario'";
        $consultaCarrito = mysqli_query($conexion, $sqlCarrito);
        $carritoRow = mysqli_fetch_array($consultaCarrito);
        $idCarrito = $carritoRow['id_carrito'];

        return $idCarrito;
    }

    // Agrega un producto al carrito.
    function agregarCarrito($idCarrito, $idProducto, $nombreProducto, $precioProducto)
    {
        // Conexion base de datos
        $conexion = conectar(); 

        if(!existeProducto($idCarrito, $idProducto))
        {
            $sqlAddCarrito = "INSERT INTO rel_car_prod(id_carrito, id_producto, cantidad)
                            VALUES ('$idCarrito','$idProducto','1')";

            if (mysqli_query($conexion, $sqlAddCarrito)) 
            {
                actualizarPrecio($idCarrito, $precioProducto);
            } 
            else 
            {
                echo "Error: " . $sqlAddCarrito . "<br>" . mysqli_error($conexion);
            } 
        }
        else // Existe ya el producto en el carrito
        {
            $sqlAddCantidad = "SELECT * FROM rel_car_prod WHERE id_carrito = '$idCarrito' AND id_producto = '$idProducto'";
            $consulta = mysqli_query($conexion, $sqlAddCantidad); 
            $idProductoRow = mysqli_fetch_array($consulta);

            $sqlUpdate = "UPDATE rel_car_prod SET cantidad = cantidad + 1 WHERE id_producto = '$idProducto'";

            if (mysqli_query($conexion, $sqlUpdate)) 
            {
                actualizarPrecio($idCarrito, $precioProducto);
            } 
            else 
            {
                echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($conexion);
            } 
        }

        mysqli_close($conexion);
    }

    function quitarCarrito($idCarrito, $idProducto, $nombreProducto, $precioProducto)
    {
        // Conexion base de datos
        $conexion = conectar(); 

        // Compruebo que el producto esté en el carrito.
        if (existeProducto($idCarrito, $idProducto)) 
        {
            $sqlCantidad = "SELECT * FROM rel_car_prod WHERE id_producto='$idProducto' AND id_carrito='$idCarrito'";
            $consulta = mysqli_query($conexion, $sqlCantidad);
            $carritoProd = mysqli_fetch_array($consulta);

            if ($carritoProd['cantidad'] > 1) 
            {
                $sqlUpdate = "UPDATE rel_car_prod SET cantidad = cantidad - 1 WHERE id_producto='$idProducto' AND id_carrito='$idCarrito'";

                if (mysqli_query($conexion, $sqlUpdate)) 
                {
                    restarPrecio($idCarrito, $precioProducto);
                } 
                else 
                {
                    echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($conexion);
                }
            }
            else    // Si solo hay una unidad del producto, se borra del carrito
            {
                $sqlDeleteCarrito = "DELETE FROM rel_car_prod WHERE id_producto='$idProducto' AND id_carrito='$idCarrito'";

                if (mysqli_query($conexion, $sqlDeleteCarrito)) 
                {
                    restarPrecio($idCarrito, $precioProducto);
                    
                } 
                else 
                {
                    echo "Error: " . $sqlDeleteCarrito . "<br>" . mysqli_error($conexion);
                }
            }
        }

        mysqli_close($conexion);
    }

    function existeProducto($idCarrito, $idProducto)
    {
        // Conexion base de datos
        $conexion = conectar(); 

        $sqlCarrito = "SELECT * FROM rel_car_prod WHERE id_carrito = '$idCarrito' AND id_producto = '$idProducto'";
        $consulta = mysqli_query($conexion, $sqlCarrito); 

        if($consulta->num_rows == 0)
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

    // Le suma al precio del carrito, el precio del producto nuevo.
    function actualizarPrecio($idCarrito, $precioProducto)
    {
        $conexion = conectar(); 

        $sqlCarrito = "SELECT * FROM carrito WHERE id_carrito = '$idCarrito'";
        $consulta = mysqli_query($conexion, $sqlCarrito); 

        $sqlUpdate = "UPDATE carrito SET total_precio = total_precio + '$precioProducto' WHERE id_carrito = '$idCarrito'";
        mysqli_query($conexion, $sqlUpdate);
    }

    function restarPrecio($idCarrito, $precioProducto)
    {
        $conexion = conectar(); 

        $sqlCarrito = "SELECT * FROM carrito WHERE id_carrito = '$idCarrito'";
        $consulta = mysqli_query($conexion, $sqlCarrito); 

        $sqlUpdate = "UPDATE carrito SET total_precio = total_precio - '$precioProducto' WHERE id_carrito = '$idCarrito'";
        mysqli_query($conexion, $sqlUpdate);
    }
 
?>
