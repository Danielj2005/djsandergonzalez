<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/alertModel.php"; // se incluye el model de alertas
require_once "../model/productModel.php"; // se incluye el model de categorias


// modulo a trabajar
$modulo = modeloprincipal::limpiar_cadena($_POST["modulo"]);

function validar_imagen_literal($tmp_path, $nombre_original) {
    if (!is_file($tmp_path)) {
        return false;
    }

    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
    $ext_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

    if (!in_array($extension, $ext_permitidas, true)) {
        return false;
    }

    $info = @getimagesize($tmp_path);
    if ($info === false) {
        return false;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $finfo ? finfo_file($finfo, $tmp_path) : null;
    if ($finfo) {
        finfo_close($finfo);
    }

    $mimes_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/x-windows-bmp'];
    if ($mime === false || $mime === null || !in_array($mime, $mimes_permitidos, true)) {
        return false;
    }

    if (strtolower($extension) === 'svg') {
        return false;
    }

    $contenido = @file_get_contents($tmp_path, false, null, 0, 4096);
    if ($contenido === false) {
        return false;
    }

    $contenido_min = strtolower($contenido);
    if (str_contains($contenido_min, '<script') || str_contains($contenido_min, '<?php') || str_contains($contenido_min, '<svg') || str_contains($contenido_min, 'javascript:')) {
        return false;
    }

    return true;
}


function eliminar_imagenes_producto($id_producto, $imgDeleted) {
    if (empty($imgDeleted)) {
        return;
    }

    foreach ($imgDeleted as $key => $value) {
        $query = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id_producto = $id_producto AND id = $value"));
        echo $value;
        $img_src = trim($query['img_src']);
        $nombre_archivo = strtolower(basename($img_src));

        if (in_array($nombre_archivo, $imgDeleted, true)) {
            $storage_path = dirname(__DIR__) . '/' . ltrim($img_src, './');

            if (file_exists($storage_path) && is_file($storage_path)) {
                unlink($storage_path);
            }

            modeloPrincipal::DeleteSQL("producto_image", "id = $value");
        }
    }
}

if($modulo == 'Modificar'){
    
    $id_producto = modeloPrincipal::decryptionId($_POST["id"]);
    $imgDeleted = $_POST['imgDeleted'] ?? '';
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
    // imagenes a eliminar

    if (!empty($imgDeleted)) {
        $imgDeleted = explode(',', $imgDeleted);
        eliminar_imagenes_producto($id_producto, $imgDeleted);
    }
    
    /* 
        seccion mover imagenes al storage local
    */
    // 1. Procesar los archivos si existen
    if (isset($_FILES['image'])) {
        $files = $_FILES['image'];
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            if ($files['error'][$key] === 0 && is_uploaded_file($tmp_name)) {
                if (!validar_imagen_literal($tmp_name, $files['name'][$key])) {
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