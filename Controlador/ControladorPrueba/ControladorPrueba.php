<?php
include_once '../Modelo/MasterModel.php';

class ControladorPrueba extends MasterModel{
    
    private $ObjPru;
    private $Obligario;
    
    public function __construct() {
      
        $this->ObjPru= new MasterModel();
        
    }
    public function crear(){
        
        $sqlCaso="select nombre_caso,id_cas_pru from caso_prueba";
        $casPru= $this->ObjPru->getData($sqlCaso);
        
        $sqlModulo="select id_modulo,mod_descripcion from modulo";
        $modulo= $this->ObjPru->getData($sqlModulo);
        
        
        include_once '../Vista/Form_prueba/crear.html.php';
        
    }
    /*private function crearVacio(){
        
        $sqlCaso="select nombre_caso,id_cas_pru from caso_prueba where estado=1";
        $casPru= $this->ObjPru->getData($sqlCaso);
        
        $sqlModulo="select id_modulo,mod_descripcion from modulo";
        $modulo= $this->ObjPru->getData($sqlModulo);
        
        echo'<div id="setAlertPrueb" class="posicion2 width_70">'.
                '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'.
                          'Todos los campos con * son obligatorio, para validar su registro debe estar evaluado por lo menos 1 caso de prueba.'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;'.
                        '</span>'.
                    '</button>'.
                '</div>'.
            '</div>';
        
        include_once '../Vista/Form_prueba/crear.html.php';
        
    }*/
    public function casoPrueba(){
        
        $codigo= $_POST['codigo'];
        $codigoPrueba= $_POST['codigoPrueba'];
        
        $conexion= $this->ObjPru->getConect();
        $sqlElCasoExiste="select dpp.fk_calificacion from detalle_prueba_proceso as dpp where dpp.fk_pru_pro=:codigoPrueba and dpp.fk_cas_pru=:codigoCaso;";
        $casoExiste= $conexion->prepare($sqlElCasoExiste);
        $casoExiste->bindParam(':codigoPrueba', $codigoPrueba);
        $casoExiste->bindParam(':codigoCaso', $codigo);
        $casoExiste->fetchAll(PDO::FETCH_ASSOC);
        $casoExiste->execute();
        $existe=null;
        
        foreach ($casoExiste as $casoExiste){
            $existe= $casoExiste['fk_calificacion'];
        }
        
        if($existe==2){
            
            $investigue= array('operacion'=>2);
            
            echo json_encode($investigue);
            
        }else if($existe==1){
            
            $investigue= array('operacion'=>3);
            
            echo json_encode($investigue);
            
        }else if(!$existe){
            
            $investigue= array('operacion'=>4);
            
            echo json_encode($investigue);
        }
    }
    public function casoPruebaInformacion(){
        
        $codigo= $_POST['codigo'];
        
        $sqlCaso= "select id_cas_pru,nombre_caso from caso_prueba where id_cas_pru like :codigo";
        $nomCas= $this->ObjPru->getData($sqlCaso, $codigo);

        foreach ($nomCas as $nomCaso){

        }

        echo json_encode($nomCaso);
        
    }
    //Function que guarda la prueba como se diseño anteriormente
    public function postCrear(){
        
        //Funcion que define la zona horario para obtener la fecha y hora
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        $fecha_mod= "Sin modificacion";
        
        $usuID= $_SESSION['id_usu'];
                
        if($nomPru= $_POST['nomPru']){
            $nomPru= $_POST['nomPru'];
        }else{
            $nomPru= "Prueba sin nombre"; 
        }
        
        if($modulo= $_POST['modulo']!="#"){
            $modulo= $_POST['modulo'];
        }else{
            $modulo= 42;
        }
        
        if( ($aprobado= $_POST['aprobado']!=null)&&($argumento= $_POST['argumento']) ){
            //if( count($argumento)<count($aprobado) ){
                $aprobado= $_POST['aprobado'];
                $argumento= $_POST['argumento'];
                $idCaso= $_POST['idCasoPrueba'];
                $numID= null;

                $sqlPru= "insert into prueba_proceso values(:numID,:usuID,:modID,:nomPru,:fecCre,:fecMod)";

                $conexion= $this->ObjPru->getConect();

                $elementos= $conexion->prepare($sqlPru);
                $elementos->bindParam(':numID', $numID);
                $elementos->bindParam(':usuID', $usuID);
                $elementos->bindParam(':modID', $modulo);
                $elementos->bindParam(':nomPru', $nomPru);
                $elementos->bindParam(':fecCre', $fecha_cre);
                $elementos->bindParam(':fecMod', $fecha_mod);
                $elementos->execute();
                $elementos= null;

                $numID2= null;

                $lastID= $conexion->lastInsertId();

                for($i=0;$i<count($idCaso);$i++){
                    $sqlDetPru= "insert into detalle_prueba_proceso values(:numID,:lastID,:casPru,:calif,:argumento)";
                    $conexion2= $this->ObjPru->getConect();
                    $element= $conexion2->prepare($sqlDetPru);
                    $element->bindParam(':numID', $numID2);
                    $element->bindParam(':lastID', $lastID);
                    $element->bindParam(':casPru', $idCaso[$i]);
                    $element->bindParam(':calif', $aprobado[$i]);
                    $element->bindParam(':argumento', $argumento[$i]);
                    $element->execute();
                    $element= null;
                }
                $update="update detalle_prueba_proceso set argumento='Sin argumento' where argumento=''";
                $updateArgumento= $this->ObjPru->getData($update);
                //$Exito= new ControladorPrueba();
                //$Exito->listarExitoso();
                redir("index.php?modulo=Prueba&controlador=Prueba&funcion=listar");
            //}else{
                
            //}
        }else{
            $Exito2= new ControladorPrueba();
            $Exito2->crearVacio();
            //redir("index.php?modulo=Prueba&controlador=Prueba&funcion=crearVacio");
        }
            
    }
    public function postCrearDos(){
        
        //Funcion que define la zona horario para obtener la fecha y hora
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        $fecha_mod= "Sin modificacion";
        
        $usuID= $_SESSION['id_usu'];    
        $nomPru= $_POST['nombrePrueba'];
        $modulo= $_POST['modulo'];
        $asociarOpropia= $_POST['asociarOpropia'];
        
        $sqlExistePrueba="select count(*) as total from prueba_proceso where descripcion_pru_pro like :codigo";
        $existePrueba= $this->ObjPru->getData($sqlExistePrueba, $nomPru);
        $estadoPrueba=1;
        
        $laPruebaExiste=null;
        
        foreach ($existePrueba as $existePrueba){
            $laPruebaExiste= $existePrueba['total'];
        }
        
        if($laPruebaExiste==0){
            
            $sqlPru= "insert into prueba_proceso values(:numID,:usuID,:modID,:nomPru,:fecCre,:fecMod,:asociar,:estadoPrueba,:fecha_termiando,:fecha_pausado)";
            
            $conexion= $this->ObjPru->getConect();
            
            $elementos= $conexion->prepare($sqlPru);
            $elementos->bindParam(':numID', $numID);
            $elementos->bindParam(':usuID', $usuID);
            $elementos->bindParam(':modID', $modulo);
            $elementos->bindParam(':nomPru', $nomPru);
            $elementos->bindParam(':fecCre', $fecha_cre);
            $elementos->bindParam(':fecMod', $fecha_mod);
            $elementos->bindParam(':asociar', $asociarOpropia);
            $elementos->bindParam(':estadoPrueba', $estadoPrueba);
            $elementos->bindParam(':fecha_termiando', $fecha_mod);
            $elementos->bindParam(':fecha_pausado', $fecha_mod);
            $elementos->execute();
            $elementos= null;
            
        }
        
        $pruebaExtisteOElIdEs=null;
        $pruebaProcesoDato=null;
        if($laPruebaExiste!=0){
            $pruebaExtisteOElIdEs= array("Dato"=>525);
        }else{
            
            $sqlConsultaPruebaProceso="select id_pru_pro from prueba_proceso where descripcion_pru_pro like :codigo";
            $pruebaProceso= $this->ObjPru->getData($sqlConsultaPruebaProceso, $nomPru);

            foreach ($pruebaProceso as $pruebaProceso){
                $pruebaProcesoDato=  $pruebaProceso['id_pru_pro'];
            }
            
            //$pruebaProcesoDato=  (string)$pruebaProcesoDato;
            
            $pruebaExtisteOElIdEs= array("Dato"=>$pruebaProcesoDato);
            
        }
        
        $jsonPruebaProceso= json_encode($pruebaExtisteOElIdEs);
        
        echo $jsonPruebaProceso;
        
    }
    public function listar(){
        
        $sqlProPru= "select mod_descripcion,id_pru_pro,descripcion_pru_pro,concat(nombre,' ',apellido)as nombre_cpt,fecha_creacion,estadoPrueba from prueba_proceso as pp,usuario as us,modulo as modu "
                    ."where pp.fk_usu=us.id_usu and pp.fk_mod=modu.id_modulo order by id_pru_pro desc";
        
        $proPru= $this->ObjPru->getData($sqlProPru);
        
        include_once '../Vista/Form_prueba/listar.html.php';
        
    }
    /*private function listarExitoso(){
        
        $sqlProPru= "select mod_descripcion,id_pru_pro,descripcion_pru_pro,concat(nombre,' ',apellido)as nombre_cpt,fecha_creacion from prueba_proceso as pp,usuario as us,modulo as modu "
                    ."where pp.fk_usu=us.id_usu and pp.fk_mod=modu.id_modulo order by id_pru_pro desc";
        
        $proPru= $this->ObjPru->getData($sqlProPru);
        
        echo'<div id="setAlertPrueb" class="posicion2 width_70">'.
                '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'.
                          'Prueba registrada exitosamente.'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;'.
                        '</span>'.
                    '</button>'.
                '</div>'.
            '</div>';
        
        include_once '../Vista/Form_prueba/listar.html.php';
        
    }*/
    public function editar(){
        
        $codigo= $_GET['codigo'];
        
        $sqlModulo="select id_modulo,mod_descripcion from modulo";
        $modulo= $this->ObjPru->getData($sqlModulo);
        
        $sqlEditProPru="select id_modulo,id_pru_pro,concat(nombre,' ',apellido) as nombre,descripcion_pru_pro from prueba_proceso as pp,usuario as u,modulo as modu where pp.fk_usu=u.id_usu and pp.fk_mod=modu.id_modulo and id_pru_pro like :codigo";
        $pruPro= $this->ObjPru->getData($sqlEditProPru, $codigo);
        
        $sqlEditDetProPru="select fk_cas_pru,fk_calificacion,nombre_caso,fk_pru_pro from detalle_prueba_proceso as dpp,caso_prueba as cp where dpp.fk_cas_pru=cp.id_cas_pru and fk_pru_pro like :codigo order by id_det_pru_pro";
        $detPruPro= $this->ObjPru->getData($sqlEditDetProPru, $codigo);
        
        $sqlCaso="select nombre_caso,id_cas_pru from caso_prueba where estado=1";
        $casPru= $this->ObjPru->getData($sqlCaso);
        
        include_once '../Vista/Form_prueba/editar.html.php';
        
    }
    public function eliminar(){
        
        $codigo= $_POST['codigo'];
        
        $sqlEliAsoProPru="delete from tbl_asociacion_prueba_caso where fk_pru_pro like :codigo";

        $conexion4= $this->ObjPru->getConect();
        
        $elements= $conexion4->prepare($sqlEliAsoProPru);
        $elements->bindParam(":codigo",$codigo);
        $elements->execute();
        $elements= null;
        
        $selectDetProPru="select count(*) as total from detalle_prueba_proceso where fk_pru_pro like :codigo";
        $cantidaDetProPru= $this->ObjPru->getData($selectDetProPru, $codigo);
        foreach ($cantidaDetProPru as $cantidaDetProPru){
            $cantidadCasosDetProPru= $cantidaDetProPru['total'];
        }
        if($cantidadCasosDetProPru>0){
            $sqlEliDetProPru="delete from detalle_prueba_proceso where fk_pru_pro like :codigo";

            $conexion= $this->ObjPru->getConect();

            $elementos= $conexion->prepare($sqlEliDetProPru);
            $elementos->bindParam(":codigo",$codigo);
            $elementos->execute();
            $elementos= null;
        }
        
        $sqlDelNotificacion="delete from notificacion where fk_pru_pro like :codigo";
        
        $conexion3= $this->ObjPru->getConect();
        
        $elemento= $conexion3->prepare($sqlDelNotificacion);
        $elemento->bindParam(":codigo",$codigo);
        $elemento->execute();
        $elemento= null;
        
        $sqlEliProPru="delete from prueba_proceso where id_pru_pro like :codigo";

        $conexion2= $this->ObjPru->getConect();
        
        $element= $conexion2->prepare($sqlEliProPru);
        $element->bindParam(":codigo",$codigo);
        $element->execute();
        $element= null;
        
    }
    public function postEditar(){
        
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        
        $idPruPro= $_POST['id_pru_pro'];
        $nomPru= $_POST['nomPru'];
        $usuario= $_POST['usuario'];
        $modulo= $_POST['modulo'];
        $idCasoPru= $_POST['idCasoPrueba'];
        $aprobado= $_POST['aprobado'];
        $argumento= $_POST['argumento'];
       
        $delDetProPru= "delete from detalle_prueba_proceso where fk_pru_pro like :codigo";
        $delDetPrupro= $this->ObjPru->getData($delDetProPru, $idPruPro);
        
        $updPruPro= "update prueba_proceso set fk_mod=:modID,fecha_modificacion=:fecha where id_pru_pro like :codigo";
        $conexion= $this->ObjPru->getConect();
        $updPrupro= $conexion->prepare($updPruPro);
        $updPrupro->bindParam(':modID',$modulo);
        $updPrupro->bindParam(':fecha',$fecha_cre);
        $updPrupro->bindParam(':codigo',$idPruPro);
        $updPrupro->execute();
       
        
        $numID=null;
        for($i=0;$i<count($idCasoPru);$i++){
            $intDetPruPro= "insert into detalle_prueba_proceso values(:numID,:pruPro,:casPru,:calif,:argumento)" ;
            $conexion2= $this->ObjPru->getConect();
            $insDetPruPro=$conexion2->prepare($intDetPruPro);
            $insDetPruPro->bindParam(':numID', $numID);
            $insDetPruPro->bindParam(':pruPro', $idPruPro);
            $insDetPruPro->bindParam(':casPru', $idCasoPru[$i]);
            $insDetPruPro->bindParam(':calif', $aprobado[$i]);
            $insDetPruPro->bindParam(':argumento', $argumento[$i]);
            $insDetPruPro->execute();
            $conexion2=null;
        }
        
        $update="update detalle_prueba_proceso set argumento='Sin argumento' where argumento=''";
        $updateArgumento= $this->ObjPru->getData($update);
        
         $conexion=null;
        redir("index.php?modulo=Prueba&controlador=Prueba&funcion=listar");
        
    }
    
