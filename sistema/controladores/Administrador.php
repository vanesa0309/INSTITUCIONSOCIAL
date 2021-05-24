<?php
    class Administrador extends Controlador{
        public function __construct()
        {   
            $this->modelo=$this->cargarModelo("Administradores");
        }
        public function index(){
            verificarSesion("Administrador");
            $parametros=[
                "citas"=>$this->modelo->consultar_citas()
            ];
            $this->cargarVista("admin/index",$parametros);
        }
        public function registrar(){
            if($_SERVER['REQUEST_METHOD']=="GET"){
                verificarSesionLogin("Administrador");
                $this->cargarVista("admin/registrar");
            }
            else{
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $nombre= trim($_POST['nombre']);
                    $correo= trim($_POST['email']);
                    $usuario= trim($_POST['usuario']);
                    $password= trim($_POST['password']);
                    $this->modelo=$this->cargarModelo("Usuarios");
                    echo $this->modelo->registar_usuario($nombre,$correo,$usuario,$password,1);
                }
            }
        }
        public function modificar_cita($id){
            if($_SERVER['REQUEST_METHOD']=="GET"){
                verificarSesion("Administrador");
                $parametros=[
                    "cita"=>$this->modelo->consultar_cita($id)
                ];
                
                $this->cargarVista("admin/modificar_cita",$parametros);
            }
            else{
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $datos=[
                        "idcita"=>trim($_POST['idcita']),
                        "fecha"=>trim($_POST['fecha']),

                        "hora"=>trim($_POST['hora']),
                        "motivo"=>trim($_POST['motivo']),
                    ];
                    echo $this->modelo->modificar_cita($datos);
                }
            } 
        }
        public function boton_citas(){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $fecha=$_POST['fecha'];
                $idusuario=$_POST['idusuario'];
                echo $this->modelo->boton_citas($idusuario,$fecha);
            }
        }
        public function eliminar_cita($id){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                echo $this->modelo->eliminar_cita($id);
            }
        }
        
    }
?>