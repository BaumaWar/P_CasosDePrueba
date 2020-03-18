<?php
//Inclusion de la clase que contiene la conexion a la base de datos
include_once '../Modelo/MasterModel/MasterModel.php';

class ControladorCaso extends MasterModel{
    //Atributo privado que instanciamos
    private $Objeto="";
    //Funcion constructror que inicializa un objeto en MasterModel
    public function __construct(){
        
        $this->Objeto= new MasterModel();
        
    }//Funcion que muestra el formulario de los casos de pruebas
    public function caso(){
        
        $sqlModulo="select * from modulo";
        $modulo= $this->Objeto->getData($sqlModulo);
        
        include_once '../Vista/Form_caso/crear.html.php';
        
    }//Funcion que registrar un caso de prueba y detalle de caso de prueba
    public function crearCaso(){
        
        $numID= null;
        $nomCaso= $_POST['nomCaso'];
        $descripcion= $_POST['descripcion'];
        $option= $_POST['option'];
        $valEnt= $_POST['valEnt'];
        $preCon= $_POST['preCon'];
        $resEsp= $_POST['resEsp'];
        $posCon= $_POST['posCon'];
        $modulo= $_POST['modulo'];
        $resCaso= $_POST['resultadoCaso'];
                
        $idUsu= $_SESSION['id_usu'];
        //Funcion que define la zona horario para obtener la fecha y hora
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        $fecha_mod= "Sin modificacion";
        
        $conexion= $this->Objeto->getConect();
        
        $sqlCaso= "insert into caso_prueba values(:numID,:option,:idUsu,:nomCaso,:fecCre,:fecMod,:modulo)";
        $elementos= $conexion->prepare($sqlCaso);
        $elementos->bindParam(':numID', $numID);
        $elementos->bindParam(':option', $option);
        $elementos->bindParam(':idUsu', $idUsu);
        $elementos->bindParam(':nomCaso', $nomCaso);
        $elementos->bindParam(':fecCre', $fecha_cre);
        $elementos->bindParam(':fecMod', $fecha_mod);
        $elementos->bindParam(':modulo', $modulo);
        $elementos->execute();
        //Funcion que obtiene el ultimo id isertado con la misma conexion.
        $idLast= $conexion->lastInsertId();
        
        $sqlDetalle= "insert into detalle_caso_prueba values(:numID,:id,:descripcion,:valEnt,:resCaso,:preCon,:resEsp,:posCon)";
        $elementos= $conexion->prepare($sqlDetalle);
        $elementos->bindParam(':numID', $numID);
        $elementos->bindParam(':id', $idLast);
        $elementos->bindParam(':descripcion', $descripcion);
        $elementos->bindParam(':valEnt', $valEnt);
        $elementos->bindParam(':resCaso', $resCaso);
        $elementos->bindParam(':preCon', $preCon);
        $elementos->bindParam(':resEsp', $resEsp);
        $elementos->bindParam(':posCon', $posCon);
        $elementos->execute();
        $elementos= null;
        
    }//Funcion que trae la tabla con los datos de los casos de prueba
    public function listarCaso(){
        
        $sql= "select id_cas_pru,nombre_caso,tip_pru_descripcion from caso_prueba as cp, tipo_prueba as tp where cp.fk_tip_pru=tp.id_tip_pru order by id_cas_pru desc";
        $conSql= $this->Objeto->getData($sql);
        $sqlCasFk="select fk_cas_pru from detalle_prueba_proceso group by fk_cas_pru";
        $sqlFk= $this->Objeto->getData($sqlCasFk);
        
        include_once '../Vista/Form_caso/listar.html.php';
        
    }//Metodo para la optener la informacion en el modal
    public function postListarDetalle(){
        
        $codigo=$_POST['codigo'];
        
        $sql= "select det_descripcion,fecha_creacion,fecha_modificacion,valores_entrada,precondiciones_ejecucion,resultados_esperados,post_condiciones,mod_descripcion,resultado_caso from detalle_caso_prueba as dps,caso_prueba as cs,modulo as modu where dps.fk_cas_pru=cs.id_cas_pru and cs.fk_modulo=modu.id_modulo and fk_cas_pru like :codigo";
        $sqlDetCas= $this->Objeto->getData($sql, $codigo);
        
        foreach ($sqlDetCas as $detalle) {
            
        }
        
        echo json_encode($detalle);
        
    }//Funcion que trae el formulario de editar casos de prueba y captura el codigo para mostrar los datos en el
    public function editarCaso(){
        
        $codigo= $_GET['codigo'];
        
        $sqlModulo="select id_modulo,mod_descripcion from modulo";
        $modulo= $this->Objeto->getData($sqlModulo);
        
        $sql= "select id_det_cas_pru,fk_modulo,fk_cas_pru,det_descripcion,nombre_caso,fk_tip_pru,valores_entrada,precondiciones_ejecucion,resultados_esperados,post_condiciones,resultado_caso "
                    ."from detalle_caso_prueba as dcp, caso_prueba as cp, tipo_prueba as tp "
                        ."where dcp.fk_cas_pru=cp.id_cas_pru and cp.fk_tip_pru=tp.id_tip_pru and fk_cas_pru like :codigo";
        $conEdit= $this->Objeto->getData($sql,$codigo);
        $conEdiCas= $conEdit;
        
        include_once '../Vista/Form_caso/editar.html.php';
        
    }//Funcion que registra el caso de prueba una vez ya sea alla editado
    public function postEditarCaso(){
        
        $idCasPru= $_POST['codigo'];
        $nomCaso= $_POST['nomCaso'];
        $descripcion= $_POST['descripcion'];
        $option= $_POST['option'];
        $valEnt= $_POST['valEnt'];
        $resEsp= $_POST['resEsp'];
        $preCon= $_POST['preCon'];
        $posCon= $_POST['posCon'];
        $modulo= $_POST['modulo'];
        $resultadoCaso= $_POST['resultadoCaso'];
        
        //Funcion que define la zona horario para obtener la fecha y hora
        date_default_timezone_set('America/Bogota');
        $fecha_mod= date("Y-m-d H:i:s");
        
        $conexion= $this->Objeto->getConect();
        
        $sqlPosEdiCas= "update caso_prueba set nombre_caso=:nomCaso, fk_tip_pru=:option, fecha_modificacion=:fecha_mod,fk_modulo=:modulo where id_cas_pru like :idCasPru";
        $elementos= $conexion->prepare($sqlPosEdiCas);
        $elementos->bindParam(':nomCaso', $nomCaso);
        $elementos->bindParam(':option', $option);
        $elementos->bindParam(':fecha_mod', $fecha_mod);
        $elementos->bindParam(':idCasPru', $idCasPru);
        $elementos->bindParam(':modulo', $modulo);
        $elementos->execute();
        
        $sqlPosEdiDet= "update detalle_caso_prueba set det_descripcion=:descripcion,valores_entrada=:valEnt,"
                            ."precondiciones_ejecucion=:preCon,post_condiciones=:posCon,resultados_esperados=:resEsp,resultado_caso=:resCaso where fk_cas_pru like :idCasPru";
        $elementos= $conexion->prepare($sqlPosEdiDet);
        $elementos->bindParam(':descripcion', $descripcion);
        $elementos->bindParam(':idCasPru', $idCasPru);
        $elementos->bindParam(':valEnt', $valEnt);
        $elementos->bindParam(':preCon', $preCon);
        $elementos->bindParam(':posCon', $posCon);
        $elementos->bindParam(':resEsp', $resEsp);
        $elementos->bindParam(':resCaso', $resultadoCaso);
        $elementos->execute();
        $elementos= null;

    }//Funcion que elimina el caso de prueba y el detalle del caso de prueba
    public function eliminarCaso(){
        
        $codigo= $_POST['codigo'];
        
        $conexion4= $this->Objeto->getConect();
        $sqlEliAsoProPru="delete from tbl_asociacion_prueba_caso where fk_cas_pru like :codigo";
        $elementoo= $conexion4->prepare($sqlEliAsoProPru);
        $elementoo->bindParam(':codigo', $codigo);
        $elementoo->execute();
        $elementoo=null;
        
        $conexion3= $this->Objeto->getConect();
        $sqlEliDetProPru="delete from detalle_prueba_proceso where fk_cas_pru like :codigo";
        $elemento= $conexion3->prepare($sqlEliDetProPru);
        $elemento->bindParam(':codigo', $codigo);
        $elemento->execute();
        $elemento=null;
        
        $conexion= $this->Objeto->getConect();
        $sqlEliDet= "delete from detalle_caso_prueba where fk_cas_pru like :codigo";
        $elementos= $conexion->prepare($sqlEliDet);
        $elementos->bindParam(':codigo', $codigo);
        $elementos->execute();
        $elementos=null;
        
        $conexion2= $this->Objeto->getConect();
        $sqlEliCas= "delete from caso_prueba where id_cas_pru like :codigo";
        $element= $conexion2->prepare($sqlEliCas);
        $element->bindParam(':codigo', $codigo);
        $element->execute();
        $element= null;

        
    }
    
