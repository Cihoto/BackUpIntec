<div class="container" style="margin: 0px;">

    <div class="formHeader" style="align-items: center!important; margin-left: 13px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <circle cx="6" cy="6" r="6" fill="#069B99" />
        </svg>
        <p class="header-P" style="margin-top: -3px;">Resumen de tu evento creado</p>
    </div>
    <div class="row resumeProjectTables" style="padding:  16px 24px 24px 24px;">
        <div style="display: flex;
        width: 100%;
        padding: var(--none, 0px);
        align-items: flex-start;">

            <div style="display: flex;
            padding: var(--none, 0px);
            align-items: flex-start;
            margin-right: 400px;
            gap: var(--1, 8px);">
                <p class="resumeDescription" style="margin-right: 500px;">Evento:</p>
                <p id="projectNameResume" class="resumeDetail"></p>
            </div>
            <div style="display: flex;
            padding: var(--none, 0px);
            align-items: flex-start;
            gap: var(--1, 8px);">
                <p class="resumeDescription" style="margin-right: 500px;">Cliente:</p>
                <p id="clienteProjectResume" class="resumeDetail"></p>
            </div>

        </div>
        <div style="display: flex;
        width: 100%;
        padding: var(--none, 0px);
        align-items: flex-start;">

            <div style="display: flex;
            padding: var(--none, 0px);
            align-items: flex-start;
            margin-right: 400px;
            gap: var(--1, 8px);">
                <p class="resumeDescription" style="margin-right: 500px; width: 250px;">Dirección:</p>
                <p id="lugarProjectResume" class="resumeDetail"></p>
            </div>
        </div>



        <div style="display: flex;
            width: 100%;
            padding: var(--none, 0px);
            align-items: flex-start;">
            <div style="display: flex;
                padding: var(--none, 0px);
                align-items: flex-start;
                margin-right: 400px;
                gap: var(--1, 8px);">
                <p class="resumeDescription" style="margin-right: 500px;">Fecha:</p>
                <p id="fechaProjectResume" class="resumeDetail"></p>
            </div>
            <div style="display: flex;
                padding: var(--none, 0px);
                align-items: flex-start;
                gap: var(--1, 8px);">
                <p class="resumeDescription" style="margin-right: 500px;">Horario:</p>
                <p id="" class="resumeDetail"></p>
            </div>
        </div>
        <table id="total-productResume" style="margin-bottom: 40px;">
            <thead>
                <tr style="height: 50px;">
                    <th colspan="2" style="width: 70%;">
                        <p style="font-size: 24px;font-weight: 700;">Ingresos del evento</p>
                    </th>
                    <th style="width: 30%;" id="totalPrice-equipos">$0</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <table id="total-othersResume">
            <thead>
                <tr>
                    <th colspan="2" style="width: 70%;">Otros</th>
                    <th id="totalOthers">$0</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>

            </tfoot>
        </table>

        <table>
            <thead>
                <tr style="height: 50px;">
                    <th colspan="2" style="width: 70%;">
                        <p style="font-size: 24px;font-weight: 700;">Costos del evento</p>
                    </th>
                    <th style="width: 30%;" id="totalCost-project"></th>
                </tr>
            </thead>
        </table>
        <table id="total-personalResume">
            <thead>
                <tr>
                    <th colspan="2" style="width: 70%;">Personas</th>
                    <th style="width: 30%;"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            </tfoot>
        </table>

        <table id="total-vehiculosResume">
            <thead>
                <tr>
                    <th colspan="2" style="width: 70%;">Vehículos</th>
                    <th style="width: 30%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-4"></td>
                    <td>Propios</td>
                    <td id="totalVehiculosPropios"></td>
                </tr>
                <tr>
                    <td class="col-4"></td>
                    <td>Externos</td>
                    <td id="totalVehiculosExternos"></td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>

        <table id="total-SubArriendosResume">
            <thead>
                <tr>
                    <th style="width: 70%;">Sub Arriendos</th>
                    <th id="totalSubArriendos">$0</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
        <table style="margin-top: 50px;">
            <thead>
                <tr style="padding: 15px;">
                    <th class="utev" style="width: 70%;">Utilidad Evento</th>
                    <th class="utev" id="utilidadEvento">$0</th>
                </tr>
                <tr style="padding: 15px;">
                    <th class="utev" style="width: 70%;">Margen Operacional</th>
                    <th class="utev" id="margfenOperacional">$0</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
<div class="projectSave-footer">
    <div class="returnPreviusPage">
        <button class="s-Button-w" style="width: 170px;" id="saveDraft">
            <p class="s-P-g">Guardar Borrador</p>
        </button>
    </div>

    <div class="saveProject">
        <button class="s-Button" id="openVenta" style="width: 170px;">
            <p class="s-P">guardar</p>
        </button>
    </div>
</div>