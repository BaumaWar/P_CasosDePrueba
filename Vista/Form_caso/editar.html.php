<?php foreach ($conEdiCas as $cas){}?>
<div id="setAlert" class="posicion2 width_70"></div>
<div class="container font-weight-bold p-3 border bor-rad bg-sombra width_form posicion bg-blanco">
    <form method="POST" id="formEdiCasPru" name="editarCaso">

        <input type="hidden" id="fk_caso" name="idCasPru" value="<?php echo $cas['fk_cas_pru']; ?>"/>               
        
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">FORMULARIO EDITAR CASO DE PRUEBA</label>
        </div>
        <div class="cajas">
            <span class="comun nombreCaso">Nombre del caso*</span>
            <input class="form-control textarea" id="nomCaso" type="text" name="nomCaso" value="<?php echo $cas['nombre_caso']; ?>"/>
        </div>
        <div class="cajas">
            <span class="comun descripcionCaso">Descripcion*</span>
            <textarea class="form-control textarea" id="descripcion" name="descripcion" rows="4" ><?php echo $cas['det_descripcion']; ?></textarea>
        </div>
        <div class="cajas">
            <span class="comun valorEntrada">Valores de entrada*</span>
            <input class="form-control textarea" id="valEnt" name="valEnt" type="text" value="<?php echo $cas['valores_entrada']; ?>"/>
        </div>
        <div class="cajas">
            <span class="comun" id="resultadoDelCaso">Resultado del caso*</span>
            <textarea id="resCas" class="form-control textarea" name="valEnt" type="text" rows="2" ><?php echo $cas['resultado_caso']; ?></textarea>
        </div>
        <div class="cajas">
            <span class="comun precondicionesEjecucion">Precondiciones de ejecucion*</span>
            <textarea class="form-control textarea" id="preCon" name="preCon" rows="4" ><?php echo $cas['precondiciones_ejecucion']; ?></textarea>
        </div>
        <div class="cajas">
            <span class="comun resultadosEsperados">Resultados esperados*</span>
            <textarea class="form-control textarea" id="resEsp" name="resEsp" rows="4" ><?php echo $cas['resultados_esperados']; ?></textarea>
        </div>
        <div class="cajas">
            <span class="comun poscondiciones">Postcondiciones*</span>
            <textarea class="form-control textarea" id="posCon" name="posCon" rows="4" ><?php echo $cas['post_condiciones']; ?></textarea>
        </div>
        <div class="cajas">
            <span class="comun moduloCaso" >Modulo*</span>
            <select name="modulo" class="form-control casoModulo">
                <option value="#">Seleccion de modulo</option>
                <?php
                    foreach($modulo as $mod){
                        if($mod['id_modulo']==$cas['fk_modulo']){
                            $select="selected";
                        }
                        echo "<option value='".$mod['id_modulo']."'$select>".$mod['mod_descripcion']."</option>";
                        $select="";
                    }
                ?>
            </select>
        </div>
        <?php
        
            if ($cas['fk_tip_pru']==1){
                echo"<div class='cajas'>";
                    echo"<div class='custom-control custom-radio'>";
                        echo"<input type='radio' id='cajNeg' name='option' class='custom-control-input' value='2'/>";
                        echo"<label class='custom-control-label labelCP' for='cajNeg'>T. Caja negra</label>";
                    echo"</div>";
                    echo"<div class='custom-control custom-radio'>";
                        echo"<input type='radio' id='cajBla' name='option' class='custom-control-input' value='1' checked='checked'/>";
                        echo"<label class='custom-control-label labelCP' for='cajBla'>T. Caja blanca</label>";
                    echo"</div>";
                
            }else{
                echo"<div class='cajas'>";
                    echo"<div class='custom-control custom-radio'>";
                        echo"<input type='radio' id='cajNeg' name='option' class='custom-control-input' value='2' checked='checked'/>";
                        echo"<label class='custom-control-label labelCP' for='cajNeg'>T. Caja negra</label>";
                    echo"</div>";
                    echo"<div class='custom-control custom-radio'>";
                        echo"<input type='radio' id='cajBla' name='option' class='custom-control-input' value='1'/>";
                        echo"<label class='custom-control-label labelCP' for='cajBla'>T. Caja blanca</label>";
                    echo"</div>";
                
            }
            
        ?>
        <div class="cajas">
            <input class="btn btn-azul form-control labelCP" id="ediCasPru" type="button" data-url="<?php echo setUrl("Caso","Caso","postEditarCaso","ajax"); ?>" name="btn" value="Guardar"/>
        </div>
    </form>
</div>
<div style="margin: 500px;"></div>