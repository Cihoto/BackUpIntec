<?php

// require_once('./ws/pais_region_comuna/Comuna.php');
// require_once('./ws/vehiculo/Vehiculo.php');
// require_once('./ws/personal/Personal.php');
// require_once('./ws/productos/Producto.php');
// require_once('./ws/pais_region_comuna/Region.php');
// require_once('./ws/cliente/cliente.php');

$empresaId = 1;

// $obj = (object) array('idRegion' => 1);
// $comunas = getComunasByRegion($obj);
// $vehiculos = getVehiculos($empresaId);
// $personal =  getPersonal($empresaId);
// $productos = getProductos($empresaId);
// $regiones = getRegiones();

$requestClientes = (object) array('empresaId' => 1);
// $clientes = getClientesByEmpresa($requestClientes);
$clientes = [];


$vehiculos = [];
$personal = [];
$productos = [];
$regiones = [];


?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once('./includes/head.php');
$active = 'proximosEventos';
?>

<body>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-header">
                <h3>Proximos Eventos</h3>
            </div>

            <div class="page-content">
                <div class="card box">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="mt-2">
                                <form id="projectForm">
                                    <div class="row centered-spaced">
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
                                            <input type="date" class="form-control" name="dpTermino" id="fechaTermino">
                                        </div>
                                    </div>
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" style="min-height: 150px;" placeholder="" id="commentProjectArea" name="txtAreaComments"></textarea>
                                        <label for="commentProjectArea">Comentarios</label>
                                    </div>

                                    <button type="submit" style="display: none;" id="addProjectName" class="btn btn-success ml-1 col-4">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Guardar</span>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-header">
                    <h3>Datos del cliente</h3>
                </div>

                <div class="card box">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <h3>Lugar del evento</h3>
            </div>
            <div class="card box">
                <div class="card-body">
                    <div class="form-group">
                        <div class="mt-2">
                            <form id="direccionForm">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3 col-12 form-group">
                                            <label for="txtDir">Dirección</label>
                                            <input type="text" name="txtDir" id="txtDir" placeholder="Dir" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-12 form-group">
                                            <label for="txtNumDir">Número </label>
                                            <input type="number" name="txtNumDir" id="txtNumDir" placeholder="Num" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-12 form-group">
                                            <label for="txtDepto">Depto </label>
                                            <input type="text" name="txtDepto" id="txtDepto" placeholder="Depto/Bloque/Casa" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-12 form-group">
                                            <label for="txtcodigo_postal">Codigo postal </label>
                                            <input type="text" name="txtcodigo_postal" id="txtcodigo_postal" placeholder="Código postal" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="regionSelect">Región</label>
                                            <select class="col-md-6 col-12 form-select" name="regionSelect" id="regionSelect" aria-label="Default select example">
                                                <option value=""></option>
                                                <?php foreach ($regiones as $region) : ?>
                                                    <option value="<?= $region->id ?>"><?= $region->region ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="comunaSelect">Comuna</label>
                                            <select class="col-md-6 col-12 form-select" name="comunaSelect" id="comunaSelect" aria-label="Default select example">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer row" style="justify-content: space-between; margin-top: 15px;">

                                        <button type="submit" style="display: none;" id="addDireccion" class="btn btn-success ml-1 col-4">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Guardar</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card box">
                <div class="row" style="justify-content: end;">
                    <div class="col-3 mt-2 mb-2">
                        <button class="btn btn-success" id="submitProject">Crear Proyecto</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>
    <?php require_once('./includes/footer.php') ?>
    </div>
    </div>
    <!-- require Modal -->
    <?php require_once('./includes/Modal/direccion.php') ?>
    <?php require_once('./includes/Modal/cliente.php') ?>
    <!-- FIN require Modal -->
    <?php require_once('./includes/footerScriptsJs.php') ?>

</body>

