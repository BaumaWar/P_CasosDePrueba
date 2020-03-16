<?php
    
    foreach ($proseguisPrueba as $proPru){
        
    }

?>
<div id="setAlertPrueb" class="posicion2 width_70"></div>
<div class="bg-blanco m-auto container border posicion p-10 bor-rad bg-sombra" style="width:1018px; margin-bottom:80px;">
    <form method="POST" action="<?php echo setUrl("Prueba", "Prueba", "postCrear") ?>" >
        
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">FORMULARIO PROCESO DE PRUEBA</label>
        </div>
       
        <span class="comun" id="nombrePrueba" >Nombre de prueba</span>
        <span class="comun" style="padding-left: 230px ;" >Nombre del creador</span>
        <span class="comun" style="padding-left: 197px ;" >Fecha de creacion</span>
        
        <div class="input-group cajas">
            <input type="text" name="nomPru" id="nomPru" class="form-control textarea" style="text-align: center;" value="<?php echo $proPru['descripcion_pru_pro']; ?>" readonly/>
            <input type="text" class="form-control textarea" style="text-align: center; font-family: monospace;" value="<?php echo $proPru['nombreCompleto']; ?>" readonly />
            <input type="text" class="form-control textarea" style="text-align: center;" value="<?php echo $proPru['fecha_creacion']; ?>" readonly />
        </div>
        
        <div class="cajas" style="padding-bottom: 8px;">
            <span class="comun" id="tituloModulo">Modulo</span>
            <input type="text" class="form-control textarea" readonly value="<?php echo $proPru['mod_descripcion']; ?>" />
            <input type="hidden" class="modulo" value="<?php echo $proPru['id_modulo']; ?>">
        </div>
        
        <!-- PruebaProceso Contiene el ID de la prueba -->
        <input type="hidden" id="pruebaProcesoIDRegistrada" data-url="<?php echo setUrl("Caso", "Caso", "asociarCasoPruebaAlaPrueba"); ?>" value="<?php echo $proPru['id_pru_pro']; ?>">
        <!-- PruebaProceso Contiene la url para obtener el detalle del caso de prueba -->
        <input type="hidden" id="urlParaElDetalleCasoPrueba" data-url="<?php echo setUrl("Caso", "Caso","postListarDetalle","ajax"); ?>" />
        <!-- PruebaProceso Contiene la url para atraer los casos de prueba -->
        <input type="hidden" id="traeTodosLosCasosDePruebaYaAsociados" data-url="<?php echo setUrl("Caso", "Caso","casosDePruebaAsociado","ajax"); ?>" />
        <!-- PruebaProceso Contiene la url para atraer los casos de prueba -->
        
        <!--CasosPorModulo-->
        <?php
        
            if($proPru['asociacion_propia']==1){
                
                echo'<div class="cajas">
                        <span style="position: relative;" class="labelHead mano casosPorModulo" data-codigo="1">
                            <img style="position: relative; left: 480px; width: 30px; " class="mano bor-rad" src="../Lib/open-iconic-master/svg/carpetaArchivo.svg" data-placement="top" data-toggle="tooltip" >
                        </span>
                    </div>';
                
            }else{
                
                echo'<div class="cajas">
                        <span style="position: relative;" class="labelHead" >
                            <span style="position: relative; left:480px;" data-codigo="0" ><img style="width: 30px" class="mano bor-rad" src="../Lib/open-iconic-master/svg/iconfinder.svg" data-placement="top" data-toggle="tooltip" ></span>
                        </span>
                    </div>';
                
            }
        ?>
        <input type="hidden" id="urlCasoModulo" data-url="<?php echo setUrl("Prueba", "Prueba", "casosPorModulo", "ajax"); ?>" >
        
        <!--CasosPorModulo-->
        <?php
            if($proPru['asociacion_propia']==0){
            echo'<div class="cajas" style="position: relative; top: -11px">
                    <span class="comun" >Casos de prueba</span>
                    <select id="ex-events" class="ex-events textarea" data-url="ajax.php?modulo=Prueba&controlador=Prueba&funcion=casoPrueba">
                        <option value="#">Seleccion caso de prueba</option>';
                            foreach ($casPru as $cas){
                                echo "<option value='".$cas['id_cas_pru']."'>".$cas['nombre_caso']."</option>";
                            }
                echo'</select>
                </div>';
            }
        ?>
        <div class="border" style="margin-bottom: 15px;"></div>
        
        <div class="border bor-rad blanco" style="padding-left: 8px; padding-right: 8px;">
            <div class="text-center font-weight-normal p-10">
                <label class="labelHead">EVALUACION DE CASOS DE PRUEBA</label>
            </div>
            <table class="table blanco border table-bordered">
                <thead class="labelCP" >
                    <tr>
                        <th >Caso de prueba</th>
                        <th>Si</th>
                        <th>No</th>
                        <th style="width: 15px;" >Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bodyCasPrueba comun">

                </tbody>
            </table>
        </div>
        
        <!--<div style="margin-top: 10px;">
            <input id="Prueba" class="btn btn-azul btn-block" type="submit" value="Registrar" />
        </div>-->
        
        <div class="cajas opcionDeEstadosDeLaPrueba" >
            <div class="comun">Seleccione el estado de la prueba.</div>
            <span><button type="button" class="btn btn-verde labelCP estadoDeLaPrueba" data-codigo="1">En proceso</button></span>
            <span><button type="button" class="btn btn-amarillo labelCP estadoDeLaPrueba" data-codigo="2" >En Pausa</button></span>
            <span><button type="button" class="btn btn-rojo labelCP estadoDeLaPrueba" data-codigo="3">Finalizada</button></span>
        </div>
        
    </form>
    
    <!-- Modal que obtiene los datos del caso de prueba cuando se hace click  -->
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
    
</div>
<div style="margin: 200px;"></div>