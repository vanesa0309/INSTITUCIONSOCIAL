<?php
    class Confirmaciones extends Controlador{
         //ruta: DOMINIO/bautizos/registrar

        public function __construct()
    {
        $this->modelo = $this->cargarModelo("Confirmacion"); //como este controlador matrimonio ya tiene un modelo matrimonio
        //se le carga el modelo a la variable o atributo modelo, para poder realizar la logica del sistema, registrar, actualizar, etc
    }
    public function registrar(){

           
        if($_SERVER['REQUEST_METHOD']=="GET"){
            verificarSesion("Usuario"); //se verifica la sesion
            
            $parametros=[
                "niveles"=>$this->modelo->consultar_niveles()
            ];
            $this->cargarVista("Registrar_confirmacion",$parametros);
            //acciones a ejecutar sobre el método get
        }
        else{
            if($_SERVER['REQUEST_METHOD']=="POST"){
                //instrucciones a ejecutar en el metodo post
                $parametros=[
                    "nombre"=>trim($_POST['txtNombre']),
                    "apellidos"=>trim($_POST['txtApellidos']),
                    "fecha_nacimiento"=>trim($_POST['txtecha']),
                    "edad"=>trim($_POST['txtEdad']),
                    "idnivel"=>trim($_POST['txtNivel']),
                    "actanacimiento"=>$_FILES['actadenacimiento'],
                    "febautizo"=>$_FILES['febautizo'],
                    "certificadocomunion"=>$_FILES['CertificadoComunion'],
                    "direccion"=>trim($_POST['txtdireccion']),
                    "comprobantedomicilio"=>$_FILES['txtComprobante'],
                    "nombmadre"=>trim($_POST['nomad']),
                    "apellidosmadre"=>trim($_POST['apemad']),
                    "nombpadre"=>trim($_POST['nompad']),
                    "apellidospadre"=>trim($_POST['apepad']),
                    "telefono"=>trim($_POST['telefono'])  ,
                ];
                echo $this->modelo->registrar($parametros);   
            }
        }
        

    }
}
    
?>