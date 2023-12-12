<div class="modal fade" id="arriendosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content" style="padding: 20px;">
            <div class="modal-header">
                <h2>Ingresar nuevos datos de subarriendo</h2>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="card box">
                <form id="arriendoForm">
                    <div class="row centered-spaced">
                        <div class="row card mb-3">
                            <div class="card-header">
                                <h4>Datos del subarriendo</h4>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6 col-12">
                                    <label for="nombreArriendo">Nombre Arriendo</label>
                                    <input type="text" name="nombreArriendo" id="nombreArriendo" class="form-control" placeholder="Nombre">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="valorArriendo">Valor Arriendo</label>
                                    <input type="text" name="valorArriendo" id="valorArriendo" class="form-control" placeholder="Valor">
                                </div>
                            </div>
                        </div>
                        <div class="row card mb-3">
                            <div class="card-header">
                                <h4>Datos del proveedor</h4>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-4 col-12">
                                    <label for="inputNombre">Nombres</label>
                                    <input type="text" class="form-control" name="txtNombre" id="inputNombreForm" placeholder="">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputApellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="txtApellidos" id="inputApellidos" placeholder="">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputRut">Rut</label>
                                    <input type="text" class="form-control" name="txtRut" id="inputRut" placeholder="">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputCorreo">Correo</label>
                                    <input type="text" class="form-control" name="txtCorreo" id="inputCorreo" placeholder="">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="inputTelefono">Teléfono</label>
                                    <input type="text" class="form-control" name="txtTelefono" id="inputTelefono" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row card mb-3">
                        <div class="card-header">
                            <h4>Datos de facturación del proveedor</h4>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4 col-12">
                                <label for="inputRut">Rut</label>
                                <input type="text" class="form-control" name="txtRut" id="inputRut" placeholder="">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="inputRazonSocial">Razón Social</label>
                                <input type="text" class="form-control" name="txtRazonSocial" id="inputRazonSocial" placeholder="">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="inputRazonSocial">Nombre fantasía</label>
                                <input type="text" class="form-control" name="txtNombreFantasia" id="inputNombreFantasia" placeholder="">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="inputDireccionCliente">Dirección</label>
                                <input type="text" class="form-control" name="txtDireccionDatosFacturacion" id="inputDireccionDatosFacturacion" placeholder="">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="inputDireccionCliente">Correo</label>
                                <input type="text" class="form-control" name="txtCorreoDatosFacturacion" id="inputCorreoDatosFacturacion" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row card">
                        <div class="card-body row centered-spaced">

                            <button class="btn btn-success col-2" style="min-height: 50px;" onclick="CleanCliente()">
                                Limpiar Formulario
                            </button>

                            <button type="submit" id="addArriendo" style="min-height: 50px;" class="btn btn-success col-4">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>