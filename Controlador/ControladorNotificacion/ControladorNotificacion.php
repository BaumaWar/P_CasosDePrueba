<?php
include_once '../Modelo/MasterModel.php';

class ControladorNotificacion{
    
    private $Objeto;
    
    public function __construct(){
        
        $this->Objeto=  new MasterModel();
        
    }
    
    public function crear(){
        
        $sqlUsu="select id_usu,nombre,apellido from usuario";
        $sqlUsuario= $this->Objeto->getData($sqlUsu);
        
        $sqlPru="select id_pru_pro,descripcion_pru_pro from prueba_proceso order by id_pru_pro desc";
        $sqlPrueba= $this->Objeto->getData($sqlPru);
        
        include_once '../Vista/Form_notificacion/crear.html.php';
        
    }
    
    public function crearExitoso(){
        
        $sqlUsu="select id_usu,nombre,apellido from usuario";
        $sqlUsuario= $this->Objeto->getData($sqlUsu);
        
        $sqlPru="select id_pru_pro,descripcion_pru_pro from prueba_proceso";
        $sqlPrueba= $this->Objeto->getData($sqlPru);
        
        echo'<div id="setAlertPrueb" class="posicion2 width_70">'.
                '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'.
                          'Notificacion exitosa'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;'.
                        '</span>'.
                    '</button>'.
                '</div>'.
            '</div>';
        
        include_once '../Vista/Form_notificacion/crear.html.php';
        
    }
    
    public function crearVacio(){
        
        $sqlUsu="select id_usu,nombre,apellido from usuario";
        $sqlUsuario= $this->Objeto->getData($sqlUsu);
        
        $sqlPru="select id_pru_pro,descripcion_pru_pro from prueba_proceso";
        $sqlPrueba= $this->Objeto->getData($sqlPru);
        
        echo'<div id="setAlertPrueb" class="posicion2 width_70">'.
                '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'.
                          'Todos los campos con * son obligatorio.'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;'.
                        '</span>'.
                    '</button>'.
                '</div>'.
            '</div>';
        
        include_once '../Vista/Form_notificacion/crear.html.php';
        
    }
    
    public function pruebaDesarrollada(){
        
        $codigo= $_POST['codigo'];
        
        $sqlPru="select concat(nombre,' ',apellido) as nombreCompleto,mod_descripcion,fecha_creacion "
                . "from prueba_proceso as pp join modulo as modu on pp.fk_mod=modu.id_modulo join usuario as u on pp.fk_usu=u.id_usu "
                . "where id_pru_pro like :codigo";
        $sqlPrueba= $this->Objeto->getData($sqlPru, $codigo);
        
        foreach ($sqlPrueba as $sqlPrueba){}
        
        echo json_encode($sqlPrueba);
        
    }
    
    public function usuarioNotificado(){
        
        $codigo= $_POST['codigo'];
        
        $sqlUsuario="select id_usu,concat(nombre,' ',apellido) as nombreCompleto,email from usuario where id_usu like :codigo";
        $sqlUsuarioNotificado= $this->Objeto->getData($sqlUsuario, $codigo);
        
        foreach ($sqlUsuarioNotificado as $sqlUsuarioNotificado){}
        
        echo json_encode($sqlUsuarioNotificado);
    }
    
