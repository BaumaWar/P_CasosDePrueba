<?php
include_once '../Modelo/MasterModel/MasterModel.php';
class ControladorGrafica extends MasterModel{
    
    private $Objecto;
    public function __construct() {
        $this->Objecto = new MasterModel();
    }

    public function grafica(){
        // GRAFICA LIQUIDACION
        // SQL para obtener la fecha de la ultima prueba
        $sqlGLiquidacion= "select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=1";
        $GLiquidacion= $this->Objecto->getData($sqlGLiquidacion);
        $FecLiquidacion=null;
        foreach ($GLiquidacion as $GLiquidacion){
            $FecLiquidacion=$GLiquidacion['fecha'];
        }
        // SQL para obtener las calificaciones
        $sqlGLiquidacionCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=1 and pp.fecha_creacion='$FecLiquidacion'";
        $GLiquidacionCalificacion= $this->Objecto->getData($sqlGLiquidacionCalificacion);
        // ----------------------------------------------------------------------
        // GRAFICA RASTREO
        // SQL para obtener la fecha de la ultima prueba
        $sqlGRastreo="select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=2";
        $GRastreo= $this->Objecto->getData($sqlGRastreo);
        foreach ($GRastreo as $GRastreo){
            $FecRastreo= $GRastreo['fecha'];
        }
        // SQL para obtener las calificaciones
        $sqlGRastreoCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=2 and pp.fecha_creacion='$FecRastreo'";
        $GRastreoCalificacion= $this->Objecto->getData($sqlGRastreoCalificacion);
        // ----------------------------------------------------------------------
        // GRAFICA DESCAPCHO
        // SQL para obtener la fecha de la ultmina prueba
        $sqlGDespacho="select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=3";
        $GDespacho= $this->Objecto->getData($sqlGDespacho);
        foreach ($GDespacho as  $GDespacho){
            $fecDespacho= $GDespacho['fecha'];
        }
        // SQL para obtener las calificaciones
        $sqlGDespachoCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=3 and pp.fecha_creacion='$fecDespacho'";
        $GDespachoCalificacion= $this->Objecto->getData($sqlGDespachoCalificacion);
        // ----------------------------------------------------------------------
        // GRAFICA USUARIO
        // SQL para obtener la fecha de la ultima prueba
        $sqlGUsuario="select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=5";
        $GUsuario= $this->Objecto->getData($sqlGUsuario);
        foreach ($GUsuario as $GUsuario){
            $fecUsuario= $GUsuario['fecha'];
        }
        // SQL para obtenr las calificaciones
        $sqlGUsuarioCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=5 and pp.fecha_creacion='$fecUsuario'";
        $GUsuarioCalificacion= $this->Objecto->getData($sqlGUsuarioCalificacion);
        // ----------------------------------------------------------------------
        // GRAFICA REPORTE
        //SQL para obtener la fecha de la ultima prueba
        $sqlGReporte="select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=4";
        $GReporte= $this->Objecto->getData($sqlGReporte);
        foreach ($GReporte as $GReporte){
            $fecReporte= $GReporte['fecha'];
        }
        // SQL para obtener las calificaciones
        $sqlGReporteCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=4 and pp.fecha_creacion='$fecReporte'";
        $GReporteCalificacion= $this->Objecto->getData($sqlGReporteCalificacion);
        // ----------------------------------------------------------------------
        // GRAFICA VEHICULO
        // SQL para obtener la fecha de la ultima prueba
        $sqlGVehiculo="select max(pp.fecha_creacion) as fecha from prueba_proceso as pp where pp.fk_mod=9";
        $GVehiculo= $this->Objecto->getData($sqlGVehiculo);
        foreach($GVehiculo as $GVehiculo){
            $fecVehiculo= $GVehiculo['fecha'];
        }
        // SQL para obtener las calificaciones
        $sqlGVehiculoCalificacion="select dpp.fk_calificacion from detalle_prueba_proceso as dpp join prueba_proceso as pp on dpp.fk_pru_pro=pp.id_pru_pro where pp.fk_mod=9 and pp.fecha_creacion='$fecVehiculo'";
        $GVehiculoCalificacion= $this->Objecto->getData($sqlGVehiculoCalificacion);
        
        include_once '../Vista/Form_grafica/crear.html.php';
        
    }
    public function estado(){
        
        $sqlModulo="select * from modulo";
        $modulo= $this->Objecto->getData($sqlModulo);
        
        include_once '../Vista/Form_grafica/estado.html.php';
        
    }
    public function consultarEstadoGrfica(){
        verDato("llego");
    }
    
}

