<?php
include_once './Modelo/MasterModel/MasterModel.php';

class ControladorLogin extends MasterModel{
    
    private $ObjLog;
    
    public function __construct(){
    
        $this->ObjLog= new MasterModel();
    
    }
    public function login(){
        
        include_once './Vista/Form_login/Login.html.php';
        
    }
    public function postLogin(){
        
        $correo= $_POST['correo'];
      
        $clave= $_POST['clave'];
        if((!empty($correo))&& (!empty($clave))){
            $sql= "select contrasena from usuario where email like :codigo";
            $consult= $this->ObjLog->getData($sql,$correo);
            foreach($consult as $comparar){

            }
            if($comparar <> null){
                if(password_verify($clave,$comparar['contrasena'])){

                    $sqlUsu="select * from usuario where email like :codigo";

                    $usuLog= $this->ObjLog->getData($sqlUsu,$correo);
                    foreach ($usuLog as $login){}


                    $_SESSION['usu_nombre']= $login['nombre']." ".$login['apellido'];
                    $_SESSION['id_usu']= $login['id_usu'];

                    echo"<script>"."window.location.href='Web/index.php'"."</script>";

                }else{
                    echo"<script>"."alert('Contraseña Incorrecto');"."</script>";
                    echo"<script>"."window.location.href='index.php?modulo=Usuario&controlador=Login&funcion=login'"."</script>";
                }
            }else{
                echo"<script>"."alert('El correo es incorrecto');"."</script>";
                echo"<script>"."window.location.href='index.php?modulo=Usuario&controlador=Login&funcion=login'"."</script>";
            }
        }else{
            echo"<script>"."alert('Todos los campos son obligatorios');"."</script>";
            echo"<script>"."window.location.href='./index.php?modulo=Usuario&controlador=Login&funcion=login'"."</script>";
        }
    }
    public function crear(){

        include_once './Vista/Form_usuario/crear.html.php';

    }
    public function postCrear(){

        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $telefono= $_POST['telefono'];
        $tipDoc= $_POST['tipDoc'];
        $correo= $_POST['correo'];
        $clave= $_POST['password'];
        $documento= $_POST['documento'];
        $numID= null;
        
        $sqlExiteNumDocumento="select count(*) as totalDoc from usuario where num_documento like :codigo";
        $existeNumDocumento= $this->ObjLog->getData($sqlExiteNumDocumento, $documento);
        foreach ($existeNumDocumento as $existeNumDocumento){
            $totalDoc=$existeNumDocumento['totalDoc'];
        }
        
        $sqlExiteCorreo="select count(*) as total from usuario where email like :codigo";
        $existeCorreo= $this->ObjLog->getData($sqlExiteCorreo, $correo);
        foreach ($existeCorreo as $existeCorreo){
            $total=$existeCorreo['total'];
        }
        
        if(($totalDoc==0)&&($total==0)){
            $contr= password_hash($clave, PASSWORD_BCRYPT);

            $sql= "insert into usuario values(:numID,:nombre,:apellido,:documento,:tipDoc,:correo,:telefono,:clave)";

            $conexion= $this->ObjLog->getConect();

            $elementos= $conexion->prepare($sql);
            $elementos->bindParam(':numID', $numID);
            $elementos->bindParam(':nombre', $nombre);
            $elementos->bindParam(':apellido', $apellido);
            $elementos->bindParam(':documento', $documento);
            $elementos->bindParam(':tipDoc', $tipDoc);
            $elementos->bindParam(':correo', $correo);
            $elementos->bindParam(':telefono', $telefono);
            $elementos->bindParam(':clave', $contr);
            $elementos->execute();       
        }
        
        $YaEsta= null;
        if(($totalDoc!=0)&&($total!=0)){
            $YaEsta = Array("total"=>3);
        }else if($total!=0){
            $YaEsta= Array("total"=>1);
        }else if($totalDoc!=0){
            $YaEsta= Array("total"=>2);
        }else{
            $YaEsta = Array("total"=>0);
        }
        
        $jsonvalue= json_encode($YaEsta);
        echo $jsonvalue;
        
        
    }
    
    public function recuperarContraseña(){
        
        $correo=$_POST['codigo'];
        
        $sqlExiste="select count(*) as existe from usuario where email like :codigo";
        
        $sqlExisteUs= $this->ObjLog->getData($sqlExiste, $correo);
                
        foreach ($sqlExisteUs as $sqlExisteUs){
            $totalExi=$sqlExisteUs['existe'];
        }
        
        if($totalExi!=0){
            
            $contraseña="registel";
            $contr= password_hash($contraseña, PASSWORD_BCRYPT);

            $sqlRecuperar="update usuario set contrasena=:contrasena where email=:correo";
            $conexion= $this->ObjLog->getConect();
            $element= $conexion->prepare($sqlRecuperar);
            $element->bindParam(':contrasena', $contr);
            $element->bindParam(':correo', $correo);
            $element->execute();
            $element= null;
        }
        echo json_encode($sqlExisteUs);
    }
    
}

