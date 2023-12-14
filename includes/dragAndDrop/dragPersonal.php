<div class="row">
    <div class="col-12 " style="max-height: 800px; overflow-y: scroll;overflow-x: hidden;">
        <div class="row">
            <div class="col-8 mt-3">
                <h4>Asignar Personal</h4>
            </div>
        </div>
        <div class="card-body">

            <div class="searchRow">
                <div class="d-flex" style="align-items: end;">

                    <div style="margin-right: 8px;">
                        <label for="filterAllPersonal">Contrato</label>
                        <select name="filterAllPersonal" id="filterAllPersonal" class="form-select s-Select toRight" style="margin-bottom:0px">
                        </select>
                    </div>

                    <button class="s-Button-w">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path d="M17 2.75H2L8 9.845V14.75L11 16.25V9.845L17 2.75Z" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="s-P-g">Filtros</p>
                    </button>
                </div>

                <div>
                    <button class="s-Button" id="openModalNewFree">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path d="M9.5 17C13.6421 17 17 13.6421 17 9.5C17 5.35786 13.6421 2 9.5 2C5.35786 2 2 5.35786 2 9.5C2 13.6421 5.35786 17 9.5 17Z" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.5 6.5V12.5" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.5 9.5H12.5" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="s-P">Crear técnico</p>
                    </button>
                </div>

            </div>

            <div class="row">
                <div class="col-8">

                    <div class="tableContainer">
                        <table id="personalResumeAssigment" class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Especialidad</th>
                                    <th>Tipo Contrato</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-4">
                    <h4>Personal a disponer</h4>

                    <table id="selectedPersonalSideResume">
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
            </div>
        </div>
    </div>

</div>
<div class="projectSave-footer">
    <div class="returnPreviusPage">
        <button class="s-Button-w" style="width: 170px;">
            <p class="s-P-g">Guardar Borrador</p>
        </button>
    </div>

    <div class="saveProject">
        <button class="s-Button" id="openVehiculos" style="width: 170px;">
            <p class="s-P">guardar</p>
        </button>
    </div>
</div>