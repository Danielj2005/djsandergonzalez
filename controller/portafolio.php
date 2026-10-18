<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/alertModel.php"; 
require_once "../model/imageModel.php"; 
require_once "../model/portafolioModel.php"; 

// modulo a trabajar
$modulo = modeloprincipal::limpiar_cadena($_POST["modulo"]);

if($modulo == 'hero'){

    $hero = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT * FROM hero WHERE id = 1"));

    $titulo = modeloPrincipal::limpiar_cadena($_POST["titulo"]);
    $subtitulo = modeloPrincipal::limpiar_cadena($_POST["subtitulo"]);
    $imageLogo = $hero['logo'];
    $imageBg = $hero['bg_image'];
    
    modeloPrincipal::validar_campos_vacios([$titulo, $subtitulo]);
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´ ]{3,250}",$titulo)) {
        alert_model::alert_of_format_wrong("'titulo'");
        exit();
    }

    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´ ]{3,250}",$subtitulo)) {
        alert_model::alert_of_format_wrong("'subtitulo'");
        exit();
    }

    /* 
        seccion mover imagenes al storage local
    */
    // 1. Procesar los archivos si existen
    
    if (isset($_FILES['imageLogo']) && $_FILES['imageLogo']['error'][0] === UPLOAD_ERR_OK) {
        $imageLogo = imageModel::changeImg($_FILES['imageLogo'], "portafolio", $hero['logo']);
        $imageLogo = $imageLogo[0];
    }
    
    if (isset($_FILES['imageBg']) && $_FILES['imageBg']['error'][0] === UPLOAD_ERR_OK) {
        $imageBg = imageModel::changeImg($_FILES['imageBg'], "portafolio", $hero['bg_image']);
        $imageBg = $imageBg[0];
    }

    try {

        $actualizar = modeloPrincipal::UpdateSQL("hero", "titulo = '$titulo', subtitulo = '$subtitulo', logo = '$imageLogo', bg_image = '$imageBg'", "id = 1");

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
    
}

