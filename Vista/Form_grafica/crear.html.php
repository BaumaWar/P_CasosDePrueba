<?php 

// GRAFICA MODULO LIQUIDACION

// Se llaman las clases de la libreria de la clase JPGRAPH
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph.php');
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph_pie.php');
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph_bar.php');
require_once ('../Lib/jpgraph-4.2.10/src/jpgraph_pie3d.php');

// Datos de la consulta
foreach ($GLiquidacionCalificacion as $GraficaCalificacion){
    
     if($GraficaCalificacion['fk_calificacion']==1){
         $positvosLiquidacion+=1;
     }else{
         $negativosLiquidacion+=1;
     }
     
}
if((!$negativosLiquidacion)&&(!$positvosLiquidacion)){
    $positvosLiquidacion=50;
    $negativosLiquidacion=50;
}

// Se ponen los datos en un array
$data = array($negativosLiquidacion,$positvosLiquidacion);

// Se instancia la grafica circular
$graph = new PieGraph(350,250);

$theme_class="DefaultTheme";
// Se pone el titulo
$graph->title->Set("Modulo liquidacion");;
// se establece la posicion del lenged
$graph->legend->pos(0.1,0.9);
$graph->SetBox(true);

// Se pasan los datos al la grafica circular
$p1 = new PiePlot($data);

// Radio
$p1->SetSize(0.35);
 
$graph->Add($p1);

// Agregamos los caracteristicas
$p1->ShowBorder();
$p1->SetColor('#000000');

// Creamos la barra de accion con los nombre
$p1->SetLegends(array("C.P. Rechazados","C.P. Aprobados"));

// Definimos los colores para todo los datos
$p1->SetSliceColors(array('#4756EE','#84E585'));

