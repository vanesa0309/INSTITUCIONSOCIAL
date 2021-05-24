<?php require_once "encabezados/Header.php" ?>

<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_matrimonio.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/registros/registrar_bautizo.js" type="text/javascript"></script>
<script src="<?php echo DOMINIO; ?>/public/assets/js/validacion_entrada_de_campos.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap');
</style>
<div class="container">
    
    <h3 class="text-center" style="font-family:Exo;">REGISTRAR BAUTIZO</h3>
    <form action="#" method="post" id="formulario" accept-charset="utf-8" enctype="multipart/form-data">
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
                        <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="txtapellido">Apellidos Niño</label><br>
                        <input type="text" name="apellido" placeholder="Apellidos" id="apellidos" class="form-control">
                    </div>
                    <div class="input-file">
                        <label for="actadenacimiento">Acta de Nacimiento</label>
                        <input type="file" name="actadenacimiento" id="actadenacimiento" accept="application/pdf">
                        <label for="actadenacimiento" id="labelactadenacimiento" class="nombre-archivo">Selecciona un archivo
                            PDF</label>
                    </div>
                </div>
                <div class="tab-container-item" id="contenido_dos">
                    <div class="form-group">
                        <label for="txtnom">Nombre Madre</label>
                        <input type="text" name="nomad" placeholder="Nombre de la Madre" id="nombre_madre" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="txtape">Apellidos Madre</label>
                        <input type="text" name="apemad" placeholder="Apellidos de la Madre" id="apellidos_madre" class="form-control">

                    </div>
                    <div class="form-group ">
                        <label for="txtape">Nombre Padre</label>
                        <input type="text" name="nompad" placeholder="Nombre del Padre" id="nombre_padre" class="form-control">

                    </div>
                    <div class="form-group ">
                        <label for="txtape">Apellidos Padre</label>
                        <input type="text" name="apepad" placeholder="Apellidos del Padre" id="apellidos_padre" class="form-control">

                    </div>
                    <div class="form-group ">
                        <label for="txtnumero"> Telefóno <small>(10 dígitos)</small>:</label>
                        <input type="number" name="telefono" pattern="[0-9]{10}" id="telefono" class="form-control">
                        
                    </div>

                </div>
                <div class="tab-container-item" id="contenido_tres">
                    <div class="form-group">
                        <label for="txtnom">Nombre Madrina o Padrino</label>
                        <input type="text" name="nompadrinos" placeholder="Nombre de la Madrina" id="nombre_madrina" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtape">Apellidos Madrina o Padrino</label><br>
                        <input type="text" name="apepadrinos" placeholder="Apellidos de la Madrina" id="apellidos_madrina" class="form-control">
                    </div>

                    <div class="input-file">
                        <label for="comprobante">Fe de Bautizo o Acta de Matrimonio</label>
                        <input type="file" name="comprobante" id="comprobante" accept="application/pdf">
                        <label for="comprobante" id="labelcomprobante" class="nombre-archivo">Selecciona un archivo PDF</label>
                    </div>
                </div>
                <div class="tab-container-item" id="contenido_cuatro">
                    <div class="from-group">
                        <label for="txtfecha">Fecha Bautizo:</label>
                        <input id="fecha_bautizo" type="date" name="txtfecha" placeholder="" class="form-control" min="<?php
                                                                                                                        $fecha = Date('d-m-Y');
                                                                                                                        $temp = strtotime($fecha);
                                                                                                                        $fecha_temporal = date("d-m-Y", strtotime("+1 month", $temp));
                                                                                                                        $fecha_completa = strtotime($fecha_temporal);
                                                                                                                        echo date("Y-m-d", $fecha_completa);
                                                                                                                        ?>">

                    </div>

                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" name="hora" class="form-control" style="display:none" id="hora">
                        <div class="contenedor-hora" id="contenedor-hora">
                            <ul>
                                <li><button id="btn1" onclick="cambiar_hora('12:00','btn1')" type="button">12:00pm -
                                        13:00pm</button></li>
                                <li><button id="btn2" onclick="cambiar_hora('13:00','btn2')" type="button">13:00pm -
                                        14:00pm</button></li>
                                <li><button id="btn3" onclick="cambiar_hora('14:00','btn3')" type="button">14:00pm -
                                        15:00pm</button></li>
                                <li><button id="btn4" onclick="cambiar_hora('17:00','btn4')" type="button">17:00pm -
                                        18:00pm</button></li>
                                <li><button id="btn5" onclick="cambiar_hora('18:00','btn5')" type="button">18:00pm -
                                        19:00pm</button></li>
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
                        <button type="submit" class="btn btn-primary" id="btn_register" style="position:relative; top:90px">Registrar</button>
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
</div>
<br><br>
<a href="<?php echo DOMINIO; ?>/home/usuario" id="ruta" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/bautizos/cambiar_hora" id="boton" style="display:none"></a>
<?php
require_once "alertas/alertas.php";
require_once "encabezados/Footer.php"; ?>