    public function casosPorModulo(){
        
        $codigo= $_POST['codigo7'];
        
        $sqlCasoPorModulo="select nombre_caso,id_cas_pru from caso_prueba where estado=1 and fk_modulo like :codigo";
        
        $conexion= $this->ObjPru->getConect();
        $casoPorModulo= $conexion->prepare($sqlCasoPorModulo);
        $casoPorModulo->bindParam(':codigo', $codigo);
        $casoPorModulo->execute();
        
        $casoModulo = array();
        
        while($row=$casoPorModulo->fetch(PDO::FETCH_ASSOC)){
            
            $casoModulo['casoModulo'][] = $row;
         
        }
        
        echo json_encode($casoModulo);
        
    }
    
    public function proseguirPrueba(){
        
        $codigo= $_GET['codigo'];
        
        $sqlProseguirPrueba="select pp.asociacion_propia,pp.id_pru_pro,pp.descripcion_pru_pro,modu.mod_descripcion,modu.id_modulo,pp.fecha_creacion,concat(us.nombre,' ',us.apellido) as nombreCompleto from prueba_proceso pp join usuario us on pp.fk_usu=us.id_usu join modulo modu on pp.fk_mod=modu.id_modulo where pp.id_pru_pro like :codigo";
        $proseguisPrueba= $this->ObjPru->getData($sqlProseguirPrueba, $codigo);
        
        $sqlCaso="select nombre_caso,id_cas_pru from caso_prueba where estado=1";
        $casPru= $this->ObjPru->getData($sqlCaso);
        
        include_once '../Vista/Form_prueba/proseguir.html.php';
        
    }
    
