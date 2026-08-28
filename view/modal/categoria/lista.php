<div class="modal fade" id="modalList" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal_tamano" class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista de Categorías</h5>
                <button id="btnCloseModal" type="button" class="text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body row m-0" id="bodyModalList">

                <div id="tableList" class="justify-content-between align-items-center table table-responsive">
                    <table class="table tableListModal mb-3 table-striped" id="tableListModal">
                        <thead>
                            <tr>
                                <th class="col text-center" scope="col">N.º</th>
                                <th class="col text-center" scope="col">Nombre</th>
                                <th class="col text-center" scope="col">Descripción</th>
                                <th class="col text-center" scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>