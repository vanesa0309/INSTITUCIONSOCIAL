$().ready(function () { // aqui indico cuando esta lista la página (o haya cargado completamente), con nomenclatura de jquery
    // primer cosa selector $("").
    //# : se ocupa para los id
    //.:se ocupa para clases
    tabs(); 
    let array_hrs=["12:00","13:00","14:00","17:00","18:00"];
    let array_btns = ["btn1", "btn2", "btn3", "btn4", "btn5"];
    let btn = array_btns[ array_hrs.indexOf($("#hora").val())];

    cambiar_hora($("#hora").val(), btn);

    $("#fecha_bautizo").change(function () {
        $("#hora").val("");
        
        $.ajax({
            type: "post",
            url: $("#boton").attr("href"),
            data: {
                "fecha": $(this).val(),
                "idusuario":$("#idusuario").val()
            },
            success: function (respuesta) {
                $("#contenedor-hora").html(respuesta);
            },
            error: function (respuesta) {
                console.log("el error es: " + respuesta);
            }
        });
    });
    document.getElementById("actadenacimiento").addEventListener("change", function () {
        var extensiones = /(.pdf|.PDF)$/i;
        if ($(this).value != "") {
            if (extensiones.exec(this.value)) {
                if (this.files[0].size < 10240000) {
                    $("#labelactadenacimiento").html(this.files[0].name);
                }
                else {
                    $("#contenido_modal_danger").html("solo puedes agregar archivos menores de 10Mb");
                    $("#modal_danger").modal("show");
                    this.value = null;
                    $("#labelactadenacimiento").html("Selecciona un archivo PDF");
                }
            }
            else {
                $("#contenido_modal_danger").html("Solo puedes agregar archivos pdf");
                $("#modal_danger").modal("show");
                this.value = null;
                $("#labelactadenacimiento").html("Selecciona un archivo PDF");
            }
        }
        else {
            this.value = null;
            $("#labelactadenacimiento").html("Selecciona un archivo PDF");
        }
    });

    document.getElementById("comprobante").addEventListener("change", function () {
        var extensiones = /(.pdf|.PDF)$/i;
        if ($(this).value != "") {
            if (extensiones.exec(this.value)) {
                if (this.files[0].size < 10240000) {
                    $("#labelcomprobante").html(this.files[0].name);
                }
                else {
                    $("#contenido_modal_danger").html("solo puedes agregar archivos menores de 10Mb");
                    $("#modal_danger").modal("show");
                    this.value = null;
                    $("#labelcomprobante").html("Selecciona un archivo PDF");
                }
            }
            else {
                $("#contenido_modal_danger").html("Solo puedes agregar archivos pdf");
                $("#modal_danger").modal("show");
                this.value = null;
                $("#labelcomprobante").html("Selecciona un archivo PDF");
            }
        }
        else {
            this.value = null;
            $("#labelcomprobante").html("Selecciona un archivo PDF");
        }
    });





    $("#formulario").submit(function (e) {
        e.preventDefault();
        if (!validaciones(array)) {
            return false;
        }
        else {
            var formData = new FormData(document.getElementById("formulario"));
            formData.append("actadenacimiento", $("#actadenacimiento")[0].files[0]);
            formData.append("comprobate", $("#comprobante")[0].files[0])
            $.ajax({
                beforeSend: function () {
                    $("#progress_bar").css("display", "flex");
                    $("#btn_register").css("display", "none");
                },
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (event) {
                        if (event.lengthComputable) {
                            let porcentaje = Math.floor((event.loaded / event.total) * 100);
                            $("#progress_bar_content").css("width", porcentaje + "%");
                            $("#progress_bar_content").html("Registrando: " + porcentaje + "%");
                        }
                    });
                    return xhr;
                },
                type: $(this).attr("method"), // acceder a una propiedad del formulario
                url: $(this).attr("action"),
                data: formData, //se envian los datos serializados,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    // mostrar respuesta en alerta
                    if (respuesta.indexOf("La hora del bautizo ya está ocupada, selecciona otra") != -1) {
                        $("#contenido_modal_danger").html("La hora del bautizo ya está ocupada, selecciona otra");
                        $("#modal_danger").modal("show");
                    }
                    else {
                        if (respuesta.indexOf("Error") != -1) {
                            $("#contenido_modal_danger").html("Ocurrió un error");
                            $("#modal_danger").modal("show");
                        }
                        else {
                            $("#contenido_modal_success").html(respuesta);
                            $("#modal_success").modal("show");
                            $('#modal_success').on('hidden.bs.modal', function (e) {
                                location.href = $("#ruta").attr("href");
                            });
                        }
                    }
                    $("#progress_bar").css("display", "none");
                    $("#btn_register").css("display", "block");
                },
                error: function (error) {
                    $("#progress_bar").css("display", "none");
                    $("#btn_register").css("display", "block");
                    console.log("se produjo un error" );
                    console.log(error);
                }
            });
        }


    });

    var array = [
        "#telefono",
        "#fecha_bautizo",
        //"#actadenacimiento",
        "#hora_boda",
        //"#comprobante",
        "#nombre",
        "#apellidos",
        "#nombre_madre",
        "#apellidos_madre",
        "#nombre_padre",
        "#apellidos_padre",
        "#nombre_madrina",
        "#apellidos_madrina",
    ];

    validar_campos("#nombre");
    validar_campos("#apellidos");
    validar_campos("#nombre_madre");
    validar_campos("#apellidos_madre");
    validar_campos("#nombre_padre");
    validar_campos("#apellidos_padre");
    validar_campos("#nombre_madrina");
    validar_campos("#apellidos_madrina");
});


var arreglo_tabs = [
    "contenido_uno",
    "contenido_dos",
    "contenido_tres",
    "contenido_cuatro"
];
var arreglo_botones = [
    "uno",
    "dos",
    "tres",
    "cuatro"
];
var active = 0;
function tabs() {
    $("#" + arreglo_tabs[active]).toggleClass("active");
    $("#" + arreglo_botones[active]).toggleClass("active");
    eventos();
}

function eventos() {
    $("#uno").click(function () {
        cambiar_tab(0);
    });
    $("#dos").click(function () {
        cambiar_tab(1);
    });
    $("#tres").click(function () {
        cambiar_tab(2);
    });
    $("#cuatro").click(function () {
        cambiar_tab(3);
    });
}

function cambiar_tab(id) {
    if (id == 0) {
        $("#button_back").css("display", "none");
        $("#button_next").css("display", "block");
    }
    else {
        if (id == arreglo_botones.length - 1) {
            $("#button_next").css("display", "none");
            $("#button_back").css("display", "block");
        }
        else {
            $("#button_back").css("display", "block");
            $("#button_next").css("display", "block");
        }
    }
    $("#" + arreglo_tabs[active]).toggleClass("active");
    $("#" + arreglo_botones[active]).toggleClass("active");
    active = id;
    $("#" + arreglo_tabs[active]).toggleClass("active");
    $("#" + arreglo_botones[active]).toggleClass("active");
}

function tab_anterior() {
    let n = active - 1;
    cambiar_tab(n);
}
function tab_siguiente() {
    let n = active + 1;
    cambiar_tab(n);
}

function cambiar_hora(hora, btn) {
    $("#hora").val(hora);
    var array = new Array();
    array = ["btn1", "btn2", "btn3", "btn4", "btn5"];
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