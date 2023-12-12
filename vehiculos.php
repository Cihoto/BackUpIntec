<?php

require_once('./ws/bd/bd.php');
$conn = new bd();
$conn->conectar();

//AFTER SET EMPRESAID WITH SESSION();
$empresaId = 1;
$vehiculos = [];
$queryVehiculos = "SELECT v.id , v.patente, CONCAT(p.nombre,' ',p.apellido) as nombre  FROM vehiculo v 
                    LEFT JOIN persona p ON p.id =v.persona_id 
                    INNER JOIN empresa e on e.id  = v.empresa_id 
                    WHERE e.id = $empresaId";

// $queryDuenoAuto = 'SELECT CONCAT(p.nombre ," ", p.apellido) as nombre FROM personal p 
//                     INNER JOIN empresa e on e.id = p.empresa_id 
//                     where e.id = 1 GROUP BY p.nombre';


//BUILD VEHICULOS ARRAY
if ($responseBdVehiculo = $conn->mysqli->query($queryVehiculos)) {
    while ($datVehiculos = $responseBdVehiculo->fetch_objecT()) {
        $vehiculos[] = $datVehiculos;
    }
}

// print_r($vehiculos);

//BUILD DATA AUTODUENO
// if($responsebdDueno = $conn->mysqli->query($queryDuenoAuto)){
//     while($dataDueno = $responsebdDueno->fetch_objecT()){
//         $vehiculoAsignacion [] = $dataDueno;
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once('./includes/head.php');
$active = 'vehiculos';
?>

