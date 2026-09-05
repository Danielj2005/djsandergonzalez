<?php

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; 
require_once "../model/productModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        $state = $data['state'];
        $UID = $data['UID'];
        

        if ($UID >= 0 && $UID <= 1) {
            // Valid state, proceed with fetching products
            producto_model::lista($state);

        }else if ($UID == 2) {
            
            $catalogo = modeloPrincipal::consultar("SELECT id, nombre, precio, state FROM productos WHERE state = $state ORDER BY nombre ASC"); 
            
            while ($mostrar = mysqli_fetch_assoc($catalogo)) {
        
                $id_producto = $mostrar["id"];
                $categorias = modeloPrincipal::consultar("SELECT C.nombre AS categorias FROM `categorias_productos` AS CP 
                    INNER JOIN categorias AS C ON C.id = CP.categoria_id
                    WHERE CP.producto_id = $id_producto"); 
                
                $imagen = mysqli_fetch_array(modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id_producto = $id_producto LIMIT 1"))['img_src']; 
                $imagenes = modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id_producto = $id_producto"); 
                $imgsrc = [];

                while ( $img = mysqli_fetch_array($imagenes)){ 
                    $imgsrc[] = $img['img_src'];
                }
                // convertimos el array en string para enviarlo al input hidden
                $imgsrc = implode(",",$imgsrc); 
                
                ?>


                <div data-categories="" class="producto_<?= $id_producto ?> animate-slide-up border border-slate-800 duration-500 group hover:border-purple-500/50 overflow-hidden rounded-3xl dark:shadow-cyan-500/30 shadow-slate-800/30 shadow-xl transition-all">
                    
                    <div class="overflow-hidden cursor-pointer">
                        <img src=".<?= $imagen ?>" onerror="this.src='./img/404.png'">
                    </div>


                    <div class="p-3">
                        <div class="text-start">
                            <button onclick="detallesProductoById()" class="text-sm mb-3 dark:text-slate-200 text-gray-800 font-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal"> <?= ucwords(strtolower($mostrar["nombre"])) ?> </button>
                        </div>
                        
                        
                        <div class="flex flex-wrap justify-around items-center gap-3">
                            
                            <div class="mb-2">
                                <button class="btn cursor-pointer rounded-full bg-blue-700 dark:text-white text-slate-200" onclick="copyToClipboard('<?= $mostrar['precio']; ?>')">
                                    <spna><?= "$ ".$mostrar["precio"]; ?></span>
                                    <i class="text-[#fff] btn bi bi-copy"></i>
                                </button>
                            </div>
                            <div class="mb-2">
                                <button onclick="editingProduct('<?= modeloPrincipal::encryptionId($mostrar['id']) ?>')" type="button" class="rounded-full btn_details btn btn-warning transition-all gap-2 flex items-center justify-center " data-bs-toggle="modal" data-bs-target="#editar_producto">
                                    <i class="bi bi-pencil-square"></i>
                                    <span class=""> Editar</span>
                                </button> 
                            </div>
                            <div class="mb-2">
                                <button onclick="verImagen('<?= $imgsrc ; ?>','<?= $mostrar['nombre'] ?>' )" class="rounded-full btn btn-secondary transition-all gap-2 flex items-center justify-center" data-bs-toggle="modal" data-bs-target="#ver_imagenes">
                                    <i class="bi bi-image mr-1"></i> 
                                    <span class="">Ver Imagen</span>
                                </button>
                            </div>
                            <div class="mb-2">
                                <button em_size="modal-md" em_trigger="edit" em_icon="bi-pencilsquare" em_url="../api/producto/editar_img.php?UID=<?= $mostrar['id'] ?>" em_title="Modificar imagenes de un Producto" 
                                    data-bs-toggle="modal" data-bs-target="#em_lists" class="rounded-full em_trigger btn bg-slate-800 dark:text-white text-slate-200">
                                        <i class="bi bi-pencil-square"></i>
                                        <span class="">Editar Imagen</span>
                                </button>
                            </div>

                            <div class="mb-2">
                                <?php if ($mostrar["state"] == 1) { ?>

                                    <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                        <input type="hidden" name="modulo" value="activo">          
                                        <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                        <button class="rounded-full btn btn-danger bi bi-x-circle text-sm" title="estado del producto" type="submit"> Desactivar</button>
                                    </form>

                                <?php } else { ?>

                                    <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                        <input type="hidden" name="modulo" value="inactivo">          
                                        <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                        <button class="rounded-full btn btn-success bi bi-check-circle text-sm" title="estado del producto"> Activar</button>
                                    </form>

                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } 
        }else {
            echo json_encode(["status" => "error", "message" => "Invalid state value. Must be 0 or 1."]);
            exit;

        }
    }
    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>