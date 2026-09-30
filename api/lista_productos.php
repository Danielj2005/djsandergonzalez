<?php

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; 
require_once "../model/productModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        
        $estado = $_GET['UID']; ?>
    
            <div id="tableList" class=" dark:text-slate-200 justify-content-between align-items-center table table-responsive">
                <table class="em_table_data dark:text-slate-200 table tableListModal mb-3" id="tableListModal">
                    <thead>
                        <tr>
                            <th class="col text-center" scope="col">N.º</th>
                            <th class="col text-center" scope="col">Producto</th>
                            <th class="col text-center" scope="col">Precio</th>
                            <th class="col text-center" scope="col">Imagenes</th>
                            <th class="col text-center" scope="col">Editar</th>
                            <th class="col text-center" scope="col">Activar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php producto_model::lista($estado); ?>  
                    </tbody>
                </table>
            </div>
    <?php
    }
    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}