<?php
    /* 
    Mapear la url del navegador
    1- Controlador
    2- Métodos
    3- Parámetro
    Ejemplo: /vehiculo/alquilar/5
    */

    class Core {
        protected $controladorActual = 'Paginas';
        protected $metodoActual = 'index';
        protected $parametros = [];

        // Constructor
        public function __construct() {
            $url = $this->getUrl();

            if (file_exists('../app/controladores/'.ucwords($url[0]).'.php')) {
                // Si el controlador existe se usa el controlador
                $this->controladorActual = ucwords($url[0]);

                // unset indice 0 para quitar el controlador por defecto
                unset($url[0]);
            }

            // incluir el controlador
            require_once '../app/controladores/'.$this->controladorActual.'.php';
            $this->controladorActual = new $this->controladorActual;

            // Controlar el método, la segunda parte de la url
            if(isset($url[1])) {
                if (method_exists($this->controladorActual, $url[1])) {
                    // Si el método existe se usa el método
                    $this->metodoActual = $url[1];
                    
                    // unset del metodo por defecto
                    unset($url[1]);
                }
            }
            //echo $this->metodoActual;

            // Obtener los parámetros
            $this->parametros = $url ? array_values($url) : [];

            // Llamar callback con los parámetro del array
            call_user_func_array([$this->controladorActual, $this->metodoActual], 
                $this->parametros);
        }

        public function getUrl() {
            // echo $_GET['url'];
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>