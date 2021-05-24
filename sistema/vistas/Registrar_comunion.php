<?php require_once "encabezados/Header.php" ?>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_matrimonio.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/validacion_entrada_de_campos.js" type="text/javascript"></script>
<script src="<?php echo DOMINIO; ?>/public/assets/js/registros/registrar_comunion.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap');
</style>

<div class="container">
    <h3 class="text-center" style="font-family:Exo;">REGISTRAR ALUMNO DE PRIMERA COMUNIÓN</h3>
    <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formulario">
        <div class="tab shadow">
            <div class="tab-header p-3">
                <div class="row justify-content-center">
                    <button type="button" id="uno" class="btn btn-sm mr-1">1</button>
                    <button type="button" id="dos" class="btn btn-sm mr-1">2</button>
                </div>
            </div>
            <div class="tab-container p-4" id="tab_container">
                <div class="tab-container-item " id="contenido_uno">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="txtnombre">Nombre Alummno</label>
                                <input type="text" name="txtNombre" placeholder="Nombre del niño" class="form-control" id="nombre_alumno">
                            </div>

                            <div class="form-group">
                                <label for="txtApellidos">Apellidos Alummno</label>
                                <input type="text" name="txtApellidos" placeholder="Apellidos del alumno" class="form-control" id="apellidos_alumno">
                            </div>

                            <div class="from-group">
                                <label for="txtfecha">Fecha de Nacimiento</label>
                                <input id="fecha_niño" type="date" name="txtecha" placeholder="" class="form-control" >

                            </div>
                            <div class="form-group ">
                                <label for="txtEdad"> Edad</label>
                                <input type="number" name="txtEdad" placeholder="Ingresa edad " id="edad" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="txtNivel">Nivel </label>
                                <select name="txtNivel" id="nivel_alumno" class="custom-select">
                                    <?php
                                        echo $parametros['niveles'];
                                    ?>
                                </select>
                                
                            </div>
                            <div class="input-file">
                                <label for="actadenacimiento">Acta de Nacimiento</label>
                                <input type="file" name="actadenacimiento" id="actadenacimiento" accept="application/pdf">
                                <label for="actadenacimiento" id="labelactadenacimiento" class="nombre-archivo">Selecciona un archivo
                                    PDF</label>
                            </div>
                            <div class="input-file">
                                <label for="febautizo">Fe de bautizo</label>
                                <input type="file" name="febautizo" id="febautizo" accept="application/pdf">
                                <label for="febautizo" id="labelfebautizo" class="nombre-archivo">Selecciona un archivo
                                    PDF</label>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="tab-container-item " id="contenido_dos">
                    <div class="form-group">
                        <label for="txtnom">Nombre Madre</label>
                        <input type="text" name="nomad" value="" placeholder="" class="form-control" id="nombremadre">

                    </div>
                    <div class="form-group ">
                        <label for="txtape">Apellidos Madre</label><br>
                        <input type="text" name="apemad" value="" placeholder="" class="form-control" id="apellidosmadre">

                    </div>
                    <div class="form-group ">
                        <label for="txtape">Nombre Padre</label><br>
                        <input type="text" name="nompad" value="" placeholder="" class="form-control" id="nombrepadre">

                    </div>
                    <div class="form-group ">
                        <label for="txtape">Apellidos Padre</label><br>
                        <input type="text" name="apepad" value="" placeholder="" class="form-control" id="apellidospadre">

                    </div>
                    <div class="form-group ">
                        <label for="txtnumero"> Telefóno <small>(10 dígitos)</small>:</label>
                        <input type="number" name="telefono" value="" placeholder="" pattern="[0-9]{10}" class="form-control" id="telefono">

                    </div>
                    <div class="form-group">
                        <label for="txtdireccion">Dirección </label>
                        <input type="text" name="txtdireccion" placeholder="dirección" class="form-control" id="direccion" >
                    </div>
                    <div class="input-file">
                        <label for="comprobante">Comprobante de domicilio</label>
                        <input type="file" name="comprobante" id="comprobante" accept="application/pdf">
                        <label for="comprobante" id="labelcomprobante" class="nombre-archivo">Selecciona un archivo
                            PDF</label>
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
<?php
require_once "alertas/alertas.php";
require_once "encabezados/Footer.php"; ?>