<!-- MODAL CATEGORIA ITEM -->
<div class="modal fade modal-xl" id="cargoEspecialidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Agrega tus categorías o ítems</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3">

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="categoria-tab" data-bs-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="true">
                                Crear cargo
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="false">
                                Crear Especialidad
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
                            <form id="addCategoria">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="CargoName">Nombre del cargo</label>
                                        <input type="text" name="CargoName" class="form-control" id="CargoName">
                                    </div>
                                    <p>Para poder agregar multiples cargos separe los nombres por una coma</p>
                                    <p>Ejemplo : Cargo 1 , Cargo 2, Cargo 3</p>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="row">
                                    <input type="button" class="btn btn-success" id="btnConfirmCargo" value="Agregar">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
                            <form id="addItem">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="especialidadName">Nombre de la Especialidad</label>
                                        <input type="text" name="especialidadName" class="form-control" id="especialidadName">
                                    </div>
                                    <p>Para poder agregar multiples items separe los nombres por una coma</p>
                                    <p>Ejemplo : Especialidad 1 , Especialidad 2, Especialidad 3</p>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="row">
                                    <input type="button" class="btn btn-success" id="btnConfirmEspecialidad" value="Agregar">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL DIRECCION -->