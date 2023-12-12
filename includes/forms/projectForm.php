<div class="card box">
    <div class="card-body">
        <div class="form-group">
            <div class="mt-2">
                <form id="projectForm">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="inputProjectName">Nombre del proyecto</label>
                            <input <?php echo $disabled;?> type="text" class="form-control" name="txtProjectName" id="inputProjectName" placeholder="Nombre">
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="fechaInicio">Fecha del Proyecto</label>
                            <input <?php echo $disabled;?> type="date" class="form-control" name="dpInicio" id="fechaInicio">
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="fechaTermino">Fecha del Proyecto</label>
                            <input <?php echo $disabled;?> type="date" class="form-control" name="dpTermino" id="fechaTermino">
                        </div>
                    </div>
                    <div class="mt-2 row">
                        <div class="col-lg-6 col-md-12">
                            <label for="direccionInput">Direccion del proyecto</label>
                            <input <?php echo $disabled;?> autocomplete="off" type="text" idCliente class="form-control" name="txtDir" id="direccionInput" placeholder="Dirección">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="inputNombreCliente">Nombre Cliente</label>
                            <input <?php echo $disabled;?> autocomplete="off" type="text" class="form-control" name="txtCliente" id="inputNombreCliente" placeholder="Cliente">
                        </div>
                    </div>

                    <div class="form-floating mt-3">
                        <textarea <?php echo $disabled; ?>class="form-control" style="min-height: 150px;" placeholder="" id="commentProjectArea" name="txtAreaComments"></textarea>
                        <label for="commentProjectArea">Comentarios</label>
                    </div>

                    <button type="submit" style="display: none;" id="hiddenAddProject" class="btn btn-success ml-1 col-4">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Guardar</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>