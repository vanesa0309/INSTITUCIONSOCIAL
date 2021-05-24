<?php
require_once "../sistema/vistas/encabezados/Header.php";

?>
<script src="<?php echo DOMINIO; ?>/public/assets/js/admin/eliminaciones/index.js" type="text/javascript"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#maitem1").addClass("active");
    });
</script>
<div class="container">
    <?php
    require_once "menu.php";
    ?>
    <h3 class="text-center">Bautizos</h3>
    <div class="overflow-auto">
        <table class="table table-hover table-striped table-sm shadow">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nombre Madre</th>
                    <th>Nombre Padre</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Padrino</th>
                    <th>Documentos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($parametros['bautizos'])) {
                    echo $parametros['bautizos'];
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>


<?php
require_once "../sistema/vistas/alertas/alertas.php";
require_once "../sistema/vistas/encabezados/Footer.php";
?>