<?php
$active = "eventos";
$title = "Mis Eventos";
 require_once('./includes/Constantes/personalIds.php') 
?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once('./includes/head.php');
?>

<body>
    <?php require_once('./includes/Constantes/empresaId.php') ?>
    <?php require_once('./includes/Constantes/rol.php') ?>
    
    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

        <div id="main">
            <header class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="txtDec-no" href="./proximosEventos.php"><img src="./assets/svg/Eventos.svg" alt=""> Eventos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="txtDec-no" href="#">Crear evento</a></li>
                    </ol>
                </nav>
                <p class="headerTitle" style="margin:-13px 0px 16px 0px!important;">Crear un nuevo evento evento</p>
            </header>

            <div class="pageContent">
                <div class="status-container">
                    <p style="color: var(--Text-secondary, #53545C);
                        font-family: Roboto;
                        font-size: 12px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: normal;
                        letter-spacing: 0.12px;">
                        Estado actual:
                    </p>
                    

                    <div class="status-options-container">

                        <button status_id="1" class="event-status-btn borrador" id="status-button">
                            <p>Borrador</p>
                        </button>
                        <!-- <button class="event-status-btn cotizado">
                            <p>Cotizado</p>
                        </button>
                        <button class="event-status-btn confirmado">
                            <p>Confirmado</p>
                        </button>
                        <button class="event-status-btn finalizado">
                            <p>Finalizado</p>
                        </button>
                        <button class="event-status-btn cerrado">
                            <p>Cerrado</p>
                        </button> -->
                    </div>
                </div>
                <?php require_once('./includes/eventAssigments.php')?>
            </div>

            <div id="statusMenuList" class="optionLimiter">
                <section id="statusMenuHeader">
                    <div id="headerOptionsContent">
                        <img src="./assets/svg/bookMark.svg" alt="">
                        <div class="listItemHeaderText">
                            <p class="header">Etiquetas de estado</p>
                            <p class="bottom">Puedes cambiar el estado de tu evento en todo momento</p>
                        </div>
                    </div>
                </section>
                <div class="d-flex" style="width: 100%;margin:-13px 0px;padding: 0px;">

                    <div class="divider">1</div>
                </div>
                <section class="statusMenuOptions">
                    <button status_id="1"  class="event-status-btn borrador">
                        <p>Borrador</p>
                    </button>
                    <button status_id="4" class="event-status-btn cotizado">
                        <p>Cotizado</p>
                    </button>
                    <button status_id="2" class="event-status-btn confirmado">
                        <p>Confirmado</p>
                    </button>
                    <button status_id="3" class="event-status-btn finalizado">
                        <p>Finalizado</p>
                    </button>
                    <button status_id="5" class="event-status-btn cerrado" style="border-radius: 0px 0px 5px 5px;">
                        <p>Cerrado</p>
                    </button>
                </section>
            </div>
        </div>
    </div>

    
    <div style="display: none;" id="downloadPdf">
    </div>

    <?php require_once('./includes/footer.php'); ?>
    <?php require_once('./includes/footerScriptsJs.php'); ?>


    <!-- require Modal -->
    <?php require_once('./includes/Modal/direccion.php') ?>
    <?php require_once('./includes/Modal/cliente.php') ?>
    <?php require_once('./includes/Modal/addNewFreeLance.php') ?>
    <!-- FIN require Modal -->
    <?php require_once('./includes/footerScriptsJs.php') ?>


    <!-- REQUIRE FORM ARRIENDOS -->
    <?php require_once('./includes/forms/arriendosForm.php') ?>

    </div>
    </div>
    <script src="./js/const/projectToSearch.js"></script>
      <!-- REQUIRE DE FUNCIONES JS -->
  <script src="/js/Funciones/NewProject.js"></script>
  <script src="/js/packages.js"></script>
  <script src="/js/clientes.js"></script>
  <script src="/js/direccion.js"></script>
  <script src="/js/personal.js"></script>
  <script src="/js/vehiculos.js"></script>
  <script src="/js/productos.js"></script>
  <script src="/js/valuesValidator/validator.js"></script>
  <script src="/js/ClearData/clearFunctions.js"></script>
  <script src="/js/localeStorage.js"></script>
  <script src="/js/ProjectResume/projectResume.js"></script>
  <script src="/js/ProjectResume/viatico.js"></script>
  <script src="/js/ProjectResume/subArriendo.js"></script>
  <script src="/js/Funciones/assigments.js"></script>
  <script src="/js/cotizacion.js"></script>
  <script src="/js/provider.js"></script>
  <script src="/js/evento/eventoController.js"></script>
  <script src="/js/map.js"></script>
  <script src="/js/evento/createEvent.js"> </script>
  <script src="/js/eventSchedule.js"></script>
  <script src="/js/filesUpload.js"></script>
  <script src="/js/evento/getEventData.js"></script>
  <!-- VALIDATE FORM -->
  <script src="/js/validateForm/addNewFreeLance.js"></script>
  <script src="/js/validateForm/addNewProvider.js"></script>
