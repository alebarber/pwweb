<?php
    class Carrito {
        private $idCarrito;
        private $totalPrecio = 0;
        private $idUsuario;

        // [][0] = Id producto
        // [][1] = Precio del producto
        // [][2] = Cantidad del producto
        private $productos = array(array());

        // Constructor
        public function __construct($idUsuario_) { 
            $this->idCarrito = uniqid(); // Generar id único
            $this->idUsuario = $idUsuario_;
        }
            
        // Getters y Setters

        public function getIdCarrito() {
            return $this->idCarrito;
        }

        public function getTotalPrecio() {
            return $this->totalPrecio;
        }

        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function getProductos() {
            return $this->productos;
        }
      
        // Métodos

        // Añade el id del producto al carrito.
        public function anadirProducto($idProducto, $precio) {

            $flag = false;
            
            // Si ya está el producto en el carrito, aumentamos su cantidad
            for ($i=0; $i < count($this->productos) && $flag == false; $i++) { 
                if ($idProducto == $this->productos[$i]) {
                    $this->productos[$i][2]++; // Aumentamos en 1 la cantidad
                    $flag = true; 
                }
            }
            
            // No existe el producto en el carrito, entonces se añade
            if ($flag == false) {

                $nuevo_producto = array($idProducto,$precio,1);
                // $this->productos[][0] = $idProducto;
                // $this->productos[][1] = $precio;
                // $this->productos[][2] = 1;
                array_push($this->productos,$nuevo_producto);
                $this->totalPrecio += $precio;
            }
        }

        // Elimina el id del producto del carrito.
        public function eliminarProducto($idProducto, $precio) {
            for ($i=0; $i < count($this->productos); $i++) { 
                if ($idProducto == $this->productos[$i]) {
                    unset($this->productos[$i]);
                    $this->totalPrecio -= $this->totalPrecio;
                }
            }
        }
            
        // Vacía el carrito de productos.
        public function vaciarCarrito() {
            for ($i=0; $i < count($this->productos); $i++) { 
                unset($this->productos[$i]);
            }
            $totalPrecio = 0;
        }

        // Convierte carrito en un producto.
        public function hacerPedido() {
            $pedido = new Pedido($this->totalPrecio,$this->idUsuario,$this->productos); 
        }
    }  
?>