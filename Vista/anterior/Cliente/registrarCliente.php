
<form name="form-data" action="../../Modelo/cliente/insertarCli.php" method="POST">
    <h5 class="text-condensedLight">Datos Cliente</h5>
		
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" pattern="[0-9]{10}" id="cedula" name="cedula" maxlength="10">
			<label class="mdl-textfield__label" for="cedula">Cédula</label>
			<label for="" id="error-cedula" style="color: blue; font-size: 13px"></label>
			<script>
					const cedula = document.getElementById("cedula");
					const errorCedula = document.getElementById("error-cedula");

					cedula.addEventListener("input", function() {
						let cedulaValue = cedula.value;
						let cedulaLength = cedulaValue.length;

						if (cedulaLength == 10) {
							let total = 0;
							let longitud = cedulaValue.length;
							let longcheck = longitud - 1;
							if (cedulaValue != "0000000000" &&
								cedulaValue != "2222222222" &&
								cedulaValue != "3333333333" &&
								cedulaValue != "4444444444" &&
								cedulaValue != "5555555555" &&
								cedulaValue != "6666666666" &&
								cedulaValue != "7777777777" &&
								cedulaValue != "8888888888" &&
								cedulaValue != "9999999999") {
								for (i = 0; i < longcheck; i++) {
									if (i % 2 === 0) {
										var aux = cedulaValue.charAt(i) * 2;
										if (aux > 9) aux -= 9;
										total += aux;
									} else {
										total += parseInt(cedulaValue.charAt(i));
									}
								}
								total = total % 10 ? 10 - total % 10 : 0;
								if (cedulaValue.charAt(longitud - 1) == total) {
									errorCedula.innerHTML = "Cédula Correcta";
								} else {
									//alert("Cédula inválida");
									errorCedula.innerHTML = "Cédula Invalida";
								}
							} else {
								//alert("Cédula inválida");
								errorCedula.innerHTML = "Maximo 10 digitos";
							}
						}
					});

				</script>
		
		
		</div>

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?"  maxlength="20" id="nombreCli" name="nombreCli">
			<label class="mdl-textfield__label" for="nombreCli">Nombre</label>
			<span class="mdl-textfield__error">Nombre Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" maxlength="20" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="apellidoCli" name="apellidoCli">
			<label class="mdl-textfield__label" for="apellidoCli">Apellido</label>
			<span class="mdl-textfield__error">Apellido Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" id="teleCli" maxlength="10" name="teleCli" pattern="-?[0-9]*(\.[0-9]+)?">
			<label class="mdl-textfield__label" for="teleCli">Teléfono</label>
			<span class="mdl-textfield__error">Telefono Invalido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" id="direcCli" maxlength="30" name="direcCli">
			<label class="mdl-textfield__label" for="direcCli">Direccion</label>
			<span class="mdl-textfield__error">Direccion Invalida</span>
		</div>	
        <div class="row justify-content-start text-center mt-5">
          <div class="col-12">
              <button class="btn btn-primary btn-block" id="btnEnviar" style="background-color: green;">
                  Registrar Cliente
              </button>
          </div>
      </div>
</form>



