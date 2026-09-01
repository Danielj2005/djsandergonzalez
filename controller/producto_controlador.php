<?php 
session_start();

require_once "../config/SERVER.php";

require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/alertModel.php"; // se incluye el model de alertas
require_once "../model/productModel.php"; // se incluye el model de categorias

function asegurar_tabla_producto_imagen() {
    modeloPrincipal::consultar("CREATE TABLE IF NOT EXISTS producto_image (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_producto INT NOT NULL,
        img_hash TEXT NOT NULL,
        img_src TEXT NOT NULL,
        num_img INT NOT NULL,
        INDEX idx_producto (id_producto),
        INDEX idx_producto_num (id_producto, num_img)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
}

function obtener_imagenes_desde_tabla($id_producto) {
    $resultado = modeloPrincipal::consultar("SELECT num_img, img_hash, img_src FROM producto_image WHERE id_producto = $id_producto ORDER BY num_img ASC");
    $existing_images = [];
    $existing_hashes = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $img_src = trim($fila['img_src']);

        if ($img_src === '' || !file_exists(dirname(__DIR__) . '/' . ltrim($img_src, './')) || !is_file(dirname(__DIR__) . '/' . ltrim($img_src, './'))) {
            modeloPrincipal::DeleteSQL("producto_image", "id_producto = $id_producto AND num_img = " . (int) $fila['num_img']);
            continue;
        }

        $existing_images[] = $img_src;
        $existing_hashes[] = $fila['img_hash'];
    }

    return [$existing_images, $existing_hashes];
}

function guardar_imagenes_producto($id_producto, $uploaded_paths, $uploaded_hashes) {
    $consulta_max = modeloPrincipal::consultar("SELECT COALESCE(MAX(num_img), 0) AS max_num FROM producto_image WHERE id_producto = $id_producto");
    $fila_max = mysqli_fetch_assoc($consulta_max);
    $siguiente_num = (int) $fila_max['max_num'] + 1;

    foreach ($uploaded_paths as $index => $ruta) {
        $hash = $uploaded_hashes[$index];
        $verificacion = modeloPrincipal::consultar("SELECT id FROM producto_image WHERE id_producto = $id_producto AND img_hash = '$hash' LIMIT 1");

        if (mysqli_num_rows($verificacion) > 0) {
            continue;
        }

        $ruta_normalizada = trim($ruta);
        modeloPrincipal::InsertSQL("producto_image", "id_producto, img_hash, img_src, num_img", "$id_producto, '$hash', '$ruta_normalizada', $siguiente_num");
        $siguiente_num++;
    }
}

function eliminar_imagenes_producto($id_producto, $deleted_image_names) {
    if (empty($deleted_image_names)) {
        return;
    }

    $resultado = modeloPrincipal::consultar("SELECT id, num_img FROM producto_image WHERE id_producto = $id_producto ORDER BY num_img ASC");

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $img_src = trim($fila['img_src']);
        $nombre_archivo = strtolower(basename($img_src));

        if (in_array($nombre_archivo, $deleted_image_names, true)) {
            $storage_path = dirname(__DIR__) . '/' . ltrim($img_src, './');

            if (file_exists($storage_path) && is_file($storage_path)) {
                unlink($storage_path);
            }

            modeloPrincipal::DeleteSQL("producto_image", "id = " . (int) $fila['id']);
        }
    }
}

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

// modulo a trabajar
$modulo = modeloprincipal::limpiar_cadena($_POST["modulo"]);

