<?php
    include_once '../../../Modelo/MasterModel.php';
    $codigo=$_GET['codigo'];
    $Obje= new MasterModel();
    $sqlNombre="select fecha_creacion,descripcion_pru_pro,concat(nombre,' ',apellido) as nombre from prueba_proceso pru join usuario usu on pru.fk_usu=usu.id_usu where id_pru_pro like :codigo";
    $sqlNomFec= $Obje->getData($sqlNombre,$codigo);
    $sqlcasoCal="select fk_calificacion,nombre_caso from detalle_prueba_proceso dpp join caso_prueba cp on dpp.fk_cas_pru=cp.id_cas_pru where fk_pru_pro like :codigo";
    $casoCal= $Obje->getData($sqlcasoCal, $codigo);


    require '../../../Lib/vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $numFila=1;
    //$sheet->setCellValueByColumnAndRow(1,1,"Calificacion");
    foreach ($casoCal as $casoCal){
        
        if($casoCal['fk_calificacion']==1){
            $sheet->setCellValueByColumnAndRow(1,$numFila,"1");
        }else{
            $sheet->setCellValueByColumnAndRow(1,$numFila,"0");
        }
        $numFila++;
        
    }
    
    $nombreDelDocumento="Pruebas_Software";
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;


