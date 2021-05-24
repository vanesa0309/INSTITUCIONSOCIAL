function validar_campos(selector){
    $(selector).keyup(function(tecla){
        
        var valor=$(this).val();
        if(valor){
            let espacios=valor.split(" "); 
            valor="";
            espacios.forEach(function(elemento,index){ 
                if(elemento){
                    if(index!=0){
                        valor+=" "+elemento[0].toUpperCase()+elemento.slice(1).toLowerCase();
                    }
                    else{
                        valor+=elemento[0].toUpperCase()+elemento.slice(1).toLowerCase();
                    }
                }
                else{
                    
                    if(tecla.keyCode==32 && index!=0) {
                        valor+=" ";
                    }
                }
            });
            if(tecla.keyCode==32 && valor!=""){
                valor+=" ";
            }
            $(this).val(valor);
        }
     
        // if(!( tecla.keyCode >=65 && tecla.keyCode<=90 ||  tecla.keyCode >=97 && tecla.keyCode<=122 || tecla.keyCode==32 )){
        //     $(this).val($(this).val().replace(""+tecla.key,""));
        // }
        // else{
        //     if( $(this).val().length>0 ){
        //         $(this).val($(this).val()[0].toUpperCase()+$(this).val().slice(1).toLowerCase());    
        //         $(this).val($(this).val()[0].toUpperCase()+$(this).val().slice(1).toLowerCase());
        //     }    
        // }
        var longitud = $(this).val().length;
        valor="";
        for(var i = 0 ; i< longitud; i++){
            if($(this).val().charCodeAt(i) >= 65 && $(this).val().charCodeAt(i)<=90 || $(this).val().charCodeAt(i) >= 97 && $(this).val().charCodeAt(i)<=122 || $(this).val().charCodeAt(i) ==32){
                valor+=$(this).val()[i];
            }
        }
        $(this).val(valor);
    });
}

function validaciones(array){
   
    var error=true;
    array.forEach(function(valor){
        if( $(valor).val()==""){
           $("#contenido_modal_danger").html("Completa los campos correctamente");
           $("#modal_danger").modal("show");
           error=false;
           return false;
        }
    });
    return error;
}