<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/portafolioModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        
        if (!empty($_GET["UID"]) || isset($_GET["UID"])) {
                
            $id = modeloprincipal::limpiar_cadena(modeloprincipal::decryptionId($_GET["UID"]));
            $service = mysqli_fetch_array(modeloPrincipal::consultar("SELECT * FROM servicio WHERE id = $id"));
        
        ?>            

            <form id="em_form" action="../controller/portafolio.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                <input type="hidden" name="modulo" value="service">
                <input type="hidden" name="UID" value="<?=  modeloPrincipal::encryptionId($service['id']) ?>">

                <div class="p-2 row">
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Nombre</label>
                        <input value="<?= $service['nombre'] ?>" type="text" id="titulo" name="titulo" placeholder="ingresa el título"
                            class=" text-slate-800 dark:text-slate-400 mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Subtitulo</label>
                        <input value="<?= $service['subtitulo'] ?>" type="text" id="subtitulo" name="subtitulo" placeholder="ingresa el subtitulo"
                            class=" text-slate-800 dark:text-slate-400  mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>
                    
                    <div class="col-12 text-start mb-8 pb-2 ">
                        <label class="text-sm text-slate-800 dark:text-slate-200">Lo que incluye  </label>
                        <p class="mb-3 text-xs text-red-500">(cada items que se agrege se deben separar por comas. ej: música,Coordinación musical,Sonido e iluminación) </p>
                        <textarea value="<?= $service['incluye'] ?>" type="text" id="incluye" name="incluye" placeholder="ingresa los items que incluyen tus servicios."
                            class="text-slate-800 dark:text-slate-400 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent"
                            style=" resize: none; field-sizing: content; "><?= $service['incluye'] ?></textarea>
                    </div>
                </div>
    
            </form>
<?php   }else{

            echo '<script type="text/javascript"> 
                    Toastify({ 
                        text: " No se encontro el ID del archivo", 
                        className: " bi bi-x-circle", 
                        duration: 3000,
                        style: {
                            background: "oklch(57.7% 0.245 27.325)",
                        },
                    }).showToast();
            </script>';
            exit();
        }


    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}