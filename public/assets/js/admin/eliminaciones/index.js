$().ready(function () {
    
    $(".eliminar").each(function(indice,element){
        $(element).click(function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $("#modalfooter").html(` 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminar('`+ url + `')">Aceptar</button>
            `);
            $("#modaleliminar").modal("show");
        });
        
    });
});

function eliminar(url) {
    
    $.ajax({
        url: url,
        type: "post",
        success:function(respuesta){
            if(respuesta.indexOf("Error")!=-1){
                $("#contenido_modal_danger").html("Ocurrió un error");
                $("#modal_danger").modal("show");
            }
            else{
                $("#contenido_modal_success").html(respuesta);
                $("#modal_success").modal("show");
                $('#modal_success').on('hidden.bs.modal', function (e) {
                    location.reload();
                });
            }
        }
    });
}