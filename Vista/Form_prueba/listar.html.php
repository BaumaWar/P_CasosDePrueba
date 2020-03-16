<div style="margin-bottom:200px;">
    <div class="width_table m-auto border-bottom border-top border-left border-right width_div bg-blanco bor-rad">
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">PRUEBAS DE SOFTWARE DESARROLLADAS</label>
        </div>
        <table  class="table table-striped blanco border-right border-left border-bottom table-bordered text-justify" id="example">
            <thead>
                <tr>
                    <th class="labelHead" style="font-weight: 500; width:20px;">#</th>
                    <th class="labelHead" style="font-weight: 500;">Nombre de la prueba</th>
                    <th class="labelHead" style="font-weight: 500;">Nombre del creador</th>
                    <th class="labelHead" style="font-weight: 500;">Modulo</th>
                    <th class="labelHead" style="font-weight: 500;">Fecha de creacion</th>
                    <!--<th class="labelHead" style="font-weight: 500;">EXCEL</th>-->
                   
                    <th class="labelHead" style="font-weight: 500;">Ver</th>
                    <th class="labelHead" style="font-weight: 500;">Continuar</th>
                    <!--<th class="labelHead" style="font-weight: 500;">Notificar</th>-->
                    <th class="labelHead" style="font-weight: 500;">Estado</th>
                    <th class="labelHead" style="font-weight: 500;">Editar</th>
                    <th class="labelHead" style="font-weight: 500;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $num=1;
                    foreach ($proPru as $proPru){
                        echo"<tr class='comun'>";
                            echo"<td style='font-weight: bold;'>".$num."</td>";
                            echo"<td>".$proPru['descripcion_pru_pro']."</td>";
                            echo"<td>".$proPru['nombre_cpt']."</td>";
                            echo"<td>".$proPru['mod_descripcion']."</td>";
                            echo"<td>".$proPru['fecha_creacion']."</td>";
                            //echo"<td class='text-center' style='width:15px;'><a target='_blank' href='../Controlador/ControladorPrueba/PruebaReporte/ReportePruebaDeSoftware-excel.php?codigo=".$proPru['id_pru_pro']."'><button class='btn btn-verde' title='Excel'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/document.svg'></button></a></td>";
                            echo"<td class='text-center' style='width:15px;'><a target='_blank' href='../Controlador/ControladorPrueba/PruebaReporte/ReportePruebaDeSoftwarepdf.html.php?codigo=".$proPru['id_pru_pro']."'><button type='button' class='btn btn-informacion' id='pdfPruSoft' title='PDF' data-target='#modDetCas'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/file.svg'></button></a></td>";
                            if($proPru['estadoPrueba']==2){
                                echo"<td class='text-center' style='width:70px;'><a target='_blank' href='index.php?modulo=Prueba&controlador=Prueba&funcion=proseguirPrueba&codigo=".$proPru['id_pru_pro']."'><button type='button' class='btn btn-naranja' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/paperclip.svg'></button></a></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-amarillo labelCP' title='Estado'>En pausa</button></td>";
                                echo"<td class='text-center' style='width:15px;'><a href='index.php?modulo=Prueba&controlador=Prueba&funcion=editar&codigo=".$proPru['id_pru_pro']."'><button type='button' class='btn btn-amarillo' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/pencil.svg'></button></a></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-rojo' id='eliProPru' data-codigo='".$proPru['id_pru_pro']."' data-url='".setUrl("Prueba","Prueba","eliminar")."' data-toggle='modal' data-target='#modEliProPru' data-toggle='tooltip' title='Eliminar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/trash.svg'></button></td>";
                            }else if($proPru['estadoPrueba']==3){
                                echo"<td class='text-center' style='width:70px;'><button type='button' class='btn btn-naranja' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/lock-locked.svg'></button></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-segundo labelCP' title='Estado'>Finalizada</button></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-amarillo' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/lock-locked.svg'></button></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-rojo' id='eliProPru' data-codigo='".$proPru['id_pru_pro']."' data-url='".setUrl("Prueba","Prueba","eliminar")."' data-toggle='modal' data-target='#modEliProPru' data-toggle='tooltip' title='Eliminar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/trash.svg'></button></td>";
                            }else if($proPru['estadoPrueba']==1){
                                echo"<td class='text-center' style='width:70px;'><a target='_blank' href='index.php?modulo=Prueba&controlador=Prueba&funcion=proseguirPrueba&codigo=".$proPru['id_pru_pro']."'><button type='button' class='btn btn-naranja' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/paperclip.svg'></button></a></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-verde labelCP' title='Estado'>En proceso</button></td>";
                                echo"<td class='text-center' style='width:15px;'><a href='index.php?modulo=Prueba&controlador=Prueba&funcion=editar&codigo=".$proPru['id_pru_pro']."'><button type='button' class='btn btn-amarillo' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/pencil.svg'></button></a></td>";
                                echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-rojo' id='eliProPru' data-codigo='".$proPru['id_pru_pro']."' data-url='".setUrl("Prueba","Prueba","eliminar")."' data-toggle='modal' data-target='#modEliProPru' data-toggle='tooltip' title='Eliminar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/trash.svg'></button></td>";
                            }
                        echo"</tr>";
                        $num++;
                    } 
                ?>
                <!-- Modal eliminacion inicio-->
                <div class="modal fade" id="modEliProPru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop='static' aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Prueba</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Esta accion se ejecutara de forma permanente. 
                                ¿Esta seguro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id='eliProPruConfirm'>Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal eliminacion fin-->
            </tbody>
        </table>
    </div>
</div>