    public function asociarCasoPruebaAlaPrueba(){
        
        $idPrueba= $_POST['idPrueba'];
        $codigoCaso= $_POST['codigoCaso'];
        $calificacion= $_POST['calificacion'];
        $argumentoComentarioClave= $_POST['argumentoComentario'];
        $decision= $_POST['decision'];
        
        $argumentoComentario= ($argumentoComentarioClave!=null) ? $argumentoComentarioClave : 'Sin argumento';
        
        //Function que define la zona horario para obtener la fecha y hora.
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        $ID=null;
        $idUsu= $_SESSION['id_usu'];
        
        if($decision== 4){
        
            $sqlInsertCasoPrueba="insert into detalle_prueba_proceso values(:idDetallePruPro,:fkPruPro,:fkCasPru,:fkCalificacion,:argumentoComentario,:fechaAsociacion,:fkUsuAsociador)";
            $conexion= $this->Objeto->getConect();

            $element=$conexion->prepare($sqlInsertCasoPrueba);
            $element->bindParam(':idDetallePruPro', $ID);
            $element->bindParam(':fkPruPro',$idPrueba);
            $element->bindParam(':fkCasPru',$codigoCaso);
            $element->bindParam(':fkCalificacion', $calificacion);
            $element->bindParam(':argumentoComentario', $argumentoComentario);
            $element->bindParam(':fechaAsociacion',$fecha_cre);
            $element->bindParam(':fkUsuAsociador', $idUsu);
            $element->execute();
            
        }else if($decision== 2){
            
            $upDateAsociacion=null;
            if($calificacion==1){
                
                $upDateAsociacion="update tbl_asociacion_prueba_caso as apc set apc.fk_calificado=1, apc.fecha_creacion=:fecha where apc.fk_cas_pru=:codigoCaso and apc.fk_pru_pro=:codigoPrueba";
                $conexion1= $this->Objeto->getConect();
                $elemento= $conexion1->prepare($upDateAsociacion);
                $elemento->bindParam(':fecha', $fecha_cre);
                $elemento->bindParam(':codigoCaso', $codigoCaso);
                $elemento->bindParam(':codigoPrueba', $idPrueba);
                $elemento->execute();
                
            }else if($calificacion==2){
                
                $upDateAsociacion="update tbl_asociacion_prueba_caso as apc set apc.fk_calificado=2, apc.fecha_creacion=:fecha where apc.fk_cas_pru=:codigoCaso and apc.fk_pru_pro=:codigoPrueba";
                $conexion2= $this->Objeto->getConect();
                $elementoo= $conexion2->prepare($upDateAsociacion);
                $elementoo->bindParam(':fecha', $fecha_cre);
                $elementoo->bindParam(':codigoCaso', $codigoCaso);
                $elementoo->bindParam(':codigoPrueba', $idPrueba);
                $elementoo->execute();
                
            }
            
            $deleteCaseTest="delete from detalle_prueba_proceso where fk_cas_pru=:codigoCaso and fk_pru_pro=:codigoPrueba";
            $conexion3= $this->Objeto->getConect();
            $elements= $conexion3->prepare($deleteCaseTest);
            $elements->bindParam(':codigoCaso', $codigoCaso);
            $elements->bindParam(':codigoPrueba', $idPrueba);
            $elements->execute();
            
            $sqlInsertCasoPrueba="insert into detalle_prueba_proceso values(:idDetallePruPro,:fkPruPro,:fkCasPru,:fkCalificacion,:argumentoComentario,:fechaAsociacion,:fkUsuAsociador)";
            $conexion= $this->Objeto->getConect();
            
            $element=$conexion->prepare($sqlInsertCasoPrueba);
            $element->bindParam(':idDetallePruPro', $ID);
            $element->bindParam(':fkPruPro',$idPrueba);
            $element->bindParam(':fkCasPru',$codigoCaso);
            $element->bindParam(':fkCalificacion', $calificacion);
            $element->bindParam(':argumentoComentario', $argumentoComentario);
            $element->bindParam(':fechaAsociacion',$fecha_cre);
            $element->bindParam(':fkUsuAsociador', $idUsu);
            $element->execute();
            
        }
        
    }
    
