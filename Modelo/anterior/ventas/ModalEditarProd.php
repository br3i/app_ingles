
<!--ventana para Update--->
<div class="modal fade" id="editarProd<?php echo $mostrarPd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
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

      <form method="POST" action="../../Modelo/producto/Actualizar.php">
        <input type="hidden" name="idProv" value="<?php echo $mostrarPd['id']; ?>">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <?php $mysqli = new mysqli('localhost', 'root', '', 'vivero');?>
          <label for="">Proveedor </label>
              <?php
                $query = $mysqli -> query ("SELECT a.nombre as nombre FROM proveedores as a INNER JOIN producto as b ON a.ID_PRO=b.ID_PRO");
                IF ($valores = mysqli_fetch_array($query)) {
                  ?>
                  <option><?php echo $valores['nombre']?></option> <?php
                }?>
          </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="producto" name="producto" value="<?php echo $mostrarPd['nombre']?>">
          <label class="mdl-textfield__label" for="producto">Producto</label>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <?php $mysqli = new mysqli('localhost', 'root', '', 'vivero');?>
          <label for="">Categotia</label> <br>
          <select class="mdl-textfield__input" name="categoria">
              <?php
                $query1 = $mysqli -> query ("SELECT a.categoria as categoria FROM categoria as a INNER JOIN producto as b ON a.ID_CATE=b.tipo");
                IF ($valores1 = mysqli_fetch_array($query1)) {
                  ?>
                  <option ><?php echo $valores1['categoria']?></option> <?php
                }
                $query1 = $mysqli -> query ("SELECT * FROM categoria");
                while ($valores1 = mysqli_fetch_array($query1)) {
                  echo '<option value="'.$valores1['ID_CATE'].'">'.$valores1['categoria'].'</option>';
                }?>

          </select>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="number" name="cantidad" id="cantidad" min="1" pattern="^[0-9]+" value="<?php echo $mostrarPd['cantidad']?>" required="true">
          <label class="mdl-textfield__label" for="direcCli">Cantidad</label>
          <span class="mdl-textfield__error"> Invalida</span>
        </div>
        
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" name="minorista" id="minorista" min="1" pattern="^[0-9]+(\.[0-9]{1,2})?$" value="<?php echo $mostrarPd['pMenor']?>" required="true">
          <label class="mdl-textfield__label" for="direcCli">Precio Minorista</label>
          <span class="mdl-textfield__error"> Invalida</span>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" name="mayorista" id="mayorista" min="1" pattern="^[0-9]+(\.[0-9]{1,2})?$" value="<?php echo $mostrarPd['pMayor']?>" required="true">
          <label class="mdl-textfield__label" for="direcCli">Precio Mayorista</label>
          <span class="mdl-textfield__error"> Invalida</span>
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
