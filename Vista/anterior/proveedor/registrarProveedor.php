
<form name="form-data" action="../../Modelo/proveedor/insertar.php" method="POST">
    <h5 class="text-condensedLight">Datos Proveedor</h5>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="nombreP" name="nombreP" maxlength="20" >
			<label class="mdl-textfield__label" for="nombreP"> Nombre Proveedor</label>
			<span class="mdl-textfield__error">Nombre Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="asesor" name="asesor" maxlength="20">
			<label class="mdl-textfield__label" for="asesor">Asesor</label>
			<span class="mdl-textfield__error">Apellido Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" id="teleP" name="teleP" pattern="-?[0-9]*(\.[0-9]+)?" maxlength="10">
			<label class="mdl-textfield__label" for="teleP">Teléfono</label>
			<span class="mdl-textfield__error">Telefono Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" id="direcP" name="direcP" maxlength="20">
			<label class="mdl-textfield__label" for="direcP">Direccion</label>
			<span class="mdl-textfield__error">Direccion Invalida</span>
		</div>	
        <div class="row justify-content-start text-center mt-5">
          <div class="col-12">
              <button class="btn btn-primary btn-block" id="btnEnviar" style="background-color: green;">
                  Registrar Proveedor
              </button>
          </div>
      </div>
</form>
