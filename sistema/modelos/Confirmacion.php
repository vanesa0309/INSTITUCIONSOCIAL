<?php
class Confirmacion {
    public function registrar($datos=[]){
        $base= new Base();
        session_start();
        $idusuario=$_SESSION['id'];
        
        $actadenacimiento=$this->subir_archivo($datos['actanacimiento']["tmp_name"],$datos['actanacimiento']["name"]);
        $febautizo=$this->subir_archivo($datos['febautizo']["tmp_name"],$datos['febautizo']["name"]);
        $certificado=$this->subir_archivo($datos['certificadocomunion']["tmp_name"],$datos['certificadocomunion']["name"]);
        $comprobante=$this->subir_archivo($datos['comprobantedomicilio']["tmp_name"],$datos['comprobantedomicilio']["name"]);
        
        $sql="INSERT INTO confirmacion(
            nombre,apellidos,
            fecha_nacimiento, edad,
            idnivel,actanacimiento,
            febautizo,certificadocomunion,
            direccion,comprobantedomicilio,
            nombmadre,apellidosmadre,
            nombpadre,apellidospadre,
            telefono,idusuario    
        ) values(
            :nombre,:apellidos,
            :fecha_nacimiento, :edad,
            :idnivel,:actanacimiento,
            :febautizo,:certificadocomunion,
            :direccion,:comprobantedomicilio,
            :nombmadre,:apellidosmadre,
            :nombpadre,:apellidospadre,
            :telefono,:idusuario
        )";
        $parametros= [
            ["etiqueta"=>"nombre","valor"=>$datos['nombre'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"apellidos","valor"=>$datos['apellidos'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"fecha_nacimiento","valor"=>$datos['fecha_nacimiento'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"edad","valor"=>$datos['edad'],"parametro"=>PDO::PARAM_INT],
            ["etiqueta"=>"idnivel","valor"=>$datos['idnivel'],"parametro"=>PDO::PARAM_INT],
            ["etiqueta"=>"actanacimiento","valor"=>$actadenacimiento,"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"febautizo","valor"=>$febautizo,"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"certificadocomunion","valor"=>$certificado,"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"direccion","valor"=>$datos['direccion'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"comprobantedomicilio","valor"=>$comprobante,"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"nombmadre","valor"=>$datos['nombmadre'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"apellidosmadre","valor"=>$datos['apellidosmadre'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"nombpadre","valor"=>$datos['nombpadre'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"apellidospadre","valor"=>$datos['apellidospadre'],"parametro"=>PDO::PARAM_STR],
            ["etiqueta"=>"telefono","valor"=>$datos['telefono'],"parametro"=>PDO::PARAM_INT],
            ["etiqueta"=>"idusuario","valor"=>$idusuario,"parametro"=>PDO::PARAM_INT],
        ];
        if($base->insertar($sql,$parametros) ==1){
            return "Se realizó el registro correctamente";
        }
        else{
            return "Error";
        }
    }
    
    private function subir_archivo($tmp_name, $nombreArchivo)
    {
        $nombreTemporal = "";
        $ruta = "assets/archivospdf/";
        $destino = $ruta . $nombreArchivo;
        $archivo = $nombreArchivo;
        while (is_file($destino)) {
            $numeroAleatorio = rand(0, getrandmax());
            $nombreTemporal = $numeroAleatorio . $nombreArchivo;
            $archivo = $nombreTemporal;

            $destino = $ruta . $nombreTemporal;
            $nombreTemporal = $nombreArchivo;
        }
        if (move_uploaded_file($tmp_name, $destino)) {
            return $archivo;
        }
    }

    public function consultar_niveles(){
        $base= new Base();
        $sql="SELECT *from nivel";
        $niveles=$base->consultar($sql);
        $retorno='';

            foreach($niveles as $nivel){
                $retorno.='<option value="'.$nivel->idnivel.'">'.$nivel->nivel.'</option>';
            }
        $retorno.='</select>';

        return $retorno;
    }
    
}
