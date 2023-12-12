<div class="row"  style="">
<div class="col-12 col-md-6">
    <h4>EQUIPOS</h4>
</div>
<div class="d-flex col-md-6 col-12 justify-content-center">
    <p>Filtrar productos por categoría</p>
    <select name="" id="projectResumeFilter-products">
        <option value="all">Todos</option>
    </select>
</div>
</div>
<div id="ventaContainer">
    <div>
        <div id="ventaEventos">
        </div>

    </div>
    <div id="otrosVenta"> 
        <p class = "categorieHeaderTitle">Otros</p>
        <table id="others-table" class="tableCatsAnsResume"> 
            <thead>
                <tr>
                    <th>
                        Descripción
                    </th>
                    <th>
                        <p>Cantidad</p>
                        <svg  class="hideColumn hide-cant" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <g clip-path="url(#clip0_570_13275)">
                            <path d="M7.425 3.18002C7.94125 3.05918 8.4698 2.99877 9 3.00002C14.25 3.00002 17.25 9.00002 17.25 9.00002C16.7947 9.85172 16.2518 10.6536 15.63 11.3925M10.59 10.59C10.384 10.8111 10.1356 10.9884 9.85961 11.1114C9.58362 11.2343 9.28568 11.3005 8.98357 11.3058C8.68146 11.3111 8.38137 11.2555 8.10121 11.1424C7.82104 11.0292 7.56654 10.8608 7.35288 10.6471C7.13923 10.4335 6.97079 10.179 6.85763 9.89881C6.74447 9.61865 6.68889 9.31856 6.69423 9.01645C6.69956 8.71434 6.76568 8.4164 6.88866 8.1404C7.01163 7.86441 7.18894 7.61601 7.41 7.41002M13.455 13.455C12.1729 14.4323 10.6118 14.9737 9 15C3.75 15 0.75 9.00002 0.75 9.00002C1.68292 7.26144 2.97685 5.74247 4.545 4.54502L13.455 13.455Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 0.75L17.25 17.25" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                    </th>
                    <th>
                        <p>Total</p>
                        <svg  class="hideColumn hide-total" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <g clip-path="url(#clip0_570_13275)">
                            <path d="M7.425 3.18002C7.94125 3.05918 8.4698 2.99877 9 3.00002C14.25 3.00002 17.25 9.00002 17.25 9.00002C16.7947 9.85172 16.2518 10.6536 15.63 11.3925M10.59 10.59C10.384 10.8111 10.1356 10.9884 9.85961 11.1114C9.58362 11.2343 9.28568 11.3005 8.98357 11.3058C8.68146 11.3111 8.38137 11.2555 8.10121 11.1424C7.82104 11.0292 7.56654 10.8608 7.35288 10.6471C7.13923 10.4335 6.97079 10.179 6.85763 9.89881C6.74447 9.61865 6.68889 9.31856 6.69423 9.01645C6.69956 8.71434 6.76568 8.4164 6.88866 8.1404C7.01163 7.86441 7.18894 7.61601 7.41 7.41002M13.455 13.455C12.1729 14.4323 10.6118 14.9737 9 15C3.75 15 0.75 9.00002 0.75 9.00002C1.68292 7.26144 2.97685 5.74247 4.545 4.54502L13.455 13.455Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 0.75L17.25 17.25" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                    </th>
                </tr>
            </thead>    
            <tbody>
                <!-- <tr>
                    <td><input type="text" class="nameOthers" value="Ampolleta LED"></td>
                    <td class="cantTd"><input type="text" class="totalOthers" value="2"></td>
                    <td class="totalTd"><input type="text" class="totalOthers" value="$12.000"></td>
                </tr> -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <button class="s-Button-w changeInvertHover" style="width: 200px!important;"  id="addNewOthersRow" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_521_15624)">
                                    <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 6V12" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 9H12" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                            </svg>
                            <p class="s-P-g">Agregar Fila</p>
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="row justify-content-end" >
            <table class="col-4">
                <thead>
                    <tr>
                        <td>NETO</td>
                        <td id="netoVenta"></td>
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td id="ivaVenta"></td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td id="totalVenta"></td>
                    </tr>
                </thead>
            </table>
    
            
    

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
        <button class="s-Button-p" style="width: 200px!important;"  id="generateQuotes" >
            <p class="s-P-g" style="margin-top: 5px;">Generar cotización</p>
            <img src="../../assets/svg/downloadIcon.svg" alt="">
        </button>
        <button class="s-Button" id="openCostos" style="width: 170px;margin-top: 10px;">
            <p class="s-P">guardar</p>
        </button>
    </div>
</div>

<!-- <a href="../ws/" download>DESCARGAR PDF DESCARGAR PDF</a> -->
<!-- <a href="../../ws/BussinessDocuments/documents/buss1/quotes/invoice.pdf" download>DESCARGAR PDF DESCARGAR PDF</a> -->