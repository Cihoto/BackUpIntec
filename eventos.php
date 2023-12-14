<?php
$active = "eventos";
$title = "Mis Eventos";
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
                        <li class="breadcrumb-item active" aria-current="page"><a class="txtDec-no" href="#">Listado de eventos</a></li>
                    </ol>
                </nav>
                <p class="headerTitle">Listado de eventos</p>
            </header>

            <div class="pageContent">
                <div class="formHeader d-flex justify-content-start" style="margin-top: 8px;">
                    <svg style="margin-top: 4px;" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <circle cx="6" cy="6" r="6" fill="#069B99" />
                    </svg>
                    <p class="header-P">Aquí puedes ver y editar tus eventos</p>
                </div>


                <div class="row" style="margin-left: 0px;margin-bottom: -16px; justify-content: space-between;width: 100%;">

                    <button class="s-Button-w">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path d="M17 2.75H2L8 9.845V14.75L11 16.25V9.845L17 2.75Z" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="s-P-g">Filtros</p>
                    </button>

                    <button class="s-Button" id="openModalNewFree">
                        <p class="s-P">Crear técnico</p>
                    </button>
                </div>



                <table class="resume-table s-table" id="allProjectTable-list">
                    <thead>
                        <tr>
                            <th style="width: 17.8226514%;">
                                <p>Evento</p>
                            </th>
                            <th style="width: 6.67251975%;">
                                <p>Estado</p>
                            </th>
                            <th style="width: 12.642669%;justify-content: space-between;">
                                <p>Fecha</p>
                                <img src="./assets//svg/calendar.svg" alt="">
                            </th>
                            <th style="width: 13.5355575%;">
                                <p>Cliente</p>
                            </th>
                            <th style="width: 10.5355575%;">
                                <p>Tipo de evento</p>
                            </th>
                            <th style="width: 10.5355575%;">
                                <p>Precio venta</p>
                            </th>
                            <th style="width: 10.5355575%;">
                                <p>Owner</p>
                            </th>
                            <th style="width: 14.15%;">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 17.8226514%;">
                                <p class="event-name"> Fiesta fin de año </p>
                                <button class="commentContainer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M15.75 8.62502C15.7526 9.61492 15.5213 10.5914 15.075 11.475C14.5458 12.5338 13.7323 13.4244 12.7256 14.047C11.7189 14.6696 10.5587 14.9996 9.375 15C8.3851 15.0026 7.40859 14.7713 6.525 14.325L2.25 15.75L3.675 11.475C3.2287 10.5914 2.99742 9.61492 3 8.62502C3.00046 7.44134 3.33046 6.28116 3.95304 5.27443C4.57562 4.26771 5.46619 3.4542 6.525 2.92502C7.40859 2.47872 8.3851 2.24744 9.375 2.25002H9.75C11.3133 2.33627 12.7898 2.99609 13.8969 4.10317C15.0039 5.21024 15.6638 6.68676 15.75 8.25002V8.62502Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </td>
                            <td style="width: 6.67251975%;padding: 10px 16px 10px 8px;">
                                <p class="event-status confirmado">Confirmado</p>
                            </td>
                            <td style="width: 12.6426691%; ">
                                <p>Fecha</p>
                            </td>
                            <td style="width: 13.5355575%;">
                                <p>Cliente</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Tipo de evento</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Precio venta</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Owner</p>
                            </td>
                            <td style="width: 14.15%;">
                                <button class="buttonEventList">
                                    <img src="./assets/svg/ArchiveNoActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/PersonalActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/VehicleNoActive.svg" alt="">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 17.8226514%;">
                                <p class="event-name"> Fiesta fin de año </p>
                                <button class="commentContainer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M15.75 8.62502C15.7526 9.61492 15.5213 10.5914 15.075 11.475C14.5458 12.5338 13.7323 13.4244 12.7256 14.047C11.7189 14.6696 10.5587 14.9996 9.375 15C8.3851 15.0026 7.40859 14.7713 6.525 14.325L2.25 15.75L3.675 11.475C3.2287 10.5914 2.99742 9.61492 3 8.62502C3.00046 7.44134 3.33046 6.28116 3.95304 5.27443C4.57562 4.26771 5.46619 3.4542 6.525 2.92502C7.40859 2.47872 8.3851 2.24744 9.375 2.25002H9.75C11.3133 2.33627 12.7898 2.99609 13.8969 4.10317C15.0039 5.21024 15.6638 6.68676 15.75 8.25002V8.62502Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </td>
                            <td style="width: 6.67251975%;padding: 10px 16px 10px 8px;">
                                <p class="event-status finalizado">Finalizado</p>
                            </td>
                            <td style="width: 12.642669%;">
                                <p>Fecha</p>
                            </td>
                            <td style="width: 13.5355575%;">
                                <p>Cliente</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Tipo de evento</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Precio venta</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Owner</p>
                            </td>
                            <td style="width: 14.15%;">
                                <button class="buttonEventList">
                                    <img src="./assets/svg/ArchiveNoActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/PersonalActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/VehicleActive.svg" alt="">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 17.8226514%;">
                                <p class="event-name"> Fiesta fin de año </p>
                                <button class="commentContainer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M15.75 8.62502C15.7526 9.61492 15.5213 10.5914 15.075 11.475C14.5458 12.5338 13.7323 13.4244 12.7256 14.047C11.7189 14.6696 10.5587 14.9996 9.375 15C8.3851 15.0026 7.40859 14.7713 6.525 14.325L2.25 15.75L3.675 11.475C3.2287 10.5914 2.99742 9.61492 3 8.62502C3.00046 7.44134 3.33046 6.28116 3.95304 5.27443C4.57562 4.26771 5.46619 3.4542 6.525 2.92502C7.40859 2.47872 8.3851 2.24744 9.375 2.25002H9.75C11.3133 2.33627 12.7898 2.99609 13.8969 4.10317C15.0039 5.21024 15.6638 6.68676 15.75 8.25002V8.62502Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </td>
                            <td style="width: 6.67251975%;padding: 10px 16px 10px 8px;">
                                <p class="event-status cotizado">Cotizado</p>
                            </td>
                            <td style="width: 12.642669%;">
                                <p>Fecha</p>
                            </td>
                            <td style="width: 13.5355575%;">
                                <p>Cliente</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Tipo de evento</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Precio venta</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Owner</p>
                            </td>
                            <td style="width: 14.15%;">
                                <button class="buttonEventList">
                                    <img src="./assets/svg/ArchiveActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/PersonalActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/VehicleActive.svg" alt="">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 17.8226514%;">
                                <p class="event-name"> Fiesta fin de año </p>
                                <button class="commentContainer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M15.75 8.62502C15.7526 9.61492 15.5213 10.5914 15.075 11.475C14.5458 12.5338 13.7323 13.4244 12.7256 14.047C11.7189 14.6696 10.5587 14.9996 9.375 15C8.3851 15.0026 7.40859 14.7713 6.525 14.325L2.25 15.75L3.675 11.475C3.2287 10.5914 2.99742 9.61492 3 8.62502C3.00046 7.44134 3.33046 6.28116 3.95304 5.27443C4.57562 4.26771 5.46619 3.4542 6.525 2.92502C7.40859 2.47872 8.3851 2.24744 9.375 2.25002H9.75C11.3133 2.33627 12.7898 2.99609 13.8969 4.10317C15.0039 5.21024 15.6638 6.68676 15.75 8.25002V8.62502Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </td>
                            <td style="width: 6.67251975%;padding: 10px 16px 10px 8px;">
                                <p class="event-status cerrado">Cerrado</p>
                            </td>
                            <td style="width: 12.642669%;">
                                <p>Fecha</p>
                            </td>
                            <td style="width: 13.5355575%;">
                                <p>Cliente</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Tipo de evento</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Precio venta</p>
                            </td>
                            <td style="width: 10.5355575%;">
                                <p>Owner</p>
                            </td>
                            <td style="width: 14.15%;">
                                <button class="buttonEventList">
                                    <img src="./assets/svg/ArchiveActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/PersonalNoActive.svg" alt="">
                                </button>
                                <button class="buttonEventList">
                                    <img src="./assets/svg/VehicleActive.svg" alt="">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>



            </div>
        </div>
    </div>
    <?php require_once('./includes/footer.php') ?>
    <?php  require_once('./includes/footerScriptsJs.php') ?>

    </div>
    </div>
</body>

<script src="/js/eventList.js"></script>
<script src="./js/const/projectToSearch.js"></script>

<script>
    $(document).ready(function() {
        const EMPRESA_ID = <?php echo $empresaId; ?>;
        const ROL_ID = <?php echo json_encode($rol_id); ?>;
        getEvents(EMPRESA_ID);
    })


    $(document).on('click','.eventListRow',function(){
        const EVENT_ID = $(this).closest('tr').attr('evento_id');
        console.log(EVENT_ID);
        project_id_to_search = EVENT_ID;
        console.log(project_id_to_search)
        window.location = `/miEvento.php?event_id=${EVENT_ID}`
    })
</script>

</html>