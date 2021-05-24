<?php
require_once "../sistema/vistas/encabezados/Header.php";

?>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_matrimonio.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/validacion_entrada_de_campos.js" type="text/javascript"></script>
<script src="<?php echo DOMINIO; ?>/assets/js/admin/modificaciones/bautizo.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap');
</style>
<script type="text/javascript">
    $().ready(function() {
        $("#maitem1").addClass("active");
    });
</script>

<div class="container">
    <?php
        require_once "menu.php";
    ?>
    <?php
    if (isset($parametros['bautizo'])) {
        echo $parametros['bautizo'];
    }
    ?>
</div>

<br>
<br>
<a href="<?php echo DOMINIO; ?>/bautizos/index" id="ruta" style="display:none"></a>
<a href="<?php echo DOMINIO; ?>/bautizos/cambiar_hora_administrador" id="boton" style="display:none"></a>
<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>