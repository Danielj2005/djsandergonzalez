<?php session_start(); ?>


<div class="modal fade" id="cambiar_contraseña_usuario" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-dialog-scrollable">
        <div class="dark:bg-slate-800 modal-content rounded-4 border shadow-2xl">
            <div class="modal-header">
                <h5 class="dark:text-slate-200 modal-title" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Registro de Usuarios</h5>
                <button id="btnCloseModal" type="button" class="dark:bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="body_modal">
                
                <form id="cambiar_contraseña_form" autocomplete="off" action="../controller/usuario_controller.php" method="post" class="SendFormAjax" data-type-form="save">
                    <input type="hidden" name="modulo" value="modificar_contraseña_usuario">
                    <div class="col-12 mb-2">
                        <label class="dark:text-slate-200 "> Contraseña actual <span style="color: red; font-size: 20px;"> * </span>  </label>
                        <div class="input-group mb-3">
                            <input type="password" required maxlength="60" class="p-2 passw form-control" id="current_password" name="current_password" pattern="[!@#$%A-Za-zÁÉÍÚÓáéíóúñÑ0-9\-]{8,16}" placeholder="ingrese la contraseña actual">
                            
                            <span class="input-group-text btn btn-secondary bi bi-eye" id="eyeIcon" onclick="show_password('eyeIcon', 'current_password')"></span>
                        </div>
                    </div>
                
                    <div class="col-12 mb-2">
                        <label class="dark:text-slate-200 "> Contraseña Nueva <span style="color: red; font-size: 20px;"> * </span> </label>
                        <div class="input-group mb-3">
                            <input type="password" required maxlength="60" class="p-2 passw form-control" id="password" name="password" pattern="[!@#$%A-Za-zÁÉÍÚÓáéíóúñÑ0-9\-]{8,60}" placeholder="ingrese la contraseña nueva">
                
                            <span class="input-group-text btn btn-secondary bi bi-eye" id="eyeIconNewPass" onclick="show_password('eyeIconNewPass', 'password')"></span>
                        </div>
                    </div>
                
                    <div class="col-12 mb-2">
                        <label class="dark:text-slate-200 "> Repetir Contraseña <span style="color: red; font-size: 20px;"> * </span> </label>
                
                        <div class="input-group mb-3">
                            <input type="password" required maxlength="60" class="p-2 passw form-control" id="password2" name="password2" pattern="[!@#$%A-Za-zÁÉÍÚÓáéíóúñÑ0-9\-]{8,60}" placeholder="repita la contraseña">
                            
                            <span class="input-group-text btn btn-secondary bi bi-eye" id="eyeIconRepeatPass" onclick="show_password('eyeIconRepeatPass', 'password2')"></span>
                        </div>
                    </div>
                
                    <div class="dark:text-slate-200">
                        <p class="dark:text-slate-200 mb-2">
                            <span class="dark:text-red-300">la contraseña Puede contener</span>
                            al menos 1 número, 1 de estos caracteres: <span class="dark:text-emerald-500">!@#$%</span>
                            y <span class="font-bold font-monospace "> Debe tener entre 7 y 16 caracteres.</span> 
                        </p>
                    </div>
                </form>
            </div>

            <div class="modal-footer block ">
                <p class="dark:bg-slate-200 text-sm">Todos los Campos Con <span style="color:#f00;">*</span> Son Obligatorios.</p>

                <div class="border-0 m-0 modal-footer p-0">
                    <button id="btn_guardar_modal" form="cambiar_contraseña_form" type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>