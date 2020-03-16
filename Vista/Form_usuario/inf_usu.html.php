<?php foreach($infUsu as $inf){} ?>
<div style="width:560px ; position: relative; top:100px ; padding:20px; margin-bottom: 100px;" class="m-auto font-weight-normal bor-rad bg-blanco border bg-sombra">
    <table class="table table-bordered table-striped blanco">
      <thead>
        <tr>
            <th colspan="4" style="text-align:center; font-weight: 500;">
                <div class="text-center ">
                    <label class="labelHead">INFORMACION DE LA CUENTA</label>
                </div>
            </th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <th style="width:170px ; font-weight: 500;" class="labelHead">Nombre</th>
          <td colspan="3" class="labelHead"><?php echo $inf['nombre']; ?></td>
        </tr>
        <tr>
          <th style="width:170px ; font-weight: 500;" class="labelHead">Apellido</th>
          <td colspan="3" class="labelHead"><?php echo $inf['apellido']; ?></td>
        </tr>
        <tr>
          <th style="width:170px ; font-weight: 500;" class="labelHead">Tipo dodumento</th>
          <td colspan="3" class="labelHead">
           <?php  echo $inf['tip_doc_descripcion']; ?>
          </td>
        </tr>
        <tr>
          <th style="width:170px ; font-weight: 500;" class="labelHead">No. dodumento</th>
          <td colspan="3" class="labelHead"><?php echo $inf['num_documento']; ?></td>
        </tr>
        <tr>
          <th style="width:170px ; font-weight: 500;" class="labelHead">Telefono/Celular</th>
          <td colspan="3" class="labelHead"><?php echo $inf['telefono']; ?></td>
        </tr>
      </tbody>
    </table>
    <span class="row m-auto">
        <a href="index.php?modulo=Usuario&controlador=Usuario&funcion=editar" class="btn btn-verde labelCP" style="position: realtive; width:50%; text-decoration:none; color:black;">Editar informacion</a> 
        <a href="index.php?modulo=Usuario&controlador=Usuario&funcion=editarDatosAcceso" class="btn btn-amarillo labelCP" style="position: relative; width:50%; text-decoration:none; color:black;">Editar datos de acceso</a>
    </span>
</div>