    public function asociarCasoPruebaALaPruebaAFuturo(){
        
        $codigoCaso= $_POST['codigoCaso'];
        $codigoPrueba= $_POST['codigoPrueba'];
        $usuarioID= $_SESSION['id_usu'];
        $ID=null;
        $cero=2;
        //Function que define la zona horario para obtener la fecha y hora.
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        
        $sqlInsertAsociarCasoPrueba="insert into tbl_asociacion_prueba_caso values(:pk_aso_pru_cas,:fk_pru_pro,:fk_cas_pro,:fk_usu,:fecha,:yaCalifico)";
        
        $conexion= $this->Objeto->getConect();
        $element= $conexion->prepare($sqlInsertAsociarCasoPrueba);
        $element->bindParam(':pk_aso_pru_cas',$ID);
        $element->bindParam(':fk_pru_pro',$codigoPrueba);
        $element->bindParam(':fk_cas_pro', $codigoCaso);
        $element->bindParam(':fk_usu', $usuarioID);
        $element->bindParam(':fecha', $fecha_cre);
        $element->bindParam(':yaCalifico', $cero);
        $element->execute();
        
    }
    
    public function asociarCasoPruebaALaPruebaAFuturoTodos(){
        
        $codigoPrueba= $_POST['codigoPrueba'];
        $modulo= $_POST['modulo'];
        $usuarioID= $_SESSION['id_usu'];
        $ID=null;
        $cero=2;
        //Function que define la zona horario para obtener la fecha y hora.
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d H:i:s");
        
        $sqlCasosPrueba="select id_cas_pru from caso_prueba where fk_modulo like :codigo";
        $casosPrueba= $this->Objeto->getData($sqlCasosPrueba, $modulo);
        
        foreach($casosPrueba as $casosPrueba){
            
            $insertAllCaseTest="insert into tbl_asociacion_prueba_caso values(:fk_aso_pru_cas,:fk_pru_pro,:fk_cas_pru,:fk_usu,:fecha_creacion,:yaCalifico)";
            $conexion= $this->Objeto->getConect();
            $element= $conexion->prepare($insertAllCaseTest);
            $element->bindParam(':fk_aso_pru_cas', $ID);
            $element->bindParam(':fk_pru_pro', $codigoPrueba);
            $element->bindParam(':fk_cas_pru', $casosPrueba['id_cas_pru']);
            $element->bindParam(':fk_usu', $usuarioID);
            $element->bindParam(':fecha_creacion', $fecha_cre);
            $element->bindParam(':yaCalifico', $cero);
            $element->execute();
            
        }
        
    }
    
