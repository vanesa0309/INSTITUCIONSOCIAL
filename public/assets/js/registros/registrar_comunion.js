$().ready(function () { // aqui indico cuando esta lista la página (o haya cargado completamente), con nomenclatura de jquery
    // primer cosa selector $("").
    //# : se ocupa para los id
    //.:se ocupa para clases
    tabs();
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

    document.getElementById("febautizo").addEventListener("change", function () {
        var extensiones = /(.pdf|.PDF)$/i;
        if ($(this).value != "") {
            if (extensiones.exec(this.value)) {
                if (this.files[0].size < 10240000) {
                    $("#labelfebautizo").html(this.files[0].name);
                }
                else {
                    $("#contenido_modal_danger").html("solo puedes agregar archivos menores de 10Mb");
                    $("#modal_danger").modal("show");
                    this.value = null;
                    $("#labelfebautizo").html("Selecciona un archivo PDF");
                }
            }
            else {
                $("#contenido_modal_danger").html("Solo puedes agregar archivos pdf");
                $("#modal_danger").modal("show");
                this.value = null;
                $("#labelfebautizo").html("Selecciona un archivo PDF");
            }
        }
        else {
            this.value = null;
            $("#labelfebautizo").html("Selecciona un archivo PDF");
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


    var array = [
        '#nombre_alumno',
        '#apellidos_alumno',
        '#fecha_niño',
        '#edad',
        '#nivel_alumno',
        '#actadenacimiento',
        "#febautizo",
        '#nombremadre',
        "#apellidosmadre",
        '#nombrepadre',
        '#apellidospadre',
        '#telefono',
        '#direccion',
        '#comprobante'
    ];

    $("#formulario").submit(function (e) {
        e.preventDefault();
        if (!validaciones(array)) {
            return false;
        }
        else {
            var formData = new FormData(document.getElementById("formulario"));
            formData.append("actanacimiento", $("#actadenacimiento")[0].files[0]);
            formData.append("febautizo", $("#febautizo")[0].files[0]);
            formData.append("comprobantedomicilio", $("#comprobante")[0].files[0]);

            $.ajax({
                beforeSend: function () {
                    $("#progress_bar").css("display", "flex");
                    $("#btn_register").css("display", "none");
                },
                xhr: function () {
                    let xhr = new XMLHttpRequest();
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
                    if (respuesta.indexOf("Error ") != -1) {
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
                    $("#progress_bar").css("display", "none");
                    $("#btn_register").css("display", "block");
                },
                error: function (error) {
                    $("#progress_bar").css("display", "none");
                    $("#btn_register").css("display", "block");
                    console.log("se produjo un error" + error);
                }
            });
        }

    });
});


var arreglo_tabs = [
    "contenido_uno",
    "contenido_dos",
];
var arreglo_botones = [
    "uno",
    "dos",
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