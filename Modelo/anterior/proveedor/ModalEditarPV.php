
<!--ventana para Update--->
<div class="modal fade" id="editarProve<?php echo $mostrarPV['ID_PRO']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
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

      <form method="POST" action="../../Modelo/proveedor/ActualizarPV.php">
        <input type="hidden" name="idPV" value="<?php echo $mostrarPV['ID_PRO']; ?>">
          <div class="modal-body" id="cont_modal">
      	    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="nombrePV" name="nombrePV" value="<?php echo $mostrarPV['nombre']?>" required="true">
              <label class="mdl-textfield__label" for="nombrePV"> Nombre Proveedor</label>
              <span class="mdl-textfield__error">Nombre Invalido</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="asesorPV" name="asesorPV" value="<?php echo $mostrarPV['asesor']?>">
              <label class="mdl-textfield__label" for="ase">Asesor</label>
              <span class="mdl-textfield__error">Apellido Invalido</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="telePV" name="telePV" pattern="-?[0-9]*(\.[0-9]+)?" value="<?php echo $mostrarPV['telefono']?>">
              <label class="mdl-textfield__label" for="telePV">Teléfono</label>
              <span class="mdl-textfield__error">Telefono Invalido</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="direcPV" name="direcPV" value="<?php echo $mostrarPV['direccion']?>">
              <label class="mdl-textfield__label" for="direcPV">Direccion</label>
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
