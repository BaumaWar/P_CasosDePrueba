<!DOCTYPE HTML>
<div id="setAlert" class="posicion2 width_70"></div>
<div class="posicion container font-weight-bold p-3 border bor-rad bg-sombra width_form bg-blanco">
    <form id="formCreCasPru" method="POST" name="crearCaso">
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">FORMULARIO CASO DE PRUEBA</label>
        </div>
        <div class="cajas">
            <span class="comun" id="nombreCaso">Nombre del caso*</span>
            <input id="nomCaso" type="text" class="form-control textarea" name="nomCaso"/>
        </div>
        <div class="cajas">
            <span class="comun" id="descripcionCaso">Descripcion*</span>
            <textarea id="descripcion" class="form-control textarea" name="descripcion" rows="4"></textarea>
        </div>
        <div class="cajas">
            <span class="comun" id="valorEntrada">Valor de entrada*</span>
            <input id="valEnt" class="form-control textarea" name="valEnt" type="text" />
        </div>
        <div class="cajas">
            <span class="comun" id="resultadoDelCaso">Resultado del caso*</span>
            <textarea id="resCas" class="form-control textarea" name="valEnt" type="text" rows="2" ></textarea>
        </div>
        <div class="cajas">
            <span class="comun" id="precodicionesEjecucion">Precondiciones de ejecucion*</span>
            <textarea id="preCon" class="form-control textarea"  name="preCon" rows="4" ></textarea>
        </div>
        <div class="cajas">
            <span class="comun" id="resultadosEsperados">Resultados esperados*</span>
            <textarea id="resEsp" class="form-control textarea" name="resEsp" rows="4" ></textarea>
        </div>
        <div class="cajas">
            <span class="comun" id="poscondiciones">Postcondiciones*</span>
            <textarea id="posCon" class="form-control textarea" name="posCon" rows="4" ></textarea>
        </div>
        <div class="cajas">
            <span class="comun" id="modulo">Modulo*</span>
            <select name="modulo" class="form-control casoModulo">
                <option value="#">Seleccion modulo</option>
                <?php
                    foreach ($modulo as $modulo){
                        echo"<option value='".$modulo['id_modulo']."'>".$modulo['mod_descripcion']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="cajas">
            <div class="custom-control custom-radio">
                <input type="radio" id="cajNeg" name="option" class="custom-control-input" value="2" />
                <label class="custom-control-label labelCP" for="cajNeg">T. Caja negra</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="cajBla" name="option" class="custom-control-input" value="1" />
                <label class="custom-control-label labelCP" for="cajBla">T. Caja blanca</label>
            </div>
        </div>
        <div class="cajas">
            <input id="regCas" class="btn btn-azul form-control labelCP" type="button" data-url="<?php echo setUrl("Caso","Caso","crearCaso","ajax"); ?>" name="btn" value="Registrar"/>
        </div>
    </form>
</div>
<div style="margin: 500px;"></div>