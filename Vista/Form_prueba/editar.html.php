<?php
    date_default_timezone_set('America/Bogota');
    $fecha_cre= date("Y-m-d");
    
    foreach($pruPro as $pruPro){
        
    }
?>
<div id="setAlertPrueb" class="posicion2 width_70"></div>
<div class="bg-blanco m-auto container border posicion p-10 bor-rad bg-sombra" style="width:1018px; margin-bottom:80px;">
    <form method="POST" action="<?php echo setUrl("Prueba", "Prueba", "postEditar") ?>">
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">FORMULARIO EDITAR PROCESO DE PRUEBA</label>
        </div>
        
        <input type="hidden" id="urlParaElDetalleCasoPrueba" data-url="<?php echo setUrl("Caso", "Caso","postListarDetalle","ajax"); ?>">
        <input type="hidden" data-codigo="3" class="mano" id="probarCasosAsociadosAProbar">
        <input type="hidden" id="urlParaAsociarCasoAPruebaEliminar" data-url="<?php echo setUrl("Caso", "Caso","eliminarCasoDePruebaAsociado","ajax"); ?>">
        
        <span class="comun" id="nombreIncorrecto" >Nombre de prueba*</span>
        <span class="comun" style="padding-left: 230px ;" >Nombre del creador*</span>
        <span class="comun" style="padding-left: 195px ;" >Fecha de modificacion*</span>
        <div class="input-group cajas">
            <input type="text" id="nombrePrueba" name="nomPru" class="form-control textarea" style="text-align: center;" value="<?php echo $pruPro['descripcion_pru_pro']; ?>" placeholder="Nombre de la prueba" />
            <input type="text" name="usuario" class="form-control textarea" style="text-align: center; font-family: monospace;" placeholder="Usuario" value="<?php echo $pruPro['nombre']; ?>" readonly />
            <input type="date" class="form-control textarea" style="text-align: center;" value="<?php echo $fecha_cre;?>" readonly/>
            <input type="hidden" name="id_pru_pro" value="<?php echo $pruPro['id_pru_pro']; ?>">
        </div>
        
        <div class="cajas" style="padding-bottom: 10px">
            <span class="comun" >Modulo*</span>
            <select name="modulo" class="form-control textarea" disabled>
                <option value="#">Seleccion de modulo</option>
                <?php
                    foreach($modulo as $mod){
                        if($mod['id_modulo']==$pruPro['id_modulo']){
                            $select="selected";
                        }
                        echo "<option value='".$mod['id_modulo']."'$select>".$mod['mod_descripcion']."</option>";
                        $select="";
                    }
                ?>
            </select>
        </div>
        
        <div class="cajas" style="padding-bottom: 12px">
            <button style="position: relative; left: 794px; width: 200px;" type="button" id="idPruebaProcesoEditarNombre" class="btn btn-azul labelCP" data-url="<?php echo setUrl("Prueba","Prueba","editarNombrePrueba","ajax"); ?>" >Editar prueba</button>
        </div>
        
        <!--<div class="cajas" style="position: relative;">
            <span class="comun" >Casos de prueba*</span>
            <select id="ex-events" class="textarea ex-events" data-url="<?php echo setUrl("Prueba", "Prueba", "casoPrueba", "ajax"); ?>">
                <option value="#">Seleccion de caso de prueba</option>
                <?php
                    /*foreach ($casPru as $cas){
                        echo "<option value='".$cas['id_cas_pru']."'>".$cas['nombre_caso']."</option>";
                    }*/
                ?>
            </select>
        </div>-->
        
        <div class="border bor-rad blanco" style="padding-left: 8px; padding-right: 8px;">
            <div class="text-center font-weight-normal p-10">
                <label class="labelHead">EVALUACION DE CASOS DE PRUEBA</label>
            </div>
            <table class="table blanco border table-bordered">
                <thead class="labelHead labelCP" style="font-weight: 500;">
                    <tr>
                        <th>Nombre del caso</th>
                        
                        <th style="width: 15px" >Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bodyCasPrueba comun">
                    <?php
                                
                        foreach ($detPruPro as $detPruPro){
                            
                            echo'<tr class="agrCasPru comun ocultate'.$detPruPro['fk_cas_pru'].' id="'.$detPruPro['fk_cas_pru'].'">
                                    <td class="text-justify">
                                        <div id="nombreCaso'.$detPruPro['fk_cas_pru'].'" type="text" class="form-control comun" style="margin-bottom:5px;" >"'.$detPruPro['nombre_caso'].'"</div>
                                        <div>
                                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative;" id="ocultaOJO'.$pruPro['id_pru_pro'].'" data-codigo="'.$detPruPro['fk_cas_pru'].'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">
                                        </div>
                                    </td>
                                    <input type="hidden" id="pruebaProcesoIDRegistrada" value="'.$detPruPro['fk_pru_pro'].'">
                                    <td align="center" >
                                        <button type="button" class="btn btn-rojo eli_casPru" id="eliCaso'.$detPruPro['fk_cas_pru'].'Pru" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>
                                        <input type="hidden" class="exitenCasoParaEvaluar" name="prueba[]" value="">
                                        <input type="hidden" id="updateORInsert" name="queHacer" value="4">
                                    </td>
                                </tr>';
                                            
                        
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
        <!--<div style="margin-top: 10px;">
            <input class="btn btn-azul btn-block" type="submit" value="Guardar" />
        </div>-->
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