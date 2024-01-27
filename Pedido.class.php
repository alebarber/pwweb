<?php
    class Pedido {
        private $idPedido;
        private $totalPrecio = 0;
        private $idUsuario;
        private $productos = array();

        // Constructor
        public function __construct($totalPrecio_,$idUsuario_,$productos_) { 
            $this->idPedido = uniqid(); // Generar id único
            $this->totalPrecio = $totalPrecio_;
            $this->idUsuario = $idUsuario_;
            $this->productos = $productos_;
        }
    }
?>