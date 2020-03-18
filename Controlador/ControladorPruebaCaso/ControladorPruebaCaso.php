<?php
require_once '../Modelo/ModelPruebaCaso/ModelPruebaCaso.php';

class ControladorPruebaCaso{
    
    private $ObjModel;
    
    public function __construct() {
        $this->ObjModel= new ModelPruebaCaso();
    }
    
    public function vistaFormularioPruebaCasoCrear(){
        
        $modulo= $this->ObjModel->sqlSelectModulos();
        $usuario= $this->ObjModel->sqlSelectUsuarios();
        date_default_timezone_set('America/Bogota');
        $fecha_cre= date("Y-m-d");

        require_once '../Vista/FormularioPruebaCaso/crear.html.php';
        
    }
    
    public function guardarPruebaCasoPrueba(){
        
    }
    
}

