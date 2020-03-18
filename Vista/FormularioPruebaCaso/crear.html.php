<!--Start FomularioPruebaCaso Crear-->
<div class="container bg-blanco posicion border bor-rad">
    <!--Start Card-->
    <div class="card bg-blanco border-0"> 
        <!--Start CardBody-->
        <div class="card-body">
            <!--Start Title-->
            <div class="text-center font-weight-normal p-10 labelHead">
                PROCESO DE PRUEBA DE CASOS
            </div>
            <!--End Title-->
            <!--Start Row-->
            <div class="row">
                <div class="col-sm">
                    <span id="" class="labelCP">Nombre de prueba*</span><br>
                    <input type="text" name="" id="" class="custom-select-sm form-control input-group" />
                </div>
                <div class="col-sm">
                    <span id="" class="labelCP">Nombre del creador*</span><br>
                    <input type="text" name="" id="" class="custom-select-sm form-control input-group" />
                </div>
                <div class="col-sm">
                    <span id="" class="labelCP">Fecha de creacion*</span><br>
                    <input type="text" name="" id="" value="<?php echo $fecha_cre?>" class="text-center options custom-select-sm form-control input-group" disabled />
                </div>
            </div>
            <!--End Row-->
            <!--Start Row-->
            <div class="row">
                <div class="col-sm">
                    <span id="descripcionVersion" class="labelCP">Modulo*</span><br>
                    <select name="version" id="versionSCUno" data-live-search="true" class="selectpicker custom-select-sm form-control input-group" data-size="4">
                        <option value="#" class="options">Seleccion del modulo</option>
                        <?php
                            foreach ($modulo as $modulo){
                                echo '<option class="options" value="'.$modulo['id_modulo'].'">'.$modulo['mod_descripcion'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm">
                    <span id="descripcionVersion" class="labelCP">Configuracion de la prueba*</span><br>
                    <select name="version" id="versionSCUno" data-live-search="true" class="selectpicker custom-select-sm form-control input-group" data-size="4">
                        <option value="#" class="options">Seleccion el tipo de prueba</option>
                        <option value="ActualPrueba" class="options">El usuario actual es responsable del proceso</option>
                        <option value="OtroPrueba" class="options">Otro usuario sera responsable del proceso</option>
                    </select>
                </div>
            </div>
            <!--End Row--> 
            <!--Start Boton Guardar Prueba-->
            <div class="row">
                <div class="col-sm-3 p-3">
                    <button type="button" id="SavePruebaProceso" class="btn btn-azul btn-block labelCP" >Guardar prueba</button>
                </div>
            </div>
            <!--End Boton Guardar Prueba-->
        </div>
        <!--End CardBody-->
    </div>
    <!--End Card-->
</div>
<!--End FomularioPruebaCaso Crear-->    