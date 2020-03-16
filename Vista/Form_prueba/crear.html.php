<?php
    date_default_timezone_set('America/Bogota');
    $fecha_cre= date("Y-m-d");
?>
<div id="setAlertPrueb" class="posicion2 width_70"></div>
<div class="bg-blanco m-auto container border posicion p-10 bor-rad bg-sombra" style="width:1018px; margin-bottom:80px;">
    
    <form method="POST" action="<?php echo setUrl("Prueba", "Prueba", "postCrear") ?>" >
        
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">FORMULARIO PROCESO DE PRUEBA</label>
        </div>
       
        <span class="comun" id="nombrePrueba" >Nombre de prueba*</span>
        <span class="comun" style="padding-left: 225px ;" >Nombre del creador*</span>
        <span class="comun" style="padding-left: 215px ;" >Fecha de creacion*</span>
        <div class="input-group cajas">
            <input type="text" name="nomPru" id="nomPru" class="form-control textarea" style="text-align: center;" />
            <input type="text" class="form-control textarea" style="text-align: center; font-family: monospace;" readonly value="<?php echo $nombre=$_SESSION['usu_nombre']; ?>" />
            <input type="date" class="form-control textarea" style="text-align: center;" readonly value="<?php echo $fecha_cre;?>" />
        </div>
        
        <div class="cajas">
            <span class="comun" id="tituloModulo">Modulo*</span>
            <select name="modulo" class="ex-events textarea modulo">
                <option value="#">Seleccion modulo</option>
                <?php
                    foreach($modulo as $mod){
                        echo "<option value='".$mod['id_modulo']."'>".$mod['mod_descripcion']."</option>";
                    }
                ?>
            </select>
        </div>
        
        <!-- PruebaProceso Contiene el ID de la prueba -->
        <input type="hidden" id="pruebaProcesoIDRegistrada" data-url="<?php echo setUrl("Caso", "Caso", "asociarCasoPruebaAlaPrueba"); ?>">
        <!-- PruebaProceso Contiene la url para obtener el detalle del caso de prueba -->
        <input type="hidden" id="urlParaElDetalleCasoPrueba" data-url="<?php echo setUrl("Caso", "Caso","postListarDetalle","ajax"); ?>">
        <!-- PruebaProceso Contiene la url para asociar el caso de prueba que se ejecutara luego -->
        <input type="hidden" id="urlParaAsociarCasoAPrueba" data-url="<?php echo setUrl("Caso", "Caso","asociarCasoPruebaALaPruebaAFuturo","ajax"); ?>">
        <!-- PruebaProceso Contiene la url para asociar todos los casos a la prueba -->
        <input type="hidden" id="urlParaAsociarCasoAPruebaTodos" data-url="<?php echo setUrl("Caso", "Caso","asociarCasoPruebaALaPruebaAFuturoTodos","ajax"); ?>">
        <!-- PruebaProceso Contiene la url para eliminar la asociacion de los caso a la prueba -->
        <input type="hidden" id="urlParaAsociarCasoAPruebaEliminar" data-url="<?php echo setUrl("Caso", "Caso","eliminarCasoDePruebaAsociado","ajax"); ?>">
        
        <!-- CasosPorModulo -->
        <div class="cajasoculto">
            <span style="position: relative;" class="labelHead mano casosPorModulo oculto" data-codigo="0" >
                <img style="position: relative; left: 480px; width: 22px; " class='mano bor-rad' src='../Lib/open-iconic-master/svg/refresh.svg' data-placement="top" data-toggle="tooltip" >
            </span>
            <span style="position: relative;" class="labelHead mano" >
                
                <!--
                <span>Seleccione el modo de prueba*</span>
                    <label style="position: relative; left:100px;" data-codigo="0" class="mano asociarOpropia labelCP" data-codigoAP="3" id="probarCasosAsociados">Crear y probar  <img style="width: 20px" class='mano' src='../Lib/open-iconic-master/svg/checkboxNot.svg' data-placement="top" data-toggle="tooltip" ></label>
                <label style="position: relative; left:200px;" data-codigo="0" class="mano asociarOpropia labelCP" data-codigoAP="3" id="probarCasosAsociados">Crear y otro prueba <img style="width: 20px" class='mano' src='../Lib/open-iconic-master/svg/checkboxNot.svg' data-placement="top" data-toggle="tooltip" ></label>
                -->
                
            </span>
        </div>
        
        <input type="hidden" id="urlCasoModulo" data-url="<?php echo setUrl("Prueba", "Prueba", "casosPorModulo", "ajax"); ?>" >
        
        <!-- CasosPorModulo Seleccionabale -->
        <div class="cajas" style="position: relative; top: -19px">
            <span class="comun" >Casos de prueba*</span>
            <select id="ex-events" class="ex-events textarea" data-url="<?php echo setUrl("Prueba", "Prueba", "casoPrueba", "ajax"); ?>">
                <option value="#">Seleccion caso de prueba</option>
                <?php
                    foreach ($casPru as $cas){
                        echo "<option value='".$cas['id_cas_pru']."'>".$cas['nombre_caso']."</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="cajas" style="margin-bottom: 10px">
            
            <!--
            <div class="comun" style="position: relative; top: -11;">Seleccione el modo de prueba*</div>
            <select class="form-control labelHead" style="max-width: 33.5%; position: relative; top: -10px;">
                <option value="#">Seleccion modo de prueba</option>
            </select>
            -->
            
            <button style="position: relative; width: 200px;" type="button" id="idPruebaProceso" class="btn btn-azul labelCP" data-url="<?php echo setUrl("Prueba","Prueba","postCrearDos","ajax"); ?>" >Guardar prueba</button>
            <label style="position: relative; left: 150px;" data-codigo="0" class="mano asociarOpropia labelCP" data-codigoAP="3" id="probarCasosAsociados" >Modo de prueba*  <img style="width: 24px" title="Este usuario calificara los casos de prueba." class='mano' src='../Lib/open-iconic-master/svg/checkboxNot.svg' data-placement="top" data-toggle="tooltip" ></label>
            <label style="position: relative; left: 170px;" data-codigo="0" class="mano asociarOpropia labelCP" data-codigoAP="3" id="probarCasosAsociados"><img style="width: 24px" title="Otro usuario calificara los casos de prueba." class='mano' src='../Lib/open-iconic-master/svg/checkboxYes.svg' data-placement="top" data-toggle="tooltip" ></label>
            
        </div>
        
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
        
        <div class="cajas opcionDeEstadosDeLaPrueba blanco" style="padding: 10px">
            <div class="comun">Seleccione el estado de la prueba.</div>
            <span><button type="button" class="btn btn-verde labelCP estadoDeLaPrueba" data-codigo="1">En proceso</button></span>
            <!--<span><button type="button" class="btn btn-amarillo labelCP estadoDeLaPrueba" data-codigo="2" >En Pausa</button></span>-->
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
    
</div>
<div style="margin: 200px;"></div>
