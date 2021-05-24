<?php
class Matrimonios extends Controlador
{
    public function __construct()
    {
        $this->modelo = $this->cargarModelo("Matrimonio"); //como este controlador matrimonio ya tiene un modelo matrimonio
        //se le carga el modelo a la variable o atributo modelo, para poder realizar la logica del sistema, registrar, actualizar, etc
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Administrador");
            $parametros = [
                "matrimonios" => $this->modelo->consultar_matrimonios()
            ];
            $this->cargarVista("admin/index_matrimonios", $parametros);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
            }
        }
    }
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Usuario"); //se verifica la sesion
            $this->cargarVista("Registrar_matrimonios"); // se carga una vista, la primer letra tiene que se mayuscula, y no debe tener la extencion .php
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $nombreNovia = trim($_POST['txtnombre']);
                $apellidosNovia = trim($_POST['txtapellido']);

                $nombreNovio = trim($_POST["txtnom"]);
                $apellidosNovio = trim($_POST["txtape"]);
                $fecha = trim($_POST['txtfecha']);

                $nombreMadrina = trim($_POST['txtnmad']);
                $apellidosMadrina = trim($_POST['txtamad']);

                $nombrePadrino = trim($_POST['txtapad']);
                $apellidosPadrino = trim($_POST['txtnpad']);
                $hora_boda = trim($_POST['hora']);

                //                datos para registrar la cita
                $fecha_cita = trim($_POST['txtfecha_cita']); //captura de datos 
                $hora_cita = trim($_POST['txthora']);
                $motivo_cita = trim($_POST['txtmotivo']);

                $ann = $_FILES['actanacimientonovia'];
                $comnovia = $_FILES['comprobantedomicilionovia'];
                $cbanovia = $_FILES['comprobantebautizonovia'];
                $ctdna = $_FILES['certificadoconfirmacionnovia'];
                $actno = $_FILES['actanacimientonovio'];
                $cdno = $_FILES['comprobantedomicilionovio'];
                $cbno = $_FILES['comprobantebautizonovio'];
                $ccno = $_FILES['certificadoconfirmacionnovio'];
                $amp = $_FILES['actamatrimoniopadrinos'];

                echo $this->modelo->registrar( //se le dice al modelo que ejecute su metodo registrar para que registre el matrimonio
                    $nombreNovia,
                    $apellidosNovia,
                    $nombreNovio,
                    $apellidosNovio,
                    $fecha,
                    $nombreMadrina,
                    $apellidosMadrina,
                    $nombrePadrino,
                    $apellidosPadrino,
                    $ann,
                    $comnovia,
                    $cbanovia,
                    $ctdna,
                    $actno,
                    $cdno,
                    $cbno,
                    $ccno,
                    $amp,
                    $hora_boda,
                    $fecha_cita,
                    $hora_cita,
                    $motivo_cita
                );
            }
        }
    }
    public function boton_cita()
    {
        echo $this->modelo->boton_citas(trim($_POST['fecha']));
        //ejecutar metodo
    }
    public function boton_cita_matrimonios()
    {
        echo $this->modelo->boton_citas_matrimonios(trim($_POST['fecha']));
    }
    public function registrar_cita()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Usuario"); //se verifica la sesion
            $this->cargarVista("Registrar_citas"); // se carga una vista, la primer letra tiene que se mayuscula, y no debe tener la extencion .php
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $fecha = trim($_POST['txtfecha']); //captura de datos 
                $hora = trim($_POST['txthora']);
                $motivo = trim($_POST['txtmotivo']);
                echo $this->modelo->registrar_citas($fecha, $hora, $motivo); //objeto 
            }
        }
    }
    public function modificar($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            verificarSesion("Administrador"); //se verifica la sesion
            $parametros = [
                "matrimonio" => $this->modelo->consultar_matrimonio($id)
            ];
            $this->cargarVista("admin/Modificar_matrimonios", $parametros); // se carga una vista, la primer letra tiene que se mayuscula, y no debe tener la extencion .php
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $nombreNovia = trim($_POST['txtnombre']);
                $apellidosNovia = trim($_POST['txtapellido']);

                $nombreNovio = trim($_POST["txtnom"]);
                $apellidosNovio = trim($_POST["txtape"]);
                $fecha = trim($_POST['txtfecha']);

                $nombreMadrina = trim($_POST['txtnmad']);
                $apellidosMadrina = trim($_POST['txtamad']);

                $nombrePadrino = trim($_POST['txtapad']);
                $apellidosPadrino = trim($_POST['txtnpad']);
                $hora_boda = trim($_POST['hora']);

                //                datos para registrar la cita
                $fecha_cita = trim($_POST['txtfecha_cita']); //captura de datos 
                $hora_cita = trim($_POST['txthora']);
                $motivo_cita = trim($_POST['txtmotivo']);

                $ann = $_FILES['actanacimientonovia'];
                $comnovia = $_FILES['comprobantedomicilionovia'];
                $cbanovia = $_FILES['comprobantebautizonovia'];
                $ctdna = $_FILES['certificadoconfirmacionnovia'];
                $actno = $_FILES['actanacimientonovio'];
                $cdno = $_FILES['comprobantedomicilionovio'];
                $cbno = $_FILES['comprobantebautizonovio'];
                $ccno = $_FILES['certificadoconfirmacionnovio'];
                $amp = $_FILES['actamatrimoniopadrinos'];
                $idcita=$_POST['idcita'];
                $idmatrimonio=$_POST['idmatrimonio'];

                echo $this->modelo->modificar( //se le dice al modelo que ejecute su metodo registrar para que registre el matrimonio
                    $nombreNovia,
                    $apellidosNovia,
                    $nombreNovio,
                    $apellidosNovio,
                    $fecha,
                    $nombreMadrina,
                    $apellidosMadrina,
                    $nombrePadrino,
                    $apellidosPadrino,
                    $ann,
                    $comnovia,
                    $cbanovia,
                    $ctdna,
                    $actno,
                    $cdno,
                    $cbno,
                    $ccno,
                    $amp,
                    $hora_boda,
                    $fecha_cita,
                    $hora_cita,
                    $motivo_cita,
                    $idcita,
                    $idmatrimonio
                );
            }
        }
    }
    public function eliminar($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            echo $this->modelo->eliminar($id);
        }
    }
    public function boton_citas_administrador()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $fecha = $_POST['fecha'];
            $idusuario = $_POST['idusuario'];
            $this->modelo = $this->cargarModelo("Administradores");
            echo $this->modelo->boton_citas_matrimonios($idusuario, $fecha);
        }
    }
}
