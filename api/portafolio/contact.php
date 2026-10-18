<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/portafolioModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        
        $contact = modeloPrincipal::consultar("SELECT * FROM contacto"); ?>            

            <form id="em_form" action="../controller/portafolio.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                <input type="hidden" name="modulo" value="contact">
                <div class="grid grid-cols-2 gap-2 mb-7">
                    
                    <?php while ($data = mysqli_fetch_array($contact)): ?>
                        <div class="flex gap-4 group" bis_skin_checked="1">
                            <div class="flex flex-col justify-center" bis_skin_checked="1">
                                <p class="text-slate-800 dark:text-slate-200 text-[9px] font-bold uppercase tracking-[0.2em] mb-1"><?= str_replace("_", " ", $data['nombre']) ?></p>
                                <input type="text" class="border border-slate-500 dark:bg-slate-400 p-2 text-slate-800 rounded-full font-extrabold text-xs sm:text-sm leading-tight tracking-tight" 
                                    name="<?= $data['nombre'] ?>" value="<?= $data['url'] ?>" />
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </form>     
        <?php   
    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}