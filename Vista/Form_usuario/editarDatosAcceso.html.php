<?php foreach($sqlCorreo as $correo){} ?>
<div id="setAlertDatos" class="posicion2 width_70"></div>
    <div id="formEdiDatAcc" class="container p-3 bor-rad sombra bg-blanco">
        <div class="text-center font-weight-normal p-10">
            <label class="labelHead">EDICION DE DATOS DE ACCESO</label>
        </div>
        <form>
            <div class="cajas">
                <span class="comun" id="emailUsuario" >Email*</span>
                <input id="correo" type="text" class="form-control textarea" value="<?php echo $correo['email']; ?>" />
            </div>
            <div class="cajas">
                <span class="comun" id="nuevaContrasena">Nueva contraseña*</span>
                <div class="input-group">
                    <input id="password1" type="password" class="form-control" required/>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="correcto1">░</span>
                    </div>
                </div>
            </div>
            <div class="cajas">
                <span class="comun" id="confirmeContrasena">Confirme contraseña*</span>
                <div class="input-group">
                    <input id="password2" type="password" class="form-control" required/>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="correcto2">░</span>
                    </div>
                </div>
            </div>
            <div style="padding-top: 10px;">
                <button id="ediDatAcc" type="button" data-url="<?php echo setUrl("Usuario", "Usuario", "posteditarDatosAcceso", "ajax"); ?>" class="btn btn-azul btn-block labelCP">Editar datos</button>
            </div>
        </form>
        <div id="alert" align="center" style="color: tomato; font-weight: 600;"></div>
    </div>