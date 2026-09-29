<?php

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') {
        
            // info producto a editar
            $id = modeloPrincipal::decryptionId($_GET['UID']);

            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = $products[0];
            
            ?>

                <input name="id" value="<?= modeloPrincipal::encryptionId($id) ?>" type="hidden">

                <div class="col-12 col-md- mb-2">
                    <label class="dark:text-slate-200 col-form-label">Nombre del producto <span class="rounded-full bg-red-500 w-[15px] h-[15px] badge animate-pulse text-[#fff0]">*</span> </label>
                    <input name="producto" value="<?= modeloPrincipal::convert_to_utf8($products['nombre']) ?>" placeholder="Nombre" required class="form-control">
                </div>

                <div class="col-12 col-md- mb-2">
                    <label class="dark:text-slate-200 col-form-label">Precio <span class="rounded-full bg-red-500 w-[15px] h-[15px] badge animate-pulse text-[#fff0]">*</span> </label>
                    <input name="price" value="<?= $products['precio'] ?>" type="number" step="0.01" placeholder="Precio ($)" class="form-control">
                </div>

                <div class="col-12 mb-2">
                    <label class="dark:text-slate-200 col-form-label">Descripción <span class="rounded-full bg-red-500 w-[15px] h-[15px] badge animate-pulse text-[#fff0]">*</span> </label>
                    <textarea name="desc" value="<?= modeloPrincipal::convert_to_utf8($products['description']) ?>" placeholder="Descripción del producto..." class="form-control"><?= modeloPrincipal::convert_to_utf8($products['description']) ?></textarea>
                </div>
            
                <div class="text-start mb-4">
                    <p class="w-full text-slate-200 mt-4 text-sm">Los campos con  <span class="rounded-full bg-red-500 w-[15px] h-[15px] badge animate-pulse text-[#fff0]">*</span>  son obligatorios.</p>
                </div>
    <?php  
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>