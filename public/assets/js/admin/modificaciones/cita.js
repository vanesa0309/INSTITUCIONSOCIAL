$().ready(function () {
    array = ["btn1", "btn2", "btn3", "btn4", "btn5", "btn6"];
    array_horas = ["10:00", "11:00", "12:00", "13:00", "16:00", "17:00"];
    let hora = $("#hora").val();
    let btn = array[array_horas.indexOf(hora)];
    cambiar_hora(hora, btn)

    $("#formulario").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            success: function (respuesta) {
                if (respuesta.indexOf("Se actualizó el registro correctamente") != -1) {
                    $("#contenido_modal_success").html(respuesta);
                    $("#modal_success").modal("show");
                    $('#modal_success').on('hidden.bs.modal', function (e) {
                        location.href = $("#boton").attr("href");
                    });
                }
                else {
                    $("#contenido_modal_danger").html(respuesta);
                    $("#modal_danger").modal("show");
                }
            }
        });
    });
    $("#fecha").change(function () {

        $.ajax({
            url: $("#boton_cita").attr("href"),
            type: "post",
            data: {
                "fecha": $("#fecha").val(),
                "idusuario": $("#idusuario").val(),
            },
            success: function (respuesta) {
                $("#contenedor-hora").html(respuesta);
            }
        });
    });

});
function cambiar_hora(hora, btn) {
    $("#hora").val(hora);
    var array = new Array();
    array = ["btn1", "btn2", "btn3", "btn4", "btn5", "btn6"];
    var i = 0;
    for (i = 0; i < 6; i++) {
        if (btn == array[i]) {
            $("#" + btn).css("backgroundColor", "#21B2F8");
        }
        else {
            $("#" + array[i]).css("backgroundColor", "#1A2537");
        }
    }

}