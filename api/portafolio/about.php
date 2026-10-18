<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/portafolioModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        $about = portafolioModel::getPortafolioData('about');
        $incluye = explode(",",$about['incluye']);
        
        ?>            

            <form id="em_form" action="../controller/portafolio.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                <input type="hidden" name="modulo" value="about">
                <input id="imgDeleted" name="imgDeleted" type="hidden">
                <div class="p-2 row">
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Título</label>
                        <input value="<?= $about['titulo'] ?>" type="text" id="titulo" name="titulo" placeholder="ingresa el título"
                            class=" text-slate-800 dark:text-slate-400 mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Subtitulo</label>
                        <input value="<?= $about['subtitulo'] ?>" type="text" id="subtitulo" name="subtitulo" placeholder="ingresa el subtitulo"
                            class=" text-slate-800 dark:text-slate-400  mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>
                    
                    <div class="col-12 text-start mb-8 ">
                        <label class="text-sm text-slate-800 dark:text-slate-200">Slogan</label>
                        <textarea value="<?= $about['slogan'] ?>" type="text" id="slogan" name="slogan" placeholder="placeholder"
                            class="h-full text-slate-800 dark:text-slate-400 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent"
                            style=" resize: none; field-sizing: content; "><?= $about['slogan'] ?></textarea>
                    </div>
                    
                    <div class="col-12 text-start mb-8 pb-2 ">
                        <label class="text-sm text-slate-800 dark:text-slate-200">Lo que incluye  </label>
                        <p class="mb-3 text-xs text-red-500">(cada items que se agrege se deben separar por comas. ej: música,Coordinación musical,Sonido e iluminación) </p>
                        <textarea value="<?= $about['incluye'] ?>" type="text" id="incluye" name="incluye" placeholder="placeholder"
                            class="h-full text-slate-800 dark:text-slate-400 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent"
                            style=" resize: none; field-sizing: content; "><?= $about['incluye'] ?></textarea>
                    </div>
                
                    <div class="col-12 text-start mb-8 mt-5">
                        <label class="dark:text-slate-200 col-form-label">Imagen cargada</label>
                        <div class="border border-secondary p-2 rounded-3 justify-content-start overflow-hidden overflow-x-auto">
                            <label class="dark:text-slate-200 col-form-label">Cargar nueva imagen <span style="color:#f00;">*</span> </label>
                            <input type="file" id="aboutImg" name="aboutImg[]" accept="image/*" 
                                class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-400 hover:file:bg-slate-200 cursor-pointer transition"/>
                            <div class="flex flex-wrap gap-3 items-center justify-center w-full">
                                <img src="<?= str_replace("./view/", "./", $about['src']) ?>" style="width: 15rem; height:15rem; "
                                        class="mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                            </div>
                        </div>
                        
                    </div>
                </div>
    
            </form>
    <?php  
    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}