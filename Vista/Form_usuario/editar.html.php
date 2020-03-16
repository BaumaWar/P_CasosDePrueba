<?php foreach($conUsu as $usu){} ?>
<div id="setAlertDatos" class="posicion2 width_70"></div>
    <div id="formEdiUsu" class="container p-3 bor-rad sombra bg-blanco">
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">EDICION DE DATOS DE USUARIO</label>
        </div>
        <form>
            <div class="cajas">
                <span class="comun" id="nombreUsuario" >Nombre*</span>
                <input id="nombre" type="text" class="form-control textarea" value="<?php echo $usu['nombre']; ?>" required/>
            </div>
           <div class="cajas">
               <span class="comun" id="apellidoUsuario">Apellido*</span>
                <input id="apellido" type="text" class="form-control textarea" value="<?php echo $usu['apellido']; ?>" required/>
            </div>  
            <div class="cajas">
                <span class="comun" id="tipoDocumento">Tipo de documento*</span>
                <select id="tipDoc" class="form-control textarea" required>
                    <?php
                    foreach($conTip as $tip){
                        
                        if($tip['id_tip_doc']==$usu['fk_tip_doc']){
                         $select="selected";
                        }
                        echo "<option value='".$tip['id_tip_doc']."'$select>".$tip['tip_doc_descripcion']."</option>";
                        $select="";
                    }
                    ?>
                </select>
            </div>
            <div class="cajas">
                <span class="comun" id="numeroDocumento">Numero de documento*</span>
                <input id="documento" type="text" class="form-control textarea" value="<?php echo $usu['num_documento']; ?>"/>
            </div>
            <div class="cajas">
                <span class="comun" id="telefonoCelular">Telefono/Celular*</span>
                <input id="telefono" type="text" class="form-control textarea" value="<?php echo $usu['telefono']; ?>"/>
            </div>
            <div style="padding-top: 10px;">
                <button id="ediUsuInf" type="button" data-url="<?php echo setUrl("Usuario", "Usuario", "postEditar", "ajax"); ?>" class="btn btn-azul btn-block labelCP">Editar datos</button>
            </div>
        </form>
    </div>
