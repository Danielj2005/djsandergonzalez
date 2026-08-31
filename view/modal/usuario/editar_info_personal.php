<?php session_start(); ?>


<div class="modal fade" id="editar_info_usuario" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-dialog-scrollable">
        <div class="dark:bg-slate-800 modal-content rounded-4 border shadow-2xl">
            <div class="modal-header">
                <h5 class="dark:text-slate-200 modal-title" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Registro de Usuarios</h5>
                <button id="btnCloseModal" type="button" class="dark:bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="body_modal">
                
                <form id="editar_info" autocomplete="off" action="../controller/usuario_controller.php" method="post" class="SendFormAjax" data-type-form="save">
                    <input type="hidden" name="modulo" value="modificar_info_personal_usuario">
                    <div class="mb-3 ">
                        <label class="dark:text-slate-200 control-label">Nombre Completo<span style="color:#f00;">*</span></label>
                        <input value="<?= $_SESSION['dataUser']['nombre']; ?>" type="text" pattern="[A-Za-zñÑÁÉÍÚÓáéíóú ]{4,100}" maxlength="100" required="" placeholder="Ingresa el Nombre" class="form-control" id="nombre" name="nombre">
                    </div>

                    <div class="mb-3 label-floathing form-group">
                        <label class="dark:text-slate-200 control-label">Correo <span style="color:#f00;">*</span></label>
                        <input value="<?= $_SESSION['dataUser']['correo']; ?>" type="text" pattern="[A-Za-zÁÉÍÚÓáéíóúñÑ@.0-9]{11,200}" maxlength="200" required="" placeholder="Ingrese el Correo" class="form-control" id="correo" name="correo">
                    </div>

                    <div class="mb-3 label-floathing form-group">
                        <label class="dark:text-slate-200 control-label">Teléfono <span style="color:#f00;">*</span></label>
                        <input value="<?= $_SESSION['dataUser']['telefono']; ?>" type="text" pattern="[0-9]{10,15}" maxlength="15" required="" placeholder="Ingrese el Teléfono" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="col-12 mb-1">
                        <div class="form-group">
                            <p class="dark:text-slate-200 form-p">Los campos con <span style="color:#f00;">*</span> son obligatorios</p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="btn_guardar_modal" form="editar_info" type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>