

<div class="modal fade" id="editar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-dialog-scrollable">
        <div class="dark:bg-slate-800 modal-content rounded-4 border border-secondary shadow-lg">
            <div class="modal-header">
                <h5 class="dark:text-slate-200 modal-title" id="exampleModalLabel"> <i class="bi bi-pencil-square"></i> Modificar Producto</h5>
                <button id="btnCloseModal" type="button" class="dark:bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editProduct" action="../controller/producto_controlador.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                    <input type="hidden" name="modulo" value="Modificar">
                    <div id="tableModalEdit" class="row justify-content-center align-items-center">

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button form="editProduct" type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>