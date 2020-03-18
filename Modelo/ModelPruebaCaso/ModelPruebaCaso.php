<?php
require_once '../Modelo/MasterModel/MasterModel.php';

class ModelPruebaCaso extends MasterModel{
    
    private $ObjeMasterModel;
    
    public function __construct() {
        
        $this->ObjeMasterModel= new MasterModel();
        
    }
    
    public function sqlSelectModulos(){
        
        $sql= "select * from modulo";
        $sqlSelectModulo= $this->ObjeMasterModel->getData($sql);
        return $sqlSelectModulo;
        
    }
    
    
    
}