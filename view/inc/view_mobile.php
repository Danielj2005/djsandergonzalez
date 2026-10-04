
<div id="containerListProducts" class="text-center col-12 mb-3">
    <div class="grid gap-3 justify-around grid-cols-1 md:grid-cols-4">
        
        <?php 
            $catalogo = modeloPrincipal::consultar("SELECT id, nombre, precio, state FROM productos WHERE state = $estado ORDER BY nombre ASC"); 

            if (mysqli_num_rows($catalogo) > 0) {
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


                    <div class="producto_<?= $id_producto ?> animate-slide-up border border-slate-800 duration-500 group hover:border-purple-500/50 overflow-hidden rounded-3xl dark:shadow-cyan-500/30 shadow-slate-800/30 shadow-xl transition-all">
                        
                        <div class="overflow-hidden cursor-pointer"> <img src=".<?= $imagen ?>" onerror="this.src='./img/404.png'"> </div>

                        <div class="p-3">
                            <div class="text-start">
                                <button onclick="detallesProductoById()" class="text-sm mb-3 dark:text-slate-200 text-gray-800 font-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal"> <?= ucwords(strtolower($mostrar["nombre"])) ?> </button>
                            </div>
                            
                            
                            <div class="mb-2">
                                <button class="px-3 cursor-pointer rounded-full dark:text-[#fff] bg-emerald-800 text-slate-200" onclick="copyToClipboard('<?= $mostrar['precio']; ?>')">
                                    <spna><?= "$ ".$mostrar["precio"]; ?></span>
                                    <i class="text-[#fff] btn bi bi-copy"></i>
                                </button>
                            </div>

                            <div class="mb-2 grid grid-cols-2 items-center gap-3">
                                
                                <div class="mb-2">
                                    <button onclick="editingProduct('<?= modeloPrincipal::encryptionId($mostrar['id']) ?>')" type="button" class="w-full rounded-full btn_details btn btn-warning transition-all gap-2 flex items-center justify-center " data-bs-toggle="modal" data-bs-target="#editar_producto">
                                        <i class="bi bi-pencil-square"></i>
                                        <span class=""> Editar</span>
                                    </button> 
                                </div>
                                <div class="mb-2">
                                    <button onclick="verImagen('<?= $imgsrc ; ?>','<?= $mostrar['nombre'] ?>' )" class="w-full rounded-full btn btn-secondary transition-all gap-2 flex items-center justify-center" data-bs-toggle="modal" data-bs-target="#ver_imagenes">
                                        <i class="bi bi-image mr-1"></i> 
                                        <span class="">Ver Imagen</span>
                                    </button>
                                </div>
                                <div class="mb-2">
                                    <button em_size="modal-md" em_trigger="edit" em_icon="bi-pencilsquare" em_url="../api/producto/editar_img.php?UID=<?= $mostrar['id'] ?>" em_title="Modificar imagenes de un Producto" 
                                        data-bs-toggle="modal" data-bs-target="#em_lists" class="w-full rounded-full em_trigger btn bg-slate-800 dark:text-white text-slate-200">
                                            <i class="bi bi-pencil-square"></i>
                                            <span class="">Editar Imagen</span>
                                    </button>
                                </div>

                                <div class="mb-2">
                                    <?php if ($mostrar["state"] == 1) { ?>

                                        <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                            <input type="hidden" name="modulo" value="activo">          
                                            <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                            <button class="w-full rounded-full btn btn-info bi bi-x-circle text-sm" title="estado del producto" type="submit"> Desactivar</button>
                                        </form>

                                    <?php } else { ?>

                                        <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="update_estate" >
                                            <input type="hidden" name="modulo" value="inactivo">          
                                            <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                            <button class="w-full rounded-full btn btn-success bi bi-check-circle text-sm" title="estado del producto"> Activar</button>
                                        </form>

                                    <?php }  ?>
                                </div>

                            </div>

                            <div class="mb-2">
                                
                                <form action="../controller/producto_controlador.php" method="post" class="SendFormAjax" data-type-form="delete" >
                                    <input type="hidden" name="modulo" value="Eliminar">          
                                    <input type="hidden" name="id" value="<?= modeloPrincipal::encryptionId($mostrar['id']) ?>">
                                    <button class="w-full rounded-full btn btn-danger bi bi-trash text-sm" title="estado del producto" type="submit">&nbsp;Eliminar </button>
                                </form>
                            </div>
                        </div>
                    </div>

            <?php }

            }else{ ?>

                <div class="p-3 animate-slide-up border border-slate-800 duration-500 group hover:border-purple-500/50 overflow-hidden rounded-3xl dark:shadow-cyan-500/30 shadow-slate-800/30 shadow-xl transition-all">
                    
                    <div class="overflow-hidden cursor-pointer text-[10rem] text-slate-800 dark:text-[#fff]">
                        <i class="bi bi-question-circle"></i>
                    </div>

                    <div class="p-3">
                        <p class="text-center text-2xl text-slate-800 dark:text-[#fff]"> No hay productos <?= $estado == 1 ? 'activos' : 'inactivos' ?> </p>
                    </div>
                </div>

            <?php } ?>
        
    </div>
</div>