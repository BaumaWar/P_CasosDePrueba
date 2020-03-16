<?php

    include_once '../../../Modelo/MasterModel.php';
    $codigo=$_GET['codigo'];
    $Obje= new MasterModel();
    $sqlNombre="select fecha_creacion,descripcion_pru_pro,concat(nombre,' ',apellido) as nombre from prueba_proceso pru join usuario usu on pru.fk_usu=usu.id_usu where id_pru_pro like :codigo";
    $sqlNomFec= $Obje->getData($sqlNombre,$codigo);
    $sqlcasoCal="select fk_calificacion,nombre_caso,argumento from detalle_prueba_proceso dpp join caso_prueba cp on dpp.fk_cas_pru=cp.id_cas_pru where fk_pru_pro like :codigo";
    $casoCal= $Obje->getData($sqlcasoCal, $codigo);
    $sqlModulo="select mod_descripcion from prueba_proceso pp join modulo modu on pp.fk_mod=modu.id_modulo where id_pru_pro like :codigo";
    $modulo= $Obje->getData($sqlModulo, $codigo);
    
    ob_start();
    
?>
<!--<page backtop="15mm" backbottom="15mm" backleft="20mm" backright="30mm">
    
    <style>
        table{
            font-size: 12px;
            border: 1px solid;
            border-collapse: collapse;
            height: 650px;
            margin-right: 120px;
        }
        td,th{
            border: 1px solid;
            border-collapse: collapse;
        }
        .aprobado{
            height: 10px;
        }
        .caso{
            padding: 3px;
        }
        
    </style>
    #00BBEE
    <page_header>
        <label style="position: absolute; left: 298px; font-size: 13px;">REPORTE PRUEBA DE SOFTWARE</label>
        <div style="position: absolute; top:30px; left: 75px; border: 2px solid #B1D4E8; background-color: #B1D4E8; width: 645px;"></div>
    </page_header>-->
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Pruebas Registel</title>
        
        <!--<link language="css" rel="stylesheet" href="./Web/css/datatables.min.css?<?php //echo rand(0, 9999); ?>"/>-->
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap-grid.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap-grid.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap-reboot.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap-reboot.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/width_Form.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/iconos.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/botones.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/Font-style.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="../../../Web/css/reportes.css?<?php echo rand(0, 9999); ?>">
        
    </head>
    <body class="rebosar" style="background-color: #525659; ">
        <div style="margin: 60px;"></div>
        <div align="center">
            <div class="border blanco"  style="width: 750px; padding-top:15px; padding-bottom: 50px;">
                <div class="blanco width_tamañoHoja">
                
                <label style="padding-top: 10px; font-size: 13px; font-weight: 500;">REPORTE PRUEBA DE SOFTWARE</label>
            <div style="position: relative; top:8px; border: 2px solid #B1D4E8; background-color: #B1D4E8; width: 645px;"></div>
    <?php
    echo'<table class="tablaReportePrueba">';
            echo'<thead>';
                foreach ($sqlNomFec as $sqlNomFec){
                echo'<tr>';
                        echo'<th class="borderCollapse" colspan="4" align="justify" style="font-weight: 500; border-top:hidden; border-bottom:hidden; border-left:hidden; border-right:hidden; padding-bottom:10px; font-size:13px;">';
                                echo'Nombre de la prueba: ';
                                echo $sqlNomFec['descripcion_pru_pro'];
                        echo'</th>';
                echo'</tr>';
                echo'<tr style="font-size:13px;">';
                echo'<th class="borderCollapse" colspan="3" style="font-weight: 500; border-top: hidden; border-bottom: hidden; border-left: hidden; border-right: hidden; padding-bottom: 10px;">';
                            echo'Fecha de creacion: ';
                                echo $sqlNomFec['fecha_creacion'];
                        echo'<span style="position: relative; left:165px;">';
                            echo 'Fecha de impresion: ';
                                date_default_timezone_set('America/Bogota');
                                $fecha_cre= date("Y-m-d H:i:s");
                                echo $fecha_cre;
                        echo'</span>';
                echo'</th>';
            echo'</tr>';
            echo'<tr style="font-size:13px;">';
                echo'<th class="borderCollapse" colspan="3" style="width: 650px; font-weight: 500; border-top: hidden; border-left: hidden; border-right: hidden; border-bottom:hidden; padding-bottom: 10px;">';
                    echo'Reponsable: ';
                            echo $sqlNomFec['nombre'];
                            }
                    echo'</th>';
                echo'</tr>';
                foreach ($modulo as $modulo){
                echo'<tr style="font-size:13px;">';
                echo'<th class="borderCollapse" colspan="3" style="font-weight: 500; border-top: hidden; border-left: hidden; border-right: hidden; padding-bottom: 20px;">';
                    echo'Modulo: ';
                    
                        echo $modulo['mod_descripcion'];
                    
                    echo'</th>';
                echo'</tr>';
                }
                echo'<tr style="text-align: center; font-size:12px;">';
                    echo'<th  class="borderCollapse" colspan="3" style="background-color: #B1D4E8; font-weight: 500; padding: 5px;">CASOS DE PRUEBA EVALUADOS</th>';
                echo'</tr>';
                echo'<tr>';
                    echo'<th class="borderCollapse" style="width:25px; font-weight: 500; text-align:center;">#</th>';
                    echo'<th class="borderCollapse" style="padding-left: 5px; font-weight: 500;">Nombre del caso de prueba</th>';
                    echo'<th class="borderCollapse" style="font-weight: 500; text-align:center;">S/N</th>';
                    //echo'<th style="font-weight: normal; padding: 5px;">No</th>';
                echo'</tr>';
            echo'</thead>';
            $num=1;
            $positivos=null;
            $negativos=null;
            $totalCasos=null;
            foreach ($casoCal as $casoCal){
            echo'<tbody>';
                echo'<tr>';
                 echo'<td class="borderCollapse" style="width:10px; font-size:9px; text-align:center;" >'.$num.'</td>';
                    if($casoCal['argumento']=="Sin argumento"){
                       echo'<td class="caso borderCollapse" style="width: 580px;">'.$casoCal['nombre_caso'].'</td>'; 
                    }else{
                       if($casoCal['fk_calificacion']==1){ 
                       echo'<td class="caso borderCollapse" style="width: 567px;">'
                            . '<div style="border-bottom:1px solid; padding-bottom:4px; margin-bottom:4px;">'.$casoCal['nombre_caso'].'</div>'
                            . '<div><span style="font-weight:bold;">Sugerencia: </span>'.$casoCal['argumento'].'</div>'
                            . '</td>'; 
                       }else{
                           echo'<td class="caso borderCollapse" style="width: 567px;">'
                            . '<div style="border-bottom:1px solid; padding-bottom:4px; margin-bottom:4px;">'.$casoCal['nombre_caso'].'</div>'
                            . '<div><span style="font-weight:bold;">Argumento: </span>'.$casoCal['argumento'].'</div>'
                            . '</td>'; 
                       }
                    }
                   
                    
                    if($casoCal['fk_calificacion']==1){
                        $positivos++;
                        $totalCasos++;
                        echo'<td class="aprobado borderCollapse" style="width:2px" text-align="center"><img class="ncnszReport" src="check.svg"></td>';
                        //echo'<td class="aprobado" style="width:5px;" text-align="center"><img class="ncnszeye" src="media-record.png"></td>';
                    }else{
                        $negativos++;
                        $totalCasos++;
                        echo'<td class="aprobado borderCollapse" style="width:2px;" text-align="center"><img class="ncnszReport" src="x.svg"></td>';
                        //echo'<td class="aprobado" style="width:5px; " text-align="center"><img class="ncnszeye" src="target.png"></td>';
                    }
                    
                echo'</tr>';
                echo'</tbody>';
            $num++;
            }
            /*echo '<tr>'
            . '<td style="height:50px;">'.$positivos.'<td>'
                    . '</tr>';*/
    echo'</table>';
         echo'<div style="position:relative; border-top:1px solid; border-left:1px solid; border-right:1px solid; font-weight: 500; width:190px; left:230px; background-color:#B1D4E8; ">Totalidad de casos: '.$totalCasos.'</div>';
         echo'<div style="position:relative; border-left:1px solid; border-right:1px solid; font-weight: 500; width:190px; left:230px; background-color:#B1D4E8; ">Aprobados: '.$positivos.'</div>';
         echo'<div style="position:relative; border-bottom:1px solid; border-left:1px solid; border-right:1px solid; font-weight: 500; width:190px; left:230px; background-color:#B1D4E8; ">Reprobados: '.$negativos.'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    
    echo '<div style="margin: 200px;"></div>';
    echo '</body>';
    
    echo'<footer>';
        
        echo'<!-- Libreria de javascript, Jquery-->';
        echo'<script language="javascript" src="../../../Lib/jquery-3.4.1.min.js?<?php echo rand(0, 9999); ?>"></script>';
        echo'<!-- Plugin que proporciona el filtro en las tablas -->';
        echo'<script language="javascript" src="../../../Web/js/datatables.min.js?<?php echo rand(0, 9999); ?>"></script>';
        echo '<!-- Bootstrap-->';
        echo'<script language="javascript" src="../../../Web/css/bootstrap/js/bootstrap.bundle.js?<?php echo rand(0, 9999); ?>" ></script>';
        echo'<script language="javascript" src="../../../Web/css/bootstrap/js/bootstrap.bundle.min.js?<?php echo rand(0, 9999); ?>" ></script>';
        echo'<script language="javascript" src="../../../Web/css/bootstrap/js/bootstrap.js?<?php echo rand(0, 9999); ?>" ></script>';
        echo'<script language="javascript" src="../../../Web/css/bootstrap/js/bootstrap.min.js?<?php echo rand(0, 9999); ?>" ></script>';
        echo'<!--fin bootstrap-->';
        echo'<!-- Controlador de Jquery-->';
        echo'<script language="javascript" src="../../../Controlador/ControladorJS/ControladorJquery.js?<?php echo rand(0, 9999); ?>"></script>';

    echo'</footer>';
    
echo '</html>';
    /*echo'<page_footer>';
        echo'<label style="text-align: center; position: relative; left: 340px; font-size: 15px;">Pagina [[page_cu]] de [[page_nb]]</label> ';
    echo'</page_footer>';*/
   
//echo '</page>';



  /*$content = ob_get_clean();
  require_once('../../../Lib/vendor/autoload.php');
  use Spipu\Html2Pdf\Html2Pdf;
  use Spipu\Html2Pdf\Exception\Html2PdfException;
  use Spipu\Html2Pdf\Exception\ExceptionFormatter;
  
  try
  {
      $html2pdf = new html2pdf('P','A4','es',true,'UTF-8',3);
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->setDefaultFont();
      $html2pdf->setTestIsImage(false);
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output('Prueba_Software.pdf');
      
  }catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }*/
  
