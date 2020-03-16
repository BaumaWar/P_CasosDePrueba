<?php
    //Sesion start
    session_start();

    //Funcion que redireciona, util para los metodos del controlador.
    function redir($Url){

        echo "<script language='javascript'>"."window.location.href='$Url';"."</script>";

    }
    function verDato($codigo){
        echo"<script language='javascript'>"."alert('$codigo');"."</script>";
    }
    //Funcion que redireciona, util para el action en el formulario.
    function setUrl($modulo,$controlador,$funcion,$ajax=false){
        
        //Variable contiene la ip o dominio del servidor.
        $servidor= null;
        
        if($ajax){
            $pagina="ajax";
        }else{
            $pagina="index";
        }
        if($servidor==null){
            $Url= "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        }else{
            $Url= "$servidor/$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        }
        
        return $Url;
    }//Funcion que optiene los datos de la url y redireciona al controlador.
    function getUrl(){
        
        $modulo= $_GET['modulo'];
        $controlador= $_GET['controlador'];
        $funcion= $_GET['funcion'];
        
        if(!empty($_SESSION['usu_nombre'])){
            if((isset($modulo))&&(isset($controlador))&&(isset($funcion))){

                if("../Controlador/Controlador".$modulo){

                    if("../Controlador/Controlador".$modulo."/Controlador".$controlador.".php"){
                        
                        if(include_once "../Controlador/Controlador".$modulo."/Controlador".$controlador.".php"){

                            $ClaseControler= "Controlador".$controlador;

                            $Objet= new $ClaseControler();

                            if(method_exists($ClaseControler, $funcion)){
                                   $Objet->$funcion();
                            }else{
                               $Url= "index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
                               redir($Url);
                            }
                            
                        }else{
                            $Url= "index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
                            redir($Url);
                        }
                    }else{
                       $Url= "index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
                        redir($Url);
                    }

                }else{
                    $Url= "index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
                    redir($Url);
                }

            }else{
               $Url= "index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
               redir($Url);
            }
        }else{
            echo"<script>"."window.location.href='../index.php'"."</script>";
        }

    }
    function getUrlII(){

        $modulo= $_GET['modulo'];
        $controlador= $_GET['controlador'];
        $funcion= $_GET['funcion'];
        
        if((isset($modulo))&&(isset($controlador))&&(isset($funcion))){

            if("Controlador/Controlador".$modulo){

                if("Controlador/Controlador".$modulo."/Controlador".$controlador.".php"){

                    if(include_once "Controlador/Controlador".$modulo."/Controlador".$controlador.".php"){

                    $ClaseControler= "Controlador".$controlador;

                    $Objet= new $ClaseControler();

                    if(method_exists($ClaseControler, $funcion)){
                           $Objet->$funcion();
                    }else{
                        echo "ERROR 777 funcion";
                    }
                    
                    }else{
                        $Url= "Web/index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
                        redir($Url);
                    }

                }else{
                   echo "ERROR 777 Controlador";
                }

            }else{
                echo "ERROR 777 Modulo";
            }

        }else{
            
           if(!empty($_SESSION['id_usu'])){
               $Url= "Web/index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio";
               redir($Url);
           }else{
                $Url= "index.php?modulo=Usuario&controlador=Login&funcion=login";
                redir($Url);
           }
           
        }
      
    }