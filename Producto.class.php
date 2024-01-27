<?php
    class Tipo {
        const MENU = 'menu';
        const PRINCIPAL = 'principal';
        const ENTRANTE = 'entrante';
        const BEBIDA = 'bebida';
        const POSTRE = 'postre';
    }

    class Producto {
        private $idProducto;
        private $nombre;
        private $precio;
        private $tipo;
        private $descripcion;

        // Constructor
        public function __construct($nombre,$precio,$tipo,$descripcion) { 
            $this->idProducto = uniqid(); // Generar id único
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->tipo = $tipo;
            $this->descripcion = $descripcion;
        }

        // Getters y Setters

        public function getIdProducto() {
            return $this->idProducto;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getPrecio() {
            return $this->precio;
        }

        public function getTipo() {
            return $this->tipo;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
    }   
?>