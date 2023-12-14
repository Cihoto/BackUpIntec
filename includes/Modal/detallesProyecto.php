<!-- MODAL DIRECCION PROYECTO-->

<div class="modal fade"  id="proyectosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content" style="padding: 20px;">
            <div class="modal-header">
                <p style="display: none;" id="idProjectModalResume"></p>
                <p style="display: none;" id="idClienteModalResume"></p>
                <p style="display: none;" id="idLugarModalResume"></p>
                <p style="display: none;" id="estadoProyecto"></p>
                <h4 class="modal-title" id="myModalLabel33">Dirección del proyecto </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="row">
                <i style="display:none; font-size:20px" id="car" class="fa-solid fa-car"></i>
                <i style="display:none; font-size:20px" id="person" class="fa-solid fa-person"></i>
                <i style="display:none; font-size:20px" id="toolbox" class="fa-solid fa-toolbox"></i>
            </div>
            <?php
                require_once('./includes/forms/projectForm.php');
            ?>
            <?php if ($detalle) :?>
                <?php require_once('./includes/projectAssigments.php')?>

            <?php  endif;?>

            <?php if (in_array("7", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)):?>
            <div class="card box">
                <div class="row" style="justify-content: end;">
                
                    <div class="col-3 mt-2 mb-2">
                        <?php if(!$isDetails):?>
                            <button class="btn btn-success" id="submitProject">Crear Evento</button>
                        <?php else:?>
                            <button class="btn btn-success" id="updateProject">Guardar Cambios</button>
                        <?php endif;?>
                    </div>

                    <?php if($isDetails):?>
                        <div class="col-3 mt-2 mb-2">
                            <button class="btn btn-success" id="changeStatusButton" value=""></button>
                        </div>
                    <?php endif;?>

                    <div style="display: none;" class="col-3 mt-2 mb-2">
                        <button class="btn btn-success" id="verarray">Ver array</button>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- END MODAL PROYECTO -->