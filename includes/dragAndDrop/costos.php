
<div id="costoEventos" style="margin-top: 30px;min-height:0px;max-height: 400px; overflow-y:scroll; margin-bottom: 30px;">
    <div class="accordion" id="cardAccordion">

        <div class="card-top-acordion" id="personalHeading" data-bs-toggle="collapse" data-bs-target="#personalAcordion" aria-expanded="false" aria-controls="personalAcordion" role="button">
            
            <p class="s-P s-P-Acordion">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 11.25L9 6.75L4.5 11.25" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>   
                Agregar Costos de personal
            </p>
        </div>
        <div id="personalAcordion" class="collapse pt-1" aria-labelledby="personalHeading" data-parent="#cardAccordion">
            <div class="row justify-content-center">
                <div class="col-11">
                <div class="d-flex col-md-6 col-12 justify-content-center">
                    <p>Filtrar Técnicos por tipo de contrato</p>
                    <select name="" id="projectResumeFilter-products">
                        <option value="all">Todos</option>
                    </select>
                </div>
                    <table id="selectedPersonalAssigtment" class="table">
                        <thead>
                            <!-- NOMBRE DEL TECNICO - CONTRATO - HORAS TRABAJADAS -TOTAL ; -->
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Tipo de contrato</th>
                                <th>Valor hora</th>
                                <th>Horas trabajadas</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card collapse-header c0mb">
            <div class="card-top-acordion" id="vehiculos-Heading" data-bs-toggle="collapse" data-bs-target="#vehiculoAcordion" aria-expanded="false" aria-controls="vehiculoAcordion" role="button">
                <p class="s-P s-P-Acordion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 11.25L9 6.75L4.5 11.25" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>   
                    Agregar Costos de vehículos
                </p>
            </div>
            <div id="vehiculoAcordion" class="collapse pt-1" aria-labelledby="vehiculos-Heading" data-parent="#cardAccordion">
                <div class="card-body">
                    <table id="selectedVehiclesCosts">
                        <thead>
                            <tr>
                                <th>Tipo Vehículo</th>
                                <th>Propietario</th>
                                <th>Costo por Viaje</th>
                                <th>Cantidad de viajes</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card collapse-header c0mb">
            <div class="card-top-acordion" id="others-Heading" data-bs-toggle="collapse" data-bs-target="#othersAcordion" aria-expanded="false" aria-controls="othersAcordion" role="button">
                <p class="s-P s-P-Acordion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 11.25L9 6.75L4.5 11.25" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>   
                    Agregar costos de otros
                </p>
            </div>
            <div id="othersAcordion" class="collapse pt-1" aria-labelledby="subArriendo-Heading" data-parent="#cardAccordion">
                <div class="card-body">
                    <p>Otros</p>
                </div>
            </div>
        </div>
        <div class="card collapse-header c0mb">
            <div class="card-top-acordion" id="subArriendo-Heading" data-bs-toggle="collapse" data-bs-target="#subArriendoAcordion" aria-expanded="false" aria-controls="subArriendoAcordion" role="button">
                <p class="s-P s-P-Acordion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 11.25L9 6.75L4.5 11.25" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>   
                    Agregar Costos de subarriendos
                </p>
            </div>
            <div id="subArriendoAcordion" class="collapse pt-1" aria-labelledby="subArriendo-Heading" data-parent="#cardAccordion">
                <div class="card-body">
                    <?php require_once('./includes/dragAndDrop/subarriendosAssigments.php')?>
                </div>
            </div>
        </div>
        <div class="card collapse-header c0mb">
            <div class="card-top-acordion" id="subArriendo-Heading" data-bs-toggle="collapse" data-bs-target="#rendicionesAcordion" aria-expanded="false" aria-controls="rendicionesAcordion" role="button">
                <p class="s-P s-P-Acordion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 11.25L9 6.75L4.5 11.25" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>   
                    Agregar Costos de Rendiciones
                </p>
            </div>
            <div id="rendicionesAcordion" class="collapse pt-1" aria-labelledby="subArriendo-Heading" data-parent="#cardAccordion">
                <div class="card-body">
                    <?php require_once('./includes/dragAndDrop/dragRendiciones.php')?>
                    
                </div>
            </div>
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
        <button class="s-Button" id="openResumen" style="width: 170px;">
            <p class="s-P">guardar</p>
        </button>
    </div>
</div>