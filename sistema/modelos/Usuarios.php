<?php
class Usuarios
{
    public $usuario;
    public $password;

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function consultar_login()
    {

        $q = "SELECT idusuario,password,idrol from usuario WHERE idrol='2' AND BINARY usuario = :usuario"; // Consulta a la tabla administrador de la base de datos
        $parametros = [
            ["etiqueta" => "usuario", "valor" => $this->usuario, "parametro" => PDO::PARAM_STR]
        ];

        $base = new Base();
        $respuesta = $base->consultarRegistro($q, $parametros);

        if ($respuesta) { // Condición que indica si encuentra los datos ingresador en el formulario
            // y si coinciden con la base de datos entonces se creará una variable de sesión
            if (password_verify($this->password, $respuesta->password)) {
                session_start();
                $_SESSION['id'] = $respuesta->idusuario;
                $_SESSION['username'] = $this->usuario; // Variable de sesión que almacena el correo del administrador

                $sql = "SELECT rol from rol where idrol=:idrol";
                $parametros = [
                    ["etiqueta" => "idrol", "valor" => $respuesta->idrol, "parametro" => PDO::PARAM_STR]
                ];
                $resp = $base->consultarRegistro($sql, $parametros);
                $_SESSION['rol'] = $resp->rol;
                return "Bienvenido";
            } else {
                return "Datos Incorrectos";
            }
        } else {
            $q = "SELECT idusuario,password,idrol from usuario WHERE idrol='1' AND BINARY usuario = :usuario"; // Consulta a la tabla administrador de la base de datos
            $parametros = [
                ["etiqueta" => "usuario", "valor" => $this->usuario, "parametro" => PDO::PARAM_STR]
            ];

            $base = new Base();
            $respuesta = $base->consultarRegistro($q, $parametros);
            if ($respuesta) { // Condición que indica si encuentra los datos ingresador en el formulario
                // y si coinciden con la base de datos entonces se creará una variable de sesión
                if (password_verify($this->password, $respuesta->password)) {
                    session_start();
                    $_SESSION['id'] = $respuesta->idusuario;
                    $_SESSION['username'] = $this->usuario; // Variable de sesión que almacena el correo del administrador
                    $sql = "SELECT rol from rol where idrol=:idrol";
                    $parametros = [
                        ["etiqueta" => "idrol", "valor" => $respuesta->idrol, "parametro" => PDO::PARAM_STR]
                    ];
                    $resp = $base->consultarRegistro($sql, $parametros);
                    $_SESSION['rol'] = $resp->rol;
                    return "Bienvenido Administrador";
                } else {
                    return "Datos Incorrectos";
                }
            } else {
                return "Datos Incorrectos";
            }
        }
    }

    public function registar_usuario($nombre, $correo, $usuario, $password, $idrol)
    {
        $base_de_datos = new Base(); //crear un objeto de base de datos, de la clase base
        $sql = "SELECT *from usuario where usuario = :usuario";
        $parametros = [
            ["etiqueta" => "usuario", "valor" => $usuario, "parametro" => PDO::PARAM_STR]
        ];

        if ($base_de_datos->consultarRegistro($sql, $parametros)) {
            return "El Nombre de Usuario ya Existe";
        } else {
            $passHash = password_hash($password, PASSWORD_DEFAULT);

            $insertar = "INSERT INTO usuario (nombre,correo,usuario,password,idrol) VALUES(:nombre, :correo,:usuario,:password, :idrol)"; //se define la instruccion sql
            $parametros = [
                ["etiqueta" => "nombre", "valor" => $nombre, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "correo", "valor" => $correo, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "usuario", "valor" => $usuario, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "password", "valor" => $passHash, "parametro" => PDO::PARAM_STR],
                ["etiqueta" => "idrol", "valor" => $idrol, "parametro" => PDO::PARAM_INT]
            ];               //se cargan los parametros a insertar, con el nombre de la etiqueta que debe coincidir con la etiqueta que esta dentro de la instruccion sql (:etiqueta)
            //se llama al metodo insertar de la clase base o del objeto declarado en la linea anterior
            if ($base_de_datos->insertar($insertar, $parametros) == 1) { //si el metodo insertar regresa 1, significa que se registro bien, sino pues hubo un error.
                $asunto = 'Registro exitoso';
                $desde = 'vanesasantana66@gmail.com';
                $comentario = '<p> Hola,te registraste exitosamente </p> <br>';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf8\r\n";
                $headers .= "From: Remitente\r\n";
                mail($correo, $asunto, $comentario, $headers);

                session_start();

                $sql = "SELECT idusuario from usuario where usuario=:usuario";
                $parametros = [
                    ["etiqueta" => "usuario", "valor" => $usuario, "parametro" => PDO::PARAM_STR]
                ];
                $respuesta = $base_de_datos->consultarRegistro($sql, $parametros);


                $_SESSION['id'] = $respuesta->idusuario;
                $_SESSION['username'] = $usuario; // Variable de sesión que almacena el correo del administrador

                $sql = "SELECT rol from rol where idrol=:idrol";
                $parametros = [
                    ["etiqueta" => "idrol", "valor" => $idrol, "parametro" => PDO::PARAM_STR]
                ];
                $resp = $base_de_datos->consultarRegistro($sql, $parametros);
                $_SESSION['rol'] = $resp->rol;

                return "Gracias por Registrarse";
            } else {
                return "Error al registrarse";
            }
        }
    }
}
