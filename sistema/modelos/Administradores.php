<?php
class Administradores
{
    public function consultar_citas()
    {
        $base = new Base();

        $sql = "SELECT 
                cita.idcita as id,
                usuario.nombre as usuario,
                cita.fecha as fecha,
                cita.hora as hora,
                cita.motivo as motivo
            from cita inner join usuario on cita.idusuario = usuario.idusuario";
        $citas = $base->consultar($sql);
        $retorno = "";
        if ($citas) {
            foreach ($citas as $cita) {
                $retorno .=
                    "<tr>
                    <td>{$cita->fecha}</td>
                    <td>{$cita->hora}</td>
                    <td>{$cita->usuario}</td>
                    <td>{$cita->motivo}</td>
                    <td>
                        <div class='d-flex'>
                            <a href='" . DOMINIO . "/administrador/modificar_cita/{$cita->id}' class='btn btn-sm btn-primary mr-2'>Modificar</a>
                            <a href='" . DOMINIO . "/administrador/eliminar_cita/{$cita->id}' class='btn btn-sm btn-danger eliminar' >Eliminar</a>
                        </div>
                    </td>

                </tr>";
            }
        } else {
            $retorno = "<h3 class='text-center text-danger'> No hay registros de citas </h3>";
        }
        return $retorno;
    }

    public function consultar_cita($id)
    {
        $base = new Base();
        $sql = "SELECT *from cita where idcita=:idcita";
        $parametros = [
            ["etiqueta" => "idcita", "valor" => $id, "parametro" => PDO::PARAM_INT]
        ];
        $cita = $base->consultarRegistro($sql, $parametros);
        $retorno = "";
        if ($cita) {
            $retorno = "
                <h3 class='text-center'>Modificar Cita</h3>
                <form action='#' method='post' id='formulario'>
                    <input type='hidden' name='idcita' value='{$cita->idcita}' >
                    <input type='hidden' name='idusuario' value='{$cita->idusuario}' id='idusuario' >
                    
                    <div class='form-group'>
                        <label for='fecha'>Fecha</label>
                        <input type='date' class='form-control' name='fecha' id='fecha' value='{$cita->fecha}'>
                    </div>
                    <div class='form-group'>
                        <label for='hora'>Hora</label>
                        <input type='time' class='form-control' name='hora' id='hora' value='{$cita->hora}'>
                        <div class='contenedor-hora' id='contenedor-hora'>
                            <ul>
                                <li><button id='btn1' onclick=" . '"' . "cambiar_hora(" . "'10:00'" . "," . "'btn1'" . ")" . '"' . " type='button'>10:00am - 11:00am</button></li>
                                <li><button id='btn2' onclick=" . '"' . "cambiar_hora(" . "'11:00'" . "," . "'btn2'" . ")" . '"' . " type='button'>11:00pm - 12:00pm</button></li>
                                <li><button id='btn3' onclick=" . '"' . "cambiar_hora(" . "'12:00'" . "," . "'btn3'" . ")" . '"' . " type='button'>12:00pm - 13:00pm</button></li>
                                <li><button id='btn4' onclick=" . '"' . "cambiar_hora(" . "'13:00'" . "," . "'btn4'" . ")" . '"' . " type='button'>13:00pm - 14:00pm</button></li>
                                <li><button id='btn5' onclick=" . '"' . "cambiar_hora(" . "'16:00'" . "," . "'btn5'" . ")" . '"' . " type='button'>16:00pm - 17:00pm</button></li>
                                <li><button id='btn6' onclick=" . '"' . "cambiar_hora(" . "'17:00'" . "," . "'btn6'" . ")" . '"' . " type='button'>17:00pm - 18:00pm</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='motivo'>Motivo</label>
                        <input type='text' class='form-control' name='motivo' id='motivo' value='{$cita->motivo}'>
                    </div>
                    
                    <input type='submit' class='btn btn-primary' value='Modificar'> 

                </form>

                ";
        } else {
            $retorno = "<h3 class='text-center text-danger'> No se encontró la cita </h3>";
        }
        return $retorno;
    }
    function boton_citas($id_usuario, $fecha)
    {
        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from cita where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {


            $sql = "SELECT hora from cita where fecha=:fecha and idusuario!=:idusuario";
            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idusuario", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT]
            ];
            $citas = $base->consultar($sql, $parametros);
            $citas_horas = [];
            foreach ($citas as $cita) {
                $citas_horas[$cita->hora] = $cita->hora;
            }
            $horas = [
                "10:00", "11:00", "12:00", "13:00", "16:00", "17:00"
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
               <li><button id="btn1" onclick="cambiar_hora(' . "'10:00'" . ',' . "'btn1'" . ')" type="button">10:00am - 11:00am</button></li>
               <li><button id="btn2" onclick="cambiar_hora(' . "'11:00'" . ',' . "'btn2'" . ')" type="button">11:00pm - 12:00pm</button></li>
               <li><button id="btn3" onclick="cambiar_hora(' . "'12:00'" . ',' . "'btn3'" . ')" type="button">12:00pm - 13:00pm</button></li>
               <li><button id="btn4" onclick="cambiar_hora(' . "'13:00'" . ',' . "'btn4'" . ')" type="button">13:00pm - 14:00pm</button></li>
               <li><button id="btn5" onclick="cambiar_hora(' . "'16:00'" . ',' . "'btn5'" . ')" type="button">16:00pm - 17:00pm</button></li>
               <li><button id="btn6" onclick="cambiar_hora(' . "'17:00'" . ',' . "'btn6'" . ')" type="button">17:00pm - 18:00pm</button></li>
           </ul>
           ';
        }
    }
    function boton_citas_matrimonios($id_usuario, $fecha)
    {
        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from matrimonios where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {


            $sql = "SELECT hora from matrimonios where fecha=:fecha and idusuario!=:idusuario";
            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idusuario", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT]
            ];
            $citas = $base->consultar($sql, $parametros);
            $citas_horas = [];
            foreach ($citas as $cita) {
                $citas_horas[$cita->hora] = $cita->hora;
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
               <li><button id="btnb1" onclick="cambiar_hora_boda(' . "'12:00'" . ',' . "'btnb1'" . ')" type="button">12:00pm - 13:00pm</button></li>
               <li><button id="btnb2" onclick="cambiar_hora_boda(' . "'13:00'" . ',' . "'btnb2'" . ')" type="button">13:00pm - 14:00pm</button></li>
               <li><button id="btnb3" onclick="cambiar_hora_boda(' . "'14:00'" . ',' . "'btnb3'" . ')" type="button">14:00pm - 15:00pm</button></li>
               <li><button id="btnb4" onclick="cambiar_hora_boda(' . "'17:00'" . ',' . "'btnb4'" . ')" type="button">17:00pm - 18:00pm</button></li>
               <li><button id="btnb5" onclick="cambiar_hora_boda(' . "'18:00'" . ',' . "'btnb5'" . ')" type="button">18:00pm - 19:00pm</button></li>
           </ul>
           ';
        }
    }