<script>

    async function addLugar(lugarRequest) {
        return $.ajax({
        type: "POST",
        url: 'ws/lugar/lugar.php',
        data: JSON.stringify({
            request: lugarRequest,
            action: "addLugar"
        }),
        dataType: 'json',
        success: function(data) {
            let id_lugar = data.id_lugar;
            console.log("LUGAR", data);
        },
        error: function(response) {
            console.log(response);
        }
        })
    }
    async function addDir(dirRequest) {
        return $.ajax({
        type: "POST",
        url: 'ws/direccion/direccion.php',
        data: JSON.stringify({
            request: dirRequest,
            action: "addDireccion"
        }),
        dataType: 'json',
        success: function(data) {

            id_direccion = data.id_direccion;
            console.log("DIRECCION", data);


        },
        error: function(response) {

        }
        })
    }
    async function addCliente(clienteRequest) {
        return $.ajax({
        type: "POST",
        url: 'ws/cliente/cliente.php',
        data: JSON.stringify({
            request: {
            clienteRequest
            },
            tipo: "addCliente"
        }),
        dataType: 'json',
        success: function(data) {
            idCliente = data.idCliente
            console.log("CLIENTE", data);
        },
        error: function(response) {
            console.log(response.responseText);
        }
        })
    }

    async function createProject(requestProject) {
        return $.ajax({
        type: "POST",
        url: 'ws/proyecto/proyecto.php',
        data: JSON.stringify({
            request: {
            requestProject
            },
            action: "addProject"
        }),
        dataType: 'json',
        success: function(data) {
            console.log("RESPONSE PROYECTO", data);
        },
        error: function(response) {
            console.log(response.responseText);
        }
        })
    }
    $(document).ready(function() {

        $('#projectForm').validate({
            rules: {

                txtProjectName: {
                    required: true
                },
                dpInicio: {
                    required: true
                },
                dpTermino: {
                    required: true
                }
            },
            messages: {
                txtProjectName: {
                    required: "Ingrese un valor"
                },
                dpInicio: {
                    required: "Ingrese un valor"
                },
                dpTermino: {
                    required: "Ingrese un valor"
                },
                txtAreaComments: {
                    required: false
                }
            },
            submitHandler: function() {
                event.preventDefault();
                // console.log("validado");
            }
        })

        // SELECT 2 

        $('#clienteForm').validate({
            rules: {
                txtNombreCliente: {
                    required: true
                },
                txtRut: {
                    required: true
                },
                txtRazonSocial: {
                    required: true
                },
                txtDireccionCliente: {
                    required: true
                }
            },
            messages: {
                txtNombreCliente: {
                    required: "Ingrese un valor"
                },
                txtRut: {
                    required: "Ingrese un valor"
                },
                txtRazonSocial: {
                    required: "Ingrese un valor"
                },
                txtDireccionCliente: {
                    required: "Ingrese un valor"
                }

            },
            submitHandler: function() {
                event.preventDefault();
            }

        })
        $('#direccionForm').validate({
            rules: {
                txtNumDir:{
                    required:true
                },
                txtDepto:{
                    required:true
                },
                txtcodigo_postal:{
                    required:true
                },
                regionSelect:{
                    required:true
                },
                comunaSelect:{
                    required:true
                }
            },
            messages: {
                txtNumDir:{
                    required:"Ingrese un valor"
                },
                txtDepto:{
                    required:"Ingrese un valor"
                },
                txtcodigo_postal:{
                    required:"Ingrese un valor"
                },
                regionSelect:{
                    required:"Ingrese un valor"
                },
                comunaSelect:{
                    required:"Ingrese un valor"
                }
            },
            submitHandler: function() {
                event.preventDefault();
            }

        })


        $('#submitProject').on('click', async() => {

            $('#hiddenAddProject').trigger('click');
            console.log("1");
            if ($('#projectForm').valid()) {
                console.log("2");
                console.log("2.5");

                if($('#clienteForm').valid()){
                    console.log("3");

                    if($('#direccionForm').valid()){
                        console.log("4");


                        //CREAR CLIENTE PARA PROYECTO
                        let idCliente;
                        let nombre = $('#txtNombreCliente').val()
                        let requestCliente = {
                            nombre: nombre
                        }

                        //DATOS DE DIRECCION
                        let dir = $('#txtDir').val()
                        let numDir = $('#txtNumDir').val()
                        let depto = $('#txtDepto').val()
                        let region = $('#regionSelect').val()
                        let comuna = $('#comunaSelect').val()
                        let postal_code = $('#txtcodigo_postal').val()

                        let id_direccion;
                        let id_lugar;

                        let requestDir = [{
                            direccion: dir,
                            numero: numDir,
                            depto: depto,
                            region: region,
                            codigo_postal: postal_code,
                            comuna: comuna
                        }]
                        const resultDireccion = await Promise.all([addDir(requestDir), addCliente(requestCliente)])
                        id_direccion = resultDireccion[0].id_direccion
                        idCliente = resultDireccion[1].idCliente


                        //REQUEST LUGAR
                        let lugarRequest = [{
                            lugar: dir,
                            direccion_id: id_direccion
                        }]

                        // DATOS PARA LA CRECION BASE DE UN PROYECTO
                        let projectName = $('#inputProjectName').val();
                        let fechaInicio = $('#fechaInicio').val();
                        let fechaTermino = $('#fechaTermino').val();
                        let comentarios = $('#commentProjectArea').val()

                        const responseLugar = await Promise.all([addLugar(lugarRequest)])
                        id_lugar = responseLugar[0].id_lugar

                        let requestProject = {
                            nombre_proyecto: projectName,
                            lugar_id: id_lugar,
                            fecha_inicio: fechaInicio,
                            fecha_termino: fechaTermino,
                            cliente_id: idCliente,
                            comentarios: comentarios
                            // empresa_id:1
                        }

                        const responseProject = await Promise.all([createProject(requestProject)])
                        idProject = responseProject[0].id_project;
                        console.log(idProject);

                    }else{
                        $('#addDireccion').trigger('click')
                    }
                }else{
                    $('#addCliente').trigger('click')
                }
            }else{
                $('#addProjectName').trigger('click')
            }

        })



    })


    $("#clienteSelect").on('change', function() {

        let clienteId = $(this).val();
        if (clienteId === "new") {
            $('#inputNombreCliente').val("")
            $('#inputRut').val("")
            $('#inputRazonSocial').val("")
            $('#inputDireccionCliente').val("")
        } else {
            $.ajax({
                type: "POST",
                url: 'ws/cliente/cliente.php',
                data: JSON.stringify({
                    request: {
                        "idCliente": clienteId
                    },
                    tipo: "getCliente"
                }),
                dataType: 'json',
                success: function(data) {

                    data.cliente

                    data.cliente.forEach(c => {

                        $('#inputNombreCliente').val(c.nombre_cliente)
                        // $('#inputRut').val(c.)
                        // $('#inputRazonSocial').val(c.)
                        // $('#inputDireccionCliente').val(c.)
                    });
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            })
        }

    })
    $('#regionSelect').on('blur', function() {
        let idRegion = $(this).val();
        $.ajax({
        type: 'POST',
        url: 'ws/pais_region_comuna/Comuna.php',
        data: {
            action: 'getComunasByRegion',
            jsonRequest: JSON.stringify({
            idRegion: idRegion
            })
        },
        dataType: 'json',
        success: function(response) {

            var comuna = response;
            $('#comunaSelect').empty();
            $('#comunaSelect').append(new Option("", ""));
            comuna.forEach(comuna => {
            $('#comunaSelect').append(new Option(comuna.comuna, comuna.id))
            })
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
        });
    })
</script>

</html>