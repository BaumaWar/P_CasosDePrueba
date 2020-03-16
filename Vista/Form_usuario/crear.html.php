<div id="alertLogin" class="posicion3 width_70" style="margin-left: 20px;"></div>
<div id="formCreUsu" class="container p-3 bor-rad sombra bg-blanco" >
    <div class="text-center font-weight-normal p-10">
        <label class="labelHead">REGISTRO DE USUARIO</label>
    </div>
    <form id="5form" >
        <div class="cajas">
            <span class="comun" id="nombreCrearUsuario">Nombre*</span>
            <input id="nombre" type="text" class="form-control textarea" required/>
        </div>
        <div class="cajas">
            <span class="comun" id="apellidoCrearUsuario">Apellido*</span>
            <input id="apellido" type="text" class="form-control textarea" required/>
        </div>  
        <div class="cajas">
            <span class="comun" id="tipoDocumentoUsuario">Tipo de documento*</span>
            <select id="tipDoc" class="form-control textarea" required>
                <option value="#">seleccion tipo de documento</option>
                <option value="1">CEDULA DE CIUDADANIA</option>
                <option value="2">TARJETA DE IDENTIDAD</option>
            </select>
        </div>
        <div class="cajas">
            <span class="comun" id="numeroDocumentoUsuario">Numero de documento*</span>
            <input id="documento" type="text" class="form-control textarea" required />
        </div>
        <div class="cajas">
            <span class="comun" id="telefonoCrearUsuario">Telefono/Celular*</span>
            <input id="telefono" type="text" class="form-control textarea" required />
        </div>
        <div class="cajas">
            <span class="comun" id="emailCrearUsuario">Email*</span>
            <input id="correo" type="email" class="form-control textarea" required/>
        </div>
        <div class="cajas">
            <span class="comun" id="contrasenaCrearUsuario">Contraseña*</span>
            <div class="input-group">
                <input id="password1" type="password" class="form-control" required/>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="correcto1">░</span>
                </div>
            </div>
        </div>
        <div class="cajas">
            <span class="comun" id="confirmeContrasenaUsuario">Confirme contraseña*</span>
            <div class="input-group">
                <input id="password2" type="password" class="form-control" required/>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="correcto2">░</span>
                </div>
            </div>
        </div>
        <div style="padding-top: 10px;">
            <button id="regUsu" type="button" data-url="<?php echo setUrl("Usuario", "Login", "postCrear", "ajax"); ?>" class="btn btn-azul btn-block">Registrar</button>
        </div>
    </form>
    <a class="comun text-primary mano" href="index.php?modulo=Usuario&controlador=Login&funcion=login">Regresar</a>
    <div id="alert" style="font-weight: 600; color: tomato;" align="center" ></div>
    
</div>
<div style="margin:350px;"></div>