<div cliente_id="" class="modal fade text-left w-100" id="clientInfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content overflow-auto">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body ">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos del Cliente</a>
                            </li>
                            <li class="nav-item" role="presentation" id="showEventsRecord">
                                <a class="nav-link" id="EventRecord-tab" data-bs-toggle="tab" href="#EventRecord" role="tab" aria-controls="EventRecord" aria-selected="false">Historial de Eventos</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form id="clienteForm" style="margin: 30px;">
                                    <div class="row centered-spaced">
                                        <hr>
                                        <div style="display: flex;">
                                            <h4>Datos Personales</h4>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="inputNombreCliente">Nombres</label>
                                            <input type="text" class="form-control" name="txtNombreCliente" id="clientName" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="inputApellidos">Apellidos</label>
                                            <input type="text" class="form-control" name="txtApellidos" id="clientLastName" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="inputRutCliente">Rut</label>
                                            <input type="text" class="form-control" name="txtRut" id="clientRut" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="inputCorreo">Correo</label>
                                            <input type="text" class="form-control" name="txtCorreo" id="clientEmail" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="inputTelefono">Teléfono</label>
                                            <input type="text" class="form-control" name="txtTelefono" id="clientNumber" placeholder="">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row mt-4">
                                        <div style="display: flex;">
                                            <h4>Datos de facturación</h4>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="clientRutDf">Rut</label>
                                            <input type="text" class="form-control" name="txtRut" id="clientRutDf" placeholder="Nombre">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="clientRazonSocial">Razon Social</label>
                                            <input type="text" class="form-control" name="txtRazonSocial" id="clientRazonSocial" placeholder="Nombre">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="clientNombreFantasia">Nombre fantasía</label>
                                            <input type="text" class="form-control" name="txtNombreFantasia" id="clientNombreFantasia" placeholder="Nombre">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="clientAddressDf">Dirección</label>
                                            <input type="text" class="form-control" name="txtDireccionDatosFacturacion" id="clientAddressDf" placeholder="Nombre">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="clientEmailDf">Correo</label>
                                            <input type="text" class="form-control" name="txtCorreoDatosFacturacion" id="clientEmailDf" placeholder="Nombre">
                                        </div>
                                    </div>

                                    <?php if (in_array("7", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)) : ?>
                                        <div style="display: flex; margin-top: 50px; justify-content:space-between">
                                            <button class="btn btn-success" style="justify-self: start;" onclick="CleanCliente()">Limpiar Formulario</button>
                                            <button type="submit" id="addCliente" class="btn btn-success">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span id="clientDataBtn" class="d-none d-sm-block">Guardar</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="EventRecord" role="tabpanel" aria-labelledby="EventRecord-tab">
                                
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>