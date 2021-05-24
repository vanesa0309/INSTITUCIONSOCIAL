<?php
require_once "../sistema/vistas/encabezados/Header.php";

?>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<script src="<?php echo DOMINIO; ?>/assets/js/admin/modificaciones/cita.js" type="text/javascript"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#maitem2").addClass("active");
    });
</script>

<div class="container">
    <?php
    require_once "menu.php";
    ?>
    <?php
    if (isset($parametros['cita'])) {
        echo $parametros['cita'];
    }
    ?>
</div>

<br>
<br>
<a href="<?php echo DOMINIO; ?>/administrador/index" id="boton" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/administrador/boton_citas" id="boton_cita" style="display:none"></a>
<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>