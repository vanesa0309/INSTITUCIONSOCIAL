<?php
class Bautizos extends Controlador
{
    //ruta: DOMINIO/bautizos/registrar

    public function __construct()
    {
        $this->modelo = $this->cargarModelo("Bautizo"); //como este controlador matrimonio ya tiene un modelo matrimonio
        //se le carga el modelo a la variable o atributo modelo, para poder realizar la logica del sistema, registrar, actualizar, etc
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Usuario"); //se verifica la sesion
            $this->cargarVista("Registrar_bautizos");
            //acciones a ejecutar sobre el método get
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $parametros = [
                    "nombre" => trim($_POST['nombre']),
                    "apellido" => trim($_POST['apellido']),
                    "nombmadre" => trim($_POST['nomad']),
                    "apellidosmadre" => trim($_POST['apemad']),
                    "nombpadre" => trim($_POST['nompad']),
                    "apellidospadre" => trim($_POST['apepad']),
                    "telefono" => trim($_POST['telefono']),
                    "fecha" => trim($_POST['txtfecha']),
                    "horabautizo" => trim($_POST['hora']),
                    "nombrepad" => trim($_POST['nompadrinos']),
                    "apepad" => trim($_POST['apepadrinos']),
                    "actadenacimiento" => $_FILES['actadenacimiento'],
                    "comprobate" => $_FILES['comprobante'],
                ];
                echo $this->modelo->registrar($parametros);
            }
        }
    }
    public function cambiar_hora()
    {
        $fecha = $_POST['fecha'];
        echo $this->modelo->cambiar_hora($fecha);
    }
    public function cambiar_hora_administrador()
    {
        $fecha = $_POST['fecha'];
        $idusuario = $_POST["idusuario"];
        echo $this->modelo->cambiar_hora_administrador($idusuario, $fecha);
    }
    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Administrador"); //se verifica la sesion

            $parametros = [
                "bautizos" => $this->modelo->consultar_bautizos()
            ];

            $this->cargarVista("admin/index_bautizos", $parametros);
            //acciones a ejecutar sobre el método get
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
            }
        }
    }
    public function modificar($id=0)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Administrador"); //se verifica la sesion

            $parametros = [
                "bautizo" => $this->modelo->consultar_bautizo($id)
            ];

            $this->cargarVista("admin/Modificar_bautizo", $parametros);
            //acciones a ejecutar sobre el método get
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $parametros = [
                    "idbautizo"=>trim($_POST['idbautizo']),
                    "nombre" => trim($_POST['nombre']),
                    "apellido" => trim($_POST['apellido']),
                    "nombmadre" => trim($_POST['nomad']),
                    "apellidosmadre" => trim($_POST['apemad']),
                    "nombpadre" => trim($_POST['nompad']),
                    "apellidospadre" => trim($_POST['apepad']),
                    "telefono" => trim($_POST['telefono']),
                    "fecha" => trim($_POST['txtfecha']),
                    "horabautizo" => trim($_POST['hora']),
                    "nombrepad" => trim($_POST['nompadrinos']),
                    "apepad" => trim($_POST['apepadrinos']),
                    "actadenacimiento" => $_FILES['actadenacimiento'],
                    "comprobate" => $_FILES['comprobante'],
                ];
                echo $this->modelo->modificar($parametros);
            }
        }
    }
    public function eliminar($id=0){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            echo $this->modelo->eliminar($id);
        }
    }
}
