
$().ready(function(){ // aqui indico cuando esta lista la página (o haya cargado completamente), con nomenclatura de jquery
    // primer cosa selector $("").
    //# : se ocupa para los id
    //.:se ocupa para clases
    $("#formulario").submit(function(e){
        console.log("estas en la funcion");
        e.preventDefault();
        $.ajax({
            type:$(this).attr("method"), // acceder a una propiedad del formulario
            url:$(this).attr("action"),
            data:$(this).serialize(), //se envian los datos serializados,
            
            success:function(respuesta){
                 // mostrar respuesta en alerta
                if(respuesta.indexOf("El Nombre de Usuario ya Existe")!=-1){
                    $("#contenido_modal_danger").html("El nombre de Usuario ya Existe elije otro Por Favor");
                    $("#modal_danger").modal("show");
                }
                else{
                    if(respuesta.indexOf("Error al registrarse")!=-1){
                        $("#contenido_modal_danger").html("Ocurrió un error al Registrar el Usuario");
                        $("#modal_danger").modal("show");
                    }
                    else{
                        $("#contenido_modal_success").html(respuesta);
                        $("#modal_success").modal("show");
                        $('#modal_success').on('hidden.bs.modal', function (e) {
                            location.reload();//actualizar pagina
                        });
                    }
                }
            },
            error:function(error){
                console.log("se produjo un error"+error);
            }
        });
    });
});