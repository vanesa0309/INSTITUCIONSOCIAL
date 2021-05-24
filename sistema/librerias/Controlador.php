<?php
    class Controlador{
        protected $modelo;
        protected $vista;
        
        public function cargarModelo($modelo,$parametros=[]){            
            require_once "../sistema/modelos/".ucwords($modelo).".php";
            return new $modelo();
        }
        public function cargarVista($vista,$parametros=[]){  
            
            $rutas=explode("/",$vista);
            $rutas[count($rutas)-1]= ucwords($rutas[count($rutas)-1]);
            $vista="";
            foreach($rutas as $ruta){
                $vista.="/".$ruta;
            }
            
            if(is_file("../sistema/vistas/".$vista.".php")){
                require_once "../sistema/vistas/".$vista.".php";
            }
            else{
                die("No existe vista");
            }
        }        
    }
?>