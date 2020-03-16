<?php

include_once '../Modelo/MasterModel.php';

class ControladorUsuario extends MasterModel{
    
    private $ObjUsu;
    
    public function __construct(){
    
        $this->ObjUsu= new MasterModel();
    
    }
    public function crear(){

        include_once '../Vista/Form_usuario/crear.html.php';

    }// Este no
    public function postCrear(){

        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $telefono= $_POST['telefono'];
        $tipDoc= $_POST['tipDoc'];
        $correo= $_POST['correo'];
        $clave= $_POST['password'];
        $documento= $_POST['documento'];
        $numID= null;

        $contr= password_hash($clave, PASSWORD_BCRYPT);

        $sql= "insert into usuario values(:numID,:nombre,:apellido,:documento,:tipDoc,:correo,:telefono,:clave)";

        $conexion= $this->ObjUsu->getConect();

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
    public function editar(){
        
        $codigo= $_SESSION['id_usu'];
        
        $sqlUsu= "select * from usuario where id_usu like :codigo";
        $conUsu= $this->ObjUsu->getData($sqlUsu, $codigo);
        
        $sqlTipDoc= "select * from tipo_documento";
        $conTip= $this->ObjUsu->getData($sqlTipDoc);
        include_once '../Vista/Form_usuario/editar.html.php';
        
    }
    public function postEditar(){
        
        $codigo= $_SESSION['id_usu'];
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $tipDoc= $_POST['tipDoc'];
        $numDoc= $_POST['numDoc'];
        $telefono= $_POST['telefono'];
        
        /*if(){
            $sqlExiteNumDocumento="select count(*) as totalDoc from usuario where num_documento like :codigo";
            $existeNumDocumento= $this->ObjLog->getData($sqlExiteNumDocumento, $numDoc);
            foreach ($existeNumDocumento as $existeNumDocumento){
                $totalDoc=$existeNumDocumento['totalDoc'];
            }
        }else{
            
        }*/
        
        $sqlEdiUsu= "update usuario set nombre=:nombre, apellido=:apellido, fk_tip_doc=:tipDoc, num_documento=:numDoc, telefono=:telefono where id_usu like :codigo";
        $conexion= $this->ObjUsu->getConect();
        $element= $conexion->prepare($sqlEdiUsu);
        $element->bindParam(':nombre', $nombre);
        $element->bindParam(':apellido', $apellido);
        $element->bindParam(':tipDoc', $tipDoc);
        $element->bindParam(':numDoc', $numDoc);
        $element->bindParam(':telefono', $telefono);
        $element->bindParam(':codigo', $codigo);
        $element->execute();
              
    }
    public function infUsuario(){
        
        $codigo= $_SESSION['id_usu'];
        
        $sqlUsuEdi= "select nombre,apellido,tip_doc_descripcion,email,telefono,num_documento from usuario as u,tipo_documento as td where u.fk_tip_doc=td.id_tip_doc and id_usu like :codigo";
        $infUsu= $this->ObjUsu->getData($sqlUsuEdi, $codigo);
        
        include_once '../Vista/Form_usuario/inf_usu.html.php';
        
    }
    public function editarDatosAcceso(){
        
        $codigo= $_SESSION['id_usu'];
        $sql= "select email from usuario where id_usu like :codigo";
        $sqlCorreo= $this->ObjUsu->getData($sql, $codigo);
        
        include_once '../Vista/Form_usuario/editarDatosAcceso.html.php';
        
    }
    public function posteditarDatosAcceso(){
        
        $codigo= $_SESSION['id_usu'];
        $correo= $_POST['email'];
        $password= $_POST['password'];
        
        $sqlexiste="select count(*) as total from usuario where id_usu!=:codigo and email=:email";
        $conexion= $this->ObjUsu->getConect();
        $existe= $conexion->prepare($sqlexiste);
        $existe->bindParam(':codigo', $codigo);
        $existe->bindParam(':email', $correo);
        $existe->fetchAll(PDO::FETCH_ASSOC);
        $existe->execute();
        
        foreach ($existe as $existe){
            $corExi= $existe['total'];
        }
        
        if($corExi==0){
        
            $clave= password_hash($password, PASSWORD_BCRYPT);

            $sqlDatAcc= "update usuario set email=:correo, contrasena=:clave where id_usu like :codigo";

            $conexion= $this->ObjUsu->getConect();
            $elementos= $conexion->prepare($sqlDatAcc);
            $elementos->bindParam(':correo', $correo);
            $elementos->bindParam(':clave', $clave);
            $elementos->bindParam(':codigo', $codigo);
            $elementos->execute();
            
        }
        
        echo json_encode($existe);
        
    }
    
}