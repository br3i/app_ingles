<div class="modal fade" id="editChildresn<?php echo $mostrar['ID_CLI']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #563d7c !important;">
        <h6 class="modal-title" style="color: #fff; text-align: center;">
            Actualizar Información
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="../../Modelo/cliente/Actualizar.php">
        <input type="hidden" name="id" value="<?php echo $mostrar['ID_CLI']; ?>">

            <div class="modal-body" id="cont_modal">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" pattern="[0-9]{10}" name="cedula" value="<?php echo $mostrar['cedula']?>" disabled>
                <label class="mdl-textfield__label" for="cedula">Cédula</label>
              </div>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" maxlength="20" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="nombreCli" value="<?php echo $mostrar['nombre']; ?>" required="true">
                <label class="mdl-textfield__label" for="nombreCli">Nombre</label>
                <span class="mdl-textfield__error">Nombre Invalido</span>
              </div>
              
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" maxlength="20" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="apellidoCli" value="<?php echo $mostrar['apellido']; ?>" required="true">
                <label class="mdl-textfield__label" for="apellidoCli">Apellido</label>
                <span class="mdl-textfield__error">Apellido Invalido</span>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" maxlength="10" id="teleCli" name="teleCli" pattern="-?[0-9]*(\.[0-9]+)?" value="<?php echo $mostrar['telefono']; ?>" required="true" >
                <label class="mdl-textfield__label" for="teleCli">Teléfono</label>
                <span class="mdl-textfield__error">Telefono Invalido</span>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" maxlength="30" name="direcCli" value="<?php echo $mostrar['direccion']; ?>" required="true">
                <label class="mdl-textfield__label" for="direcCli">Dirección</label>
                <span class="mdl-textfield__error">Direccion Invalida</span>
              </div>	
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->
