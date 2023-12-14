<!-- MODAL DIRECCION -->
<div class="modal fade text-left" id="direccionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Dirección del proyecto </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="direccionAddForm">
                <p id="idDireccionModal"></p>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dirSelect">Búscar Dirección</label>
                        <select <?php echo $disabled; ?> class="form-select" name="dirSelector" id="dirSelect" aria-label="">
                            <option value=""></option>
                        </select>
                    </div>
                    <hr/>
                    <div class="form-group" style="margin-top: 50px;">
                        <label for="txtDir">Dirección</label>
                        <input <?php echo $disabled; ?> type="text" name="txtDir" id="txtDir" placeholder="Dir" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="txtNumDir">Número </label>
                        <input <?php echo $disabled; ?> type="number" name="txtNumDir" id="txtNumDir" placeholder="Num" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtDepto">Depto </label>
                        <input <?php echo $disabled; ?> type="text" name="txtDepto" id="txtDepto" placeholder="Depto/Bloque/Casa" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtcodigo_postal">Codigo postal </label>
                        <input <?php echo $disabled; ?> type="text" name="txtcodigo_postal" id="txtcodigo_postal" placeholder="Código postal" class="form-control">
                    </div>

                    <label for="regionSelect">Región</label>
                    <select <?php echo $disabled; ?> class="form-select" onchange="GetComunas()" name="regionSelect" id="regionSelect" aria-label="Default select example">
                        <option value=""></option>
                        <?php foreach ($regiones as $region) : ?>
                            <option value="<?= $region->id ?>"><?= $region->region ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="comunaSelect">Comuna</label>
                    <select <?php echo $disabled; ?> class="form-select" name="comunaSelect" id="comunaSelect" aria-label="Default select example">

                    </select>
                </div>
                <?php  if(in_array("7", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)):?>
                <div class="modal-footer row" style="justify-content: space-between;">
                    <button type="button" class="btn btn-danger col-4" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancelar</span>
                    </button>
                    <button type="submit" id="addDireccion" class="btn btn-success ml-1 col-4">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Guardar</span>
                    </button>
                </div>
                <?php endif;?>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL DIRECCION -->