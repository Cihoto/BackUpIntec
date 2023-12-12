<div class="row">
    <div class="row justify-content-end align-items-center">
        <button class="s-Button-w changeInvertHover"  style="width:300px!important;" id="AddNewProvider">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <g clip-path="url(#clip0_521_15624)">
                    <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85786 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85786 16.5 9 16.5Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 6V12" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 9H12" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
            </svg>
            <p class="s-P-g">Agregar Proveedor</p>
        </button>
    </div>
    <div class="subarriendosContainer">
        <table id=subarriendosTable>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Proveedor</th>
                    <th>Monto</th>
                    <th class="actionRemoveSubArriendo"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="notCompletedSubArriendo">
                    <td>
                        <input class="form-control rentDetail" type="text" name="" id="" value=""> 
                    </td>
                    <td>
                        <select class="form-select allProvidersSelect" name="" id="allProviders">


                        </select>
                    </td>
                    <td>
                        <input class="form-control subArriendoValue" type="text" name="" id="" value="0">
                    </td>
                    <td class="removeSubArriendo">
                        <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M2 4H3.33333H14" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.33334 4.00065V2.66732C5.33334 2.3137 5.47381 1.97456 5.72386 1.72451C5.97391 1.47446 6.31305 1.33398 6.66667 1.33398H9.33334C9.68696 1.33398 10.0261 1.47446 10.2761 1.72451C10.5262 1.97456 10.6667 2.3137 10.6667 2.66732V4.00065M12.6667 4.00065V13.334C12.6667 13.6876 12.5262 14.0267 12.2761 14.2768C12.0261 14.5268 11.687 14.6673 11.3333 14.6673H4.66667C4.31305 14.6673 3.97391 14.5268 3.72386 14.2768C3.47381 14.0267 3.33334 13.6876 3.33334 13.334V4.00065H12.6667Z" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.33334 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.66666 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <button class="s-Button-w changeInvertHover" style="width: 200px!important;"  id="addNewRowSubArriendos" >
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
    </div>
    <div class="subarriendosfooter">

    </div>
</div>

<?php require_once('./includes/Modal/addNewProvider.php')?>