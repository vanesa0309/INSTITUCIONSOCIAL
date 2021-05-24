<?php
class Bautizo
{

    public function registrar($datos = [])
    {
        $base = new Base();
        $sql = "SELECT count(*) as existe from bautizos where fecha=:fecha and horabautizo=:horabautizo";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "horabautizo", "valor" => $datos['horabautizo'], "parametro" => PDO::PARAM_STR],
        ];
        $resp = $base->consultarRegistro($sql, $parametros);

        if ($resp->existe > 0) {
            return "La hora del bautizo ya está ocupada, selecciona otra";
        } else {
            session_start();
            $idusuario = $_SESSION['id'];

            $actadenacimiento = $this->subir_archivo($datos['actadenacimiento']["tmp_name"], $datos['actadenacimiento']["name"]);
            $comprobante = $this->subir_archivo($datos['comprobate']["tmp_name"], $datos['comprobate']["name"]);

            $sql = "INSERT INTO bautizos(
                nombre,apellido,
                nombmadre,apellidosmadre,
                nombpadre,apellidospadre,
                telefono,fecha,
                horabautizo, nombrepad,
                apepad, actadenacimiento,comprobate,idusuario
            ) values(
                :nombre,:apellido,
                :nombmadre,:apellidosmadre,
                :nombpadre,:apellidospadre,
                :telefono,:fecha,
                :horabautizo, :nombrepad,
                :apepad, :actadenacimiento,:comprobate,:idusuario
            )";
            $parametros = [
                ["etiqueta" => "nombre", "valor" => $datos['nombre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellido", "valor" => $datos['apellido'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombmadre", "valor" => $datos['nombmadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosmadre", "valor" => $datos['apellidosmadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombpadre", "valor" => $datos['nombpadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidospadre", "valor" => $datos['apellidospadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "telefono", "valor" => $datos['telefono'], "parametro" => PDO::PARAM_INT],
                ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "horabautizo", "valor" => $datos['horabautizo'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombrepad", "valor" => $datos['nombrepad'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apepad", "valor" => $datos['apepad'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "actadenacimiento", "valor" => $actadenacimiento, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobate", "valor" => $comprobante, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idusuario", "valor" => $idusuario, "parametro" => PDO::PARAM_INT],
            ];
            if ($base->insertar($sql, $parametros) == 1) {
                return "Se realizó el registro correctamente";
            } else {
                return "Error";
            }
        }
    }
    public function cambiar_hora($fecha)
    {
        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from bautizos where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {
            $sql = "SELECT count(*) as existe from bautizos where idusuario=:idusuario and fecha=:fecha";
            session_start();
            $id_usuario = $_SESSION['id'];
            $parametros = [
                ["etiqueta" => "idusuario", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT],
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
            ];
            $respuesta = $base->consultarRegistro($sql, $parametros);
            if ($respuesta->existe > 0) {
                return '
                <ul>
                    <li><button style="background-color:red;" type="button">12:00am - 13:00pm</button></li>
                    <li><button style="background-color:red;" type="button">13:00pm - 14:00pm</button></li>
                    <li><button style="background-color:red;" type="button">14:00pm - 15:00pm</button></li>
                    <li><button style="background-color:red;" type="button">17:00pm - 18:00pm</button></li>
                    <li><button style="background-color:red;" type="button">18:00pm - 19:00pm</button></li>
                </ul>
            ';
            } else {
                $sql = "SELECT horabautizo from bautizos where fecha=:fecha";
                $parametros = [
                    ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
                ];
                $citas = $base->consultar($sql, $parametros);
                $citas_horas = [];
                foreach ($citas as $cita) {
                    $citas_horas[$cita->horabautizo] = $cita->horabautizo;
                }
                $horas = [
                    "12:00", "13:00", "14:00", "17:00", "18:00",
                ];
                $retorno = "<ul>";
                for ($i = 0; $i < count($horas); $i++) {
                    $ii = $i + 1;
                    $fin = Date($horas[$i]);

                    $temp = strtotime($fin);
                    $fecha_temporal = date("d-m-Y H:i:s", strtotime("+1 hour", $temp));

                    $fecha_completa = strtotime($fecha_temporal);
                    $hora_final = date("H:i", $fecha_completa);
                    if (array_search($horas[$i], $citas_horas)) {
                        $retorno .= '<li><button style="background-color:red;" type="button">' . $horas[$i] . ' - ' . $hora_final . '</button></li>';
                    } else {
                        $retorno .= '<li><button id="btn' . $ii . '" onclick="cambiar_hora(' . "'" . $horas[$i] . "'" . ',' . "'btn" . $ii . "'" . ')" type="button">' . $horas[$i] . ' - ' . $hora_final . '</button></li>';
                    }
                }
                $retorno .= "</ul>";
                return $retorno;
            }
        } else {
            return '
        <ul>
            <li><button id="btn1" onclick="cambiar_hora(' . "'12:00'" . ',' . "'btn1'" . ')" type="button">12:00am - 13:00pm</button></li>
            <li><button id="btn2" onclick="cambiar_hora(' . "'13:00'" . ',' . "'btn2'" . ')" type="button">13:00pm - 14:00pm</button></li>
            <li><button id="btn3" onclick="cambiar_hora(' . "'14:00'" . ',' . "'btn3'" . ')" type="button">14:00pm - 15:00pm</button></li>
            <li><button id="btn4" onclick="cambiar_hora(' . "'17:00'" . ',' . "'btn4'" . ')" type="button">17:00pm - 18:00pm</button></li>
            <li><button id="btn5" onclick="cambiar_hora(' . "'18:00'" . ',' . "'btn5'" . ')" type="button">18:00pm - 19:00pm</button></li>
        </ul>
        ';
        }
    }
    public function consultar_bautizos()
    {
        $base = new Base();
        $sql = "SELECT * from bautizos";

        $bautizos = $base->consultar($sql);

        $retorno = "";

        if ($bautizos) {
            foreach ($bautizos as $bautizo) {
                $retorno .= "
                    <tr>
                        <td>{$bautizo->nombre} {$bautizo->apellido}</td>
                        <td>{$bautizo->nombmadre} {$bautizo->apellidosmadre}</td>
                        <td>{$bautizo->nombpadre} {$bautizo->apellidospadre}</td>
                        <td>{$bautizo->telefono}</td>
                        <td>{$bautizo->fecha}</td>
                        <td>{$bautizo->horabautizo}</td>
                        <td>{$bautizo->nombrepad}</td>
                        <td>
                            <div style='display:inline-block'>
                                <a target='_blank' href='" . DOMINIO . "/public/assets/archivospdf/{$bautizo->actadenacimiento}' class='badge badge-info mr-2'>Acta de Nacimiento</a> <br>
                                <a target='_blank' href='" . DOMINIO . "/public/assets/archivospdf/{$bautizo->comprobate}' class='badge badge-info mr-2'>Comprobante</a>
                            </div>
                        </td>
                        <td>
                            <div class='d-flex'>
                                <a href='" . DOMINIO . "/bautizos/modificar/{$bautizo->idbautizo}' class='btn btn-primary btn-sm mr-2'>Modificar</a>
                                <a href='" . DOMINIO . "/bautizos/eliminar/{$bautizo->idbautizo}' class='btn btn-danger btn-sm eliminar'>Eliminar</a>

                            </div>
                        </td>

                    </tr>
                ";
            }
        } else {
            $retorno = "<h3 class='text-center text-danger'> No hay Registros de Bautizos </h3>";
        }
        return $retorno;
    }
    public function consultar_bautizo($idbautizo)
    {
        $base = new Base();

        $sql = "SELECT *from bautizos where idbautizo=:idbautizo";
        $parametros = [
            ["etiqueta" => "idbautizo", "valor" => $idbautizo, "parametro" => PDO::PARAM_INT]
        ];
        $bautizo = $base->consultarRegistro($sql, $parametros);
        $retorno = "";
        if ($bautizo) {
            $retorno = '
            <h3 class="text-center" style="font-family:Exo;">MODIFICAR BAUTIZO</h3>
            <form action="#" method="post" id="formulario" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="hidden" value="' . $bautizo->idusuario . '" id="idusuario" name="idusuario">
                <input type="hidden" value="'.$bautizo->idbautizo.'" id="idbautizo" name="idbautizo">
                <div class="tab shadow">
                    <div class="tab-header p-3">
                        <div class="row justify-content-center">
                            <button type="button" id="uno" class="btn btn-sm mr-1">1</button>
                            <button type="button" id="dos" class="btn btn-sm mr-1">2</button>
                            <button type="button" id="tres" class="btn btn-sm mr-1">3</button>
                            <button type="button" id="cuatro" class="btn btn-sm">4</button>
                        </div>
                    </div>
                    <div class="tab-container p-4" id="tab_container">
                        <div class="tab-container-item" id="contenido_uno">
                            <div class="form-group">
                                <label for="txtnombre">Nombre Niño</label>
                                <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="' . $bautizo->nombre . '">
                            </div>
                            <div class="form-group ">
                                <label for="txtapellido">Apellidos Niño</label><br>
                                <input type="text" name="apellido" placeholder="Apellidos" id="apellidos" class="form-control" value="' . $bautizo->apellido . '">
                            </div>
                            <div class="input-file">
                                <label for="actadenacimiento">Acta de Nacimiento</label>
                                <input type="file" name="actadenacimiento" id="actadenacimiento" accept="application/pdf">
                                <label for="actadenacimiento" id="labelactadenacimiento" class="nombre-archivo">Selecciona un archivo PDF</label>
                                <a href="'.DOMINIO.'/public/assets/archivospdf/'.$bautizo->actadenacimiento.'" target="_blank" class="badge badge-info"> ver documento precargado</a>
                            </div>
                        </div>
                        <div class="tab-container-item" id="contenido_dos">
                            <div class="form-group">
                                <label for="txtnom">Nombre Madre</label>
                                <input type="text" name="nomad" placeholder="Nombre de la Madre" id="nombre_madre" class="form-control" value="' . $bautizo->nombmadre . '">
                            </div>
                            <div class="form-group ">
                                <label for="txtape">Apellidos Madre</label>
                                <input type="text" name="apemad" placeholder="Apellidos de la Madre" id="apellidos_madre" class="form-control" value="' . $bautizo->apellidosmadre . '">
        
                            </div>
                            <div class="form-group ">
                                <label for="txtape">Nombre Padre</label>
                                <input type="text" name="nompad" placeholder="Nombre del Padre" id="nombre_padre" class="form-control" value="' . $bautizo->nombpadre . '">
        
                            </div>
                            <div class="form-group ">
                                <label for="txtape">Apellidos Padre</label>
                                <input type="text" name="apepad" placeholder="Apellidos del Padre" id="apellidos_padre" class="form-control" value="' . $bautizo->apellidospadre . '">
        
                            </div>
                            <div class="form-group ">
                                <label for="txtnumero"> Telefóno <small>(10 dígitos)</small>:</label>
                                <input type="number" name="telefono" pattern="[0-9]{10}" id="telefono" class="form-control" value="' . $bautizo->telefono . '">
                                
                            </div>
        
                        </div>
                        <div class="tab-container-item" id="contenido_tres">
                            <div class="form-group">
                                <label for="txtnom">Nombre Madrina o Padrino</label>
                                <input type="text" name="nompadrinos" placeholder="Nombre de la Madrina" id="nombre_madrina" class="form-control" value="' . $bautizo->nombrepad . '">
                            </div>
                            <div class="form-group">
                                <label for="txtape">Apellidos Madrina o Padrino</label><br>
                                <input type="text" name="apepadrinos" placeholder="Apellidos de la Madrina" id="apellidos_madrina" class="form-control" value="' . $bautizo->apepad . '">
                            </div>
        
                            <div class="input-file">
                                <label for="comprobante">Fe de Bautizo o Acta de Matrimonio</label>
                                <input type="file" name="comprobante" id="comprobante" accept="application/pdf">
                                <label for="comprobante" id="labelcomprobante" class="nombre-archivo">Selecciona un archivo PDF</label>
                                <a href="'.DOMINIO.'/public/assets/archivospdf/'.$bautizo->comprobate.'" target="_blank" class="badge badge-info"> ver documento precargado</a>
                            </div>
                        </div>
                        <div class="tab-container-item" id="contenido_cuatro">
                            <div class="from-group">
                                <label for="txtfecha">Fecha Bautizo:</label>
                                <input id="fecha_bautizo" type="date" name="txtfecha" placeholder="" class="form-control" value="' . $bautizo->fecha . '">
                            </div>
        
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="time" name="hora" class="form-control" style="display:none" id="hora" value="' . $bautizo->horabautizo . '">
                                <div class="contenedor-hora" id="contenedor-hora">
                                    <ul>
                                        <li><button id="btn1" onclick="cambiar_hora(' . "'" . '12:00' . "'," . "'" . 'btn1' . "'" . ')" type="button">12:00pm -13:00pm</button></li>
                                        <li><button id="btn2" onclick="cambiar_hora(' . "'" . '13:00' . "'," . "'" . 'btn2' . "'" . ')" type="button">13:00pm -14:00pm</button></li>
                                        <li><button id="btn3" onclick="cambiar_hora(' . "'" . '14:00' . "'," . "'" . 'btn3' . "'" . ')" type="button">14:00pm -15:00pm</button></li>
                                        <li><button id="btn4" onclick="cambiar_hora(' . "'" . '17:00' . "'," . "'" . 'btn4' . "'" . ')" type="button">17:00pm -18:00pm</button></li>
                                        <li><button id="btn5" onclick="cambiar_hora(' . "'" . '18:00' . "'," . "'" . 'btn5' . "'" . ')" type="button">18:00pm -19:00pm</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="progress my-2" id="progress_bar" style="display:none">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"
                                    id="progress_bar_content">
                                    cargando: 0%
                                </div>
                            </div>
                            <div class="row justify-content-end" >
                                <button type="submit" class="btn btn-primary" id="btn_register" style="position:relative; top:90px">Modificar</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-footer p-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary mr-1" id="button_back" onclick="tab_anterior()" style="display:none">Anterior</button>
                            <button type="button" class="btn btn-secondary" id="button_next" onclick="tab_siguiente()">Siguiente</button>
                        </div>
        
                    </div>
                </div>
            </form>
            ';
        } else {
            $retorno = "<h3>No se encontró el Bautizo</h3>";
        }
        return $retorno;
    }
    public function cambiar_hora_administrador($id_usuario, $fecha)
    {
        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from bautizos where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {


            $sql = "SELECT horabautizo from bautizos where fecha=:fecha and idusuario!=:idusuario";
            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idusuario", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT]
            ];
            $citas = $base->consultar($sql, $parametros);
            $citas_horas = [];
            foreach ($citas as $cita) {
                $citas_horas[$cita->horabautizo] = $cita->horabautizo;
            }
            $horas = [
                "12:00", "13:00", "14:00", "17:00", "18:00"
            ];
            $retorno = "<ul>";
            for ($i = 0; $i < count($horas); $i++) {
                $ii = $i + 1;
                $fin = Date($horas[$i]);

                $temp = strtotime($fin);
                $fecha_temporal = date("d-m-Y H:i:s", strtotime("+1 hour", $temp));

                $fecha_completa = strtotime($fecha_temporal);
                $hora_final = date("H:i", $fecha_completa);
                if (array_search($horas[$i], $citas_horas)) {
                    $retorno .= '<li><button style="background-color:red;" type="button">' . $horas[$i] . ' - ' . $hora_final . '</button></li>';
                } else {
                    $retorno .= '<li><button id="btn' . $ii . '" onclick="cambiar_hora(' . "'" . $horas[$i] . "'" . ',' . "'btn" . $ii . "'" . ')" type="button">' . $horas[$i] . ' - ' . $hora_final . '</button></li>';
                }
            }
            $retorno .= "</ul>";
            return $retorno;
        } else {
            return '
        <ul>
            <li><button id="btn1" onclick="cambiar_hora(' . "'12:00'" . ',' . "'btn1'" . ')" type="button">12:00am - 13:00am</button></li>
            <li><button id="btn2" onclick="cambiar_hora(' . "'13:00'" . ',' . "'btn2'" . ')" type="button">13:00pm - 14:00pm</button></li>
            <li><button id="btn3" onclick="cambiar_hora(' . "'14:00'" . ',' . "'btn3'" . ')" type="button">14:00pm - 15:00pm</button></li>
            <li><button id="btn4" onclick="cambiar_hora(' . "'17:00'" . ',' . "'btn4'" . ')" type="button">17:00pm - 18:00pm</button></li>
            <li><button id="btn5" onclick="cambiar_hora(' . "'18:00'" . ',' . "'btn5'" . ')" type="button">18:00pm - 19:00pm</button></li>
        </ul>
        ';
        }
    }
    public function modificar($datos = [])
    {
        $base = new Base();
        $sql = "SELECT count(*) as existe from bautizos where fecha=:fecha and horabautizo=:horabautizo and idbautizo!=:idbautizo";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "horabautizo", "valor" => $datos['horabautizo'], "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "idbautizo", "valor" => $datos['idbautizo'], "parametro" => PDO::PARAM_INT],
            
        ];
        $resp = $base->consultarRegistro($sql, $parametros);

        if ($resp->existe > 0) {
            return "La hora del bautizo ya está ocupada, selecciona otra";
        } else {
            session_start();
            $idusuario = $_SESSION['id'];
            
            $sql="SELECT actadenacimiento, comprobate from bautizos where idbautizo=:idbautizo";
            $parametros = [
                ["etiqueta" => "idbautizo", "valor" => $datos['idbautizo'], "parametro" => PDO::PARAM_INT],                
            ];
            $bau=$base->consultarRegistro($sql,$parametros);

            
            $actadenacimiento=$bau->actadenacimiento;
            $comprobante=$bau->comprobate;
            

            if($datos['actadenacimiento']['name']!=""){
                unlink("assets/archivospdf/".$actadenacimiento);
                $actadenacimiento = $this->subir_archivo($datos['actadenacimiento']["tmp_name"], $datos['actadenacimiento']["name"]);
            }
            
            if($datos['comprobate']['name']!=""){
                unlink("assets/archivospdf/".$comprobante);
                $comprobante = $this->subir_archivo($datos['comprobate']["tmp_name"], $datos['comprobate']["name"]);
            }
            

            $sql = "UPDATE bautizos set
                nombre=:nombre,apellido=:apellido,
                nombmadre=:nombmadre,apellidosmadre=:apellidosmadre,
                nombpadre=:nombpadre,apellidospadre=:apellidospadre,
                telefono=:telefono,fecha=:fecha,
                horabautizo=:horabautizo, nombrepad=:nombrepad,
                apepad=:apepad, actadenacimiento=:actadenacimiento,comprobate=:comprobate
                where idbautizo=:idbautizo
            ";
            $parametros = [
                ["etiqueta" => "nombre", "valor" => $datos['nombre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellido", "valor" => $datos['apellido'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombmadre", "valor" => $datos['nombmadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosmadre", "valor" => $datos['apellidosmadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombpadre", "valor" => $datos['nombpadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidospadre", "valor" => $datos['apellidospadre'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "telefono", "valor" => $datos['telefono'], "parametro" => PDO::PARAM_INT],
                ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "horabautizo", "valor" => $datos['horabautizo'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombrepad", "valor" => $datos['nombrepad'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apepad", "valor" => $datos['apepad'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "actadenacimiento", "valor" => $actadenacimiento, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobate", "valor" => $comprobante, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idbautizo", "valor" => $datos['idbautizo'], "parametro" => PDO::PARAM_INT],
            ];
            if ($base->modificar($sql, $parametros)) {
                return "Se Modificó el registro correctamente";
            } else {
                return "Error";
            }
        }
    }
    public function eliminar($id){
        $base = new Base();
        $sql ="SELECT actadenacimiento,comprobate from bautizos where idbautizo=:idbautizo";
        $parametros=[
            ["etiqueta"=>"idbautizo","valor"=>$id,"parametro"=>PDO::PARAM_INT]
        ];
        $bautizo=$base->consultarRegistro($sql,$parametros);
        
        unlink("assets/archivospdf/".$bautizo->actadenacimiento); //eliminar los archivos que se subieron S
        unlink("assets/archivospdf/".$bautizo->comprobate);

        $sql="DELETE from bautizos where idbautizo=:idbautizo";
        if($base->eliminarRegistro($sql,$parametros)>0){
            return "Registro Eliminado Correctamente";
        }
        else{
            return "Error";
        }
    }
    private function subir_archivo($tmp_name, $nombreArchivo)
    {
        $nombreTemporal = "";
        $ruta = "assets/archivospdf/";
        $destino = $ruta . $nombreArchivo;
        $archivo = $nombreArchivo;
        while (is_file($destino)) {
            $numeroAleatorio = rand(0, getrandmax());
            $nombreTemporal = $numeroAleatorio . $nombreArchivo;
            $archivo = $nombreTemporal;

            $destino = $ruta . $nombreTemporal;
            $nombreTemporal = $nombreArchivo;
        }
        if (move_uploaded_file($tmp_name, $destino)) {
            return $archivo;
        }
    }
}
