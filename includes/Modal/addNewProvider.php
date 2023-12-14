<div class="modal fade text-left" id="newProvider-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content" style="padding: 24px;">
            <div class="modal-header">
                <div class="formHeader">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <circle cx="6" cy="6" r="6" fill="#069B99" />
                    </svg>
                    <p class="header-P">Aquí puedes agregar un nuevo proveedor</p>
                </div>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button> -->
            </div>
            <div class="modal-body">
                <form id="addProviderToSubRents">
                    <div class="d-flex" style="width: 100%;">
                        <div class="txtDivider"><p style="width: 190px">Datos personales</p></div>
                    </div>
                    <div class="d-flex col-12" style="gap: 1px;">
                        <div class="form-group col-5">
                            <label for="providerNameInput" class="inputLabel">*Nombre</label>
                            <input  id="providerNameInput" name="providerNameInput" type="text" class="form-control input-lg s-Input"/>
                        </div>
                        <div class="form-group col-5">
                            <label for="providerLastNameInput" class="inputLabel">*Apellido</label>
                            <input  id="providerLastNameInput" name="providerLastNameInput" type="text" class="form-control input-lg s-Input" value=""/>
                        </div>
                        <div class="form-group col-2" style="margin: 0px !important;">
                            <label for="providerRutInput" class="inputLabel">*Rut</label>
                            <input  id="providerRutInput" name="providerRutInput"  type="text" class="form-control input-lg s-Input" value="" style="margin-right: 0px!important;"/>
                        </div>
                    </div>

                    <div class="d-flex" style="gap: 10px;">
                        <div class="form-group">
                            <label for="correoInput" class="inputLabel">*Correo electrónico</label>
                            <input id="providerCorreoInput" name="correoInput"  type="text" class="form-control input-lg s-Input largeFree" />
                        </div>
                        <div class="form-group">
                            <label for="telefonoInput" class="inputLabel">*Teléfono</label>
                            <input id="providerTelefonoInput" name="telefonoInput" type="text" class="form-control input-lg s-Input shortFree" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%;">
                        <div class="txtDivider"><p style="width: 200px;">Datos Facturación</p></div>
                    </div>


                    <div class="d-flex col-12" style="gap: 1px;">
                        <div class="form-group col-5">
                            <label for="providerNameInput" class="inputLabel">Razón Social</label>
                            <input  id="razonSocialInput" name="razonSocialInput" type="text" class="form-control input-lg s-Input"/>
                        </div>
                        <div class="form-group col-5">
                            <label for="nombreFantasiaInput" class="inputLabel">Nombre Fantasía</label>
                            <input  id="nombreFantasiaInput" name="nombreFantasiaInput" type="text" class="form-control input-lg s-Input" value=""/>
                        </div>
                        <div class="form-group col-2" style="margin: 0px !important;">
                            <label for="rutEmpresaInput" class="inputLabel">Rut Empresa</label>
                            <input  id="rutEmpresaInput" name="rutEmpresaInput" type="text" class="form-control input-lg s-Input" value="" style="margin-right: 0px!important;"/>
                        </div>
                    </div>

                    <div class="d-flex col-12" style="gap: 1px;">
                        <div class="form-group col-5">
                            <label for="direccionEmpresaInput" class="inputLabel">Dirreción</label>
                            <input id="direccionEmpresaInput" name="direccionEmpresaInput"  type="text" class="form-control input-lg s-Input"/>
                        </div>
                        <div class="form-group col-7">
                            <label for="correoEmpresaInput" class="inputLabel">Correo</label>
                            <input  id="correoEmpresaInput" name="correoEmpresaInput" type="text" class="form-control input-lg s-Input" value=""/>
                        </div>
                    </div>

                    <input type="submit" style="display: none; " id="createNewProvider">

                </form>
            </div>
            <div class="row" style="justify-content: end;padding-top: 30px;" >
                <button class="s-Button col-3" id="triggerNewProvider">
                    <p class="s-P">Crear Proveedor</p>
                </button>
            </div>
        </div>
    </div>

</div>

<style>
    .err{
        border:1px solid red;
    }
</style>