    public function cambiarModo(){
        
        $codigo= $_POST['codigo'];
        $codigoPrueba= $_POST['codigoPrueba'];
        
        if($codigo==1){
            
            $sqlUpdate="update prueba_proceso set asociacion_propia=1 where id_pru_pro like :codigoPrueba";
            $conexion= $this->ObjPru->getConect();
            $elementos= $conexion->prepare($sqlUpdate);
            $elementos->bindParam(':codigoPrueba', $codigoPrueba);
            $elementos->execute();
            
        }else{
            
            $sqlUpdates="update prueba_proceso set asociacion_propia=0 where id_pru_pro like :codigoPrueba";
            $conexion1= $this->ObjPru->getConect();
            $elements= $conexion1->prepare($sqlUpdates);
            $elements->bindParam(':codigoPrueba', $codigoPrueba);
            $elements->execute();
            
        }
        
    }
    
    public function cambiarEstadoDePrueba(){
        
        $codigoEstado= $_POST['codigoEstado'];
        $codigoPrueba= $_POST['codigoPrueba'];
        
        date_default_timezone_set('America/Bogota');
        $fecha_actual= date("Y-m-d H:i:s");
        
        if($codigoEstado==2){
            
            $sqlConsulta="update prueba_proceso set estadoPrueba=:codigoEstado, fecha_pausa=:fecha_pausa where id_pru_pro like :codigoPrueba";
            $conexion= $this->ObjPru->getConect();
            $elemento= $conexion->prepare($sqlConsulta);
            $elemento->bindParam(':codigoEstado', $codigoEstado);
            $elemento->bindParam(':fecha_pausa', $fecha_actual);
            $elemento->bindParam(':codigoPrueba', $codigoPrueba);
            $elemento->execute();
            
        }else if($codigoEstado==3){
            
            $sqlConsulta="update prueba_proceso set estadoPrueba=:codigoEstado, fecha_terminado=:fecha_terminado where id_pru_pro like :codigoPrueba";
            $conexion= $this->ObjPru->getConect();
            $elemento= $conexion->prepare($sqlConsulta);
            $elemento->bindParam(':codigoEstado', $codigoEstado);
            $elemento->bindParam(':fecha_terminado', $fecha_actual);
            $elemento->bindParam(':codigoPrueba', $codigoPrueba);
            $elemento->execute();
            
        }else{
            
            $sqlConsulta="update prueba_proceso set estadoPrueba=:codigoEstado where id_pru_pro like :codigoPrueba";
            $conexion= $this->ObjPru->getConect();
            $elemento= $conexion->prepare($sqlConsulta);
            $elemento->bindParam(':codigoEstado', $codigoEstado);
            $elemento->bindParam(':codigoPrueba', $codigoPrueba);
            $elemento->execute();
            
        }
        
    }
    
    public function editarNombrePrueba(){
        
        $codigoPrueba= $_POST['codigoPrueba'];
        $nombrePrueba= $_POST['nombrePrueba'];
        
        $sqlUpdatenombre="update prueba_proceso set descripcion_pru_pro=:nombrePrueba where id_pru_pro like :codigoPrueba";
        $conexion= $this->ObjPru->getConect();
        $elemento= $conexion->prepare($sqlUpdatenombre);
        $elemento->bindParam(':nombrePrueba',$nombrePrueba);
        $elemento->bindParam(':codigoPrueba', $codigoPrueba);
        $elemento->execute();
        
    }
    
}