    public function postCrear(){
        
        $usuarioNotificado= $_POST['usuarioNotificado'];
        $pruebaNotificacion= $_POST['pruebaNotificacion'];
        $usuarioEmisor= $_SESSION['id_usu'];
        $correo= $_POST['correo'];
        
        //Funcion que define la zona horario para obtener la fecha y hora
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        $estado=1;
        $visto="No visto";
        $ledio="No leido";
        $numID=null;
        
        if(($pruebaNotificacion!="#")&&($usuarioNotificado)){
            
            for($i=0; $i<count($usuarioNotificado); $i++){
                $sqlNotificacion="insert into notificacion values(:numID,:usuNoti,:pru,:usuEmisor,:fechCre,:estado,:visto,:leido)";
                $conexion= $this->Objeto->getConect();
                $sqlInsNot= $conexion->prepare($sqlNotificacion);
                $sqlInsNot->bindParam(':numID', $numID);
                $sqlInsNot->bindParam(':usuNoti', $usuarioNotificado[$i]);
                $sqlInsNot->bindParam(':pru', $pruebaNotificacion);
                $sqlInsNot->bindParam(':usuEmisor', $usuarioEmisor);
                $sqlInsNot->bindParam(':fechCre', $fecha_cre);
                $sqlInsNot->bindParam(':estado', $estado);
                $sqlInsNot->bindParam(':visto', $visto);
                $sqlInsNot->bindParam(':leido', $ledio);
                $sqlInsNot->execute();
                $sqlInsNot=null;
            }
            
            $sqlPrueba="select descripcion_pru_pro, concat(nombre,' ',apellido) as nombreCompleto from prueba_proceso pp join usuario u on pp.fk_usu=u.id_usu where pp.id_pru_pro like :codigo";
            $sqlNomPru= $this->Objeto->getData($sqlPrueba, $pruebaNotificacion);
            foreach ($sqlNomPru as $NomPru){}
            
            for($j=0; $j<count($correo);$j++){
            
                $para= $correo[$j];
                $titulo= "Prueba de software desarrollada.";
                $mensaje="Nombre de la prueba: ".$NomPru['descripcion_pru_pro']."\r\n"
                        . "Realizada por: ".$NomPru['nombreCompleto'];
                
                mail($para, $titulo, $mensaje);
            
            }
            
            redir("index.php?modulo=Notificacion&controlador=Notificacion&funcion=crearExitoso");
        
        }else{
            redir("index.php?modulo=Notificacion&controlador=Notificacion&funcion=crearVacio");
        }
        
    }
    
    public function listar(){
        
        include_once '../Vista/Form_notificacion/listar.html.php';
        
    }
    //Funcion de las notificaiones en la campanita
    public function consultaNotificacion(){
        
        $codigo=$_POST['codigo2'];
        
        $sqlNotiUsu="select id_notificacion,fecha_leido,noti.fk_pru_pro,concat(recep.nombre,' ',recep.apellido) as nomReceptor, concat(emis.nombre,' ',emis.apellido) as nomEmisor, descripcion_pru_pro, timestampdiff(MONTH,noti.fecha_creacion, now()) as mes,timestampdiff(day,noti.fecha_creacion, now()) as dias,timestampdiff(hour,noti.fecha_creacion, now()) as horas, noti.fecha_creacion "
                . "from notificacion noti join usuario recep on noti.fk_usu_receptor=recep.id_usu join usuario emis on noti.fk_usu_emisor=emis.id_usu join prueba_proceso pp on noti.fk_pru_pro=pp.id_pru_pro where estado=1 and recep.id_usu='$codigo' order by fecha_creacion asc";
        $conexion= $this->Objeto->getConect();
        $sqlNotifi= $conexion->prepare($sqlNotiUsu);
        $sqlNotifi->bindParam(':codigo', $codigo);
        $sqlNotifi->execute();
        
        $userDataNoti = array();
 
        while($row=$sqlNotifi->fetch(PDO::FETCH_ASSOC)){

            $userDataNoti['Notificacion'][] = $row;
         
        }
        
        echo json_encode($userDataNoti);
        
    }
    
    public function notificacionPorTiempo(){
        
        $codigo=$_POST['codigo3'];
        
        $sqlNotiTiempo="select count(*) as total from notificacion where fecha_visto='No visto' and estado=1 and fk_usu_receptor like :codigo";
        $notiTiempo= $this->Objeto->getData($sqlNotiTiempo, $codigo);
        
        foreach ($notiTiempo as $notiTiempo){
            
        }
        
        echo json_encode($notiTiempo);
        
    }
    
    public function notificacionLeida(){
        
        $codigo=$_POST['codigo4'];
        
        $sqlLeido="update notificacion set fecha_leido=now() where id_notificacion like :codigo";
        $conexion= $this->Objeto->getConect();
        $elemetos= $conexion->prepare($sqlLeido);
        $elemetos->bindParam(':codigo', $codigo);
        $elemetos->execute();
        
    }
    
    public function notificacionesVistas(){
        
        $codigo=$_POST['codigo5'];
        
        $sqlVisto="update notificacion set fecha_visto=now() where fecha_visto='No visto' and fk_usu_receptor like :codigo";
        $Visto= $this->Objeto->getData($sqlVisto, $codigo);
        
    }
    
    public function noVerMasNotificaciones(){
        
        $codigo= $_POST['codigo6'];
        
        $sqlNoNoti="update notificacion set estado=0 where id_notificacion like :codigo";
        $noVerMas= $this->Objeto->getData($sqlNoNoti, $codigo);
        
    }
    
}