// Se elimina el cache de la imagen
@unlink ("img/GraficaModuloLiquidacion.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph->Stroke('img/GraficaModuloLiquidacion.jpg');

echo '<div class="centrarGrafica" >';
// Mostramos la grafica y le definimos el css mediante clases
echo '<span class="graficaLiquidacion startGrafica">'
        . '<img src="img/GraficaModuloLiquidacion.jpg" />'
   . '</span>';

//------------Separador------------Separador------------Separador-------------Separador---------------Separador--------------

// GRAFICA MODULO RASTREO

// Datos de la consulta
foreach ($GRastreoCalificacion as $GRastreoCalificacion){
    if($GRastreoCalificacion['fk_calificacion']==1){
        $positivosRastreo+=1;
    }else{
        $negastivosRastreo+=1;
    }
}
if((!$positivosRastreo)&&(!$negastivosRastreo)){
    $positivosRastreo=50;
    $negastivosRastreo=50;
}
// Se ponen los datos
$datay=array($negastivosRastreo,$positivosRastreo);
 
// Se crea la grafica con la instancia espesificando el tamaño.
$graph1 = new Graph(350,250);
$graph1->SetScale('textlin');
 
// Se añade la sombra
$graph1->SetShadow();
 
// Se Ajusta la margen para que se vean los titulos
$graph1->SetMargin(40,30,20,26);

// Se crean la barras
$bplot1 = new BarPlot($datay);

$graph1->Add($bplot1);

// Ajuste de colores
$bplot1->SetColor("#E3E3E3");
$bplot1->SetFillColor(array("#DF3939","#8764F3"));

// Se ponen los titulos
$graph1->title->Set('Modulo rastreo');
//$graph1->yaxis->title->Set('Total');
$graph1->xaxis->SetTickLabels(array('C.P. Rechazados','C.P. Aprobados'));

/* 
Se pone el tipo de fuente y la negrilla
$graph1->title->SetFont(FF_FONT1,FS_BOLD);
$graph1->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph1->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
*/

// Se elimina el cache de la imagen
@unlink ("img/GraficaModuloRastreo.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph1->Stroke('img/GraficaModuloRastreo.jpg');

// Mostramos la grafica y le definimos el css mediante clases

echo '<span class="graficaLiquidacion">'
        . '<img src="img/GraficaModuloRastreo.jpg" class="gp" />'
   . '</span>';

//------------Separador------------Separador------------Separador-------------Separador---------------Separador--------------

// GRAFICA MODULO DESPACHO
// Datos de la consulta
foreach ($GDespachoCalificacion as $GDespachoCalificacion){
    if($GDespachoCalificacion['fk_calificacion']==1){
        $positivosDespacho+=1;
    }else{
        $negastivosDespacho+=1;
    }
}
if((!$negastivosDespacho)&&(!$positivosDespacho)){
    $negastivosDespacho=50;
    $positivosDespacho=50;
}
// Se ponen los datos en un array
$data1 = array($negastivosDespacho,$positivosDespacho);
 
// A new pie graph
$graph2 = new PieGraph(350,250,'auto');
 
// Setup title
$graph2->title->Set("Modulo despacho");
$graph2->legend->pos(0.1,0.9);
$graph2->SetBox(true);
//$graph2->title->SetFont(FF_ARIAL,FS_BOLD,14);
//$graph2->title->SetMargin(8); // Add a little bit more margin from the top
 
// Create the pie plot
$p2 = new PiePlotC($data1);
 
// Set size of pie
$p2->SetSize(0.35);
 
// Label font and color setup
//$p2->value->SetFont(FF_ARIAL,FS_BOLD,10);
$p2->value->SetColor('black');
 
// Setup the title on the center circle
//$p2->midtitle->Set("Edicion\nRow 1\nRow 2");
//$p2->midtitle->SetFont(FF_ARIAL,FS_NORMAL,10);
 
// Set color for mid circle
$p2->SetMidColor('#FFFFFF');
 
// Use percentage values in the legends values (This is also the default)
//$p2->SetLabelType(PIE_VALUE_PER);

$p2->ExplodeAll(1);
// Add plot to pie graph
$graph2->Add($p2);

$p2->SetLegends(array("C.P. Rechazados","C.P. Aprobados"));
// .. and send the image on it's marry way to the browser

// Se elimina el cache de la imagen
@unlink ("img/GraficaModuloDespacho.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph2->Stroke('img/GraficaModuloDespacho.jpg');

// Mostramos la grafica y le definimos el css mediante clases

echo '<span class="graficaLiquidacion">'
        . '<img src="img/GraficaModuloDespacho.jpg" class="gp" />'
   . '</span>';

//------------Separador------------Separador------------Separador-------------Separador---------------Separador--------------

// GRAFICA MODULO USUARIOS
// Datos de la consulta
foreach ($GUsuarioCalificacion as $GUsuarioCalificacion){
    if($GUsuarioCalificacion['fk_calificacion']==1){
        $positivosUsuario+=1;
    }else{
        $negastivosUsuario+=1;
    }
}
if((!$positivosUsuario)&&(!$negastivosUsuario)){
    $negastivosUsuario=50;
    $positivosUsuario=50;
}
// We need some data
$datay1=array($negastivosUsuario,$positivosUsuario);
 
// Setup the graph. 
$graph3 = new Graph(350,250);    
$graph3->SetScale("textlin");
$graph3->img->SetMargin(40,30,20,26);
 
$graph3->title->Set('Modulo usuario');
$graph3->title->SetColor('black');
 
// Setup font for axis
/*
$graph3->xaxis->SetFont(FF_FONT1);
$graph3->yaxis->SetFont(FF_FONT1);
*/ 
// Create the bar pot
$bplot = new BarPlot($datay1);
$bplot->SetWidth(0.6);
 
// Setup color for gradient fill style 
$bplot->SetFillGradient("#77EBCA","#91ABF5",GRAD_MIDVER);


// Set color for the frame of each bar
$bplot->SetColor("#77EBCA");
$graph3->Add($bplot);
$graph3->xaxis->SetTickLabels(array('C.P. Rechazados','C.P. Aprobados'));
// Finally send the graph to the browser
// Se elimina el cache de la imagen
@unlink ("img/GraficaModuloUsuario.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph3->Stroke('img/GraficaModuloUsuario.jpg');

// Mostramos la grafica y le definimos el css mediante clases

echo '<span class="graficaLiquidacion endingGrafica">'
        . '<img src="img/GraficaModuloUsuario.jpg" class="gp" />'
   . '</span>';

//------------Separador------------Separador------------Separador-------------Separador---------------Separador--------------

// GRAFICA MODULO RESPORTES
// Datos de la consulta

foreach($GReporteCalificacion as $GReporteCalificacion){
    if($GReporteCalificacion['fk_calificacion']==1){
        $negativosReporte+=1;
    }else{
        $positivosReporte+=1;
    }
}

if((!$negativosReporte)&&(!$positivosReporte)){
    $negativosReporte=50;
    $positivosReporte=50;
}

$datay2=array($negativosReporte,$positivosReporte);

// Size of graph
$width=350;
$height=250;
 
// Set the basic parameters of the graph
$graph5 = new Graph($width,$height);
$graph5->SetScale('textlin');
 
$top = 60;
$bottom = 30;
$left = 80;
$right = 30;
$graph5->Set90AndMargin($left,$right,$top,$bottom);
 
// Nice shadow
$graph5->SetShadow();

// Setup labels
$lbl = array("C.P.\nRechazados","C.P.\nAprobados");
$graph5->xaxis->SetTickLabels($lbl);
 
// Label align for X-axis
$graph5->xaxis->SetLabelAlign('right','center','right');
 
// Label align for Y-axis
$graph5->yaxis->SetLabelAlign('center','bottom');
 
// Titles
$graph5->title->Set('Modulo reporte');
 
// Create a bar pot
$bplot2 = new BarPlot($datay2);
$bplot2->SetWidth(0.5);
//$bplot2->SetYMin(1990);
 
$graph5->Add($bplot2);
$bplot2->SetColor("#E3E3E3");
$bplot2->SetFillColor(array("#48DED2","#DBDE48"));

@unlink ("img/GraficaMdouloReporte.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph5->Stroke('img/GraficaMdouloReporte.jpg');

// Mostramos la grafica y le definimos el css mediante clases

echo '<span class="graficaLiquidacion endingGrafica">'
        . '<img src="img/GraficaMdouloReporte.jpg" class="gp" />'
   . '</span>';


//------------Separador------------Separador------------Separador-------------Separador---------------Separador--------------

// GRAFICA MODULO VEHICULOS
foreach($GVehiculoCalificacion as $GVehiculoCalificacion){
    if($GVehiculoCalificacion['fk_calificacion']==1){
        $negativosVehiculo+=1;
    }else{
        $positovosVehiculo+=1;
    }
}

if((!$negativosVehiculo)&&(!$positovosVehiculo)){
    $negativosVehiculo=50;
    $positovosVehiculo=50;
}

// Some data
$data2 = array($negativosVehiculo,$positovosVehiculo);

// Create the Pie Graph. 
$graph4 = new PieGraph(350,250);
$graph4->legend->pos(0.1,0.9);
/*
$theme_class= new VividTheme;
$graph4->SetTheme($theme_class);
*/
// Set A title for the plot
$graph4->title->Set("Modulo vehiculo");

// Create
$p3 = new PiePlot3D($data2);
$graph4->Add($p3);

$p3->SetSize(0.50);
$p3->SetAngle(50);
$p3->ShowBorder();
$p3->SetSliceColors(array('#7EBEEA','#EA7EE8'));
$p3->SetColor('black');

//$p3->ExplodeSlice(1);
$p3->SetLegends(array("C.P. Rechazados","C.P. Aprobados"));
// Se elimina el cache de la imagen
@unlink ("img/GraficaModuloVehiculo.jpg");

// Desplegamos la grafica en la ruta asignada y le definimos el nombre y el formato
$graph4->Stroke('img/GraficaModuloVehiculo.jpg');

// Mostramos la grafica y le definimos el css mediante clases

echo '<span class="graficaLiquidacion endingGrafica">'
        . '<img src="img/GraficaModuloVehiculo.jpg" class="gp" />'
   . '</span>';


echo '</div>';

echo '<div style="margin:350px;"></div>';
