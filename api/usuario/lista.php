<?php
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/userModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER Lista dew usuarios (GET) ---
    if ($method === 'GET') { 
        
        $estado = $_GET['UID'] ?? 1;
        
        ?>
    
            <div id="tableList" class=" dark:text-slate-200 justify-content-between align-items-center table table-responsive">
                <table class="dark:text-slate-200 table tableListModal mb-3 em_tale_data" id="tableListModal">
                    <thead>
                        <tr>
                            <th class="text-center col" scope="col">#</th>
                            <th class="text-center col" scope="col">Nombre y Apellido</th>
                            <th class="text-center col" scope="col">Correo</th>
                            <th class="text-center col" scope="col">Teléfono</th>
                            <th scope="col" class="text-center col">Modificar</th>
                            <th scope="col" class="text-center col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php model_user::lista_de_usuarios($estado); ?>  
                    </tbody>
                </table>
            </div>

    <?php
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}