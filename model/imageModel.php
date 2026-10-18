<?php 


class imageModel {

    public static function getPath(string $path) {
        return $path = [
            "toMove" => 'portafolio' ? "../view/img/" : "../storage/",
            "toDb" => 'portafolio' ? "./view/img/" : "./storage/"
            ];
    }


    public static function uploadImg (array $dataImage, string $pathImage)  {
        $image = [];
        $path = self::getPath($pathImage);
        $toMove = $path['toMove'];
        $toDb = $path['toDb'];
        try{
            $files = $dataImage;

            foreach ($files['tmp_name'] as $key => $tmp_name) {
                if ($files['error'][$key] === 0 && is_uploaded_file($tmp_name)) {

                    if (!self::validar_imagen_literal($tmp_name, $files['name'][$key])) { continue; }

                    $file_hash = md5_file($tmp_name);
                    if ($file_hash === false) {  continue; }

                    // Obtenemos la extensión del nombre original (ej: "foto.JPG" -> "jpg");
                    $extension = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));
                    $name = $file_hash . "." . $extension;
                    $target = $toMove.$name;
                    
                    if (move_uploaded_file($tmp_name, $target)) {
                        $image[] = $toDb.$name;
                    }else {
                        break;
                    }
                }
            }
            return $image;
        } catch (Exception $e) {
            alert_model::alerta_simple("alerta","Ocurrio un arror al subir la imagen del logo","error");
            return $e;
        }
    }

    
    public static function validar_imagen_literal(string $tmp_path, string $nombre_original) {
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

    
    public static function changeImg (array $dataImage, string $typePath ,string $pathImageToDelete) {
        
        try{
            $imageUploaded = self::uploadImg($dataImage, $typePath);
            // se verifica un array con las rutas de las imagenes guardadas
            if (!empty($imageUploaded) && count($imageUploaded) > 0) {
                // se eliminan las imagenes a cambiar
                self::deleteImg($pathImageToDelete);
            }
            // se returna un array con las rutas de las imagenes guardadas
            return $imageUploaded;
        } catch (Exception $e) {
            alert_model::alerta_simple("alerta","Ocurrio un arror al subir la imagen del logo","error");
            return $e;
        }
    }

        
    public static function deleteImg(string $img) {
        
        $img_src = trim($img);

        $storage_path = dirname(__DIR__) . '/' . ltrim($img_src, './');

        if (file_exists($storage_path) && is_file($storage_path)) {
            unlink($storage_path);
        }
    }

}