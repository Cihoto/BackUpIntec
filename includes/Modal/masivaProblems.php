<div class="modal fade text-left w-100" id="masivaProblems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content overflow-auto">
            <div class="modal-header">
                <h4 class="modal-title" id="masivaProblemsTitle"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row overflow-auto hiddenScroll" style="height: 250px;">
                    <table id="tableProblems" class="table overflow-auto table-responsive">
                        <thead>
                            <th>Fila Excel</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Rut</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Especialidad</th>
                            <th>Contrato</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="sideContainer overflow-auto">
                <div class="ulProblems">
                    <div class="problemContainer">
                        <p id="especialidadesProblem">Estos cargos no están ingresadas, ¿Desesas ingresarlos?</p>
                        <ul id="ulCargos" class="elementList">

                        </ul>
                        <hr>
                        <div class="flex just-content-end">
                            <button onclick="AddCargoMasiva()" class="btn-confirm">Agregar Todos</button>
                        </div>
                    </div>
                    <div class="problemContainer">
                        <p id="especialidadesProblem">Estas especialidades no están ingresadas, ¿Desesas ingresarlas?</p>
                        <ul id="ulEspecialidades" class="elementList">

                        </ul>
                        <hr>
                        <div class="flex just-content-end">
                            <button onclick="AddespecialidadMasiva()" class="btn-confirm">Agregar Todos</button>
                        </div>
                    </div>
                    <div class="problemContainer">
                        <p id="especialidadesProblem">Estas especialidades no están ingresadas, ¿Desesas ingresarlas?</p>
                        <ul class="elementList">
                            <li>Indefinido</li>
                            <li>Plazo Fijo</li>
                            <li>BHE</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancelar</span>
                </button>
                <button type="button" onclick="AddPersonalFromModalProblems()" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Agregar nuevamente</span>
                </button>
            </div>
        </div>
    </div>
</div>