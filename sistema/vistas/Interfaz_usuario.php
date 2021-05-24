<?php
include_once "encabezados/Header.php";
?>
<link rel="stylesheet" href="<?php echo DOMINIO;?>/public/assets/css/main.css"/>
<div id="page-wrapper">

    <!-- Header -->
    <div id="header">

        <!-- Logo -->
        <h1><a href="index.html" id="logo"><em>Bienvenido</em></a></h1>
 
        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="index.html">inicio</a></li>
                <li><a href="<?php echo DOMINIO; ?>/bautizos/registrar">Bautizo</a></li>
                <li><a href="<?php echo DOMINIO; ?>/matrimonios/registrar">Matrimonio</a></li>
                <li><a href="<?php echo DOMINIO; ?>/comuniones/registrar">Comunión</a></li>
                <li><a href="<?php echo DOMINIO; ?>/confirmaciones/registrar">Confirmación</a></li>
                <li><a href="<?php echo DOMINIO; ?>/home/cerrar_sesion">Salir</a></li>
               
            </ul>
        </nav>

    </div>
</div>

<!-- Scripts -->
<script src="<?php echo DOMINIO;?>/public/assets/js/jquery.min.js"></script>
<script src="<?php echo DOMINIO;?>/public/assets/js/jquery.dropotron.min.js"></script>
<script src="<?php echo DOMINIO;?>/public/assets/js/browser.min.js"></script>
<script src="<?php echo DOMINIO;?>/public/assets/js/breakpoints.min.js"></script>
<script src="<?php echo DOMINIO;?>/public/assets/js/util.js"></script>
<script src="<?php echo DOMINIO;?>/public/assets/js/main.js"></script>

<?php
include_once "encabezados/Footer.php";
?>