if($modulo == 'about'){

    $about = mysqli_fetch_assoc(modeloPrincipal::consultar("SELECT * FROM about WHERE id = 1"));

    $titulo = modeloPrincipal::limpiar_cadena($_POST["titulo"]);
    $subtitulo = modeloPrincipal::limpiar_cadena($_POST["subtitulo"]);
    $slogan = modeloPrincipal::limpiar_cadena($_POST["slogan"]);
    $incluye = modeloPrincipal::limpiar_cadena($_POST["incluye"]);
    $srcImg = $about['src'];
    
    modeloPrincipal::validar_campos_vacios([$titulo, $subtitulo]);
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´ ]{3,250}",$titulo)) {
        alert_model::alert_of_format_wrong("'titulo'");
        exit();
    }

    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´ ]{3,250}",$subtitulo)) {
        alert_model::alert_of_format_wrong("'subtitulo'");
        exit();
    }
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´\.\, ]{3,250}",$slogan)) {
        alert_model::alert_of_format_wrong("'slogan'");
        exit();
    }
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\+0-9\|\`\´\.\, ]{3,1500}",$incluye)) {
        alert_model::alert_of_format_wrong("'incluye'");
        exit();
    }


    /* 
        seccion mover imagenes al storage local
    */
    // 1. Procesar los archivos si existen
    
    if (isset($_FILES['aboutImg']) && $_FILES['aboutImg']['error'][0] === UPLOAD_ERR_OK) {
        $srcImg = imageModel::changeImg($_FILES['aboutImg'], "portafolio", $about['src']);
        $srcImg = $srcImg[0];
    }
    

    try {

        $actualizar = modeloPrincipal::UpdateSQL("about", "titulo = '$titulo', subtitulo = '$subtitulo', slogan = '$slogan', src = '$srcImg', incluye = '$incluye'", "id = 1");

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
    
}


if($modulo == 'store'){

    
    $idImg = modeloprincipal::limpiar_cadena(modeloprincipal::decryptionId($_POST["id"]));
    $store = mysqli_fetch_array(modeloPrincipal::consultar("SELECT * FROM store WHERE id = $idImg"));
    $currentImg = $store['src'];

    if (isset($_FILES['storeImg']) && $_FILES['storeImg']['error'][0] === UPLOAD_ERR_OK) {
        $currentImg = imageModel::changeImg($_FILES['storeImg'], "portafolio", $store['src']);
    }else{
        alert_model::alerta_simple("¡Ocurrió un error!","No se seleccionó ninguna imágen.","error");
        exit();
    }
    $currentImg = $currentImg[0];
    try {

        $actualizar = modeloPrincipal::UpdateSQL("store", "src = '$currentImg'", "id = $idImg");

        echo '<script type="text/javascript"> 
                Toastify({ 
                    text: " Se Cambió correctamente la imágen.", 
                    className: " bi bi-arrow-repeat", 
                    duration: 3000,
                    style: {
                        background: "oklch(62.7% 0.194 149.214)",
                    },
                }).showToast();
        </script>';
        exit();
    } catch (Exception $e) {
        echo '<script type="text/javascript"> 
                Toastify({ 
                    text: " No se pudo cambiar la imágen.", 
                    className: " bi bi-x-circle", 
                    duration: 3000,
                    style: {
                        background: "oklch(57.7% 0.245 27.325)",
                    },
                }).showToast();
        </script>';
        exit();
    }
    
}


if($modulo == 'service'){

    
    $id = modeloprincipal::limpiar_cadena(modeloprincipal::decryptionId($_POST["UID"]));
    $service = mysqli_fetch_array(modeloPrincipal::consultar("SELECT * FROM servicio WHERE id = $id"));

    $titulo = modeloPrincipal::limpiar_cadena($_POST["titulo"]);
    $subtitulo = modeloPrincipal::limpiar_cadena($_POST["subtitulo"]);
    $incluye = modeloPrincipal::limpiar_cadena($_POST["incluye"]);

    modeloPrincipal::validar_campos_vacios([$titulo, $subtitulo, $incluye]);
    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\+\|\`\´\.\, ]{3,250}",$titulo)) {
        alert_model::alert_of_format_wrong("'titulo'");
        exit();
    }

    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\+\|\`\´\.\, ]{3,250}",$subtitulo)) {
        alert_model::alert_of_format_wrong("'subtitulo'");
        exit();
    }

    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\+\|\`\´\.\, ]{3,1500}",$incluye)) {
        alert_model::alert_of_format_wrong("'incluye'");
        exit();
    }

    try {
        $actualizar = modeloPrincipal::UpdateSQL("servicio", "nombre = '$titulo', subtitulo = '$subtitulo', incluye = '$incluye'", "id = $id");
        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
}


if($modulo == 'contact'){

    $query = modeloPrincipal::consultar("SELECT * FROM contacto ORDER BY id");
    $contactData = [];
    $contactNames = [];

    while ($names = mysqli_fetch_array($query)): 
        $contactNames[] = $names['nombre'];
    endwhile;

    $contactData[0] = isset($_POST["correo"]) ? modeloPrincipal::limpiar_cadena($_POST["correo"]) : $contactNames[0];
    $contactData[1] = isset($_POST["whatsapp"]) ? modeloPrincipal::limpiar_cadena($_POST["whatsapp"]) : $contactNames[1];
    $contactData[2] = isset($_POST["instagram"]) ? modeloPrincipal::limpiar_cadena($_POST["instagram"]) : $contactNames[2];
    $contactData[3] = isset($_POST["instagram_user"]) ? modeloPrincipal::limpiar_cadena($_POST["instagram_user"]) : $contactNames[3];
    $contactData[4] = isset($_POST["facebook"]) ? modeloPrincipal::limpiar_cadena($_POST["facebook"]) : $contactNames[4];
    $contactData[5] = isset($_POST["tiktok"]) ? modeloPrincipal::limpiar_cadena($_POST["tiktok"]) : $contactNames[5];
    $contactData[6] = isset($_POST["youtube"]) ? modeloPrincipal::limpiar_cadena($_POST["youtube"]) : $contactNames[6];

    foreach ($contactData as $data) {
        modeloPrincipal::validar_campos_vacios([$data]);
        if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\+\|\`\´\.\,\/\:\@\-\_ ]{3,250}",$data)) {
            alert_model::alert_of_format_wrong("'contacto'");
            exit();
        }
    }

    try {
        $query = modeloPrincipal::consultar("SELECT * FROM contacto ORDER BY id");

        $i = 0;
        while ($data = mysqli_fetch_array($query)): 
            $actualizar = modeloPrincipal::UpdateSQL("contacto", "url = '".$contactData[$i++]."'", "id = ".$data['id']."");
        endwhile;

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
}


if($modulo == 'Delete'){
    
    $imgId = modeloPrincipal::decryptionId($_POST["id"]);

    $existeImg = modeloPrincipal::consultar("SELECT src FROM store WHERE id = $imgId");
    
    if (mysqli_num_rows($existeImg) === 0) {
        alert_model::alerta_simple("¡Ocurrió un error!","No se encontró la imágen.","error");
        exit();
    }

    try {
        
        $imgSrc = mysqli_fetch_array($existeImg)['src'];
        imageModel::deleteImg($imgSrc);
        modeloPrincipal::DeleteSQL("store", "id = $imgId");

        echo '<script type="text/javascript"> Toastify({ text: " Se elimino correctamente la imágen.", className: " bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast(); </script>';
        exit();
    } catch (Exception $e) {
        echo '<script type="text/javascript">
                Toastify({ text: " No se pudo eliminar la imágen.", className: "bi bi-exclamation-triangle-fill text-md]", duration: 3000, }).showToast();
            </script>';
        exit();
    }
}