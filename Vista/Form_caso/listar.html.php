<div id="setAlert" class="posicion2 width_70"></div>
<div style="margin-bottom:200px;">
    <div class="width_table m-auto border-bottom border-top border-left border-right width_div bg-blanco bor-rad">

        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">CASOS DE PRUEBA</label>
        </div>
        <table  class="table table-striped blanco border-right border-left border-bottom table-bordered text-justify" id="example">
            <thead>
                <tr>
                    <th class="labelHead" style="font-weight: 500; width:20px;">#</th>
                    <th class="labelHead" style="font-weight: 500; width: 70px;">T.Prueba</th>
                    <th class="labelHead" style="font-weight: 500;">Nombre del caso</th>
                    <th class="labelHead" style="font-weight: 500; width:85px;">Descripcion</th>
                    <th class="labelHead" style="font-weight: 500;">Editar</th>
                    <th class="labelHead" style="font-weight: 500;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    $num=1;
                    foreach ($conSql as $casoDet){
                        echo"<tr class='comun'>";
                            echo"<td style='font-weight: bold;' >".$num."</td>";
                            echo"<td style='width:70px;'>".$casoDet['tip_pru_descripcion']."</td>";
                            echo"<td>".$casoDet['nombre_caso']."</td>";
                            echo"<td class='text-center' style='width:85px;'><button type='button' class='btn btn-informacion' id='modInfCas' data-codigo='".$casoDet['id_cas_pru']."' data-url='".setUrl("Caso", "Caso","postListarDetalle","ajax")."' data-toggle='modal' data-toggle='tooltip' title='Ver descripcion' data-target='#modDetCas'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/eye.svg'></button></td>";
                            echo"<td class='text-center' style='width:15px;'><a href='index.php?modulo=Caso&controlador=Caso&funcion=editarCaso&codigo=".$casoDet['id_cas_pru']."'><button type='button' class='btn btn-amarillo' data-toggle='tooltip' title='Editar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/pencil.svg'></button></a></td>";
                            echo"<td class='text-center' style='width:15px;'><button type='button' class='btn btn-rojo' id='eliCas' data-codigo='".$casoDet['id_cas_pru']."' data-url='".setUrl("Caso","Caso","eliminarCaso")."' data-toggle='modal' data-target='#modEli' data-toggle='tooltip' title='Eliminar'><img class='ncnszeye' src='../Lib/open-iconic-master/svg/trash.svg'></button></td>";
                        echo"</tr>";
                        $num++;
                    }
                    
                ?>
                <!-- Modal descripcion --> 
                <div class="modal fade bd-example-modal-lg" id='modDetCas' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop='static' aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Descripcion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-justify">
                            <span id="modText1"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Valores de entrada:</h6>
                            <span id="modText2"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Resultado del caso:</h6>
                            <span id="modText7"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Precondiciones:</h6>
                            <span id="modText3"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Resultados esperados:</h6>
                            <span id="modText4"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Post condiciones:</h6>
                            <span id="modText5"></span>
                            <hr>
                            <h6 class="font-italic font-weight-normal">Modulo:</h6>
                            <span id="modText6"></span>
                        </div>

                        <div class="modal-footer">
                            <div>F. Creacion: <span id="fecCre"></span></div>
                            <div> F. Modificacion: <span id="fecMod"></span></div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal -->
                <!-- Modal eliminacion -->
                <div class="modal fade" id="modEli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop='static' aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar caso de prueba</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Esta accion se ejecutara de forma permanente. 
                                ¿Esta seguro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id='eliCasPru'>Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal -->
            </tbody>
        </table>
    </div>
</div>