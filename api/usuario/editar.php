<?php

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER Lista dew usuarios (GET) ---
    if ($method === 'GET') { 
        
        $id_usuario = $_GET['UID'] ?? null;
        
        if ($id_usuario != null): 
            
            $id_usuario = modeloPrincipal::decryptionId($id_usuario);

            $usuario = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT * FROM users
                WHERE id = $id_usuario"));
        ?>

        <form id="em_form" action="../controller/usuario_controller.php" method="post" class="SendFormAjax row" autocomplete="off" data-type-form="update">

            <input type="hidden" name="UIDTM" value="<?= modeloPrincipal::encryptionId($usuario["id"]); ?>">
            <input type="hidden" name="modulo" value="caracteristicas_de_acceso">

            <div class="col-12 mb-2">
                <label for="nombre_completo" class="dark:text-slate-200 form-label">Nombres Completo</label>
                <input type="text" value="<?= $usuario['full_name']?>" 
                    class="form-control dark:bg-slate-200 " id="nombre_completo" name="nombre_completo"
                    readonly>
            </div>
            
            <div class="col-12 mb-2">
                <label for="telefono_user" class="dark:text-slate-200 form-label">Teléfono</label>
                <input type="text" 
                    value="<?= $usuario['telefono'] ?? 'N/A' ?>" placeholder="ingresa el teléfono del usuario" 
                    class="form-control dark:bg-slate-200" 
                    id="telefono_user" 
                    name="telefono_user"
                    required>
            </div>

            <h6 class="text-center dark:text-slate-200 font-sans font-bold text-emerald-500 border-bottom mb-1">Configuración de Acceso</h6>

            <div class="col-12">
                <label for="cambiar_estado" class="dark:text-slate-200 form-label">
                    Estado Actual: 
                    <span class="badge fw-bold text-white <?= ($usuario['state'] == 1) ? 'text-bg-success' : ' text-bg-danger'; ?>">
                        <?= ($usuario['state'] == 1) ? 'ACTIVO' : 'INACTIVO'; ?>
                    </span>
                </label>
                <select class="dark:bg-slate-200 form-select" name="cambiar_estado" id="cambiar_estado">
                    <option value="1" <?= ($usuario['state'] == 1) ? 'selected' : ''; ?>>Activar Usuario</option>
                    <option value="0" <?= ($usuario['state'] == 0) ? 'selected' : ''; ?>>Inactivar Usuario</option>
                </select>
            </div>

        </form>

        <div class="text-center mt-1 pt-3">
        
            <div class="">
                <i class="bi bi-exclamation-triangle-fill text-amber-400 text-3xl"></i>
                <h6 class="dark:text-slate-200 fw-bold text-red-600 mb-3">Acción de Mantenimiento</h6>
            </div>


            
            <form action="../controller/usuario_controller.php" method="post" class="SendFormAjax d-inline-block" 
                autocomplete="off" data-type-form="update">
                
                <input type="hidden" name="modulo" value="resetear_contraseña">
                <input type="hidden" name="UID" value="<?= modeloPrincipal::encryptionId($usuario["id"]); ?>">

                <button type="submit" class="btn btn-warning shadow-sm" title="Restablecer la contraseña del usuario a un valor por defecto.">
                    <i class="bi bi-key-fill me-2"></i>
                    Resetear Contraseña
                </button>
            </form>
        </div>
                
        <script type="text/javascript"> SendFormAjax(); </script>

<?php endif;
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}