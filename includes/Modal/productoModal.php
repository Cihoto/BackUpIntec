<!-- end modal -->
<div class="modal fade modal-xl" id="productoUnitarioCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar un nuevo Producto al inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productosCreateUnitario">
                    <div class="containter">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label for="inputNombreProducto">Nombre Producto</label>
                                <input type="text" class="form-control" name="txtNombreProducto" id="inputNombreProducto" placeholder="Nombre Producto">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="categoriaSelect">Categoría</label>
                                <select class="form-select" name="categoriaSelect" id="categoriaSelect" aria-label="Default select example">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="marcaSelect">Marca</label>
                                <select class="form-select" name="marcaSelect" id="marcaSelect" aria-label="Default select example">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="itemSelect">Item</label>
                                <select class="form-select" name="itemSelect" id="itemSelect" aria-label="Default select example">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="inputCantidad">Stock</label>
                                <input type="number" class="form-control" name="txtCantidad" id="inputCantidad" placeholder="Cantidad">
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <label for="inputPrecioCompra">Precio Compra</label>
                                <input type="text" class="form-control" name="txtPrecioCompra" id="inputPrecioCompra" placeholder="Precio Compra">
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <label for="inputPrecioEstimadoArriendo">Precio Estimado Arriendo</label>
                                <input type="text" class="form-control" name="txtPrecioEstimadoArriendo" id="inputPrecioEstimadoArriendo" placeholder="Precio Arriendo">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-end">
                        <button class="btn btn-danger col-md-3 col-12 buton-margin margin-button">Cancelar</button>
                        <input type="submit" class="btn btn-success col-md-3 col-12 margin-button" value="Guardar">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>