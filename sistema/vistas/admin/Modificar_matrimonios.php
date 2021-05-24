<?php
require_once "../sistema/vistas/encabezados/Header.php";

?>

<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_matrimonio.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/validacion_entrada_de_campos.js" type="text/javascript"></script>
<script src="<?php echo DOMINIO; ?>/assets/js/admin/modificaciones/matrimonio.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap');
</style>
<script type="text/javascript">
    $().ready(function() {
        $("#maitem5").addClass("active");
    });
</script>

<div class="container">
    <?php
        require_once "menu.php";
    ?>
    <?php
    if (isset($parametros['matrimonio'])) {
        echo $parametros['matrimonio'];
    }
    ?>
</div>

<br>
<br>
<a href="<?php echo DOMINIO; ?>/matrimonios/index" id="ruta" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/administrador/boton_citas" id="boton_cita" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/matrimonios/boton_citas_administrador" id="boton_cita_boda" style="display:none"></a>

<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>