    public function modificar_cita($datos)
    {
        $base = new Base();
        $sql = "SELECT count(*) as existe from cita where fecha=:fecha and hora=:hora and idcita!=:idcita";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "hora", "valor" => $datos['hora'], "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "idcita", "valor" => $datos['idcita'], "parametro" => PDO::PARAM_STR],
        ];
        $resp = $base->consultarRegistro($sql, $parametros);
        if ($resp->existe > 0) {
            return "La hora de la cita ya está ocupada selecciona otra";
        } else {
            $sql = "UPDATE cita set fecha=:fecha, hora=:hora, motivo=:motivo where idcita=:idcita";
            $parametros = [
                ["etiqueta" => "fecha", "valor" => $datos['fecha'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "hora", "valor" => $datos['hora'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "motivo", "valor" => $datos['motivo'], "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idcita", "valor" => $datos['idcita'], "parametro" => PDO::PARAM_INT],
            ];
            if ($base->modificar($sql, $parametros)) {
                return  "Se actualizó el registro correctamente";
            } else {
                return "Ocurrió un error al Modificar el Registro";
            }
        }
    }
    public function eliminar_cita($id)
    {
        $base = new Base();
        $sql = "SELECT idcita,actanacimientonovia, 
            comprobantedomicilionovia,
            comprobantebautizonovia,
            certificadoconfirmacionnovia, 
            actanacimientonovio,
            comprobantedomicilionovio,
            comprobantebautizonovio,
            certificadoconfirmacionnovio, 
            actamatrimoniopadrinos from matrimonios where idcita =:id";

        $parametros = [
            ["etiqueta" => "id", "valor" => $id, "parametro" => PDO::PARAM_INT]
        ];
        $matrimonio = $base->consultarRegistro($sql, $parametros);

        unlink("assets/archivospdf/{$matrimonio->actanacimientonovia}");
        unlink("assets/archivospdf/{$matrimonio->comprobantedomicilionovia}");
        unlink("assets/archivospdf/{$matrimonio->comprobantebautizonovia}");
        unlink("assets/archivospdf/{$matrimonio->certificadoconfirmacionnovia}");
        unlink("assets/archivospdf/{$matrimonio->actanacimientonovio}");
        unlink("assets/archivospdf/{$matrimonio->comprobantedomicilionovio}");
        unlink("assets/archivospdf/{$matrimonio->comprobantebautizonovio}");
        unlink("assets/archivospdf/{$matrimonio->certificadoconfirmacionnovio}");
        unlink("assets/archivospdf/{$matrimonio->actamatrimoniopadrinos}");
        
        $sql = "DELETE from cita where idcita=:idcita";
        $parametros = [
            ["etiqueta" => "idcita", "valor" => $id, "parametro" => PDO::PARAM_INT]
        ];
        if ($base->eliminarRegistro($sql, $parametros) > 0) {
            return "Se eliminó el registro correctamente";
            
        } else {
            return "Error";
        }
    }
}
