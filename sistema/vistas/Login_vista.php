<?php
    require_once "encabezados/Header.php";
?>
 <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" > -->
<link rel="stylesheet" href="<?php echo DOMINIO;?>/public/assets/css/estilos.css" />

<div class="container" id="login">
    <div class="row m-0 p-0 container_login shadow">
        <div class="col-12 col-sm-6 img p-0">
            <img src="<?php echo DOMINIO;?>/public/assets/images/login.jpeg" alt="...">
        </div>
        <div class="col-12 col-sm-12 col-lg-6 p-3 pt-5">
            <form action="#" method="post" class="formulario" id="formulario">
                <h1 class="text-center">Iniciar Sesión</h1>
                <div class="contenedor">
                    <div class="form-group">
                        <label for="usuario">Nombre de Usuario</label>
                        <input type="text" name="usuario" placeholder="Usuario" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Contraseña" required="required" class="form-control">
                    </div>
                    <input type="submit" value="Ingresar" class="btn btn-block" style="background-color:#c2b5a5; color:black;" >
                    <br><br>
                    <p class="text-center">Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                    <p class="text-center">¿No tienes una cuenta? <a class="link" href="<?php ECHO DOMINIO; ?>/home/registrar">Registrarse </a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<br><br>


<?php
require_once "alertas/alertas.php";
    require_once "encabezados/Footer.php";
?>

<script type="text/javascript">
    $().ready(function(){
        $("#formulario").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:$(this).attr("action"),
                type:$(this).attr("method"),
                data:$(this).serialize(),
                success:function(respuesta){
                    if(respuesta.indexOf("Bienvenido")!=-1){
                        $("#contenido_modal_success").html(respuesta);
                        $("#modal_success").modal("show");
                        $('#modal_success').on('hidden.bs.modal', function (e) {
                            location.reload();//actualizar pagina
                        });
                    }
                    else{
                        $("#contenido_modal_danger").html(respuesta);
                        $("#modal_danger").modal("show");
                    }
                }
            });
        });
    });
</script>