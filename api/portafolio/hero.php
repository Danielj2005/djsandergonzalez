<?php 
session_start();

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/portafolioModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') { 
        $hero = portafolioModel::getPortafolioData('hero');
        ?>            

            <form id="em_form" action="../controller/portafolio.php" method="post" class="SendFormAjax" autocomplete="off" data-type-form="update" enctype="multipart/form-data">
                <input type="hidden" name="modulo" value="hero">
                <input id="imgDeleted" name="imgDeleted" type="hidden">
                <div class="p-2 row">
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Título</label>
                        <input value="<?= $hero['titulo'] ?>" type="text" id="titulo" name="titulo" placeholder="ingresa el título"
                            class=" text-slate-800 dark:text-slate-400 mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>
                    <div class="col-12 text-start mb-2 flex items-start justify-start">
                        <label class="absolute text-md  text-slate-800 dark:text-slate-200">Subtitulo</label>
                        <input value="<?= $hero['subtitulo'] ?>" type="text" id="subtitulo" name="subtitulo" placeholder="ingresa el subtitulo"
                            class=" text-slate-800 dark:text-slate-400  mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                    </div>

                    <label class="dark:text-slate-200 col-form-label">Imagenes de la portada </label>
                    <div class="border border-secondary p-2 rounded-3 d-flex flex-wrap gap-3 justify-content-start overflow-hidden overflow-x-auto">
                        
                        <button id="<?= str_replace("./view/img/", "", $hero['logo']) ?>" type="button" class="delete_image position-relative align-items-center btn btn-outline-danger d-flex justify-content-center">
                            <img src="<?= str_replace("./view/", "./", $hero['logo']) ?>" style="width: 5rem; height:5rem; " class="d-block" alt="...">
                            <div class="align-items-center bg-danger bg-opacity-25 d-flex h-100 justify-content-center position-absolute w-100">
                                <i class="bi bi-trash fs-5"></i>
                            </div>
                        </button>
                        <button id="<?= str_replace("./view/img/", "", $hero['bg_image']) ?>" type="button" class="delete_image position-relative align-items-center btn btn-outline-danger d-flex justify-content-center">
                            <img src="<?= str_replace("./view/", "./", $hero['bg_image']) ?>" style="width: 5rem; height:5rem; " class="d-block" alt="...">
                            <div class="align-items-center bg-danger bg-opacity-25 d-flex h-100 justify-content-center position-absolute w-100">
                                <i class="bi bi-trash fs-5"></i>
                            </div>
                        </button>
                    </div>
                
                    <div class="col-12 p-2">
                        <label class="dark:text-slate-200 col-form-label">Cargar Logo <span style="color:#f00;">*</span> </label>
                        <input type="file" id="imageLogo" name="imageLogo[]" accept="image/*" class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-300 hover:file:bg-slate-200 cursor-pointer transition"/>
                    </div>
                    <div class="col-12 p-2">
                        <label class="dark:text-slate-200 col-form-label">Cargar Imagenes de la portada <span style="color:#f00;">*</span> </label>
                        <input type="file" id="imageBg" name="imageBg[]" accept="image/*" class="text-sm rounded-full ps-3 form-control border p-2 w-full text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-300 hover:file:bg-slate-200 cursor-pointer transition"/>
                    </div>
                </div>
    
            </form>
    <?php  
    }
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}