<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/alertModel.php"; // se incluye el model de alertas
require_once "../model/productModel.php"; // se incluye el model de categorias


// modulo a trabajar
$modulo = modeloprincipal::limpiar_cadena($_POST["modulo"]);


function eliminar_imagenes_producto(int $idImg) {

    $query = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id = $idImg"));
    
    $img_src = trim($query['img_src']);

    $storage_path = dirname(__DIR__) . '/' . ltrim($img_src, './');

    if (file_exists($storage_path) && is_file($storage_path)) {
        unlink($storage_path);
    }

    modeloPrincipal::DeleteSQL("producto_image", "id = $idImg");
}

if($modulo == 'Modificar'){
    
    $id_producto = modeloPrincipal::decryptionId($_POST["id"]);
    $imgHasProduct = $_POST['imgHasProduct'];

    $uploaded_paths = [];
    $uploaded_hashes = [];
    
    // Obtener imágenes y hashes actuales del producto (fuente de verdad: producto_image)
    $producto_actual = modeloPrincipal::consultar("SELECT img_hash FROM producto_image WHERE id_producto = $id_producto");
    if (mysqli_num_rows($producto_actual) === 0) {
        alert_model::alerta_simple("¡Ocurrió un error!","No se encontró el producto a modificar.","error");
        exit();
    }
    
    $producto_actual = mysqli_fetch_array($producto_actual);
    /* 
        seccion mover imagenes al storage local
    */
    // 1. Procesar los archivos si existen
    if (isset($_FILES['image'])) {
        $files = $_FILES['image'];
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            if ($files['error'][$key] === 0 && is_uploaded_file($tmp_name)) {
                if (!modeloPrincipal::validar_imagen_literal($tmp_name, $files['name'][$key])) {
                    continue;
                }

                $file_hash = md5_file($tmp_name);

                if ($file_hash === false) {
                    continue;
                }

                if (in_array($file_hash, $producto_actual, true) || in_array($file_hash, $uploaded_hashes, true)) {
                    continue;
                }

                // Obtenemos la extensión del nombre original (ej: "foto.JPG" -> "jpg")
                $extension = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));

                $name = $file_hash . "." . $extension;

                $target = "../storage/$name";
                
                if (move_uploaded_file($tmp_name, $target)) {
                    $target = "./storage/$name";

                    $uploaded_paths[] = $target;
                    $uploaded_hashes[] = $file_hash;
                }
            }
        }
    }
    
    $hay_reemplazo_valido = !empty($uploaded_paths);
    // en caso de que no suban imagenes nuevas dara una alerta
    if (empty($_FILES['image']) && !$hay_reemplazo_valido) {
        alert_model::alerta_simple("¡Ocurrió un error!", "Si eliminas la última imagen, debes subir al menos una imagen válida como reemplazo antes de guardar.", "error");
        exit();
    }

    try {
        foreach ($uploaded_paths as $i => $ruta) {
            $actualizar = modeloPrincipal::InsertSQL("producto_image", "img_src , img_hash ,id_producto", "'$ruta', '$uploaded_hashes[$i]', $id_producto");
        }
        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
    
}



if($modulo == 'Delete'){
    
    $imgId = modeloPrincipal::decryptionId($_POST["id"]);

    $existeImg = modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id = $imgId");
    
    if (mysqli_num_rows($existeImg) === 0) {
        alert_model::alerta_simple("¡Ocurrió un error!","No se encontró la imagen del producto.","error");
        exit();
    }

    
    try {
        eliminar_imagenes_producto($imgId);
        echo '<script type="text/javascript"> Toastify({ text: " Se elimino correctamente la imagen.", className: " bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast(); </script>';
        exit();
    } catch (Exception $e) {

        echo '<script type="text/javascript">
                Toastify({ text: " No se pudo eliminar la imágen del producto.", className: "bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast();
            </script>';

        exit();
    }
    
}