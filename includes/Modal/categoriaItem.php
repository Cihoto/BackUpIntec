<!-- MODAL CATEGORIA ITEM -->
<div class="modal fade modal-xl" id="modalCatItemAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                Asignar categoría
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="false">
                                Asignar ítem
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
                            <form id="addCategoria">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="CatName">Nombre de la categoría</label>
                                        <input type="text" name="CatName" class="form-control" id="CatName">
                                    </div>
                                    <p>Para poder agregar multiples categorías separe los nombres por una coma</p>
                                    <p>Ejemplo : categoría 1 , categoría 2, categoría 3</p>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="row">
                                    <input type="button" class="btn btn-success" onclick="AddCategoria()" id="btnConfirmCategoria" value="Agregar">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
                            <form id="addItem">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="ItemName">Nombre del Item</label>
                                        <input type="text" name="ItemName" class="form-control" id="ItemName">
                                    </div>
                                    <p>Para poder agregar multiples items separe los nombres por una coma</p>
                                    <p>Ejemplo : Item 1 , Item 2, Item 3</p>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="row">
                                    <input type="button" class="btn btn-success" onclick="AddItem()" id="btnConfirmItem" value="Agregar">
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