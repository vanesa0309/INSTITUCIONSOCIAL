<?php
    class Home extends Controlador{

        public function index(){
            $this->cargarVista("Home_vista");
        }
        //Recuerda que para poder ejecutar una acción, o un método de un controlador,
        // todo va en la url de la página:
        // ***dominio/controlador/metodo_del_controlador***
        // en este caso para ejecutar el metodo login de este controlador tu url sería la siguiente
        // dominio/home/login
        // aqui no es necesario escribir mayusculas, se recomienda que uses minusculas
        public function login(){ 
            if($_SERVER['REQUEST_METHOD']=="GET"){ //verirfica que el metodo por el que estas entrando a la pagina sea get
                verificarSesionLogin(); //verificar las sesiones por el login y solo se hacen dentro de las peticiones get
                $this->cargarVista("Login_vista");
            }
            else{
                if($_SERVER['REQUEST_METHOD']=="POST"){//verirfica que el metodo por el que estas entrando a la pagina sea get
                    $usuario=trim($_POST['usuario']); // Variable que almacena el correo obtenido del formulario de inicio de sesión
                    $password=trim($_POST['password']); // Variable que almacena la contraseña obtenida del formulario de inico de sesión
                    
                    $this->modelo = $this->cargarModelo("Usuarios");
                    $this->modelo->setUsuario($usuario);
                    $this->modelo->setPassword($password);
                    echo $this->modelo->consultar_login();
                }
            }
        }
        public function usuario(){
            verificarSesion("Usuario"); // se isa cuando ya esta dentro de la sesion verificar si existe una sesion, y solo se hacen en los metodos get, los post se ignoran
            $this->cargarVista("Interfaz_usuario");
        }
        //agregué este método para cerrar sesión aqui, ya que puedes hacerlo en cualquier controlador
        //no es necesario que realices algo más dentro del metodo ya que el metodo cerrarSesion que se 
        //encuentra dentro del archivo se sesiones te redirecciona al login y ya no podrás acceder a ninguna
        //página que requiera una  sesión a menos que inicies sesion nuevamente
        //si quieres llamar a este metodo puedes hacerlo con un elemento a por ejemplo:
        // <a href="dominio/home/cerrar_sesion">Cerrar Sesión</a> y esto re cerraría la sesión
        public function cerrar_sesion(){
            cerrarSesion();
        }
        
        public function registrar()
        {
            if($_SERVER['REQUEST_METHOD']=="GET")
            {
                verificarSesionLogin();//se usa cuando no haya sesion 
                $this->cargarVista("Registrar_usuarios");
            }
            else
            {
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $nombre= trim($_POST['nombre']);
                    $correo= trim($_POST['email']);
                    $usuario= trim($_POST['usuario']);
                    $password= trim($_POST['password']);
                    
                    $this->modelo=$this->cargarModelo("Usuarios");
                    echo $this->modelo->registar_usuario($nombre,$correo,$usuario,$password,2);
                }
            }
        }
     
    }
    