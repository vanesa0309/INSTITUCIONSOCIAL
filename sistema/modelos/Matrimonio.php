<?php
class Matrimonio
{
    public function registrar(
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
    ) {
        $base = new Base();
        $sql = "SELECT count(*) as existe from matrimonios  where fecha=:fecha and horaboda=:horaboda";

        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "horaboda", "valor" => $hora_boda, "parametro" => PDO::PARAM_STR]
        ];
        $resp = $base->consultarRegistro($sql, $parametros);
        if ($resp->existe > 0) {
            return "La hora de la boda ya está ocupada selecciona otra";
        } else {
            $sql = "SELECT count(*) as existe from cita  where fecha=:fecha and hora=:hora";

            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha_cita, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "hora", "valor" => $hora_cita, "parametro" => PDO::PARAM_STR]
            ];
            $resp = $base->consultarRegistro($sql, $parametros);
            if ($resp->existe > 0) {
                return "La hora de la cita ya está ocupada selecciona otra";
            }
        }

        $annName = $this->subir_archivo($ann['tmp_name'], $ann['name']);
        $comNovia = $this->subir_archivo($comnovia['tmp_name'], $comnovia['name']);
        $cbNovia = $this->subir_archivo($cbanovia['tmp_name'], $cbanovia['name']);
        $ctdNA = $this->subir_archivo($ctdna['tmp_name'], $ctdna['name']);
        $acTAno = $this->subir_archivo($actno['tmp_name'], $actno['name']);
        $cdnoo = $this->subir_archivo($cdno['tmp_name'], $cdno['name']);
        $cbNoo = $this->subir_archivo($cbno['tmp_name'], $cbno['name']);
        $ccNoo = $this->subir_archivo($ccno['tmp_name'], $ccno['name']);
        $amps = $this->subir_archivo($amp['tmp_name'], $amp['name']);
        // $annName = "un registro";
        // $comNovia = "un registro";
        // $cbNovia = "un registro";
        // $ctdNA = "un registro";
        // $acTAno = "un registro";
        // $cdnoo = "un registro";
        // $cbNoo = "un registro";
        // $ccNoo = "un registro";
        // $amps = "un registro";
        session_start();
        $id_usuario = $_SESSION['id'];
        $sql = "INSERT INTO cita (idusuario,fecha,hora,motivo)
        values(:id_usuario_etiqueta,:fecha_etiqueta,:hora_etiqueta,:motivo_etiqueta)";

        $parametros = [
            ["etiqueta" => "id_usuario_etiqueta", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT],
            ["etiqueta" => "fecha_etiqueta", "valor" => $fecha_cita, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "hora_etiqueta", "valor" => $hora_cita, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "motivo_etiqueta", "valor" => $motivo_cita, "parametro" => PDO::PARAM_STR],
        ];

        if ($base->insertar($sql, $parametros)) {
            $sql = "SELECT idcita from cita where fecha=:fecha and hora=:hora ";
            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha_cita, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "hora", "valor" => $hora_cita, "parametro" => PDO::PARAM_STR],
            ];
            $cita = $base->consultarRegistro($sql, $parametros);

            $sql = "insert into matrimonios 
            (nomnovia,apellidonovia,nomnovio,
            apellidonovio,fecha,nommadrina,apemadrina,
            nompadrino,apepadrino,actanacimientonovia,comprobantedomicilionovia,
            comprobantebautizonovia,certificadoconfirmacionnovia,actanacimientonovio,
            comprobantedomicilionovio,	comprobantebautizonovio,
            certificadoconfirmacionnovio,actamatrimoniopadrinos,horaboda,idusuario,idcita)
            values
            (:nombreNovia,:apellidosNovia,:nombreNovio,
            :apellidosNovio,:fecha,:nombreMadrina,:apellidosMadrina,
            :nombrePadrino,:apellidosPadrino,:annName,:comNovia,:cbNovia,
            :ctdNA,:acTAno,:cdnoo,:cbNoo,:ccNoo,:amps,:horaboda,:idusuario,:idcita)";
            $parametros = [

                ["etiqueta" => "nombreNovia", "valor" => $nombreNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosNovia", "valor" => $apellidosNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombreNovio", "valor" => $nombreNovio, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosNovio", "valor" => $apellidosNovio, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombreMadrina", "valor" => $nombreMadrina, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosMadrina", "valor" => $apellidosMadrina, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nombrePadrino", "valor" => $nombrePadrino, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidosPadrino", "valor" => $apellidosPadrino, "parametro" => PDO::PARAM_STR],

                ["etiqueta" => "annName", "valor" => $annName, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comNovia", "valor" => $comNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "cbNovia", "valor" => $cbNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "ctdNA", "valor" => $ctdNA, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "acTAno", "valor" => $acTAno, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "cdnoo", "valor" => $cdnoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "cbNoo", "valor" => $cbNoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "ccNoo", "valor" => $ccNoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "amps", "valor" => $amps, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "horaboda", "valor" => $hora_boda, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idusuario", "valor" => $id_usuario, "parametro" => PDO::PARAM_INT],
                ["etiqueta" => "idcita", "valor" => $cita->idcita, "parametro" => PDO::PARAM_INT],

            ];

            if ($base->insertar($sql, $parametros)) {
                return "Se realizó el registro correctamente";
            }
        }
    }

    function subir_archivo($tmp_name, $nombreArchivo)
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

    function registrar_citas($fecha, $hora, $motivo)
    {

        if ($fecha == "") {
            echo "Error ingresa la fecha";
            exit();
        } else {
            if ($hora == "00:00") {
                echo "Error Ingresa la hora";
                exit();
            } else {
                $base = new Base(); //creo nuevo objeto de la clase base que me permite realizar conexión con la base de datos

                $q = "SELECT hora from cita where dia=:fecha";
                $parametros = [
                    ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR] //indico que mando una cadena si fuera entero seria INT
                ];
                $datos = $base->consultar($q, $parametros); //regresa registros 
                //visualizar los datos 
                if ($datos) {
                    //permite recorrer objetos  
                    foreach ($datos as $dato) { //es el arreglo 
                        if ($dato->hora == $hora) { //variable de la base de datos==al que llega
                            return "ya ingresaste la hora";
                        }
                    }
                }

                if ($motivo == "") {
                    echo "Error ingresa el motivo";
                    exit();
                } else {
                    session_start();
                    $idcita = rand(100, 200);
                    $sql = "insert into cita (idcita,idusuario,dia,hora,motivo)
            values(:idcita,:idusuario,:dia,:hora,:motivo)";
                    $parametros = [
                        ["etiqueta" => "idcita", "valor" => $idcita, "parametro" => PDO::PARAM_INT],
                        ["etiqueta" => "idusuario", "valor" => $_SESSION['id'], "parametro" => PDO::PARAM_INT], //indico que mando una cadena si fuera entero seria INT
                        ["etiqueta" => "dia", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                        ["etiqueta" => "hora", "valor" => $hora, "parametro" => PDO::PARAM_STR],
                        ["etiqueta" => "motivo", "valor" => $motivo, "parametro" => PDO::PARAM_STR]


                    ];
                    //ejecutar metodo insertar de la base de datos
                    $datos = $base->insertar($sql, $parametros);
                    if ($datos == 1) {
                        return "registro correcto";
                    }
                }
            }
        }
    }

    function boton_citas($fecha)
    {
        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from cita where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {
            $sql = "SELECT count(*) as existe from cita where idusuario=:idusuario and fecha=:fecha";
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
                    <li><button style="background-color:red;" type="button">10:00am - 11:00am</button></li>
                    <li><button style="background-color:red;" type="button">11:00pm - 12:00pm</button></li>
                    <li><button style="background-color:red;" type="button">12:00pm - 13:00pm</button></li>
                    <li><button style="background-color:red;" type="button">13:00pm - 14:00pm</button></li>
                    <li><button style="background-color:red;" type="button">16:00pm - 17:00pm</button></li>
                    <li><button style="background-color:red;" type="button">17:00pm - 18:00pm</button></li>
                </ul>
            ';
            } else {
                $sql = "SELECT hora from cita where fecha=:fecha";
                $parametros = [
                    ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
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
            }
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
    function boton_citas_matrimonios($fecha)
    {

        $base = new Base(); //CREA OBJETO 

        $q = "SELECT count(*) as existe from matrimonios where fecha =:fecha";
        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
        ];
        // OBJETO QUE PERMITE COMUNICACION CON LA BASE
        $datos = $base->consultarRegistro($q, $parametros);
        if ($datos->existe > 0) {
            $sql = "SELECT count(*) as existe from matrimonios where idusuario=:idusuario and fecha=:fecha";
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
                    <li><button style="background-color:red;" type="button">10:00am - 11:00am</button></li>
                    <li><button style="background-color:red;" type="button">11:00pm - 12:00pm</button></li>
                    <li><button style="background-color:red;" type="button">12:00pm - 13:00pm</button></li>
                    <li><button style="background-color:red;" type="button">13:00pm - 14:00pm</button></li>
                    <li><button style="background-color:red;" type="button">16:00pm - 17:00pm</button></li>
                    <li><button style="background-color:red;" type="button">17:00pm - 18:00pm</button></li>
                </ul>
            ';
            } else {
                $sql = "SELECT horaboda from matrimonios where fecha=:fecha";
                $parametros = [
                    ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR]
                ];
                $citas = $base->consultar($sql, $parametros);
                $citas_horas = [];
                foreach ($citas as $cita) {
                    $citas_horas[$cita->horaboda] = $cita->horaboda;
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
                        $retorno .= '<li><button id="btnb' . $ii . '" onclick="cambiar_hora_boda(' . "'" . $horas[$i] . "'" . ',' . "'btnb" . $ii . "'" . ')" type="button">' . $horas[$i] . ' - ' . $hora_final . '</button></li>';
                    }
                }
                $retorno .= "</ul>";
                return $retorno;
            }
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
    public function consultar_matrimonios()
    {
        $base = new Base();
        $sql = "SELECT * from matrimonios";

        $matrimonios = $base->consultar($sql);
        $retorno = "";
        if ($matrimonios) {
            foreach ($matrimonios as $matrimonio) {
                $retorno .= "
                    <tr>
                        <td>{$matrimonio->nomnovia} {$matrimonio->apellidonovia}</td>
                        <td>{$matrimonio->nomnovio} {$matrimonio->apellidonovio}</td>
                        <td>{$matrimonio->fecha}</td>
                        <td>{$matrimonio->horaboda}</td>
                        <td>{$matrimonio->nommadrina} {$matrimonio->apemadrina}</td>
                        <td>{$matrimonio->nompadrino} {$matrimonio->apepadrino}</td>
                        <td>
                            <div>
                                <div class='badge btn-sm btn-pop'>
                                    Doumentos de la Novia
                                </div>
                                <div class='pop disabled'>
                                    <div class='pop-header'>
                                        Novia
                                    </div>
                                    <div class='pop-body'>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->actanacimientonovia}' class='badge badge-info' target='_blank' >Acta de Nacimiento</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->comprobantedomicilionovia}' class='badge badge-info' target='_blank' >Comprobante de Domicilio</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->comprobantebautizonovia}' class='badge badge-info' target='_blank' >Comprobante de Bautizo</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->certificadoconfirmacionnovia}' class='badge badge-info' target='_blank' >Certificado de Confirmación</a> <br>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div class='badge btn-sm btn-pop'>
                                    Doumentos de la Novio
                                </div>
                                <div class='pop disabled'>
                                    <div class='pop-header'>
                                        Novio
                                    </div>
                                    <div class='pop-body'>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->actanacimientonovio}' class='badge badge-info' target='_blank' >Acta de Nacimiento</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->comprobantedomicilionovio}' class='badge badge-info' target='_blank' >Comprobante de Domicilio</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->comprobantebautizonovio}' class='badge badge-info' target='_blank' >Comprobante de Bautizo</a> <br>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->certificadoconfirmacionnovio}' class='badge badge-info' target='_blank' >Cetficiado de Confirmación</a> <br>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class='badge btn-sm btn-pop'>
                                    Padrinos
                                </div>
                                <div class='pop disabled'>
                                    <div class='pop-header'>
                                        Padrinos
                                    </div>
                                    <div class='pop-body'>
                                        <a href='" . DOMINIO . "/public/assets/archivospdf/{$matrimonio->actamatrimoniopadrinos}' class='badge badge-info' target='_blank' >Acta de Matrimonio</a> <br>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='d-flex'>
                            <a href='" . DOMINIO . "/matrimonios/modificar/{$matrimonio->idmatrimonio}' class='btn btn-primary btn-sm mr-2'>Modificar</a>
                            <a href='" . DOMINIO . "/matrimonios/eliminar/{$matrimonio->idmatrimonio}' class='btn btn-danger btn-sm eliminar'>Eliminar</a>
                            </div>
                        </td>
                    </tr>
                ";
            }
        } else {
            $retorno = "<h3 class='text-center text-danger'>No hay registros de matrimonios</h3>";
        }
        return $retorno;
    }
    public function consultar_matrimonio($id)
    {
        $base = new Base();
        $sql = "SELECT *from matrimonios where idmatrimonio=:id";
        $parametros = [
            ["etiqueta" => "id", "valor" => $id, "parametro" => PDO::PARAM_INT]
        ];
        $matrimonio = $base->consultarRegistro($sql, $parametros);
        $retorno = "";

        $sql = "SELECT idcita,hora,fecha,motivo from cita where idcita=:idcita";
        $parametros = [
            ["etiqueta" => "idcita", "valor" => $matrimonio->idcita, "parametro" => PDO::PARAM_STR]
        ];
        $cita = $base->consultarRegistro($sql, $parametros);
        if ($matrimonio) {
            $retorno = '
            <h3 class="text-center" style="font-family:Exo;">MODIFICAR MATRIMONIO</h3>
            
            <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formulario">
                <input type="hidden" value="' . $matrimonio->idusuario . '" id="idusuario" name="idusuario">
                <input type="hidden" value="' . $matrimonio->idcita . '" id="idcita" name="idcita">
                <input type="hidden" value="' . $matrimonio->idmatrimonio . '" id="idmatrimonio" name="idmatrimonio">
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
                            <h3 class="text-center">Datos de la Novia</h3>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="txtnombre">Nombre Novia</label>
                                        <input type="text" name="txtnombre" placeholder="Nombre de la Novia"
                                            class="form-control" id="nombre_novia" value="' . $matrimonio->nomnovia . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtapellido">Apellidos Novia</label><br>
                                        <input type="text" name="txtapellido" placeholder="Apellidos de la Novia"
                                             class="form-control" id="apellidos_novia" value="' . $matrimonio->apellidonovia . '">
                                    </div>
                                    <div class="input-file">
                                        <label for="actanacimientonovia">Acta de Nacimiento</label>
                                        <input type="file" name="actanacimientonovia" id="actanacimientonovia"
                                            accept="application/pdf">
                                        <label for="actanacimientonovia" id="labelactanacimientonovia"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->actanacimientonovia . '">Ver documento precargado</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-file">
                                        <label for="comprobantedomicilionovia">Comprobante de Domicilio</label>
                                        <input type="file" name="comprobantedomicilionovia" id="comprobantedomicilionovia"
                                            accept="application/pdf">
                                        <label for="comprobantedomicilionovia" id="labelcomprobantedomicilionovia"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->comprobantedomicilionovia . '">Ver documento precargado</a>
                                    </div>
                                    <div class="input-file">
                                        <label for="comprobantebautizonovia">Comprobande de Bautizo</label>
                                        <input type="file" name="comprobantebautizonovia" id="comprobantebautizonovia"
                                            accept="application/pdf">
                                        <label for="comprobantebautizonovia" id="labelcomprobantebautizonovia"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                            <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->comprobantebautizonovia . '">Ver documento precargado</a>
                                    </div>
                                    <div class="input-file">
                                        <label for="certificadoconfirmacionnovia">Certificado de Confirmación</label>
                                        <input type="file" name="certificadoconfirmacionnovia" id="certificadoconfirmacionnovia"
                                            accept="application/pdf">
                                        <label for="certificadoconfirmacionnovia" id="labelcertificadoconfirmacionnovia"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->certificadoconfirmacionnovia . '">Ver documento precargado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container-item" id="contenido_dos">
                            <h3 class="text-center">Datos de Novio</h3>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="txtnom">Nombre Novio</label>
                                        <input type="text" name="txtnom" placeholder="Nombre del Novio" 
                                            class="form-control" id="nombre_novio" value="' . $matrimonio->nomnovio . '">
                                    </div>
        
                                    <div class="form-group">
                                        <label for="txtape">Apellidos Novio</label>
                                        <input type="text" name="txtape" placeholder="Apellidos del Novio" class="form-control"
                                            id="apellidos_novio" value="' . $matrimonio->apellidonovio . '">
                                    </div>
                                    <div class="input-file">
                                        <label for="actanacimientonovio">Acta de Nacimiento</label>
                                        <input type="file" name="actanacimientonovio" id="actanacimientonovio"
                                            accept="application/pdf">
                                        <label for="actanacimientonovio" id="labelactanacimientonovio"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->actanacimientonovio . '">Ver documento precargado</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-file">
                                        <label for="comprobantedomicilionovio">Comprobante de Domicilio</label>
                                        <input type="file" name="comprobantedomicilionovio" id="comprobantedomicilionovio"
                                            accept="application/pdf">
                                        <label for="comprobantedomicilionovio" id="labelcomprobantedomicilionovio"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                            <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->comprobantedomicilionovio . '">Ver documento precargado</a>
                                    </div>
                                    <div class="input-file">
                                        <label for="comprobantebautizonovio">Comprobande de Bautizo</label>
                                        <input type="file" name="comprobantebautizonovio" id="comprobantebautizonovio"
                                            accept="application/pdf">
                                        <label for="comprobantebautizonovio" id="labelcomprobantebautizonovio"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->comprobantebautizonovio . '">Ver documento precargado</a>
                                    </div>
                                    <div class="input-file">
                                        <label for="certificadoconfirmacionnovio">Certificado de Confirmación</label>
                                        <input type="file" name="certificadoconfirmacionnovio" id="certificadoconfirmacionnovio"
                                            accept="application/pdf">
                                        <label for="certificadoconfirmacionnovio" id="labelcertificadoconfirmacionnovio"
                                            class="nombre-archivo">Selecciona un archivo PDF</label>
                                        <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->certificadoconfirmacionnovio . '">Ver documento precargado</a>
                                    </div>
                                </div>
                            </div>
        
        
                        </div>
                        <div class="tab-container-item" id="contenido_tres">
                            <h3 class="text-center">Datos de los Padrinos</h3>
                            <div class="form-group ">
                                <label for="txtnmad">Nombre Madrina</label>
                                <input type="text" name="txtnmad" placeholder="Nombre de la Madrina" 
                                    class="form-control" id="nombre_madrina" value="' . $matrimonio->nommadrina . '">
                            </div>
                            <div class="form-group ">
                                <label for="txtamad"> Apellidos Madrina</label>
                                <input type="text" name="txtamad" placeholder="Apellidos de la Madrina" 
                                    class="form-control" id="apellidos_madrina" value="' . $matrimonio->apemadrina . '"> 
        
                            </div>
                            <div class="form-group ">
                                <label for="txtnpad"> Nombre Padrino</label>
                                <input type="text" name="txtnpad" placeholder="Nombre del Padrino" 
                                    class="form-control" id="nombre_padrino" value="' . $matrimonio->nompadrino . '">
        
                            </div>
                            <div class="form-group ">
                                <label for="txtapad"> Apellidos Padrino</label>
                                <input type="text" name="txtapad" placeholder="Apellidos del Padrino" 
                                    class="form-control" id="apellidos_padrino" value="' . $matrimonio->apepadrino . '">
        
                            </div>
                            <div class="input-file">
                                <label for="actamatrimoniopadrinos">Acta de Matrimonio por Iglesia</label>
                                <input type="file" name="actamatrimoniopadrinos" id="actamatrimoniopadrinos"
                                    accept="application/pdf">
                                <label for="actamatrimoniopadrinos" id="labelactamatrimoniopadrinos"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                                <a target="_blank" class="badge badge-info" href="' . DOMINIO . '/public/assets/arhivospdf/' . $matrimonio->actamatrimoniopadrinos . '">Ver documento precargado</a>
                            </div>
                        </div>
                        <div class="tab-container-item" id="contenido_cuatro">
                            <h3 class="text-center">Datos de la Cita de la Boda</h3>
                            <div class="row">
        
                                <div class="col-12 col-sm-6">
                                    <div class="from-group">
                                        <label for="txtfecha">Fecha Boda</label>
                                        <input id="fecha_boda" type="date" name="txtfecha" placeholder="" 
                                            class="form-control" value="' . $matrimonio->fecha . '">
        
                                    </div>
        
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
        
                                        <label for="hora">Hora</label>
                                        <input type="time" name="hora" class="form-control"  style="display:none"
                                            id="hora_boda" value="' . $matrimonio->horaboda . '">
                                        <div class="contenedor-hora" id="contenedor-hora-matrimonio">
                                            <ul>
                                                <li><button id="btnb1" onclick="cambiar_hora_boda(' . "'" . '12:00' . "'" . ',' . "'" . 'btnb1' . "'" . ')"
                                                        type="button">12:00pm - 13:00pm</button></li>
                                                <li><button id="btnb2" onclick="cambiar_hora_boda(' . "'" . '13:00' . "'" . ',' . "'" . 'btnb2' . "'" . ')"
                                                        type="button">13:00pm - 14:00pm</button></li>
                                                <li><button id="btnb3" onclick="cambiar_hora_boda(' . "'" . '14:00' . "'" . ',' . "'" . 'btnb3' . "'" . ')"
                                                        type="button">14:00pm - 15:00pm</button></li>
                                                <li><button id="btnb4" onclick="cambiar_hora_boda(' . "'" . '17:00' . "'" . ',' . "'" . 'btnb4' . "'" . ')"
                                                        type="button">17:00pm - 18:00pm</button></li>
                                                <li><button id="btnb5" onclick="cambiar_hora_boda(' . "'" . '18:00' . "'" . ',' . "'" . 'btnb5' . "'" . ')"
                                                        type="button">18:00pm - 19:00pm</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
        
                            </div>
        
        
                            <h3 class="text-center">Datos de la Cita</h3>
        
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group ">
                                        <label for="txtfecha"> Fecha Cita</label>
                                        <input type="date" name="txtfecha_cita" class="form-control" id="date"
                                            min="' . date("Y-m-d") . '" value="' . $cita->fecha . '">
        
                                    </div>
        
                                    <div class="form-group ">
                                        <label for="txtmotivo"> Motivo</label>
                                        <input type="text" name="txtmotivo" placeholder="Ingresa el Motivo de la Cita"
                                            id="motivo" class="form-control" value="' . $cita->motivo . '">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group ">
                                        <label for="txthora"> Hora Cita</label>
                                        <input type="time" name="txthora" id="hora" class="form-control" value="' . $cita->hora . '">
        
                                        <div class="contenedor-hora" id="contenedor-hora">
                                            <ul>
                                                <li><button id="btn1" onclick="cambiar_hora(' . "'" . '10:00' . "'" . ',' . "'" . 'btn1' . "'" . ')"
                                                        type="button">10:00am -
                                                        11:00am</button></li>
                                                <li><button id="btn2" onclick="cambiar_hora(' . "'" . '11:00' . "'" . ',' . "'" . 'btn2' . "'" . ')"
                                                        type="button">11:00pm -
                                                        12:00pm</button></li>
                                                <li><button id="btn3" onclick="cambiar_hora(' . "'" . '12:00' . "'" . ',' . "'" . 'btn3' . "'" . ')"
                                                        type="button">12:00pm -
                                                        13:00pm</button></li>
                                                <li><button id="btn4" onclick="cambiar_hora(' . "'" . '13:00' . "'" . ',' . "'" . 'btn4' . "'" . ')"
                                                        type="button">13:00pm -
                                                        14:00pm</button></li>
                                                <li><button id="btn5" onclick="cambiar_hora(' . "'" . '16:00' . "'" . ',' . "'" . 'btn5' . "'" . ')"
                                                        type="button">16:00pm -
                                                        17:00pm</button></li>
                                                <li><button id="btn6" onclick="cambiar_hora(' . "'" . '17:00' . "'" . ',' . "'" . 'btn6' . "'" . ')"
                                                        type="button">17:00pm -
                                                        18:00pm</button></li>
                                            </ul>
                                        </div>
        
                                    </div>
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
                                <button type="submit" class="btn btn-primary" id="btn_register" style="position:relative; top:90px">Registrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-footer p-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary mr-1" id="button_back" onclick="tab_anterior()"
                                style="display:none">Anterior</button>
                            <button type="button" class="btn btn-secondary" id="button_next"
                                onclick="tab_siguiente()">Siguiente</button>
                        </div>
                    </div>
                </div>
            </form>    
            ';
        } else {
            $retorno = "<h3 class='text-center text-danger'>No se enontró el matrimonio</h3>";
        }
        return $retorno;
    }
    public function modificar(
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
        $comnoviad,
        $cbanoviad,
        $ctdnad,
        $actnod,
        $cdnod,
        $cbnod,
        $ccnod,
        $ampd,
        $hora_boda,
        $fecha_cita,
        $hora_cita,
        $motivo_cita,
        $idcita, $idmatrimonio
    ) {
        $base = new Base();
        $sql = "SELECT count(*) as existe from matrimonios  where fecha=:fecha and horaboda=:horaboda and idmatrimonio!=:idmatrimonio";

        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "horaboda", "valor" => $hora_boda, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "idmatrimonio", "valor" => $idmatrimonio, "parametro" => PDO::PARAM_INT]
        ];
        $resp = $base->consultarRegistro($sql, $parametros);
        if ($resp->existe > 0) {
            return "La hora de la boda ya está ocupada selecciona otra";
        } else {
            $sql = "SELECT count(*) as existe from cita  where fecha=:fecha and hora=:hora and idcita!=:idcita";

            $parametros = [
                ["etiqueta" => "fecha", "valor" => $fecha_cita, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "hora", "valor" => $hora_cita, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idcita", "valor" => $idcita, "parametro" => PDO::PARAM_INT]
            ];
            $resp = $base->consultarRegistro($sql, $parametros);
            if ($resp->existe > 0) {
                return "La hora de la cita ya está ocupada selecciona otra";
            }
        }
        $sql = "SELECT actanacimientonovia, 
        comprobantedomicilionovia,
        comprobantebautizonovia,
        certificadoconfirmacionnovia, 
        actanacimientonovio,
        comprobantedomicilionovio,
        comprobantebautizonovio,
        certificadoconfirmacionnovio, 
        actamatrimoniopadrinos from matrimonios where idmatrimonio =:id";

        $parametros = [
            ["etiqueta" => "id", "valor" => $idmatrimonio, "parametro" => PDO::PARAM_INT]
        ];
        $matrimonio = $base->consultarRegistro($sql, $parametros);
        
        $annName = $matrimonio->actanacimientonovia;
        $comNovia = $matrimonio->comprobantedomicilionovia;
        $cbNovia = $matrimonio->comprobantebautizonovia;
        $ctdNA = $matrimonio->certificadoconfirmacionnovia;
        $acTAno = $matrimonio->actanacimientonovio;
        $cdnoo = $matrimonio->comprobantedomicilionovio;
        $cbNoo = $matrimonio->comprobantebautizonovio;
        $ccNoo = $matrimonio->certificadoconfirmacionnovio;
        $amps = $matrimonio->actamatrimoniopadrinos;

        if($ann['name']!=""){
            unlink("assets/archivospdf/".$annName);
            $annName = $this->subir_archivo($ann['tmp_name'], $ann['name']);
        }
        if($comnoviad['name']!=""){
            unlink("assets/archivospdf/".$comNovia);
            $comNovia = $this->subir_archivo($comnoviad['tmp_name'], $comnoviad['name']);
        }

        if($cbanoviad['name']!=""){
            unlink("assets/archivospdf/".$cbNovia);
            $cbNovia = $this->subir_archivo($cbanoviad['tmp_name'], $cbanoviad['name']);
        }

        if($ctdnad['name']!=""){
            unlink("assets/archivospdf/".$ctdNA);
            $ctdNA = $this->subir_archivo($ctdnad['tmp_name'], $ctdnad['name']);
        }
        

        if($actnod['name']!=""){
            unlink("assets/archivospdf/".$acTAno);
            $acTAno = $this->subir_archivo($actnod['tmp_name'], $actnod['name']);
        }
        
        if($cdnod['name']!=""){
            unlink("assets/archivospdf/".$cdnoo);
            $cdnoo = $this->subir_archivo($cdnod['tmp_name'], $cdnod['name']);
        }
        
        if($cbnod['name']!=""){
            unlink("assets/archivospdf/".$cbNoo);
            $cbNoo = $this->subir_archivo($cbnod['tmp_name'], $cbnod['name']);
        }
        
        if($ccnod['name']!=""){
            unlink("assets/archivospdf/".$ccNoo);
            $ccNoo = $this->subir_archivo($ccnod['tmp_name'], $ccnod['name']);
        }
        
        if($ampd['name']!=""){
            unlink("assets/archivospdf/".$amps);
            $amps = $this->subir_archivo($ampd['tmp_name'], $ampd['name']);
        }
        
        
        
        // $annName = "un registro";
        // $comNovia = "un registro";
        // $cbNovia = "un registro";
        // $ctdNA = "un registro";
        // $acTAno = "un registro";
        // $cdnoo = "un registro";
        // $cbNoo = "un registro";
        // $ccNoo = "un registro";
        // $amps = "un registro";
        session_start();
        $id_usuario = $_SESSION['id'];
        $sql = "UPDATE cita SET fecha=:fecha,hora=:hora,motivo=:motivo where idcita=:idcita";

        $parametros = [
            ["etiqueta" => "fecha", "valor" => $fecha_cita, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "hora", "valor" => $hora_cita, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "motivo", "valor" => $motivo_cita, "parametro" => PDO::PARAM_STR],
            ["etiqueta" => "idcita", "valor" => $idcita, "parametro" => PDO::PARAM_INT],
        ];

        if ($base->modificar($sql, $parametros)) {
            

            $sql = "UPDATE matrimonios SET
            nomnovia=:nomnovia,
            apellidonovia=:apellidonovia,
            nomnovio=:nomnovio,
            apellidonovio=:apellidonovio,
            fecha=:fecha,
            nommadrina =:nommadrina,
            apemadrina=:apemadrina,
            nompadrino=:nompadrino,
            apepadrino=:apepadrino,
            actanacimientonovia=:actanacimientonovia,
            comprobantedomicilionovia=:comprobantedomicilionovia,
            comprobantebautizonovia=:comprobantebautizonovia,
            certificadoconfirmacionnovia=:certificadoconfirmacionnovia,
            actanacimientonovio=:actanacimientonovio,
            comprobantedomicilionovio=:comprobantedomicilionovio,	
            comprobantebautizonovio=:comprobantebautizonovio,
            certificadoconfirmacionnovio=:certificadoconfirmacionnovio,
            actamatrimoniopadrinos=:actamatrimoniopadrinos,
            horaboda=:horaboda 
            where idmatrimonio=:idmatrimonio";
            $parametros = [

                ["etiqueta" => "nomnovia", "valor" => $nombreNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidonovia", "valor" => $apellidosNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nomnovio", "valor" => $nombreNovio, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apellidonovio", "valor" => $apellidosNovio, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "fecha", "valor" => $fecha, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nommadrina", "valor" => $nombreMadrina, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apemadrina", "valor" => $apellidosMadrina, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "nompadrino", "valor" => $nombrePadrino, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "apepadrino", "valor" => $apellidosPadrino, "parametro" => PDO::PARAM_STR],

                ["etiqueta" => "actanacimientonovia", "valor" => $annName, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobantedomicilionovia", "valor" => $comNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobantebautizonovia", "valor" => $cbNovia, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "certificadoconfirmacionnovia", "valor" => $ctdNA, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "actanacimientonovio", "valor" => $acTAno, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobantedomicilionovio", "valor" => $cdnoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "comprobantebautizonovio", "valor" => $cbNoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "certificadoconfirmacionnovio", "valor" => $ccNoo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "actamatrimoniopadrinos", "valor" => $amps, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "horaboda", "valor" => $hora_boda, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idmatrimonio", "valor" => $idmatrimonio, "parametro" => PDO::PARAM_INT],

            ];

            if ($base->modificar($sql, $parametros)) {
                return "Se Modificó el registro correctamente";
            }
        }
    }

    public function eliminar($id)
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
        actamatrimoniopadrinos from matrimonios where idmatrimonio =:id";

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

        $sql = "DELETE from matrimonios where idmatrimonio=:id";

        if ($base->eliminarRegistro($sql, $parametros) > 0) {
            $sql="DELETE from cita where idcita=:idcita";
            $parametros=[
                ["etiqueta"=>"idcita","valor"=>$matrimonio->idcita,"parametro"=>PDO::PARAM_INT]
            ];
            if($base->eliminarRegistro($sql,$parametros)>0){
                return "El matrimonio se eliminó correctamente!";
            }
            else{
             return "Error";
            }
        } else {
            return "Error";
        }
    }
}
