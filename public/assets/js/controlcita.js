$().ready(function(){
   
    $("#date").change(function(){
        $("#hora").val("");
        $.ajax({
            type:"post",
            url:$("#boton").attr("href"),
            data:{
                "fecha":$(this).val()
            },
            success:function(respuesta){
                $("#contenedor-hora").html(respuesta);
            },
            error:function(respuesta){
                console.log("el error es: "+respuesta);
            }
        });
    });

    $("#fecha_boda").change(function(){ 
        $("#hora_boda").val("");
        $.ajax({
            type:"post",
            url:$("#boton_boda").attr("href"),
            data:{
                "fecha":$(this).val()
            },
            success:function(respuesta){
                $("#contenedor-hora-matrimonio").html(respuesta);
            },
            error:function(respuesta){
                console.log("el error es: "+respuesta);
            }
        });
    });
});
function cambiar_hora(hora,btn){
    $("#hora").val(hora);
    var array = new Array();
    array=["btn1","btn2","btn3","btn4","btn5","btn6"];
    var i = 0;
    for(i=0; i<6; i++ ){
        if(btn == array[i]){
            $("#"+btn).css("backgroundColor","#21B2F8");
        }
        else{
            $("#"+array[i]).css("backgroundColor","#1A2537");
        }
    }   
    
}
function cambiar_hora_boda(hora,btn){
    $("#hora_boda").val(hora);
    var array = new Array();
    array=["btnb1","btnb2","btnb3","btnb4","btnb5"];
    var i = 0;
    for(i=0; i<6; i++ ){
        if(btn == array[i]){
            $("#"+btn).css("backgroundColor","#21B2F8");
        }
        else{
            $("#"+array[i]).css("backgroundColor","#1A2537");
        }
    }   
    
}