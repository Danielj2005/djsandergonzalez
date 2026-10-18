<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/portafolioModel.php"; 

// Obtener el user agent del cliente
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        $store = modeloPrincipal::consultar("SELECT * FROM store ORDER BY id");
        ?>            
            <label class="dark:text-slate-200 col-form-label">Imagenes actuales</label>
            <div class="overflow-hidden overflow-x-hidden">
                <div id="storeImages" class="w-full">
                    <?php while ($src = mysqli_fetch_array($store)) : ?>
                        <div class="align-items-center row justify-content-center mb-2">
                            <div class="col-3">
                                <img src="<?= str_replace("./view/", "./", $src['src']) ?>" style="width: 5rem; height:5rem; " class="d-block rounded-2xl" alt="...">
                            </div>
                            <div class="col-2">
                                <button id="<?=  modeloPrincipal::encryptionId($src['id']) ?>" type="submit" form="form_<?= modeloPrincipal::encryptionId($src['id']) ?>"
                                    class="bg-primary bg-opacity-25 delete_image align-items-center btn btn-outline-primary d-flex justify-content-center">
                                        <i class="bi bi-arrow-repeat fs-5"></i>
                                </button>
                            </div>
                            <div class="col-7">
                                <form id="form_<?= modeloPrincipal::encryptionId($src['id']) ?>" action="../controller/portafolio.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                                    <input type="hidden" name="modulo" value="store">
                                    <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($src['id']) ?>">
                                
                                    <input type="file" id="storeImg" name="storeImg[]" accept="image/*"
                                        class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-400 hover:file:bg-slate-200 cursor-pointer transition"/>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>


    <?php  
    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}