<?php
    class Paginas extends Controlador{
        public function __construct() {
            echo ('Controlador paginas cargado');
        }

        public function index () {
            $this->vista('paginas/inicio');
        }

        public function metodo1 () {
            echo ('hola');
        }

        public function metodo2 ($param) {
            echo $param;
        }
    }
?>