<style>
  #menu_administrador a:hover {
    background-color: white;
    color: #2F565C;
  }

  #menu_administrador a.active {
    background-color: white;
    color: #2F565C;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color:#2F565C" id="menu_administrador">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav w-100 justify-content-between">
      <li class="nav-item">
        <a class="nav-link " href="<?php echo DOMINIO; ?>">Home</a>
      </li>
      <li class="nav-item">
        <a id="maitem1" class="nav-link " href="<?php echo DOMINIO; ?>/bautizos/index">Bautizos</a>
      </li>
      <li class="nav-item">
        <a id="maitem2" class="nav-link" href="<?php echo DOMINIO; ?>/administrador/index">Citas</a>
      </li>
      <li class="nav-item">
        <a id="maitem3" class="nav-link" href="<?php echo DOMINIO; ?>/comuniones/index">Comuniones</a>
      </li>
      <li class="nav-item">
        <a id="maitem4" class="nav-link" href="<?php echo DOMINIO; ?>/confirmaciones/index">Confirmaciones</a>
      </li>
      <li class="nav-item">
        <a id="maitem5" class="nav-link" href="<?php echo DOMINIO; ?>/matrimonios/index">Matrimonios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo DOMINIO; ?>/home/cerrar_sesion">Cerrar Sesión</a>
      </li>
    </ul>

  </div>
</nav>
<br>