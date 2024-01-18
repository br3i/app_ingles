<!-- Ventana modal para eliminar -->
<div class="modal fade" id="borrarCATE<?php echo $mostrar['ID_CATE']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          ¿Realmente deseas eliminar la categoría?
        </h4>
      </div>

      <div class="modal-body">
        <strong style="text-align: center !important"> 
          <?php echo $mostrar['categoria']; ?>
          <?php echo $mostrar['ID_CATE']; ?>  
          </strong>
        </div>
     
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger btnBorrar" data-dismiss="modal" idCATE="<?php echo $mostrar['ID_CATE']; ?>">Borrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!---fin ventana eliminar--->