    public function eliminarCasoDePruebaAsociado(){
        
        $codigoQueHacer=$_POST['codigoQueHacer'];
        $codigoCaso= $_POST['codigoCaso'];
        $codigoPrueba= $_POST['codigoPrueba'];
            
        if($codigoQueHacer==1){
            
            $sqlEliminarCaso="delete from tbl_asociacion_prueba_caso where fk_cas_pru=:codigoCaso and fk_pru_pro=:codigoPrueba";
            $conexion= $this->Objeto->getConect();
            $element= $conexion->prepare($sqlEliminarCaso);
            $element->bindParam(':codigoCaso', $codigoCaso);
            $element->bindParam(':codigoPrueba', $codigoPrueba);
            $element->execute();
            
        }else if($codigoQueHacer==3){
            
            $sqlEliminarCaso="delete from tbl_asociacion_prueba_caso where fk_cas_pru=:codigoCaso and fk_pru_pro=:codigoPrueba";
            $conexion2= $this->Objeto->getConect();
            $element2= $conexion2->prepare($sqlEliminarCaso);
            $element2->bindParam(':codigoCaso', $codigoCaso);
            $element2->bindParam(':codigoPrueba', $codigoPrueba);
            $element2->execute();
            
            $deleteFromDetalle="delete from detalle_prueba_proceso where fk_pru_pro=:codigoPrueba and fk_cas_pru=:codigoCaso";
            $conexion1= $this->Objeto->getConect();
            $elemento= $conexion1->prepare($deleteFromDetalle);
            $elemento->bindParam(':codigoPrueba', $codigoPrueba);
            $elemento->bindParam(':codigoCaso', $codigoCaso);
            $elemento->execute();
            
        }
    }
    
    public function casosDePruebaAsociado(){
        
        $codigoPrueba= $_POST['codigoPrueba'];
      
        $sqlCasoAsociado="select fk_cas_pru,nombre_caso from tbl_asociacion_prueba_caso apc join caso_prueba cp on apc.fk_cas_pru=cp.id_cas_pru where apc.fk_calificado=2 and apc.fk_pru_pro like :pruebaProceso";
        $conexion= $this->Objeto->getConect();
        $elemento= $conexion->prepare($sqlCasoAsociado);
        $elemento->bindParam(':pruebaProceso',$codigoPrueba);
        $elemento->execute();
        
        $asociarCaso= array();
        
        while($row=$elemento->fetch(PDO::FETCH_ASSOC)){
            
            $asociarCaso['asociado'][] = $row;
         
        }
        
        echo json_encode($asociarCaso);
        
       
    }
    
}