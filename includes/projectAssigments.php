<div class="card-body">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php if (in_array("5", $rol_id) || in_array("6", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">
                    Detalles
                </a>
            </li>
        <?php endif; ?>
        <?php if (in_array("5", $rol_id) || in_array("6", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>

            <li class="nav-item" id="getAvailableProduct s" role="presentation">
                <!-- role="tab" aria-controls="products" aria-selected="true" data-bs-toggle="tab" -->
                <!-- <a class="nav-link projectAssigmentTab"  id="products-tab"  href="#" >
                    Asignar productos
                </a> -->
                <a class="nav-link" id="products-tab" data-bs-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">
                    Inventario
                </a>
            </li>
        <?php endif; ?>
        
        <?php if (in_array("11", $rol_id) || in_array("12", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" id="getAvailablePersonal" role="presentation">
                <!-- data-bs-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="false" -->
                <!-- <a class="nav-link projectAssigmentTab" id="personal-tab" href="#">
                    Asignar personal
                </a> -->
                <a class="nav-link" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">
                    Asignar personal
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array("13", $rol_id) || in_array("14", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" id="getAvailableVehicles" role="presentation">
                <!-- data-bs-toggle="tab" href="#vehicle"  aria-controls="vehicle" aria-selected="false" -->
                <!-- <a class="nav-link projectAssigmentTab" id="vehicle-tab" href="#" role="tab" >
                    
                </a> -->
                <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="true">
                    Asignar vehículos
                </a>
            </li>
        <?php endif; ?>


        <?php if (in_array("5", $rol_id) || in_array("6", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" id="tabVenta" role="presentation">
                <!-- role="tab" aria-controls="products" aria-selected="true" data-bs-toggle="tab" -->
                <a class="nav-link" id="venta-tab" data-bs-toggle="tab" href="#venta" role="tab" aria-controls="venta" aria-selected="true">
                    Venta
                </a>
            </li>
        <?php endif; ?>
        <?php if (in_array("5", $rol_id) || in_array("6", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" id="tabCostos" role="presentation">
                <!-- role="tab" aria-controls="products" aria-selected="true" data-bs-toggle="tab" -->
                <a class="nav-link" id="costo-tab" data-bs-toggle="tab" href="#costo" role="tab" aria-controls="costo" aria-selected="true">
                    Costos
                </a>
            </li>
        <?php endif; ?>

        <?php if (in_array("1", $rol_id) ||  in_array("2", $rol_id)) : ?>
            <li class="nav-item" role="presentation" id="tableResumeView">
                <!-- data-bs-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="false" -->
                <a class="nav-link" id="resumen-tab" data-bs-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="true">
                    Resumen
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="card box">
                <div class="card-body">
                    <div class="form-group">
                        <div class="mt-2">
                            <form id="projectForm">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="inputProjectName">Nombre del proyecto</label>
                                        <input type="text" class="form-control" name="txtProjectName" id="inputProjectName" placeholder="Nombre">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="fechaInicio">Fecha del Proyecto</label>
                                        <input type="date" class="form-control" name="dpInicio" id="fechaInicio">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="fechaTermino">Fecha del Proyecto</label>
                                        <input type="date" class="form-control" disabled name="dpTermino" id="fechaTermino">
                                    </div>
                                </div>
                                <div class="mt-2 row">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="direccionInput">Direccion del proyecto</label>
                                        <input autocomplete="off" type="text" class="form-control" name="txtDir" id="direccionInput" placeholder="Dirección">
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="inputNombreCliente">Nombre Cliente</label>
                                        <input autocomplete="off" type="text" class="form-control" name="txtCliente" id="inputNombreCliente" placeholder="Cliente">
                                    </div>
                                </div>

                                <div class="form-floating mt-3">
                                    <textarea class="form-control" style="min-height: 150px;" placeholder="" id="commentProjectArea" name="txtAreaComments"></textarea>
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
        </div>
        <div class="tabAssigments tabAssigments tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
            <?php include_once('./includes/dragAndDrop/dragProductos.php'); ?>
        </div>
        <div class="tabAssigments tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
            <?php require_once('./includes/dragAndDrop/dragPersonal.php'); ?>
        </div>
        <div class="tabAssigments tab-pane fade" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
            <?php require_once('./includes/dragAndDrop/dragVehiculos.php'); ?>
        </div>
        <div class="tabAssigments tab-pane fade" id="venta" role="tabpanel" aria-labelledby="venta-tab">
            <?php require_once('./includes/dragAndDrop/venta.php'); ?>
        </div>
        <div class="tabAssigments tab-pane fade" id="costo" role="tabpanel" aria-labelledby="costo-tab">
            <?php require_once('./includes/dragAndDrop/costos.php'); ?>
        </div>
        <div class="tabAssigments tab-pane fade" id="resumen" class role="tabpanel" aria-labelledby="resumen-tab">
            <?php include_once('./includes/resumeProjectTable.php') ?>
        </div>
    </div>
</div>
<!-- </div>
</div> -->


