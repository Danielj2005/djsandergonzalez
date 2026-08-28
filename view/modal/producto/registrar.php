

<div class="modal fade" id="registrar_producto" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-2xl">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-box-seam-fill"></i> Registrar Producto</h5>
                <button id="btnCloseModal" type="button" class="text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body m-0" id="body_modal">
                <form id="product-form" action="../controller/producto_controlador.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="save" enctype="multipart/form-data">
                    <input type="hidden" name="modulo" value="Guardar">
                    <div class="row ">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="col-form-label">Nombre del producto <span style="color:#f00;">*</span> </label>
                            <input name="producto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{3,180}" placeholder="Nombre" required class="w-100 form-control">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="col-form-label">Precio <span style="color:#f00;">*</span> </label>
                            <input name="price" value="0.00" type="number" min="0" step="0.01" placeholder="Precio ($)" class="w-100 form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <div class="category-selector">
                                <label class="col-form-label">Selecciona una o más Categorías: <span style="color:#f00;">*</span> </label>
                                <div id="tag-container" class="d-flex flex-wrap gap-2 mb-3"></div>

                                <select id="categoryMultiSelect" name="category[]" multiple class="d-none form-select w-full mb-3 bg-slate-800 p-3 rounded-xl border-none outline-none focus:ring-1 ring-purple-500">
                                    <?php category_model::optionsId(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="col-form-label">Cargar Imagen de producto <span style="color:#f00;">*</span> </label>
                            <input type="file" name="image[]" multiple accept="image/*" class="mb-3 w-100 form-control" />
                        </div>

                        <div class="col-12 mb-3">

                            <label class="col-form-label">Descripción <span style="color:#f00;">*</span> </label>
                            <textarea name="desc" placeholder="Descripción del producto..." class="mb-3 w-100 form-control"></textarea>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="btn_guardar_modal" form="product-form" type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>