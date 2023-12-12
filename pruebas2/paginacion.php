<!DOCTYPE html>
<html lang="en">

<?php
require_once('../includes/head.php');
$active = 'dashboard';
?>

<body>
    <script src="../assets/js/initTheme.js"></script>
    <div id="app">

        <?php require_once('../includes/sidebar.php') ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-header">
                <h3>Dashboard</h3>
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: 400px; overflow-y: auto">
                            <div class="card-header">
                                <h5 class="card-title">Mis Proyectos</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="products-tab" data-bs-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">
                                            Proyecto 1
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                            Proyecto 2
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                                            Proyecto 3
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row mt-3 mb-3" style="
                                    position: relative;
                                    z-index: 2;
                                    height: 100%;
                                    color:black;
                                    font-weight: bold;">

                                            <div class="row" style="
                                        position: absolute;
                                        z-index: -1;
                                        top: 0;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        background: url('./assets/images/img/sendero.jpg') center center;
                                        opacity: .5;
                                        border: 1px groove black;
                                        margin: auto;">
                                            </div>
                                            <div class="col-3 mt-4" style="text-align: center;">
                                                <p class="m-1">Sendero</p>
                                            </div>
                                            <div class="col-4 mt-4" style="text-align: center;">
                                                <div class="progress progress-primary m-2">
                                                    <div class="progress-bar progress-label" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>5 LandCoin Invertidos</p>
                                            </div>
                                            <div class="col-1 mt-2  mb-2">
                                                <div class="row mb-1">
                                                    <button type="button" class="btn btn-success">+1</button>
                                                </div>
                                                <div class="row">
                                                    <button type="button" class="btn btn-danger">-1</button>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>Aporta <br>+ 2 Co2</p>
                                            </div>
                                        </div>

                                        <div class="row mt-3 mb-3" style="
                                    position: relative;
                                    z-index: 2;
                                    height: 100%;
                                    color:black;
                                    font-weight: bold;">

                                            <div class="row" style="
                                        position: absolute;
                                        z-index: -1;
                                        top: 0;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        background: url(https://www.dufferincounty.ca/sites/default/files/styles/banner_1600_x_500_/public/2019-01/forest.jpg?itok=ZwbHgPD7) center center;
                                        opacity: .5;
                                        border: 1px groove black;
                                        margin: auto;">
                                            </div>
                                            <div class="col-3 mt-4" style="text-align: center;">
                                                <p class="m-1">SubProyecto 2</p>
                                            </div>
                                            <div class="col-4 mt-4">
                                                <div class="progress progress-secondary m-2">
                                                    <div class="progress-bar progress-label" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>4 LandCoin Invertidos</p>
                                            </div>
                                            <div class="col-1 mt-2  mb-2">
                                                <div class="row mb-1">
                                                    <button type="button" class="btn btn-success">+1</button>
                                                </div>
                                                <div class="row">
                                                    <button type="button" class="btn btn-danger">-1</button>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>Aporta <br>+ 1 Co2</p>
                                            </div>
                                        </div>

                                        <div class="row mt-3 mb-3" style="
                                    position: relative;
                                    z-index: 2;
                                    height: 100%;
                                    color:black;
                                    font-weight: bold;">

                                            <div class="row" style="
                                        position: absolute;
                                        z-index: -1;
                                        top: 0;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        background: url(https://media.springernature.com/m685/springer-static/image/art%3A10.1038%2Fs41477-019-0374-3/MediaObjects/41477_2019_374_Figa_HTML.jpg) center ;
                                        opacity: .5;
                                        border: 1px groove black;
                                        margin: auto;">
                                            </div>
                                            <div class="col-3 mt-4" style="text-align: center;">
                                                <p class="m-1">SubProyecto 3</p>
                                            </div>
                                            <div class="col-4 mt-4">
                                                <div class="progress progress-warning m-2">
                                                    <div class="progress-bar progress-label" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>0 LandCoin Invertidos</p>
                                            </div>
                                            <div class="col-1 mt-2  mb-2">
                                                <div class="row mb-1">
                                                    <button type="button" class="btn btn-success">+1</button>
                                                </div>
                                                <div class="row">
                                                    <button type="button" class="btn btn-danger">-1</button>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-4" style="text-align: center;">
                                                <p>Aporta <br>0 Co2</p>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <p class="mt-2">
                                            hola proyecto 2
                                        </p>
                                    </div>

                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <p class="mt-2">
                                            hola proyecto 3
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('../includes/footer.php') ?>

        </div>
    </div>

    <?php require_once('../includes/footerScriptsJs.php') ?>

</body>

</html>


<!-- resumen -->
<!-- proyectos.php

cambiar ojo por alertas -> mas de 2 errores alerta roja, entre 1 y 2 errores alerta amrilla, 0 errores check verde
seleccionar el tr completo en vez del ojo
pestañas por proyecto

pestañas:
detalle evento
equipamiento
personal
vehiculo

resumen en pestaña aparte con boton descarga excel


proximosEventos.php
lugar, con busqueda de lugares recurrentes + agregar
Clientes, lo mismo + agregar

ASIGNACIONES
mismo estilo de herramientas, con pasar de un asignar y borrar tabla inicial


Crear vista proyecto -->