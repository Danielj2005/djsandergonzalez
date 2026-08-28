<div class="modal fade" id="registrar_categoria" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-4 border border-secondary shadow-md">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Categoría</h5>
                <button id="btnCloseModal" type="button" class="text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="body_modal">
                <form id="reg_categoria" action="../controller/categoria_controller.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="save">
                    <input type="hidden" name="modulo" value="Guardar">
                    <div class="row mb-3 justify-content-center text-start">
                        <div class="col-12 mb-3">
                            <label class="col-form-label">Nombre <span style="color:#f00;">*</span> </label>
                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ.,\/ ()]{4,100}" required="" placeholder="Ejemplo: Lácteos y Refrigerados" class="form-control" id="input_añadir_categoria" name="nombre_categoria">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="col-form-label">Descripción <span style="color:#f00;">*</span> </label>
                            <textarea required placeholder="Ejemplo: Leche, yogur, queso, mantequilla, huevos, postres fríos." class="form-control" name="descripcion" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ.,\/ ()]{4,200}"></textarea>
                        </div>

                        <div class="col-12 mb-3 text-start">
                            <p class="form-p">Los campos con <span style="color:#f00;">*</span> son obligatorios</p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="btn_guardar_modal" form="reg_categoria" type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>