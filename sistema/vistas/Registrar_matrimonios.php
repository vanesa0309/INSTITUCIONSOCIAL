<?php require_once "encabezados/Header.php"; ?>

<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_matrimonio.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap');
</style>
<script src="<?php echo DOMINIO; ?>/public/assets/js/registros/registrar_matrimonio.js" type="text/javascript"></script>
<script src="<?php echo DOMINIO; ?>/public/assets/js/validacion_entrada_de_campos.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/controlcita.js" type="text/javascript"></script>

<div class="container">
    <h3 class="text-center" style="font-family:Exo;">REGISTRAR MATRIMONIO</h3>

    <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formulario">
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
                                    class="form-control" id="nombre_novia">
                            </div>
                            <div class="form-group">
                                <label for="txtapellido">Apellidos Novia</label><br>
                                <input type="text" name="txtapellido" placeholder="Apellidos de la Novia"
                                     class="form-control" id="apellidos_novia">
                            </div>
                            <div class="input-file">
                                <label for="actanacimientonovia">Acta de Nacimiento</label>
                                <input type="file" name="actanacimientonovia" id="actanacimientonovia"
                                    accept="application/pdf">
                                <label for="actanacimientonovia" id="labelactanacimientonovia"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-file">
                                <label for="comprobantedomicilionovia">Comprobante de Domicilio</label>
                                <input type="file" name="comprobantedomicilionovia" id="comprobantedomicilionovia"
                                    accept="application/pdf">
                                <label for="comprobantedomicilionovia" id="labelcomprobantedomicilionovia"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                            <div class="input-file">
                                <label for="comprobantebautizonovia">Comprobande de Bautizo</label>
                                <input type="file" name="comprobantebautizonovia" id="comprobantebautizonovia"
                                    accept="application/pdf">
                                <label for="comprobantebautizonovia" id="labelcomprobantebautizonovia"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                            <div class="input-file">
                                <label for="certificadoconfirmacionnovia">Certificado de Confirmación</label>
                                <input type="file" name="certificadoconfirmacionnovia" id="certificadoconfirmacionnovia"
                                    accept="application/pdf">
                                <label for="certificadoconfirmacionnovia" id="labelcertificadoconfirmacionnovia"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
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
                                    class="form-control" id="nombre_novio">
                            </div>

                            <div class="form-group">
                                <label for="txtape">Apellidos Novio</label>
                                <input type="text" name="txtape" placeholder="Apellidos del Novio" class="form-control"
                                    id="apellidos_novio">
                            </div>
                            <div class="input-file">
                                <label for="actanacimientonovio">Acta de Nacimiento</label>
                                <input type="file" name="actanacimientonovio" id="actanacimientonovio"
                                    accept="application/pdf">
                                <label for="actanacimientonovio" id="labelactanacimientonovio"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-file">
                                <label for="comprobantedomicilionovio">Comprobante de Domicilio</label>
                                <input type="file" name="comprobantedomicilionovio" id="comprobantedomicilionovio"
                                    accept="application/pdf">
                                <label for="comprobantedomicilionovio" id="labelcomprobantedomicilionovio"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                            <div class="input-file">
                                <label for="comprobantebautizonovio">Comprobande de Bautizo</label>
                                <input type="file" name="comprobantebautizonovio" id="comprobantebautizonovio"
                                    accept="application/pdf">
                                <label for="comprobantebautizonovio" id="labelcomprobantebautizonovio"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                            <div class="input-file">
                                <label for="certificadoconfirmacionnovio">Certificado de Confirmación</label>
                                <input type="file" name="certificadoconfirmacionnovio" id="certificadoconfirmacionnovio"
                                    accept="application/pdf">
                                <label for="certificadoconfirmacionnovio" id="labelcertificadoconfirmacionnovio"
                                    class="nombre-archivo">Selecciona un archivo PDF</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="tab-container-item" id="contenido_tres">
                    <h3 class="text-center">Datos de los Padrinos</h3>
                    <div class="form-group ">
                        <label for="txtnmad">Nombre Madrina</label>
                        <input type="text" name="txtnmad" placeholder="Nombre de la Madrina" 
                            class="form-control" id="nombre_madrina">
                    </div>
                    <div class="form-group ">
                        <label for="txtamad"> Apellidos Madrina</label>
                        <input type="text" name="txtamad" placeholder="Apellidos de la Madrina" 
                            class="form-control" id="apellidos_madrina">

                    </div>
                    <div class="form-group ">
                        <label for="txtnpad"> Nombre Padrino</label>
                        <input type="text" name="txtnpad" placeholder="Nombre del Padrino" 
                            class="form-control" id="nombre_padrino">

                    </div>
                    <div class="form-group ">
                        <label for="txtapad"> Apellidos Padrino</label>
                        <input type="text" name="txtapad" placeholder="Apellidos del Padrino" 
                            class="form-control" id="apellidos_padrino">

                    </div>
                    <div class="input-file">
                        <label for="actamatrimoniopadrinos">Acta de Matrimonio por Iglesia</label>
                        <input type="file" name="actamatrimoniopadrinos" id="actamatrimoniopadrinos"
                            accept="application/pdf">
                        <label for="actamatrimoniopadrinos" id="labelactamatrimoniopadrinos"
                            class="nombre-archivo">Selecciona un archivo PDF</label>
                    </div>
                </div>
                <div class="tab-container-item" id="contenido_cuatro">
                    <h3 class="text-center">Datos de la Cita de la Boda</h3>
                    <div class="row">

                        <div class="col-12 col-sm-6">
                            <div class="from-group">
                                <label for="txtfecha">Fecha Boda</label>
                                <input id="fecha_boda" type="date" name="txtfecha" placeholder="" 
                                    class="form-control"
                                    min="<?php
                                                                                                                            $fecha = Date('d-m-Y');
                                                                                                                            $temp = strtotime($fecha);
                                                                                                                            $fecha_temporal = date("d-m-Y", strtotime("+1 month", $temp));
                                                                                                                            $fecha_completa = strtotime($fecha_temporal);
                                                                                                                            echo date("Y-m-d", $fecha_completa);
                                                                                                                            ?>">

                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">

                                <label for="hora">Hora</label>
                                <input type="time" name="hora" class="form-control"  style="display:none"
                                    id="hora_boda">
                                <div class="contenedor-hora" id="contenedor-hora-matrimonio">
                                    <ul>
                                        <li><button id="btnb1" onclick="cambiar_hora_boda('12:00','btnb1')"
                                                type="button">12:00pm - 13:00pm</button></li>
                                        <li><button id="btnb2" onclick="cambiar_hora_boda('13:00','btnb2')"
                                                type="button">13:00pm - 14:00pm</button></li>
                                        <li><button id="btnb3" onclick="cambiar_hora_boda('14:00','btnb3')"
                                                type="button">14:00pm - 15:00pm</button></li>
                                        <li><button id="btnb4" onclick="cambiar_hora_boda('17:00','btnb4')"
                                                type="button">17:00pm - 18:00pm</button></li>
                                        <li><button id="btnb5" onclick="cambiar_hora_boda('18:00','btnb5')"
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
                                    min="<?php echo date("Y-m-d"); ?>">

                            </div>

                            <div class="form-group ">
                                <label for="txtmotivo"> Motivo</label>
                                <input type="text" name="txtmotivo" placeholder="Ingresa el Motivo de la Cita"
                                    id="motivo" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group ">
                                <label for="txthora"> Hora Cita</label>
                                <input type="time" name="txthora" value="00:00" id="hora" class="form-control">

                                <div class="contenedor-hora" id="contenedor-hora">
                                    <ul>
                                        <li><button id="btn1" onclick="cambiar_hora('10:00','btn1')"
                                                type="button">10:00am -
                                                11:00am</button></li>
                                        <li><button id="btn2" onclick="cambiar_hora('11:00','btn2')"
                                                type="button">11:00pm -
                                                12:00pm</button></li>
                                        <li><button id="btn3" onclick="cambiar_hora('12:00','btn3')"
                                                type="button">12:00pm -
                                                13:00pm</button></li>
                                        <li><button id="btn4" onclick="cambiar_hora('13:00','btn4')"
                                                type="button">13:00pm -
                                                14:00pm</button></li>
                                        <li><button id="btn5" onclick="cambiar_hora('16:00','btn5')"
                                                type="button">16:00pm -
                                                17:00pm</button></li>
                                        <li><button id="btn6" onclick="cambiar_hora('17:00','btn6')"
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
</div>
<a href="<?php echo DOMINIO; ?>/matrimonios/boton_cita" id="boton" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/home/usuario" id="ruta" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/matrimonios/boton_cita_matrimonios" id="boton_boda" style="display:none"></a>

<br><br>
<?php 
require_once "alertas/alertas.php";
require_once "encabezados/Footer.php"; ?>