<div class="row">
    <div class="card col-12 box" style="max-height: 350px; overflow-y: scroll;overflow-x: hidden;">
        <div class="row">
            <div class="col-8 mt-3">
                <h4>Asignar Vehículo</h4>
            </div>
        </div>
        <div class="card-body" id="DragVehiculos">
            <div class="serachInputDrag">
                <label for="searchInputVehiculo">Búscar Vehiculos: </label>
                <input type="text" name="" oninput="searchVehiculoDrag()" id="searchInputVehiculo">
            </div>

            <section id="vehicles-Assigment-section">

                <div id="selected-AllVehiclesResume">
                    <table id="allVehiclesTable">
                        <thead>
                            <tr>
                                <th>
                                    Tipo
                                </th>
                                <th>
                                    Propietario
                                </th>
                                <th>
                                    Patente
                                </th>
                                <th>
                                    CostoViaje
                                </th>
                                <th>
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>


                <div id="selected-vehiclesSideResume">
                    <h4>Vehículos a disponer</h4>
                    <table id="selectedVehiculoSideResume">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <thead>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="projectSave-footer">
    <div class="returnPreviusPage">
        <button class="s-Button-w" style="width: 170px;" id="saveDraft">
            <p class="s-P-g">Guardar Borrador</p>
        </button>
    </div>

    <div class="saveProject">
        <button class="s-Button" id="openVenta" style="width: 170px;">
            <p class="s-P">guardar</p>
        </button>
    </div>
</div>

