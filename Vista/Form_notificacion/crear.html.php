<div class="bg-blanco m-auto container border posicion p-10 bor-rad bg-sombra" style="width: 1018px; height: 730px; margin-bottom:80px;">
    <div class="text-center font-weight-normal p-10">
        <label class="labelHead">FORMULARIO DE NOTIFICACION</label>
    </div>
    <form method="POST" action="<?php echo setUrl("Notificacion", "Notificacion", "postCrear"); ?>">
        
    <div class="cajas" style="position: relative; top: 8px">
        <span class="comun" >Selecione una prueba desarrollada*</span>
        <select name="pruebaNotificacion" id="pruebaDesarollada" class="ex-events textarea" data-url="<?php echo setUrl("Notificacion", "Notificacion", "pruebaDesarrollada", "ajax"); ?>">
            <option value="#">Selecion de prueba desarrollada</option>
            <?php
                foreach ($sqlPrueba as $prueba){
                    echo "<option value='".$prueba['id_pru_pro']."'>".$prueba['descripcion_pru_pro']."</option>";
                }
            ?>
        </select>
    </div>
    
    <span class="comun" >Nombre del creador</span>
    <span class="comun" style="padding-left: 225px;" >Modulo</span>
    <span class="comun" style="padding-left: 285px;" >Fecha de creacion</span>
    
    <div class="input-group cajas">
        <input type="text" id="nombrePrueba" class="form-control textarea" style="text-align: center;" />
        <input type="text" id="moduloPrueba" class="form-control textarea" style="text-align: center; font-family: monospace;" />
        <input type="text" id="fechaPrueba" class="form-control textarea" style="text-align: center;" />
    </div>
    
    <div class="cajas">
        <span class="comun" >Seleccion de usuarios que se notificaran*</span>
        <select name="moduloNotificacion" id="usuarioNotificado" data-url="<?php echo setUrl("Notificacion","Notificacion","usuarioNotificado","ajax"); ?>" class="ex-events textarea">
            <option value="#">Seleccion de usuarios</option>
            <?php
                foreach($sqlUsuario as $sqlUsu){
                    echo "<option value='".$sqlUsu['id_usu']."'>".$sqlUsu['nombre']." ".$sqlUsu['apellido']."</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="border bor-rad p-10 blanco" style="height: 400px; overflow: auto; position: relative; top: 7px;">
        <table class="table border blanco table-bordered table-striped">
            <thead >
                <tr>
                    <div class="text-center font-weight-normal p-10">
                        <label class="labelHead">LISTADO DE USUARIOS A NOTIFICAR</label>
                    </div>
                </tr>
                <tr class="labelCP" style="border-bottom: 5px; border-bottom: 3px solid #dee2e6;" >
                    <th class="labelHead" style="font-weight: 500;">Nombre</th>
                    <th class="labelHead" style="font-weight: 500;">Correo</th>
                    <th class="labelHead" style="font-weight: 500; width: 10px;">Eliminar</th>
                </tr>
            </thead>
            <tbody class="comun" id="notificacionUsuario">
                
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        <input id="registroNotificacion" class="btn btn-azul btn-block comun" type="submit" value="Enviar noficacion" data-url="<?php echo setUrl("Notificacion", "Notificacion", "postCrear", "ajax"); ?>"/>
    </div>
    </form>
</div>
<div style="margin: 200px;"></div>