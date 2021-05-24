<?php
    class Core{
        public $controlador;
        public $metodo;
        public $usuario;
        public $parametros;
        public function __construct(){
            $this->controlador="Home";
            $this->metodo="index";
            $this->parametros=[];
            
            $url=$this->obtenerUrl();
            
            if(isset($url[0])){
                if(file_exists("../sistema/controladores/".ucwords($url[0]).".php")){
                    $this->controlador=$url[0];
                    unset($url[0]);
                }
            }
            require_once "../sistema/controladores/".ucwords($this->controlador).".php";
            $this->controlador=new $this->controlador();
            if(isset($url[1])){
                if(method_exists($this->controlador,$url[1])){
                    $this->metodo=$url[1];
                    unset($url[1]);
                }
            }
            if($url){
                $this->parametros=array_values($url);
            }
            call_user_func_array([$this->controlador,$this->metodo],$this->parametros);
        }
        public function obtenerUrl(){
            if(isset($_GET['url'])){
                $url=trim($_GET['url'],"/");                
                //$url=filter_var($url,FILTER_SANITIZE_URL);
                $url=explode("/",$url);
                return $url;
            }  
            else{
                return [];
            }
        }
    }
?>