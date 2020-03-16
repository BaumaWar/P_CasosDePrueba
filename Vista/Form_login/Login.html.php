<div id="alertLogin" class="posicion3 width_70" style="margin-left: 20px;"></div>
<div class="container login p-3 border bor-rad sombra bg-blanco rebosar">
    <div class="text-center font-weight-normal p-10">
        <label class="labelHead">INICIO DE SESION</label>
    </div>
    <form method="POST" action="<?php echo setUrl("Usuario", "Login", "postLogin"); ?>">
        <div class="cajas">
            <span class="comun" >Correo*</span>
            <input name="correo" type="email" class="form-control textarea" />
        </div>
        <div class="cajas">
            <span class="comun" >Contraseña*</span>
            <input name="clave" type="password" class="form-control textarea" />
        </div>
        <div style="padding-top: 10px">
            <button type="submit" class="btn btn-azul text-whites btn-block" >Iniciar</button>
        </div>
        <a href="index.php?modulo=Usuario&controlador=Login&funcion=crear">
            <span class="text-primary mano" id="registrar" style="font-size: 12;" title="Registrate si no tiene cuenta">Registrate</span>
        </a>
        <!--<span class="text-primary mano" id="registrar2" style="font-size: 12;" data-toggle="modal" data-target=".modal-recuperacion">¿Olvido su contraseña?</span>-->
    </form>
</div>

<div class="modal fade modal-recuperacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Recuperacion de cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Correo*</label>
                <input type="text" class="form-control" id="correo_recuperacion">
                <input type="hidden" id="rutaRecuperacion" data-url="<?php echo setUrl("Usuario", "Login", "recuperarContraseña","ajax"); ?>">
              </div>
                <button type="button" class="btn btn-segundo" id="recuperar_cuenta">Enviar</button>
            </form>
        </div>
        
    </div>
  </div>
</div>