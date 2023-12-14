<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Detalles</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="products-tab" data-bs-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Inventario</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="false">Personal</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="true">Vehículo</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="venta-tab" data-bs-toggle="tab" href="#venta" role="tab" aria-controls="venta" aria-selected="false">Venta</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="costo-tab" data-bs-toggle="tab" href="#costo" role="tab" aria-controls="costo" aria-selected="false">Costo</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="resumen-tab" data-bs-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="false">Resumen</a>
    </li>
</ul>
<div class="divider" style="margin-top: -25px;"></div>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active tab-data" id="details" role="tabpanel" aria-labelledby="details-tab">

        <div class="form-group">
            <div class="mt-2">
                <form id="projectForm">
                    <div class="formHeader">
                        <svg style="margin-top:4px" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <circle cx="6" cy="6" r="6" fill="#069B99" />
                        </svg>
                        <p class="header-P" style="margin: 0px!important;"> Ingresa la información del evento</p>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-7">
                            <div class="row">
                                <div class="form-group col-7">
                                    <label for="inputProjectName" class="inputLabel">Nombre del evento</label>
                                    <input id="inputProjectName" name="txtProjectName" type="text" class="form-control input-lg s-Input" value="" />
                                    <p class="errMessaje" id="eventNameMessage">Debes ingresar un nombre para el proyecto</p>
                                </div>
                                <div class="form-group col-5">
                                    <label for="event_type" class="inputLabel">*Tipo de evento</label>
                                    <select style="width: 100%;" id="event_type" name="event_type" type="text" class="form-select input-lg s-Select">
                                        <option value=""></option>
                                        <option value="1">Evento corporativo </option>
                                        <option value="2">Recital o festival </option>
                                        <option value="3">Fiestas</option>
                                        <option value="4">Matrimonio</option>
                                        <option value="5">Seminario, charlas o conferencias</option>
                                        <option value="6">Rental</option>
                                        <option value="7">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group col-7">
                                    <label for="eventOwner" class="inputLabel" style="z-index: 10000;">Owner</label>
                                    <!-- <input id="eventOwner" name="eventOwner" type="text" class="form-control input-lg s-Input" value="" /> -->
                                    <select style="width: 100%;" id="ownerSelect" name="ownerSelect" type="text" class="form-select input-lg s-Select ">
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label for="inputNombreCliente" class="inputLabel">Cliente</label>
                                    <input id="inputNombreCliente" name="txtCliente" type="text" class="form-control input-lg s-Input" value="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7" style="display: flex;flex-direction: column;justify-content: start;">
                                    <p class="date-header">Fecha del evento</p>
                                    <div style="display: flex; gap: 8px;">
    
                                        <div class="form-group col-6">
                                            <label for="fechaInicio" class="inputLabel dateLabel">Inicio</label>
                                            <input id="fechaInicio" name="dpInicio" type="date" class="form-control input-lg s-Input">
                                        </div>
    
                                        <div class="form-group col-6">
                                            <label for="fechaTermino" class="inputLabel dateLabel">Término (opcional)</label>
                                            <input id="fechaTermino" name="dpTermino" disabled type="date" class="form-control input-lg s-Input">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-8" style="margin-top: 25px!important;">
                                <label for="direccionInput" class="inputLabel">Dirección del evento</label>
                                <input id="direccionInput" name="txtDir" type="text" class="form-control input-lg s-Input">
                            </div> -->
                                <div class="form-group col-5" style="margin-top: 25px!important;">
                                    <label for="dirInput" class="inputLabel">Dirección del evento</label>
                                    <input id="dirInput" name="txt_dir" type="text" class="form-control input-lg s-Input">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            
                            <div class="rowjustify-content-end">
                                <div id="map" style="width:580px;height : 400px;margin-top:-50px;"></div>
                            </div>
                        </div>
                    </div>


                    <div class="scheduleModule d-flex" style="width: 100%;">

                        <div class="d-flex" style="width: 80%;flex-direction: column;">
                            <p class="date-header" style="margin-bottom: 0px!important;overflow-x: hidden;">Horarios del evento</p>
                            <div class="schedulesContainer hiddenScroll" id="schedule-container">
                                <div class="schedule-item" schedule_id="1" >
                                    <div class="schedule-data">
                                        <img src="../assets/svg/editPencil.svg" alt="">
                                        <input type="text" class="detail" placeholder="desc">
                                        <input type="time" class="hour" name="appt"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="addSchedule d-flex" style="align-items: end;width: 30%;justify-content: end;">
                            <button class="s-Button-w" style="width: 150px;" id="createNewSchedule" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                    <path d="M9.5 3.75V14.25" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.25 9H14.75" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="s-P-g">más horarios</p>
                            </button>
                        </div>
                    </div>

                    <div class="form-floating mt-3">
                        <textarea class="form-control" style="min-height: 150px;" placeholder="" id="commentProjectArea" name="txtAreaComments"></textarea>
                        <label for="commentProjectArea">Comentarios</label>
                    </div>


                    <!-- <form id="addFilesToEvent" enctype="multipart/form-data" action="#" method="post"> -->
                        <div class="d-flex" style="flex-direction: column;margin-top: 10px;">
                            <p class="date-header" style="margin: 0px!important;">Cargar archivos</p>
                            <input type="file" name="archivo[]" id="archivo" class="file-uploader" multiple style="border: 1px dashed var(--black-grey-100, #BEC0CA)!important;">
                        </div>
                        <!-- <input type="submit" style="display: none;" value="addDocuments" id="addDocuments"> -->

                    </form> 
                    <button type="submit" style="display: none;" id="hiddenAddProject" class="btn btn-success ml-1 col-4">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Guardar</span>
                    </button>
                </form> 

                <div class="projectSave-footer">
                    <div class="returnPreviusPage">
                        <button class="s-Button-w saveDraft" style="width: 170px;" id="">
                            <p class="s-P-g">Guardar Borrador</p>
                        </button>
                    </div>
                    <div class="saveProject">
                        <button class="s-Button createOrContinue" id="createProject" style="width: 170px;">
                            <p class="s-P">guardar</p>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="tab-pane fade tab-data" id="products" role="tabpanel" aria-labelledby="products-tab">
        <?php require_once('./includes/dragAndDrop/dragProductos.php'); ?>
    </div>
    <div class="tab-pane fade tab-data" id="personal" role="tabpanel" aria-labelledby="personal-tab">
        <?php require_once('./includes/dragAndDrop/dragPersonal.php'); ?>
    </div>
    <div class="tab-pane fade tab-data" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
        <?php require_once('./includes/dragAndDrop/dragVehiculos.php'); ?>
    </div>
    <div class="tab-pane fade tab-data" id="venta" role="tabpanel" aria-labelledby="venta-tab">
        <?php require_once('./includes/dragAndDrop/venta.php'); ?>
    </div>
    <div class="tab-pane fade tab-data" id="costo" role="tabpanel" aria-labelledby="costo-tab">
        <?php require_once('./includes/dragAndDrop/costos.php'); ?>
    </div>
    <div class="tab-pane fade tab-data" id="resumen" role="tabpanel" aria-labelledby="resumen-tab">
        <?php require_once('./includes/resumeProjectTable.php') ?>
    </div>
</div>