</body>


<script>

let is_open = false;
let ROL_ID = <?php echo json_encode($rol_id); ?>;
let   EMPRESA_ID =<?php echo $empresaId;?>;
const PERSONAL_IDS = <?php echo $personal_ids;?>;

<?php if(isset($_GET['event_id'])):?>
    const EVENT_ID = <?=$_GET['event_id'];?>;
    event_data.event_id = EVENT_ID;
    projectDates.project_id = EVENT_ID;
    
<?php endif;?>

// SET EVENT_ID


// OBJECT CONTAINS INFO ABOUT START AND FINISH DATE ON EVENT 
// TO SHOW PERSONAL, VEHICLES AND PERSONAL ON LIVE AVAILABILITY 
// ON TABLES

$('#inputProjectName').on('change', function() {
    $('#projectNameResume').text($(this).val());
});
$('#inputProjectName').on('blur', function(){
    if($(this).val() !== ""){
        $('#eventNameMessage').css('visibility','hidden');
    }else{
        $('#eventNameMessage').css('visibility','visible');

    }
});

$(document).ready(async function() {

    <?php if(isset($_GET['event_id'])):?>
        await getAllProjectData(EVENT_ID, EMPRESA_ID);
    <?php endif;?>

    projectDates.start_date = ""
    projectDates.finish_date = ""
    projectDates.total_days = ""
    projectDates.selectDates = false
    projectDates.project_id = ""
})

$('#status-button').on('click', function() {
    $('#statusMenuList').addClass('active')
    is_open = true;
})
$('#addFilestest').on('click', function() {
    console.log("_allmyUploadedFiles",_allmyUploadedFiles);
    assignFilesToEvent(_allmyUploadedFiles,event_data.event_id,EMPRESA_ID,PERSONAL_IDS);
})

$(document).on('click', function(e) {
    const IS_LIMIT = $(e.target).closest('#statusMenuList').hasClass('optionLimiter')
    if($(e.target).hasClass('event-status-btn')){  
    }else{
        if(is_open === true){
            $('#statusMenuList').removeClass('active');
        }
    } 
})

$('.event-status-btn').on('click',function(){
    const BUTTON_CLASS = $(this).attr('class').split(" ")[1];
    const ACTUAL_CLASS = $('#status-button').attr('class').split(" ")[1];
    const STATUS_ID = $(this).attr('status_id');
    $('#status-button').removeClass(ACTUAL_CLASS);
    $('#status-button').addClass(BUTTON_CLASS);
    $('#status-button').find('p').text(BUTTON_CLASS);
    $('#status-button').attr('status_id',STATUS_ID);
    console.log($('#status-button').attr('status_id'));
});

$('.saveDraft').on('click',function(){
    // $('#hiddenAddProject').trigger('click');
    SaveOrUpdateEvent();
})
$('.createOrContinue').on('click',function(){
    // $('#hiddenAddProject').trigger('click');
    SaveOrUpdateEvent();
});

$(document).keydown(function(event) {
    if (event.which === 13) {
        event.preventDefault();
        alert('Enter key is pressed!');
    }
});

</script>

</html>