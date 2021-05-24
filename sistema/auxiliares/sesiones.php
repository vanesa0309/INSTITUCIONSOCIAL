<?php
    function verificarSesionLogin(){
        session_start();
        if(isset($_SESSION['username'])){
            if($_SESSION['rol']=="Administrador"){
                header("Location: ".DOMINIO."/administrador/index");
            }
            else{
                header("Location: ".DOMINIO."/home/usuario");
            }
        }
    }
    function verificarSesion($nivel){
        session_start();
        if(!isset($_SESSION['username'])){
            header("Location: ".DOMINIO."/home/login");
        }
        else{
            if($_SESSION['rol']=="Administrador" && $nivel =="Usuario"){
                header("Location: ".DOMINIO."/administrador/index");
            }
            else{
                if($_SESSION['rol']=="Usuario" && $nivel =="Administrador"){
                    header("Location: ".DOMINIO."/home/usuario");
                }   
            }
        }
    }

    function cerrarSesion(){
        session_start();
        session_destroy();
        header("Location: ".DOMINIO."/");
    }
?>