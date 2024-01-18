
<form name="form-data" action="../../Modelo/Categoria/insertar.php" method="POST">
    <h5 class="text-condensedLight">Datos Categoría</h5>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="Categoria" name="Categoria" maxlength="20">
			<label class="mdl-textfield__label" for="Categoria"> Categoría</label>
			<span class="mdl-textfield__error">Categoria Invalida</span>
		</div>
        <div class="row justify-content-start text-center mt-5">
          <div class="col-12">
              <button class="btn btn-primary btn-block" id="btnEnviar" style="background-color: green;">
                  Registrar Categoría
              </button>
          </div>
      </div>
</form>
