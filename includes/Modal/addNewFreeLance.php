<div class="modal fade text-left" id="newFreeLance-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content" style="padding: 24px;">
            <div class="modal-header">
                <div class="formHeader">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <circle cx="6" cy="6" r="6" fill="#069B99" />
                    </svg>
                    <p class="header-P">Aquí puedes agregar un nuevo técnico Freelance al evento.
                        Todos los campos son necesarios</p>
                </div>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button> -->
            </div>
            <div class="modal-body">
                <form id="addNewFreeLance">
                    <div style="display: flex;
                                align-items: flex-start;
                                gap: 20px;">
                        <div class="form-group">
                            <label class="inputLabel">Tipo de contrato</label>
                            <input type="text" class="form-control input-lg s-Input" readonly value="Freelance" />
                        </div>
                        <div class="form-group">
                            <label for="especialidadSelect" class="inputLabel">*Especialidad</label>
                            <select id="especialidadSelect" name="especialidadSelect" type="text" class="form-select input-lg s-Select">
                                <option value="uno">Uno</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex" style="gap: 10px;">
                        <div class="form-group">
                            <label for="nombreInput" class="inputLabel">*Nombre</label>
                            <input id="nombreInput" name="nombreInput" type="text" class="form-control input-lg s-Input largeFree" />
                        </div>
                        <div class="form-group">
                            <label for="rutInput" class="inputLabel">*Rut</label>
                            <input id="rutInput" name="rutInput" type="text" class="form-control input-lg s-Input shortFree" />
                        </div>

                    </div>
                    <div class="d-flex" style="gap: 10px;">
                        <div class="form-group">
                            <label for="correoInput" class="inputLabel">*Correo electrónico</label>
                            <input id="correoInput" name="correoInput"  type="text" class="form-control input-lg s-Input largeFree" />
                        </div>
                        <div class="form-group">
                            <label for="telefonoInput" class="inputLabel">*Teléfono</label>
                            <input id="telefonoInput" name="telefonoInput" type="text" class="form-control input-lg s-Input shortFree" />
                        </div>
                    </div>

                    <input type="submit" style="display: none; " id="createNewFreeLance">

                </form>
                <div class="row" style="justify-content: end">
                    <button class="s-Button col-3" id="triggerNewFreeLance">
                        <p class="s-P">Crear Nuevo Técnico</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .err{
        border:1px solid red;
    }
</style>