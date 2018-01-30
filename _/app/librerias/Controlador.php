<?php

    // Clase controlador principal
    // Se encargara de cargar las vistas y los modelos
    class Controlador {

        // Cargar modelo
        public function modelo ($modelo) {
            // Carga
            require_once '../app/modelos/'.$modelo.'.php';
            // Instancia del modelo
            return new $modelo();
        }

        // Cargar vista
        public function vista ($vista, $datos = []) {
            // Comprobar si la vista existe
            if (file_exists('../app/vistas/'.$vista.'.php')) {
                require_once '../app/vistas/'.$vista.'.php';
            } else {
                // No existe
                die('La vista no existe');
            }
        }
    }
?>