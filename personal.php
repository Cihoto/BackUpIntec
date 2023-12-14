

<!DOCTYPE html>
<html lang="en">

<?php
require_once('./includes/head.php');
$active = 'personal';
?>

<body>
    <script src="./assets/js/initTheme.js"></script>
    <?php include_once('./includes/Constantes/empresaId.php');?>
    <?php include_once('./includes/Constantes/rol.php');?>
    <?php
        require_once('./ws/bd/bd.php');
        $conn = new bd();
        $conn->conectar();
        $arregloPersonal = [];

        // $queryPersonal = 'SELECT p.id , per.nombre , per.apellido ,e.especialidad ,c.cargo, tc.contrato,per.rut FROM personal p 
        //                 INNER JOIN cargo c on c.id  = p.cargo_id 
        //                 INNER JOIN especialidad e on e.id  = p.especialidad_id 
        //                 INNER JOIN persona per on per.id = p.persona_id 
        //                 LEFT JOIN usuario u on u.id  = p.usuario_id 
        //                 INNER JOIN tipo_contrato tc on tc.id  = p.tipo_contrato_id 
        //                 INNER JOIN empresa emp on emp.id = p.empresa_id 
        //                 where emp.id = 1
        //                 AND p.IsDelete = 0';


        $queryContrato = 'select contrato FROM tipo_contrato tc';

        // //BUILD DATA PERSONAL
        // $responseDbPersonal = $conn->mysqli->query($queryPersonal);

        // while ($dataPersonal = $responseDbPersonal->fetch_object()) {
        //     $arregloPersonal[] = $dataPersonal;
        // }

        //BUILD TIPO CONTRATO DATA
        $responseDbTipoContrato = $conn->mysqli->query($queryContrato);

        while ($dataContratos = $responseDbTipoContrato->fetch_object()) {
            $contratos[] = $dataContratos;
        }
    ?>


    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-header">
                <div style="display:flex; align-items: center; margin-bottom: 30px;" >
                    <h3 style="margin-right: 50px; line-height: 34px;text-align: center;">Personal</h3>
                    <a id="download-Excel" style="height: 20px; line-height: 20px;font-size: 30px;" href="./ExcelFiles/PersonalM.xlsx" download="Carga Masiva Personal"><i class="fa-solid fa-file-excel" style="color: #1D6F42; "></i></a>
                </div>
                <?php if (in_array("11", $rol_id) || in_array("1", $rol_id) ||  in_array("2", $rol_id)):?>
                <div class="row justify-content-center">
                    <div class="col-8 col-lg-3 col-sm-4">
                        <div class="card">
                            <button type="button" id="btnPersonalUnitario" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar personal
                            </button>
                            <button class="btn mt-2" onclick="ExportToExcel('xlsx')">
                                <h4>Exportar a Excel</h4>
                            </button>
                        </div>
                    </div>
                    <div class="col-8 col-lg-3 col-sm-4">
                        <div class="card">
                            <button type="button" disabled class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar personal masivo
                            </button>
                            <input class="form-control form-control-sm" id="excel_input" type="file" />
                        </div>
                    </div>
                    <div class="col-8 col-lg-3 col-sm-4">
                        <div class="card">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cargoEspecialidad">
                                Agregar Especialidades y cargos
                            </button>
                        </div>
                    </div>
                </div>
                <?php  endif;?>
            </div>
            <?php include_once('./includes/Modal/cargoEspecialidad.php')?>

            <!-- modal agregar personal -->
            <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" style="align-items: center;">
                                Agregar Personal
                            </h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="addPersonal">
                            <div class="modal-body">

                                <div class="row" style="margin-bottom: 8px;">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <label for="nombres">Nombres:</label>
                                        <div class="form-group">
                                            <input name="nombres" id="nombres" type="text" placeholder="Nombres" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <label for="apellidos">Apellidos:</label>
                                        <div class="form-group">
                                            <input name="apellidos" id="apellidos" type="text" placeholder="Apellidos" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <label for="rut">Rut:</label>
                                        <div class="form-group">
                                            <input name="rut" id="rut" type="text" placeholder="rut" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <label>Telefono</label>
                                        <div class="form-group">
                                            <input name="telefono" id="inputTelefonoPersonal" type="text" placeholder="56 9 1231 2345" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                            <label for="correoPersonalAddUnitario">Correo</label>
                                           <input type="text" name="correoPersonalAddUnitario" class="form-control" id="correoPersonalAddUnitario">
                                    </div>
                                    <hr>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <label>Cargo:</label>
                                        <div class="form-group">
                                            <select name="cargo_select" id="cargo_select" class="form-select">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label>Especialidad</label>
                                        <div class="form-group">
                                            <select name="especialidad_select" id="especialidad_select" class="form-select">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label>Tipo de contrato</label>
                                        <div class="form-group">
                                            <select name="contrato_Select" id="contrato_Select" class="form-select">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label for="neto">Costo Neto</label>
                                            <input type="number" name="neto" class="form-control" id="neto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <input type="submit" value="Agregar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal -->

            <div class="page-content">
                <!-- PAGE CONTENT -->

                <div class="col-12">
                    <!-- primer  -->
                    <div class="row" style="text-align: right;">

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">

                                    <table class="table" id="AllPersonalTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; display:none">id</th>
                                                <th style="text-align: center;">Nombre</th>
                                                <th style="text-align: center;">Apellido</th>
                                                <th style="text-align: center;">Rut</th>
                                                <th style="text-align: center;">Email</th>
                                                <th style="text-align: center;">Telefono</th>
                                                <th style="text-align: center;">Cargo</th>
                                                <th style="text-align: center;">Especialidad</th>
                                                <th style="text-align: center;">Tipo Contrato</th>
                                                <th style="text-align: center;">Disponibilidad</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align: center; display:none">id</th>
                                                <th style="text-align: center;">Nombre</th>
                                                <th style="text-align: center;">Apellido</th>
                                                <th style="text-align: center;">Rut</th>
                                                <th style="text-align: center;">Email</th>
                                                <th style="text-align: center;">Telefono</th>
                                                <th style="text-align: center;">Cargo</th>
                                                <th style="text-align: center;">Especialidad</th>
                                                <th style="text-align: center;">Tipo Contrato</th>
                                                <th style="text-align: center;">Disponibilidad</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal agregar personal masiva -->
            <div class="modal fade" id="masivaPersonalCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-full modal-dialog-centered" role="document">
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
                            <button type="button" id="modalClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" id="saveExcelData">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN modal masiva -->


            <?php require_once('./includes/footer.php') ?>
            <?php require_once('./includes/Modal/masivaProblems.php')?>

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
    <!-- FUNCTIONS (JS AJAX WITH PHP) PERSONAL MANAGEMENT  -->
    <script src="/js/personal.js"></script>

    <script>
        
        const EMPRESA_ID = $('#empresaId').text();

        $('#btnConfirmEspecialidad').on('click',function(){
            AddEspecialidad(EMPRESA_ID);
        });
        $('#btnConfirmCargo').on('click',function(){
            AddCargo(EMPRESA_ID);
        });
        $('#btnPersonalUnitario').on('click',function(){
            // FILL ESPECIALIDAD
            GetEspecialidad(EMPRESA_ID);  
            // FILL CARGOS
            GetCargo(EMPRESA_ID);
        });

        function FillPersonalAllData(empresaId){

            $.ajax({
                type: "POST",
                url: "ws/personal/Personal.php",
                data: JSON.stringify({
                    'action':'getAllPersonalData',
                    'empresaId':EMPRESA_ID
                }),
                dataType: 'json',
                success: function(data){

                    console.log("TODO EL PERSONAL",data);

                    if($('#AllPersonalTable tbody tr').length > 0){
                        $('#AllPersonalTable').empty();
                    }
                    if($.fn.DataTable.isDataTable( '#AllPersonalTable' )){
                        $('#AllPersonalTable').DataTable().destroy();
                    }
                    data.forEach(per => {
                        console.log("dentro del foreach");
                        let newTr = `<td class="id" align="center" style ="display:none"> ${per.id}</td>
                                    <td class="nombre" align="center"> ${per.nombre} </td>
                                    <td class="apellido" align="center"> ${per.apellido} </td>
                                    <td align="center">${per.rut} </td>
                                    <td align="center">${per.email}</td>
                                    <td align="center">${per.telefono}</td>
                                    <td align="center">${per.cargo}</td>
                                    <td align="center">${per.especialidad}</td>
                                    <td align="center">${per.contrato}</td>
                                    <td align="center"><input type="radio"></td>
                                    <td align="center"><i class="fa-solid fa-trash deletePersonal"></i><i style="left-margin:5px" class="fa-solid fa-pencil"></i></td>`
                        $('#AllPersonalTable').append(`<tr>${newTr}</tr>`);
                    });
                    $('#AllPersonalTable').DataTable({
                        fixedHeader: true,
                        scrollX:true
                    })
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            })
        }

        function GetContratos(){
            
        }


        $(document).ready(function() {

            FillPersonalAllData(EMPRESA_ID);
            $.ajax({
                type: "POST",
                url: "ws/personal/Personal.php",
                data:JSON.stringify({action:"getAllContratos"}),
                dataType: 'json',
                success: function(data){
                    // console.table(data);
                    console.log(data);
                    $('#contrato_Select').empty();
                    $('#contrato_Select').append(new Option("", ""));
                        data.forEach(con => {
                        $('#contrato_Select').append(new Option(`${con.contrato}`, con.id))
                    })

                },
                error: function(data) {
                    console.log(data.responseText);
                }
            })
            // GetContratos();
            $('#addPersonal').validate({
                rules: {
                    nombres: {
                        required: true,
                        minlength: 3
                    },
                    apellidos: {
                        required: true,
                        minlength: 3
                    },
                    rut: {

                    },
                    especialidad_select: {
                        required: true
                    },
                    contrato_Select: {
                        required: true
                    },
                    cargo_select: {
                        required: true
                    },
                    telefono:{
                        required:true
                    },
                    correoPersonalAddUnitario:{
                        required:true
                    },
                    neto:{

                    }
                },
                messages: {
                    nombres: {
                        required: "Ingrese un valor",
                        minlength: "El largo mínimo es de 3 caracteres"
                    },
                    apellidos: {
                        required: "Ingrese un valor",
                        minlength: "El largo mínimo es de 3 caracteres"
                    },
                    rut: {
                        required:"Ingrese un valor"
                    },
                    especialidad_select: {
                        required: "Ingrese un valor"
                    },
                    contrato_Select: {
                        required: "Ingrese un valor"
                    },
                    cargo_select: {
                        required: "Ingrese un valor"
                    },
                    telefono:{
                        required:"Ingrese un valor"
                    },
                    correoPersonalAddUnitario:{
                        required:"Ingrese un valor"
                    },
                    neto:{

                    }

                },
                submitHandler: function(form) {
                    event.preventDefault();
                    console.log("AGREGAR PERSONAL UNITARIO");
                    let nombres = $('#nombres').val();
                    let apellidos = $('#apellidos').val();
                    let rut = $('#rut').val();
                    let especialidad = $('#especialidad_select').val();
                    let contrato = $('#contrato_Select').val();
                    let cargo = $('#cargo_select').val();
                    let correoPersonal = $('#correoPersonalAddUnitario').val();
                    let telefonoPersonal = $('#inputTelefonoPersonal').val();
                    let neto = $('#neto').val();

                    let arrayRequest = [{
                        "nombre": nombres,
                        "apellido": apellidos,
                        "rut": rut,
                        "telefono": telefonoPersonal,
                        "correo": correoPersonal,
                        "cargo": cargo,
                        "especialidad": especialidad,
                        "idContrato": contrato,
                        "neto": neto
                    }]
                    console.log(arrayRequest);
                    $.ajax({
                        type: "POST",
                        url: "ws/personal/Personal.php",
                        data: JSON.stringify({
                            'action': 'AddPersonal',
                            'request': arrayRequest,
                            'empresaId':EMPRESA_ID
                        }),
                        dataType: 'json',
                        success: function(data) {
                            console.log("RESPONSE ADD PERSONAL UNITARIO",data);

                            if(data.success){
                                Swal.fire({
                                    'icon':'success',
                                    'title':"Listo",
                                    'text':data.success.message,
                                    'timer': 2500
                                })
                            }
                            if(data.error){
                                Swal.fire({
                                    'icon':'error',
                                    'title':"Ups!",
                                    'text':data.error.message,
                                    'timer': 2500
                                })
                            }
                        },
                        error: function(data) {
                            console.log(data.responseText);
                        }
                    }).then(()=>{
                        $('#xlarge').modal('hide');
                        FillPersonalAllData(empresaId)
                    })
                }
            })
        });

        const dataArrayIndex = ['nombres', 'apellidos', 'rut', 'telefono', 'correo', 'cargo', 'especialidad', 'contrato']
        const dataArray = {
            'xlsxData': [{
                    'name': 'nombres',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },
                {
                    'name': 'apellidos',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'rut',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': true
                },

                {
                    'name': 'telefono',
                    'type': 'int',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': true
                },
                {
                    'name': 'correo',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': true
                },

                {
                    'name': 'cargo',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'especialidad',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 15,
                    'notNull': false
                },

                {
                    'name': 'contrato',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                }
                // ,
                // {
                //     'name': 'neto',
                //     'type': 'string',
                //     'minlength': 1,
                //     'maxlength': 50,
                //     'notNull': false
                // }
            ]
        }


        //Funcion que verifica la extension del archivo ingresado
        function GetFileExtension() {
            fileName = $('#excel_input').val();
            extension = fileName.split('.').pop();
            return extension;
        }

        $('#excel_input').on('change', async function() {
            const extension = GetFileExtension()
            if (extension == "xlsx") {

                const tableContent = await xlsxReadandWrite(dataArray);
                let tableHead = $('#excelTable>thead')
                let tableBody = $('#excelTable>tbody')
                $('#masivaPersonalCreation').modal('show')

                //LIMPIAR TABLA
                tableBody.empty()
                tableHead.empty()

                //LLENAR TABLA
                tableHead.append(tableContent[0])
                tableBody.append(tableContent[1])


            } else(
                Swal.fire({
                    icon: 'error',
                    title: 'Ups',
                    text: 'Debes cargar un Excel',
                })
            )
        })

        $('#excelTable>tbody').on('blur', 'td', function() {

            let value = $(this).text();

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
                } else {

                }

            }
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
            $('#masivaPersonalCreation').modal('hide')
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
                        "nombre": value[0],
                        "apellido": value[1],
                        "rut": value[2],
                        "telefono": value[3],
                        "correo": value[4],
                        "cargo": value[5],
                        "especialidad": value[6],
                        "contrato": value[7]
                    }
                    return returnArray
                })
                $.ajax({
                    type: "POST",
                    url: "ws/personal/Personal.php",
                    data: JSON.stringify({action:"addPersonalMasiva",request:arrayRequest,empresaId:EMPRESA_ID}),
                    dataType: 'json',
                    success: function(data) {
                        $('#masivaProblems').modal('show');
                        $('#masivaProblemsTitle').text('Resumen del ingreso del personal');
                        let table = $('#tableProblems')
                        console.log(data);
                        if(data.success){
                        }
                        if(data.error){
                            let responseArray = data.error.arrErr
                            let cargos = [];
                            let especialidades = [];
                            let contratos = [];
                            responseArray.forEach(el=>{
                                if(el.problem === "Especialidad"){
                                    if(especialidades.includes(el.data.especialidad)){
                                    }else{
                                        especialidades.push(el.data.especialidad)
                                    }
                                }
                                if(el.problem === "Cargo"){
                                    if(cargos.includes(el.data.cargo)){
                                    }else{
                                        cargos.push(el.data.cargo)
                                    }
                                }
                                if(el.problem === "Contrato"){
                                    if(contratos.includes(el.data.contrato)){
                                    }else{
                                        contratos.push(el.data.contrato)
                                    }
                                }
                                let tdToSearch = $(`#tableProblems .excelRow`);
                                if(tdToSearch.length > 0 ){

                                    let arrayRows = [];

                                    $(`#tableProblems .excelRow`).each((key,element)=>{

                                        let row = $(element).text();
                                        if(arrayRows.includes(row)){

                                        }else{
                                            arrayRows.push(row);
                                        }
                                    })

                                    console.log("ARRAY ROWS",arrayRows);

                                    if(arrayRows.includes(`${el.row}`)){

                                        let element = $(`#tableProblems .excelRow:contains('${el.row}')`)
                                        if(el.problem === "Cargo"){
                                            let cargo = $(element).closest('tr').find('.cargo');
                                            if(!$(cargo).hasClass('err')){
                                                $(cargo).addClass('err');
                                                $(cargo).text(el.data.cargo);
                                            }
                                        }

                                        if(el.problem === "Especialidad"){
                                            let especialidad = $(element).closest('tr').find('.especialidad');
                                            if(!$(especialidad).hasClass('err')){
                                                
                                                $(especialidad).addClass('err');
                                                $(especialidad).text(el.data.especialidad);

                                            }
                                        }
                                        if(el.problem === "Contrato"){

                                            let contrato = $(element).closest('tr').find('.contrato');

                                            if(!$(contrato).hasClass('err')){

                                                $(contrato).addClass('err');
                                                $(contrato).text(el.data.contrato);

                                            }
                                        }
                                    }else{
                                        let tr = `<tr><td class="excelRow">${el.row}</td>
                                            <td class="nombre" >${el.data.nombre}</td>
                                            <td class="apellido" >${el.data.apellido}</td>
                                            <td class="rut" >${el.data.rut}</td>
                                            <td class="telefono" >${el.data.telefono}</td>
                                            <td class="correo" >${el.data.correo}</td>
                                            <td class="cargo ${el.problem === "Cargo" ? "err" :""}">${el.data.cargo}</td>
                                            <td class="especialidad ${el.problem === "Especialidad" ? "err" :""}">${el.data.especialidad}</td>
                                            <td class="contrato ${el.problem === "Contrato" ? "err" :""}">${el.data.contrato}</td></tr>`;
                                        table.append(tr);
                                    }
                                }else{
                                    let tr = `<tr><td class="excelRow">${el.row}</td>
                                        <td>${el.data.nombre}</td>
                                        <td>${el.data.apellido}</td>
                                        <td>${el.data.rut}</td>
                                        <td>${el.data.telefono}</td>
                                        <td>${el.data.correo}</td>
                                        <td class="cargo ${el.problem === "Cargo" ? "err" :""}">${el.data.cargo}</td>
                                        <td class="especialidad ${el.problem === "Especialidad" ? "err" :""}">${el.data.especialidad}</td>
                                        <td class="contrato ${el.problem === "Contrato" ? "err" :""}">${el.data.contrato}</td></tr>`;
                                    table.append(tr);
                                }
                            })

                            let ulEspecialidades =$('#ulEspecialidades'); 
                            let ulCargos = $('#ulCargos');
    
                            especialidades.forEach(el=>{
                                ulEspecialidades.append(`<li> <p class="especialidadName">${el}</p>
                                                            <div class="container-end">
                                                                <div class="actionContainer">
                                                                    <p onclick="AddEspecialidadFromModal(this)" class="addDynamic">Agregar</p><i class="fa-solid fa-plus plus"></i>
                                                                </div>
                                                                <div class="actionContainer">
                                                                    <p  onclick="removeLi(this)" class="deleteDynamic">Quitar</p><i class="fa-solid fa-minus minus"></i>
                                                                </div>
                                                            </div>
                                                        </li>`);
                            });
    
                            cargos.forEach(el=>{
                                ulCargos.append(`<li> <p class="cargoName">${el}</p>
                                                    <div class="container-end">
                                                        <div class="actionContainer">
                                                            <p onclick="AddCargoFromModal(this)" class="addDynamic">Agregar</p><i class="fa-solid fa-plus plus"></i>
                                                        </div>
                                                        <div class="actionContainer">
                                                            <p onclick="removeLi(this)" class="deleteDynamic">Quitar</p><i class="fa-solid fa-minus minus"></i>
                                                        </div>
                                                    </div>
                                                </li>`);
                            });
                        }
                    },
                    error: function(data) {
                        console.log(data);
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

        //DELETE PERSONAL 
        $(".deletePersonal").on('click', function() {

            let tr = $(this).closest('tr');
            let nombre = $(this).closest('tr').find('.nombre').text();
            let apellido = $(this).closest('tr').find('.apellido').text();
            let idPersonal = $(this).closest('tr').find('.id').text();

            Swal.fire({
                icon: 'info',
                title: `Desea dar de baja a: ${nombre} ${apellido}`,
                showCancelButton: true,
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {

                    let arrayRequest = [{
                        id: idPersonal
                    }]

                    $.ajax({
                        type: "POST",
                        url: "ws/personal/deletePersonal.php",
                        data: JSON.stringify(arrayRequest),
                        dataType: 'json',
                        success: async function(data) {

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

        async function AddespecialidadMasiva(){

            let names = $('#ulEspecialidades li');
            let arrayEspecialidades = [];

            if(names.length > 0){
                $(names).each((key,value)=>{
                    arrayEspecialidades.push($(value).find('.especialidadName').text());
                })
                const response = await Promise.all([AddEspecialidadGivenArray(EMPRESA_ID,arrayEspecialidades)]);

                if(response.length > 0){
                    let li = $('#ulEspecialidades');
                    li.hide('slow', function(){li.empty();});
                    Swal.fire({
                        'icon':'success',
                        'title': 'Excelente!',
                        'text': 'Datos ingresados con exito',
                        'timer': 1500,
                        'position':'bottom-end',
                        'showConfirmButton':false
                    }).then(()=>{
                        RemoveErrClass('especialidad', arrayEspecialidades);
                    })
                }else{
                    Swal.fire({
                        'icon':'error',
                        'title': 'Ups!',
                        'text': `No se ha podido ingresar las especialidades`,
                        'timer': 1500,
                        'position':'bottom-end',
                        'showConfirmButton':false
                    }).then(()=>{
                    })
                }
            }else{
                Swal.fire({
                    'icon':'error',
                    'title': 'Ups!',
                    'text': `No hay especialidades para agregar`,
                    'timer': 2000,
                    'position':'bottom-end',
                    'showConfirmButton':false
                })
            }
        }


        async function AddEspecialidadFromModal(element){

            let valor = $(element).closest('li').find('.especialidadName').text();
            let li = $(element).closest('li');

            const response = await Promise.all([AddEspecialidadGivenArray(EMPRESA_ID,[valor])]);
            if(response.length > 0){
                li.hide('slow', function(){li.remove();});
                Swal.fire({
                    'icon':'success',
                    'title': 'Excelente!',
                    'text': 'Datos ingresados con exito',
                    'timer': 1500,
                    'position':'bottom-end',
                    'showConfirmButton':false
                })
                .then(()=>{
                    RemoveErrClass('especialidad', [valor]);
                })

            }else{

                Swal.fire({
                    'icon':'error',
                    'title': 'Ups!',
                    'text': `No se ha podido ingresar la especialidad ${valor}`,
                    'timer': 1500,
                    'position':'bottom-end',
                    'showConfirmButton':false
                }).then(()=>{
                    $('#especialidadName').val("");
                    $('#cargoEspecialidad').modal('hide');
                })

            }
        }

        async function AddCargoFromModal(element){
            let valor = $(element).closest('li').find('.cargoName').text();
            let li = $(element).closest('li');

            const response = await Promise.all([AddCargoGivenArray(EMPRESA_ID,[valor])]);
            if(response.length > 0){

                li.hide('slow', function(){li.remove();});

                Swal.fire({
                    'icon':'success',
                    'title': 'Excelente!',
                    'text': 'Datos ingresados con exito',
                    'timer': 1500,
                    'position':'bottom-end',
                    'showConfirmButton':false
                })
                .then(()=>{
                    RemoveErrClass('cargo', [valor]);
                })

            }else{

                Swal.fire({
                    'icon':'error',
                    'title': 'Ups!',
                    'text': `No se ha podido ingresar la especialidad ${valor}`,
                    'timer': 1500,
                    'position':'bottom-end',
                    'showConfirmButton':false
                })
            }
        }

        async function AddCargoMasiva(){

            let names = $('#ulCargos li');
            let arrayCargos = [];

            if(names.length > 0){
                $(names).each((key,value)=>{
                    arrayCargos.push($(value).find('.cargoName').text());
                })
                const response = await Promise.all([AddCargoGivenArray(EMPRESA_ID,arrayCargos)]);

                if(response.length > 0){
                    let li = $('#ulCargos');
                    li.hide('slow', function(){li.empty();});
                    Swal.fire({
                        'icon':'success',
                        'title': 'Excelente!',
                        'text': 'Datos ingresados con exito',
                        'timer': 1500,
                        'position':'bottom-end',
                        'showConfirmButton':false
                    })
                    .then(()=>{
                        RemoveErrClass('cargo', arrayCargos)
                    })

                }else{

                    Swal.fire({
                        'icon':'error',
                        'title': 'Ups!',
                        'text': `No se ha podido ingresar las especialidades`,
                        'timer': 1500,
                        'position':'bottom-end',
                        'showConfirmButton':false
                    })
                }
            }else{

                Swal.fire({
                    'icon':'error',
                    'title': 'Ups!',
                    'text': `No hay especialidades para agregar`,
                    'timer': 2000,
                    'position':'bottom-end',
                    'showConfirmButton':false
                })
            }
        }


        function RemoveErrClass(tipo,arrayToEvaulate){
            const evaluateArray = arrayToEvaulate;
            if(tipo ==="especialidad"){
                const arrayEspecialidad = $('#tableProblems > tbody tr .especialidad');
                $(arrayEspecialidad).each((key,element)=>{
                    console.log($(element).text());
                    if($(element).hasClass('err') && evaluateArray.includes($(element).text())){
                        $(element).removeClass('err')
                    }
                })
            }
            if(tipo ==="cargo"){
                const arrayEspecialidad = $('#tableProblems > tbody tr .cargo');
                $(arrayEspecialidad).each((key,element)=>{
                    if($(element).hasClass('err') && evaluateArray.includes($(element).text())){
                        $(element).removeClass('err');
                    }
                });
            }
        }

        function AddPersonalFromModalProblems(){
            let arrayPersonal = [];

            $('#tableProblems > tbody tr').each((key,element)=>{
                if(!$(element).find('.cargo').hasClass('err') && !$(element).find('.especilidad').hasClass('err')){
                    arrayPersonal.push({
                        nombre : $(element).find('.nombre').text(),
                        apellido : $(element).find('.apellido').text(),
                        rut : $(element).find('.rut').text(),
                        correo : $(element).find('.telefono').text(),
                        telefono : $(element).find('.correo').text(),
                        neto : $(element).find('.neto').text(),
                        especialidad : $(element).find('.especialidad').text(),
                        contrato : $(element).find('.contrato').text(),
                        cargo : $(element).find('.cargo').text()
                    });
                }
            });

            if(arrayPersonal.length > 0){
                $.ajax({
                    type: "POST",
                    url: "ws/personal/Personal.php",
                    data: JSON.stringify({action:"addPersonalMasiva",request:arrayPersonal,empresaId:EMPRESA_ID}),
                    dataType: 'json',
                    success: function(data){

                    }
                })
                .then(()=>{
                    FillPersonalAllData(EMPRESA_ID);
                })
            }
        }

        function removeLi(element){
            let li = $(element).closest('li');
            li.hide('slow', function(){li.remove();});
        }
    </script>

</body>
</html>