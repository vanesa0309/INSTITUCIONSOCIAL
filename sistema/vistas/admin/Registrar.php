<?php
require_once "../sistema/vistas/encabezados/Header.php";
?>

<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos.css" />

<div class="container" id="login">
    <div class="row m-0 p-0 container_login shadow">
        <div class="col-12 col-sm-6 img p-0">
            <img src="<?php echo DOMINIO; ?>/public/assets/images/img6.jpeg" alt="...">
        </div>
        <div class="col-12 col-sm-12 col-lg-6 p-3 ">
            <form action="#" method="post" class="formulario" id="formulario">
                <h1 class="text-center">Registrarse</h1>
                <div class="contenedor">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" name="nombre" placeholder="Nombre" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="usuario">Nombre de Usuario</label>
                        <input type="text" name="usuario" placeholder="Usuario" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="text" name="email" placeholder="Email" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Contraseña" required="required" class="form-control">
                    </div>
                    <input type="submit" value="Registrarse" class="btn btn-block" style="background-color:#c2b5a5; color:black;">

                    <p class="text-center">Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                    <p class="text-center">¿Ya tienes una cuenta?<a class="link" href="<?php echo DOMINIO; ?>/home/login">Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<br><br>


<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>

<script type="text/javascript">
    $().ready(function() {
        $("#formulario").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                success: function(respuesta) {
                    if (respuesta.indexOf("El Nombre de Usuario ya Existe") != -1) {
                        $("#contenido_modal_danger").html("El nombre de Usuario ya Existe elije otro Por Favor");
                        $("#modal_danger").modal("show");
                    } else {
                        if (respuesta.indexOf("Error al registrarse") != -1) {
                            $("#contenido_modal_danger").html("Ocurrió un error al Registrar el Usuario");
                            $("#modal_danger").modal("show");
                        } else {
                            $("#contenido_modal_success").html(respuesta);
                            $("#modal_success").modal("show");
                            $('#modal_success').on('hidden.bs.modal', function(e) {
                                location.reload(); //actualizar pagina
                            });
                        }
                    }
                }
            });
        });
    });
</script>