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

            // Convertimos el string de imágenes de nuevo a Array para el JS
            $products['imgs'] = explode(",",$products['images']);
            $imgsrc = [];

                foreach ($products['imgs'] as $img) { 
                    $imgsrc[] = explode("/",$img)[2]; // obtenemos solo la ruta de la imagen
                }
            ?>

                <input name="id" value="<?= modeloPrincipal::encryptionId($id) ?>" type="hidden">
                <input id="imgDeleted" name="imgDeleted" type="hidden">
                <input id="imgHasProduct" name="imgHasProduct[]" type="hidden" value="<?= implode(',',$imgsrc); ?>">

                <div class="col-12 col-md-6 mb-2">
                    <label class="dark:text-slate-200 col-form-label">Nombre del producto <span style="color:#f00;">*</span> </label>
                    <input name="producto" value="<?= modeloPrincipal::convert_to_utf8($products['nombre']) ?>" placeholder="Nombre" required class="form-control">
                </div>

                <div class="col-12 col-md-6 mb-2">
                    <label class="dark:text-slate-200 col-form-label">Precio <span style="color:#f00;">*</span> </label>
                    <input name="price" value="<?= $products['precio'] ?>" type="number" step="0.01" placeholder="Precio ($)" class="form-control">
                </div>
                
                <label class="dark:text-slate-200 col-form-label">Imagenes del producto </label>
                <div class="p-3 mb-2 col-12">
                    <div class="border border-secondary p-2 rounded-3 d-flex flex-wrap gap-3 justify-content-start overflow-hidden overflow-x-auto">

                        <?php foreach ($products['imgs'] as $img) { ?>
                            <button type="button" dataId="<?= $products['id'] ?>" class="delete_image position-relative align-items-center btn btn-outline-danger d-flex justify-content-center">
                                <img src=".<?= $img ?>" style="width: 5rem; height:5rem; " class="d-block" alt="...">
                                <div class="align-items-center bg-danger bg-opacity-25 d-flex h-100 justify-content-center position-absolute w-100">
                                    <i class="bi bi-trash fs-5 "></i>
                                </div>
                            </button>
                        <?php } ?>

                    </div>
                </div>

                <div class="col-12 mb-2">
                    <label class="dark:text-slate-200 col-form-label">Cargar más Imagenes del producto <span style="color:#f00;">*</span> </label>
                    <input type="file" id="fileImg" name="image[]" multiple accept="image/*" class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-300 hover:file:bg-slate-200 cursor-pointer transition"/>
                </div>

                <div class="col-12 mb-2">
                    <label class="dark:text-slate-200 col-form-label">Descripción <span style="color:#f00;">*</span> </label>
                    <textarea name="desc" value="<?= modeloPrincipal::convert_to_utf8($products['description']) ?>" placeholder="Descripción del producto..." class="form-control"><?= modeloPrincipal::convert_to_utf8($products['description']) ?></textarea>
                </div>
                
    <?php  
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>