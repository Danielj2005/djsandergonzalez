<?php

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; 
require_once "../model/categoryModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { ?>
    
            <div id="tableList" class=" dark:text-slate-200 justify-content-between align-items-center table table-responsive">
                <table class="dark:text-slate-200 table tableListModal mb-3 em_tale_data" id="tableListModal">
                    <thead>
                        <tr>
                            <th class="col text-center" scope="col">N.º</th>
                            <th class="col text-center" scope="col">Nombre</th>
                            <th class="col text-center" scope="col">Descripción</th>
                            <th class="col text-center" scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php category_model::lista(); ?>  
                    </tbody>
                </table>
            </div>

    <?php
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}