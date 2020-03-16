<?php
 // content="text/plain; charset=utf-8"
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph.php');
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph_line.php');
 
$datay1 = array(20,15,23,15);
$datay2 = array(12,9,42,8);
$datay3 = array(5,17,32,24);
 
// Setup the graph
$graph = new Graph(1000,380);
$datay1 = array(20,15,23,15,20,15,23,25,20,15,23,15,20,15,23,40,20,15,23,15,20,15,23,18,12,9,35,8,28,40);
$datay2 = array(12,9,15,8,15,18,25,18,12,9,35,8,28,18,25,2,12,9,15,8,15,18,25,35,8,28,18,25,2,0);


// Setup the graph
$graph = new Graph(1000,380);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('');
$graph->SetBox(false);
$graph->legend->pos(0.39,0.94);
$graph->SetMargin(40,20,36,55);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#2D9500");
$p1->SetLegend('C.P. Positivos');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#950000");
$p2->SetLegend('C.P. Negativos');

$graph->legend->SetFrameWeight(1);
// Output line
@unlink ("img/GraficaPrueba.jpg");
$graph->Stroke('img/GraficaPrueba.jpg');

echo'<div class="centrarGrafica border bor-rad bg-blanco bg-sombra cajaGraficaCentrar container">';
        
        echo '<span class="comun selectModuloEstado" style="right:140px;">seleccion de modulo*</span>';
        echo '<span class="comun selectModuloEstado" style="left:-50px;">seleccion de fecha*</span>';
        
        echo'<div class="input-group cajas group-select-Modulo m-auto">';
            
            echo'<select class="selectModuloEstado form-control" id="moduloGrafica" >';
                echo'<option value="#">Seleccion de modulo</option>';
            foreach ($modulo as $modulo){
                echo'<option value="'.$modulo['id_modulo'].'">'.$modulo['mod_descripcion'].'</option>';
            }
            echo'</select>';
            
            echo'<input type="date" id="fechaGrafica" class="selectModuloEstado form-control" data-url="ajax.php?controlador=Grafica&modulo=Grafica&funcion=estado" >';
            
            echo'<button id="consultaGrafica" class="btn btn-azul selectModuloEstado" >Consultar</button>';
        echo'</div>';
            
        echo'<span class="graficaEstado">';
                echo'<img src="img/GraficaPrueba.jpg" class="imgGraficaEstado" />';
        echo'</span>';
            
echo'</div>';
echo '<div style="margin:350px;"></div>';
