<form id="clienteForm" style="margin: 30px;">
    <div class="row centered-spaced">
        <div class="col-12 mb-4" >
            <label for="selectProjectClient">Buscar Clientes</label>
            <select class="form-select" id="clienteSelect" name="selectCliente">
                <option value=""></option>
                <option value="new" style="background-color: green;color: white;font-weight: 700; ">Nuevo Cliente <p><i class="fa-solid fa-plus"></i></p></option>
            </select>
        </div>
        <hr>
        <div style="display: flex;">
            <h4>Datos Personales</h4>
        </div>
        <div class="col-md-4 col-12">
            <label for="inputNombreCliente">Nombres</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtNombreCliente" id="inputNombreClienteForm" placeholder="">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputApellidos">Apellidos</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtApellidos" id="inputApellidos" placeholder="">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputRutCliente">Rut</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtRut" id="inputRutCliente" placeholder="">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputCorreo">Correo</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtCorreo" id="inputCorreo" placeholder="">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputTelefono">Teléfono</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtTelefono" id="inputTelefono" placeholder="">
        </div>
    </div>
    <hr />

    <div class="checkbox-wrapper-1 existingPersonal col-md-4 col-5 d-flex justify-content-space-between ">
        <input id="clientHasFacturacion" class="substituted" type="checkbox" aria-hidden="true" />
        <label for="clientHasFacturacion">Desplegar datos de facturación</label>
    </div>
    <div class="row mt-4" id="clientFactData">
        <div style="display: flex;">
            <h4>Datos de facturación</h4>
        </div>
        <div class="col-md-4 col-12">
            <label for="inputRut">Rut</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtRut" id="inputRut" placeholder="Nombre">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputRazonSocial">Razon Social</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtRazonSocial" id="inputRazonSocial" placeholder="Nombre">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputRazonSocial">Nombre fantasía</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtNombreFantasia" id="inputNombreFantasia" placeholder="Nombre">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputDireccionCliente">Dirección</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtDireccionDatosFacturacion" id="inputDireccionDatosFacturacion" placeholder="Nombre">
        </div>
        <div class="col-md-4 col-12">
            <label for="inputDireccionCliente">Correo</label>
            <input <?php echo $disabled;?> type="text" class="form-control" name="txtCorreoDatosFacturacion" id="inputCorreoDatosFacturacion" placeholder="Nombre">
        </div>
    </div>

    <?php  if(in_array("7", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)):?>
        <div style="display: flex; margin-top: 50px; justify-content:space-between">
            <button class="btn btn-success" style="justify-self: start;" onclick="CleanCliente()">Limpiar Formulario</button>
            <button type="submit" id="addCliente" class="btn btn-success" >
                <i class="bx bx-check d-block d-sm-none"></i>
                <span id="clientDataBtn" class="d-none d-sm-block">Guardar</span>
            </button>
        </div>
    <?php endif;?>

</form>