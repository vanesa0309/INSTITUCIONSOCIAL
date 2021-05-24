<?php
    class Base{
        private $host;
        private $nombreBase;
        private $usuario;
        private $password;

        private $pdo;
        private $pstm;
        private $error;

        public function __construct(){
            $this->host=HOST;
            $this->nombreBase=NOMBRE_BASE;
            $this->usuario=USUARIO_BASE;
            $this->password=PASSWORD_BASE;
            
            try{
                $dsn="mysql:host={$this->host};dbname={$this->nombreBase};charset=utf8";
                $opciones=array(
                    PDO::ATTR_PERSISTENT=>true,
                    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                );
                $this->pdo= new PDO($dsn,$this->usuario,$this->password,$opciones);
                
            }
            catch(PDOException $ex){
                $this->error=$ex->getMessage();
                echo $this->error;
            }
        }
        public function consultarRegistro($sql,$parametros=[]){//consulta solo 1 registro
            try{
                $this->pstm=$this->pdo->prepare($sql);
                if($parametros){
                    foreach($parametros as $datos){                        
                        $this->pstm->bindParam($datos['etiqueta'],$datos['valor'],$datos['parametro']);
                    }
                }                
                $this->pstm->execute();
                return $this->pstm->fetch(PDO::FETCH_OBJ);
            }
            catch(PDOException $ex){
                $this->error=$ex->getMessage();
                echo $this->error;
            }            
        }
        public function consultar($sql,$parametros=[]){    //regresa mas de un registro        
            try{
                $this->pstm=$this->pdo->prepare($sql);
                if($parametros){
                    foreach($parametros as $datos){
                        $this->pstm->bindParam($datos['etiqueta'],$datos['valor'],$datos['parametro']);
                    }
                }                
                $this->pstm->execute();                
                return $this->pstm->fetchALL(PDO::FETCH_OBJ);
            }
            catch(PDOException $ex){
                $this->error=$ex->getMessage();
                echo $this->error;
            }            
        }
        public function insertar($sql,$parametros){//todos
            try{
                $this->pstm=$this->pdo->prepare($sql);
                foreach($parametros as $datos){
                    $this->pstm->bindParam($datos['etiqueta'],$datos['valor'],$datos['parametro']);
                }
                $this->pstm->execute();
                return $this->pstm->rowCount();
            }catch(PDOException $e){
                $this->error=$e->getMessage();
                echo $this->error;
            }            
        }   
        public function modificar($sql,$parametros){
            try{
                $this->pstm=$this->pdo->prepare($sql);
                foreach($parametros as $datos){                    
                    $this->pstm->bindParam($datos['etiqueta'],$datos['valor'],$datos['parametro']);                    
                }                
                $update=$this->pstm->execute();                
                $renglones=$this->pstm->rowCount();
                if($update ==false &&  $renglones==0){
                    return false;
                }
                else{
                    if($update ==true &&  $renglones==0){
                        return true;
                    }
                    else{
                        if($update ==true &&  $renglones>0){
                            return true;
                        }
                    }
                }                    
            }catch(PDOException $ex){
                $this->error=$ex->getMessage();
                echo $this->error;
            }
        }
        public function eliminarRegistro($sql,$parametros=[]){
            try{
                $this->pstm=$this->pdo->prepare($sql);
                foreach($parametros as $datos){                                        
                    $this->pstm->bindParam($datos['etiqueta'],$datos['valor'],$datos['parametro']);
                }                                
                $this->pstm->execute();
                return $this->pstm->rowCount();
            }catch(PDOException $ex){
                $this->error=$ex->getMessage();
                echo $this->error;
            }
        }
       public function setHost($host){
            $this->host=$host;
        }
        public function getHost(){
            return $this->host;
        }
        public function setNombreBase($nombre){
            $this->nombreBase=$nombre;
        }
        public function getNombreBase(){
            return $this->nombreBase;
        }
        public function setUsuario($usuario){
            $this->usuario=$usuario;
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function setPassword($password){
            $this->password=$password;
        }
        public function getPassword(){
            return $this->password;
        }
        public function setPdo($pdo){
            $this->pdo=$pdo;
        }
        public function getPdo(){
            return $this->pdo;
        }
        public function setPstm($pstm){ 
            $this->pstm=$pstm;
        }
        public function getStm(){
            return $this->pstm;
        }
        public function setError($error){
            $this->error=$error;
        }
        public function getError(){
            return $this->error;
        }
    }
