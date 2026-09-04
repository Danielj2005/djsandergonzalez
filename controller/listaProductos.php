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


                <div data-categories="" class="product-card product_${id} group bg-slate-900/40 border border-slate-800 rounded-3xl overflow-hidden hover:border-purple-500/50 transition-all duration-500 animate-slide-up">
                    
                    <div class="overflow-hidden cursor-pointer">
                        <img src=".<?= $imagen ?>" onerror="this.src='./img/404.png'">
                    </div>


                    <div class="p-3">
                        <div class="">
                            <button onclick="detallesProductoById()" class="text-sm mb-3 text-white font-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal"> <?= ucwords(strtolower($mostrar["nombre"])) ?> </button>
                        </div>
                        
                        <div class="">
                            <div class="align-items-center gap-2 justify-content-start mb-3 row">

                                <div class="mb-2"> 
                                    <button class="btn btn-success px-1 py-0" id="basic-addon2" onclick="copyToClipboard('<?= $mostrar['precio']; ?>')">
                                        <spna><?= "$ ".$mostrar["precio"]; ?></span>
                                        <i class="text-white btn bi bi-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="flex flex-wrap justify-between">
                            <div class="mb-3">
                                <button onclick="editingProduct('<?= modeloPrincipal::encryptionId($mostrar['id']) ?>')" type="button" class="text-sm btn_details btn btn-outline-warning transition-all gap-2 flex items-center justify-center " data-bs-toggle="modal" data-bs-target="#editar_producto">
                                    <i class="bi bi-pencil-square"></i>
                                    <span class="d-none d-md-block font-bold"> Editar</span>
                                </button> 
                            </div>
                            <td>
                                <button onclick="verImagen('<?= $imgsrc ; ?>','<?= $mostrar['nombre'] ?>' )" class="btn btn-secondary text-xs">
                                    <i class="bi bi-image mr-1"></i> 
                                    <span class="small d-none d-md-block">Ver Imagen</span>
                                </button>
                            </td>
                            <td class="col text-center">
                                <button em_size="modal-md" em_trigger="edit" em_icon="bi-pencilsquare" em_url="../api/producto/editar_img.php?UID=<?= $mostrar['id'] ?>" em_title="Modificar imagenes de un Producto" 
                                    data-bs-toggle="modal" data-bs-target="#em_lists" class="em_trigger btn btn-secondary text-xs">
                                        <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>

                            <div class="mb-2">
                                <?php if ($mostrar["state"] == 1) { ?>

                                    <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                        <input type="hidden" name="modulo" value="activo">          
                                        <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                        <button class="btn btn-outline-danger bi bi-x-circle text-sm" title="estado del producto" type="submit"> </button>
                                    </form>

                                <?php } else { ?>

                                    <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                        <input type="hidden" name="modulo" value="inactivo">          
                                        <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                        <button class="btn btn-success bi bi-check-circle text-sm" title="estado del producto"> </button>
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