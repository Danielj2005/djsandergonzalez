<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') {
        
            // info producto a editar
            $id = $_GET['UID'] ?? null;

            if (!$id) { throw new Exception("ID de producto no proporcionado"); }

            $imagenes = modeloPrincipal::consultar("SELECT id, img_src FROM producto_image WHERE id_producto = $id");   

            $imgsrc = [];            

            while ($img = mysqli_fetch_array($imagenes)){  $imgsrc[] = $img['id']; }

            // convertimos el array en string para enviarlo al input hidden
            $imgsrc = implode(",",$imgsrc); // convertimos el array en string para enviarlo al input hidden
            $imagenes = modeloPrincipal::consultar("SELECT id, img_src FROM producto_image WHERE id_producto = $id");   

            ?>            

            <form id="em_form" action="../controller/img_producto.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                <input type="hidden" name="modulo" value="Modificar">
                <input name="id" value="<?= modeloPrincipal::encryptionId($id) ?>" type="hidden">
                <input id="imgDeleted" name="imgDeleted" type="hidden">
                <input id="imgHasProduct" name="imgHasProduct" type="hidden" value="<?= $imgsrc; ?>">
                <div class="p-2">
                    <label class="dark:text-slate-200 col-form-label">Imagenes del producto </label>
                    <div class="border border-secondary p-2 rounded-3 d-flex flex-wrap gap-3 justify-content-start overflow-hidden overflow-x-auto">
                        <?php while ($img = mysqli_fetch_array($imagenes)) { ?>
                            <button id="<?= modeloPrincipal::encryptionId($img['id']) ?>" type="button" onclick="delete_img_producto('<?= modeloPrincipal::encryptionId($img['id']) ?>')" class="delete_image position-relative align-items-center btn btn-outline-danger d-flex justify-content-center">
                                <img src=".<?= $img['img_src']; ?>" style="width: 5rem; height:5rem; " class="d-block" alt="...">
                                <div class="align-items-center bg-danger bg-opacity-25 d-flex h-100 justify-content-center position-absolute w-100">
                                    <i class="bi bi-trash fs-5"></i>
                                </div>
                            </button>
                        <?php } ?>
                    </div>
                </div>
    
                <div class="p-2">
                    <label class="dark:text-slate-200 col-form-label">Cargar más Imagenes del producto <span style="color:#f00;">*</span> </label>
                    <input type="file" id="fileImg" name="image[]" multiple accept="image/*" class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-300 hover:file:bg-slate-200 cursor-pointer transition"/>
                </div>
            </form>
    <?php  
    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}