// verificar si el modulo es guardar
if($modulo === 'Guardar'){
    
    $producto = $_POST['producto'];
    $price = empty($_POST['price']) ? 0.00 : $_POST['price']; // si no se envía un precio, se asigna un valor por defecto de 1.00
    $category = $_POST['category'];
    $image = $_POST['image'];
    $desc = $_POST['desc'];

    asegurar_tabla_producto_imagen();

    $uploaded_paths = [];
    $uploaded_hashes = [];

    $id_producto = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT  MAX(id) + 1 AS id FROM productos"))['id'];
    
    
    // 1. Procesar los archivos si existen
    if (isset($_FILES['image'])) {
        $files = $_FILES['image'];
        $i = 1;
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            if ($files['error'][$key] === 0 && is_uploaded_file($tmp_name)) {
                if (!validar_imagen_literal($tmp_name, $files['name'][$key])) {
                    continue;
                }

                $file_hash = md5_file($tmp_name);

                if ($file_hash === false || in_array($file_hash, $uploaded_hashes, true)) {
                    continue;
                }

                // Obtenemos la extensión del nombre original (ej: "foto.JPG" -> "jpg")
                $extension = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));

                $file_hash = md5_file($tmp_name);
                $name = $file_hash . '_' . $i . ".$extension";
                $i++;

                $target = "../storage/$name";
                
                if (move_uploaded_file($tmp_name, $target)) {
                    $target = "./storage/$name";
                    $uploaded_paths[] = $target;
                    $uploaded_hashes[] = $file_hash;
                }
            }
        }

        if (empty($uploaded_paths)) {
            alert_model::alerta_simple("¡Ocurrió un error!", "No se pudo procesar ninguna imagen válida. Por favor, asegúrate de seleccionar archivos permitidos y vuelve a intentarlo.", "error");
            exit();
        }
    }

    // 2. Convertir el array de rutas y hashes a un solo string para la BD
    $images_string = implode(',', $uploaded_paths);
    $image_hash_string = implode(',', $uploaded_hashes);

    // Se verifica que no se hayan recibido campos vacíos.
    modeloPrincipal::validar_campos_vacios([$producto, $price, $category, $desc]);
    // $price = number_format($price, 2, '.', ',');

    // se valida el campo nombre del producto
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{3,200}", $producto)) {
        alert_model::alerta_simple("¡Ocurrió un error!","El nombre del producto $producto no cumple con el formato establecido","error");
        exit();
    }
    if (modeloPrincipal::verificar_datos("[.\,0-9 ]{1,12}", $price)) {
        alert_model::alerta_simple("¡Ocurrió un error!","El precio del producto no cumple con el formato establecido","error");
        exit();
    }
    
    // se registran los datos del producto
    try {

        $registrar = modeloPrincipal::InsertSQL("productos", "nombre, precio, description, images, image_hash, state", "'$producto', $price, '$desc', '$images_string', '$image_hash_string', 1");

        if (!$registrar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al registrar un producto.","error");
            exit();
        }

        $id_producto = producto_model::obtener_id_recien_registrada();
        guardar_imagenes_producto($id_producto, $uploaded_paths, $uploaded_hashes);

        foreach ($category as $key) {
            $categoria_id = modeloPrincipal::decryptionId($key);
            $registrar = modeloPrincipal::InsertSQL("categorias_productos", "categoria_id, producto_id" ,"$categoria_id, $id_producto");
        
            if (!$registrar) {
                alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al registrar las categorías de un producto.","error");
                exit();
            }
        }

        alert_model::alert_reg_success();
        exit();
    } catch (Exception $e) {
        // alert_model::alert_reg_error();
        echo $e;
        alert_model::alerta_simple("Ha ocurrido un Error!","ocurrio un error al registrar la información de un producto.","error");

        exit();
    }
    
}


