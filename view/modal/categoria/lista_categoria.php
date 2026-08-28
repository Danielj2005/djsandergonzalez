<?php 
session_start();

require_once "../../../modelo/modeloPrincipal.php";
require_once "../../../modelo/categoria_model.php";
require_once "../../../modelo/rol_model.php";

?>
<div class="table table-responsive">
    <table class="table table-striped mb-3 tableCategoryOfProducts" id="tableCategoryOfProducts">
        <thead>
            <tr>
                <th class="col text-center" scope="col">#</th>
                <th class="col text-center" scope="col">Nombre</th>
                <th class="col text-center" scope="col">Descripción</th>
                <?php if (modeloPrincipal::verificar_permisos_requeridos(['m_categoria'])) { ?>
                    <th class="col text-center" scope="col">Estado</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php category_model::lista(); ?>  
        </tbody>
    </table>
</div>