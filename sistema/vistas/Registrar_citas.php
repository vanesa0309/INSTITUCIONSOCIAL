<?php
require_once "encabezados/Header.php";
?>
<script src="<?php echo DOMINIO; ?>/public/assets/librerias/jquery-3.4.0.min.js"></script>
<script src="<?php echo DOMINIO; ?>/public/assets/librerias/js/materialize.min.js"></script>
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/librerias/css/materialize.min.css">
<link rel="stylesheet" href="<?php echo DOMINIO; ?>/public/assets/css/estilos_hora.css">
<script src="<?php echo DOMINIO; ?>/public/assets/js/controlcita.js" type="text/javascript"></script>
<div class="row">
    <div class="col s4 offset-s1 center-align" style="position:relative; top:5%;" id="frm_registrar">
        <h5 class="blue-text">REGISTRAR CITA</h5><br><br>
        <form action="#" method="post" accept-charset="utf-8" id="formulariocitamat">


            <div class="input-field ">
                <input type="date" name="txtfecha" value="" placeholder="" id="date" min="<?php echo date("Y-m-d"); ?>">
                <label for="txtfecha"> Fecha Cita</label>
            </div>
            <div class="input-field ">
                <input type="time" name="txthora" value="00:00" id="hora">
                <label for="txthora"> Hora Cita</label>

                <div class="contenedor-hora" id="contenedor-hora">
                    <ul>
                        <li><button id="btn1" onclick="cambiar_hora('10:00','btn1')" type="button">10:00am - 11:00am</button></li>
                        <li><button id="btn2" onclick="cambiar_hora('11:00','btn2')" type="button">11:00pm - 12:00pm</button></li>
                        <li><button id="btn3" onclick="cambiar_hora('12:00','btn3')" type="button">12:00pm - 13:00pm</button></li>
                        <li><button id="btn4" onclick="cambiar_hora('13:00','btn4')" type="button">13:00pm - 14:00pm</button></li>
                        <li><button id="btn5" onclick="cambiar_hora('16:00','btn5')" type="button">16:00pm - 17:00pm</button></li>
                        <li><button id="btn6" onclick="cambiar_hora('17:00','btn6')" type="button">17:00pm - 18:00pm</button></li>
                    </ul>
                </div>

            </div>
            <div class="input-field ">
                <input type="text" name="txtmotivo" value="" placeholder="" id="motivo">
                <label for="txtmotivo"> Motivo</label>
            </div>


            <div class="input-field">
                <button type="submit" class="blue btn-small" name="btn_guardar">Guardar</button>

            </div>
        </form>
    </div>
</div>
<a href="<?php echo DOMINIO; ?>/matrimonios/boton_cita" id="boton" style="display:none"></a>

<?php
include_once "encabezados/Footer.php";
?>