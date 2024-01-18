<!-- Ventana modal para eliminar -->
<div class="modal fade" id="deleteChildresn<?php echo $mostrar['ID_CLI']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                ¿Realmente deseas eliminar a ?
            </h4>
        </div>

        <div class="modal-body">
          <strong style="text-align: center !important"> 
            <?php echo $mostrar['nombre']; ?>
        
          </strong>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger btnBorrar" data-dismiss="modal" id="<?php echo $mostrar['ID_CLI']; ?>">Borrar</button>
        </div>
    
        </div>
      </div>
</div>
<!---fin ventana eliminar--->
