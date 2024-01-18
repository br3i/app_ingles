
<!--ventana para Update--->
<div class="modal fade" id="editarCATE<?php echo $mostrar['ID_CATE']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
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

      <form method="POST" action="../../Modelo/categoria/ActualizarCate.php">
        <input type="hidden" name="idCATE" value="<?php echo $mostrar['ID_CATE']; ?>">
          <div class="modal-body" id="cont_modal">
      	    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="Categoria" name="Categoria" value="<?php echo $mostrar['categoria']?>" required="true">
              <label class="mdl-textfield__label" for="Categoria"> Categoría</label>
              <span class="mdl-textfield__error">Nombre Invalido</span>
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
