<?php
require_once "../sistema/vistas/encabezados/Header.php";

?>
<script src="<?php echo DOMINIO; ?>/public/assets/js/admin/eliminaciones/index.js" type="text/javascript"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#maitem2").addClass("active");
    });
</script>
<div class="container">
    <?php
    require_once "menu.php";
    ?>
    <h3 class="text-center">CITAS</h3>
    <table class="table table-hover table-striped table-sm shadow">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Usuario</th>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($parametros['citas'])) {
                echo $parametros['citas'];
            }
            ?>
        </tbody>
    </table>
</div>
<br>
<br>
<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>