<body>
    <?php include_once('./includes/Constantes/empresaId.php') ?>
    <?php include_once('./includes/Constantes/rol.php') ?>

    <p style="display: none;" class="empresaId"> <?= $empresaId ?></p>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-header" style="margin-bottom: 30px;">
                <div style="display:flex; align-items: center; ">
                    <h3 style="margin-right: 50px">Vehiculos</h3>
                    <a id="download-Excel" style="height: 20px; line-height: 20px;font-size: 30px;" href="./ExcelFiles/Vehiculos.xlsx" download="Carga Masiva Vehículo"><i class="fa-solid fa-file-excel" style="color: #1D6F42; "></i></a>
                </div>
            </div>

            <input type="number" class="">

            <?php if (in_array("13", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)):?>
            <div class="col-8 col-lg-3 col-sm-4">
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar vehículo
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="addVehicle" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar Vehículos masivo
                            </button>
                            <input class="form-control form-control-sm" id="excel_input" type="file" />
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="page-content">
                <!-- aca va la info de la pagina -->

                <div class="col-12">
                    <!-- primer  -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <table class="table" id="tableVehiculo" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; display:none">ID</th>
                                                <th style="text-align: center;">Patente</th>
                                                <th style="text-align: center;">Dueño</th>
                                                <th style="text-align: center;">Documentos</th>
                                                <th style="text-align: center;">Kilmetraje</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($vehiculos as $vehiculo) {
                                                echo '<tr>';
                                                echo '<td class="id_vehiculo" style="display:none">' . $vehiculo->id . '</td>';
                                                echo '<td class="patente" align=center>' . $vehiculo->patente . '</td>';
                                                echo '<td align=center>' . $vehiculo->nombre . '</td>';
                                                echo '<td align=center>Documentos</td>';
                                                echo '<td align=center>Kilometraje</td>';
                                                echo '<td align=center><i class="fa-solid fa-trash deleteVehiculo"></i><i style="left-margin:5px" class="fa-solid fa-pencil"></i></td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align: center; display:none">ID</td>
                                                <td style="text-align: center;">Patente</td>
                                                <td style="text-align: center;">Dueño</td>
                                                <td style="text-align: center;">Documentos</td>
                                                <td style="text-align: center;">Kilmetraje</td>
                                                <td style="text-align: center;">Acciones</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal agregar personal masiva -->
        <div class="modal fade" id="masivavehicleCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Desea ingresar esta información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table" id="excelTable">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <button type="button" id="modalClose" class="col-md-3 col-12 btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success col-md-4 col-12" id="saveExcelData">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN modal masiva -->

        <!-- modal agregar personal -->
        <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" style="align-items: center;">
                            Agregar Vehiculo
                        </h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                        <p style="align-self: start;">* (campo obligatorio)</p>
                        <i data-feather="x"></i>
                    </div>
                    <form id="addVehiculo">
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-12 col-md-6">
                                    <label for="patente">Patente: *</label>
                                    <input name="patente" id="patente" type="text" placeholder="Patente *" class="form-control" />
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="asignacion_Select">Dueño:</label>
                                    <select name="asignacion_Select" class="form-control" id="asignacion_Select">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>
                                <div class="col-6">
                                    <input type="submit" value="Agregar" class=" btn btn-info">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <?php require_once('./includes/footer.php') ?>

    </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>

    <!-- xlsx Reader -->
    <script src="js/xlsxReader.js"></script>
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>

    <!-- Validador intec -->
    <script src="./js/valuesValidator/validator.js"></script>

    <!-- Validate.js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>


    <script>
        const EMPRESA_ID = $('#empresaId').text();

        $(document).ready(function() {
            $('#tableVehiculo').DataTable({
                scrollX: true
            });

            $('#addVehiculo').validate({
                rules: {
                    patente: {
                        required: true
                    }
                },
                messages: {
                    patente: {
                        required: "Ingrese un valor"
                    }
                },
                submitHandler: function() {
                    event.preventDefault()

                    let patente = $('#patente').val()
                    let asignacion_Select = $('#asignacion_Select').val()

                    let arrayRequest = [{
                        patente: patente,
                        nombre: asignacion_Select
                    }]

                    $.ajax({
                        type: "POST",
                        url: "ws/vehiculo/Vehiculo.php",
                        data: JSON.stringify({
                            action: "addVehicle",
                            vehicleData: {
                                arrayRequest
                            },
                            'empresaId': EMPRESA_ID
                        }),
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);

                            if (data.status === 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Excelente',
                                    text: `Se han agregado ${arrayRequest.length}`
                                })
                            }
                            if (data.status === 0) {



                                // let arrayErr = data.array;
                                // let htmlSwal = ""
                                // arrayErr.forEach(el => {
                                //     htmlSwal += `<tr><td>${el.patente}</td><td>${el.nombre}</td></tr>`
                                // });
                                // Swal.fire({
                                //     icon: 'error',
                                //     title: 'Ups',
                                //     html:  `<p>Estos nombres no pueden ser asignados a un vehiculo </p>
                                //             <table class="table">
                                //                 <thead>
                                //                     <th>Patente</th>
                                //                     <th>Nombre</th>
                                //                 </thead>
                                //                 <tbody>
                                //                     ${htmlSwal}
                                //                 </tbody>
                                //             </table>`
                                // })
                            }
                        },
                        error: function(data) {
                            console.log(data.responseText);
                        }
                    })
                }
            })
        });

        const dataArrayIndex = ['patente', 'asignado']
        const dataArray = {
            'xlsxData': [{
                    'name': 'patente',
                    'type': 'string',
                    'minlength': 6,
                    'maxlength': 6,
                    'notNull': false
                },

                {
                    'name': 'asignado',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                }
            ]
        }


        function GetFileExtension() {
            fileName = $('#excel_input').val();
            extension = fileName.split('.').pop();
            return extension;
        }

        $('#excel_input').on('change', async function() {
            const extension = GetFileExtension()
            if (extension == "xlsx") {



                const tableContent = await xlsxReadandWrite(dataArray);
                if (tableContent !== undefined) {
                    let tableHead = $('#excelTable>thead')
                    let tableBody = $('#excelTable>tbody')
                    $('#masivavehicleCreation').modal('show')

                    //Limpiar datos de Excel Previo
                    tableBody.empty()
                    tableHead.empty()
                    // LLENAR TABLA 
                    tableHead.append(tableContent[0])
                    tableBody.append(tableContent[1])
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups',
                        text: 'El excel cargado no es el correcto, revise e intente nuevamente',
                    })
                }
            } else(
                Swal.fire({
                    icon: 'error',
                    title: 'Ups',
                    text: 'Debes cargar un Excel',
                })
            )
        })


        $('#excelTable>tbody').on('blur', 'td', function() {

            let value = $(this).text()

            //obtencion de las propiedades del TD
            let tdListClass = $(this).attr("class").split(/\s+/);
            let tdClass = tdListClass[0]
            let tdPropertiesIndex = dataArrayIndex.indexOf(tdClass)
            let tdProperties = dataArray.xlsxData[tdPropertiesIndex]

            // SETEO DE PROPIEDADES
            let type = tdProperties.type
            let minlength = tdProperties.minlength
            let maxlength = tdProperties.maxlength
            let notNull = tdProperties.notNull

            //OBTENCION DE PROPIEDADES DE VALOR DE CELDA

            let tdType = isNumeric(value)
            let tdMinlength = minLength(value, minlength)
            let tdMaxlength = maxLength(value, maxlength)

            let tdNull = isNull(value);

            let errorCheck = false
            let tdTitle = ""

            //atributos return a td
            if (!notNull && tdNull) {
                errorCheck = false
                tdTitle = "Ingrese un valor"

            } else {

                if (type === "string" && tdType) {
                    errorCheck = true
                } else if (type === "int" && !tdType) {
                    errorCheck = false
                    tdTitle = "Ingrese un número"
                } else {
                    errorCheck = true
                }

                if (!notNull) {
                    if (!tdMinlength) {
                        tdTitle = `Debe tener un mínimo de ${minlength} caracteres`
                        errorCheck = false
                    }
                    if (!tdMaxlength) {
                        tdTitle = `Debe tener un máximo de ${maxlength} caracteres`
                        errorCheck = false
                    }
                } else {}
            }

            console.log("errorCheck", errorCheck);
            if (!errorCheck) {
                $(this).prop('title', tdTitle)
                $(this).addClass('err')
            } else {
                $(this).prop('title', "")
                $(this).removeClass('err')
            }
        })

        //Cerrar Modal

        $('#modalClose').on('click', function() {
            $('#masivavehicleCreation').modal('hide')
        })


        //GUARDAR REGISTROS MASIVA DENTRO DE MODAL
        $('#saveExcelData').on('click', function() {
            let counterErr = 0;

            $('#excelTable>tbody td').each(function() {

                var cellText = $(this).hasClass('err')
                if (cellText) {
                    counterErr++
                }

            });

            if (counterErr == 0) {

                let arrTd = []
                let preRequest = []

                $('#excelTable>tbody tr').each(function() {

                    arrTd = []
                    let td = $(this).find('td')

                    td.each(function() {
                        let tdTextValue = $(this).text()
                        arrTd.push(tdTextValue)
                    })
                    preRequest.push(arrTd)
                });

                const arrayRequest = preRequest.map(function(value) {
                    let returnArray = {
                        "empresaId": EMPRESA_ID,
                        "patente": value[0],
                        "nombre": value[1]
                    }
                    return returnArray
                })
                console.log(arrayRequest);
                $.ajax({
                    type: "POST",
                    url: "ws/vehiculo/addVehiculo.php",
                    data: JSON.stringify(arrayRequest),
                    dataType: 'json',
                    success: function(data) {

                        Swal.fire({
                            icon: 'info',
                            title: 'Excelente',
                            position: 'bottom-end',
                            text: data.data
                        })

                        if (data.status === 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Excelente',
                                text: `Se han agregado ${arrayRequest.length}`
                            })
                        }
                        if (data.status === 0) {

                            let arrayErr = data.array;
                            let htmlSwal = ""
                            arrayErr.forEach(el => {
                                htmlSwal += `<tr><td>${el.patente}</td><td>${el.nombre}</td></tr>`
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Ups',
                                html: `<p>Estos nombres no pueden ser asignados a un vehiculo </p>
                                <table class="table">
                                    <thead>
                                        <th>Patente</th>
                                        <th>Nombre</th>
                                    </thead>
                                    <tbody>
                                        ${htmlSwal}
                                    </tbody>
                                </table>`
                            })
                        }
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ups',
                    text: 'Debe corregir los datos mal ingresado para continuar'
                })
            }
        })

        //DELETE VEHICULO 
        $(".deleteVehiculo").on('click', function() {

            let tr = $(this).closest('tr');
            let patente = $(this).closest('tr').find('.patente').text()
            let idVehiculo = $(this).closest('tr').find('.id_vehiculo').text()
            Swal.fire({
                icon: 'info',
                title: `Desea dar de baja el vehiculo: ${patente}`,
                showCancelButton: true,
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {

                    let arrayRequest = [{
                        id: idVehiculo
                    }]

                    $.ajax({
                        type: "POST",
                        url: "ws/vehiculo/deleteVehiculo.php",
                        data: JSON.stringify({
                            action: "deleteVehicle",
                            arrayIdVehicles: arrayRequest
                        }),
                        dataType: 'json',
                        success: async function(data) {
                            console.log(data);
                            tr.remove()
                            Swal.fire({
                                icon: 'success',
                                title: 'Excelente',
                                text: data.message
                            })

                        },
                        error: function(data) {
                            console.log(data.responseText);
                        }
                    })

                } else {
                    console.log("Cancelado");
                }
            })
        })
    </script>

</body>

</html>