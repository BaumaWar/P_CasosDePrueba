<?php
//Clase que contiene la conexion a la base de datos y metodos que la consultan.
class MasterModel{
    //Funcion que optiene la conexion de la base de datos.
    public function getConect(){
        
        $dbname= "proyecto_casosprueba";
        $user= "root";
        $password= "diseno&desarrollo";
        $host= "localhost";
        
        $conexion= new PDO("mysql:host=$host;dbname=$dbname;",$user,$password);
        return $conexion;
        
    }
    //Funcion que recibe una consulta sql, un codigo y retorna los datos optenidos en la consulta.
    public function getData($sql,$codigo=false){
        
        if ($codigo==false){
            $filas= null;
            $conexion= $this->getConect();
            $elementos= $conexion->prepare($sql);
            $elementos->fetchAll(PDO::FETCH_ASSOC);
            $elementos->execute();
            $filas= $elementos;
            return $filas;
            $filas= null;
            
        }else{
            $filas= null;
            $conexion= $this->getConect();
            $elementos= $conexion->prepare($sql);
            $elementos->bindParam(':codigo', $codigo);
            $elementos->fetchAll(PDO::FETCH_ASSOC);
            $elementos->execute();
            $filas= $elementos;
            return $filas;
            $filas= null;
        }
            
    }
     
}