if($modulo == 'Modificar'){
    
    $id_producto = modeloPrincipal::decryptionId($_POST["id"]);
    $id_producto = modeloPrincipal::limpiar_cadena($id_producto);

    asegurar_tabla_producto_imagen();

    $producto = $_POST['producto'];
    $price = $_POST['price'] ?? null; // si no se envía un precio, se asigna un valor por defecto de 1.00
    // $price = number_format($price, 2, '.', ',');
    $category = $_POST['category'];
    $image = $_POST['image'];
    $desc = $_POST['desc'];
    $imgDeleted = [];

    if (!empty($_POST['imgDeleted'])) {
        $imgDeleted = array_values(array_filter(array_map(function ($value) {
            return trim($value);
        }, explode(',', $_POST['imgDeleted']))));
    }

    // Obtener imágenes y hashes actuales del producto (fuente de verdad: producto_image)
    $producto_actual = modeloPrincipal::consultar("SELECT img_src AS images, img_hash FROM producto_image WHERE id_producto = $id_producto");
    if (mysqli_num_rows($producto_actual) === 0) {
        alert_model::alerta_simple("¡Ocurrió un error!","No se encontró el producto a modificar.","error");
        exit();
    }

    [$existing_images, $existing_hashes] = obtener_imagenes_desde_tabla($id_producto);

    $deleted_image_names = [];
    foreach ($imgDeleted as $deleted_image) {
        $deleted_image = trim($deleted_image);
        if ($deleted_image === '') {
            continue;
        }

        $deleted_image_names[] = strtolower(basename($deleted_image));
    }

    if (!empty($deleted_image_names)) {
        eliminar_imagenes_producto($id_producto, $deleted_image_names);
        [$existing_images, $existing_hashes] = obtener_imagenes_desde_tabla($id_producto);
    }

    $uploaded_paths = [];
    $uploaded_hashes = [];

    $siguiente_num = (int) mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT COALESCE(MAX(num_img), 0) AS max_num FROM producto_image WHERE id_producto = $id_producto"))['max_num'] + 1;

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

                if (in_array($file_hash, $existing_hashes, true) || in_array($file_hash, $uploaded_hashes, true)) {
                    continue;
                }

                // Obtenemos la extensión del nombre original (ej: "foto.JPG" -> "jpg")
                $extension = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));

                $name = $file_hash . '_' . $siguiente_num++ . "." . $extension;

                $target = "../storage/$name";
                
                if (move_uploaded_file($tmp_name, $target)) {
                    $target = "./storage/$name";

                    $uploaded_paths[] = $target;
                    $uploaded_hashes[] = $file_hash;
                }
            }
        }
    }

    $final_images = $existing_images;
    $final_hashes = $existing_hashes;

    $hay_reemplazo_valido = !empty($uploaded_paths);

    if (!empty($uploaded_paths)) {
        $final_images = array_merge($final_images, $uploaded_paths);
        $final_hashes = array_merge($final_hashes, $uploaded_hashes);
        guardar_imagenes_producto($id_producto, $uploaded_paths, $uploaded_hashes);
    }

    if (empty($final_images) && !$hay_reemplazo_valido) {
        alert_model::alerta_simple("¡Ocurrió un error!", "Si eliminas la última imagen, debes subir al menos una imagen válida como reemplazo antes de guardar.", "error");
        exit();
    }

    $images_string = implode(',', $final_images);
    $image_hash_string = implode(',', $final_hashes);

    // Se verifica que no se hayan recibido campos vacíos.
    // modeloPrincipal::validar_campos_vacios([$producto, $category, $desc]);
    if ($id_producto === "" || $producto === "" || $desc === "") {
        alert_model::alert_fields_empty();
        exit();
    }
    // se valida el campo nombre del producto
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{3,200}", $producto)) {
        alert_model::alerta_simple("¡Ocurrió un error!","El nombre del producto $producto no cumple con el formato establecido","error");
        exit();
    }

    try {
        $actualizar = modeloPrincipal::UpdateSQL("productos", "nombre = '$producto', precio = $price, description = '$desc'", "id = $id_producto");
        
        if (!$actualizar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al actualizar el producto.","error");
            exit();
        }

        $actualizar = modeloPrincipal::UpdateSQL("producto_image", "img_src = '$images_string', img_hash = '$image_hash_string'", "id_producto = $id_producto");

        if (!$actualizar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al actualizar el producto.","error");
            exit();
        }
        if (is_array($category) && count($category) > 0) {
            modeloPrincipal::DeleteSQL("categorias_productos", "producto_id = $id_producto");
            foreach ($category as $key) {
                $categoria_id = modeloPrincipal::decryptionId($key);
                $registrar_categoria = modeloPrincipal::InsertSQL("categorias_productos", "categoria_id, producto_id", "$categoria_id, $id_producto");
                if (!$registrar_categoria) {
                    alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al registrar las categorías de un producto.","error");
                    exit();
                }
            }
        }

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
    
}

if($modulo === 'Eliminar'){
        
    $id_producto = modeloPrincipal::decryptionId($_POST["id"]);
    $id_producto = modeloPrincipal::limpiar_cadena($id_producto);

    // Se verifica que no se hayan recibido campos vacíos.
    modeloPrincipal::validar_campos_vacios([$id_producto]);

    // se modifican los datos del producto
    try {
        $actualizar = producto_model::actualizar_estado(0,$id_producto);

        if (!$actualizar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al eliminar un producto.","error");
        }
        
        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
    
}


$id_producto = modeloPrincipal::decryptionId($_POST["id"]);
$id_producto = modeloPrincipal::limpiar_cadena($id_producto);

if ($modulo === "activo") {
    
    try {
        $actualizar = producto_model::actualizar_estado( 0, $id_producto);
        
        if (!$actualizar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al modificar el estado una categoría.","error");
        }

        alert_model::alert_mod_success();

        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
}

if ($modulo === "inactivo") {

    try {
        $actualizar = producto_model::actualizar_estado( 1, $id_producto);
        
        if (!$actualizar) {
            alert_model::alerta_simple("¡Ocurrió un error!","ocurrio un error al modificar el estado una categoría.","error");
        }

        alert_model::alert_mod_success();

        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
}