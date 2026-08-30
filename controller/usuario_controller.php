<?php 
session_start();
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; 
require_once "../model/alertModel.php"; 
require_once "../model/userModel.php"; 


// modulo a trabajar
$modulo = modeloprincipal::limpiar_cadena($_POST["modulo"]);

if (!isset($_POST["modulo"])) {
    alert_model::alerta_simple("Ocurrio un error!","Ha ocurrido un error al procesar tu solicitud","error");
    exit();
}

/***************************************************************/
/* MODULO PARA REGISTRAR USUARIOS EN EL SISTEMA
/***************************************************************/
if($modulo === "Guardar"){

    /*------------------ información personal de el usuario ------------------*/
    $nombre = modeloprincipal::limpiar_mayusculas($_POST["nombre"]);
    $telefono = modeloprincipal::limpiar_cadena($_POST["telefono"]);
    $correo =  modeloprincipal::limpiar_cadena($_POST["correo"]);
    $contraseña =  modeloprincipal::limpiar_cadena($_POST["contraseña"]);
    $repetir_contraseña =  modeloprincipal::limpiar_cadena($_POST["repetir_contraseña"]);
    $id_rol = 2;
    
    // se comprueba que no exista un registro con los mismos datos
    model_user::validar_usuario_existe("correo","correo = '$correo'");

    // Se verifica que no se hayan recibido campos vacíos.
    modeloPrincipal::validar_campos_vacios([$nombre, $correo, $contraseña, $repetir_contraseña, $telefono, $id_rol]);
    model_user::verificar_coincidencia_de_contraseña($contraseña,$repetir_contraseña);

    if (modeloPrincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,250}",$nombre)) {
        alert_model::alert_of_format_wrong("'nombre'");
        exit();
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        alert_model::alert_of_format_wrong("'correo'");
        exit();
    }

    if (modeloPrincipal::verificar_datos("[0-9]{11}",$telefono)) {
        alert_model::alert_of_format_wrong("'teléfono'");
        exit();
    }

    if (modeloprincipal::verificar_datos("[!@#$%A-Za-zñÑÁÉÍÚÓáéíóúñÑ0-9\.\*\_\-]{7,32}", $contraseña)) {
        alert_model::alert_of_format_wrong("'contraseña'");
        exit();
    }

    $contraseña = modeloPrincipal::hashear_contrasena($contraseña);
    
    // datos verificados que se van a Registrar
    try {
        $registrar = model_user::insert_user($nombre,$correo, $contraseña, $telefono, $id_rol);
        
        if (!$registrar) {
            alert_model::alerta_simple("¡Ocurrió un error!","No se pudo registrar al usuario en el sistema.","error");
        }

        alert_model::alert_reg_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_reg_error();
        exit();
    }


}

// modulo para Modificar informacion personal de un usuario

// if($modulo === "modificar_info_personal_usuario"){
    
//     /*------------------ información personal de el usuario ------------------*/
//     $nombre = modeloprincipal::limpiar_mayusculas($_POST["nombres"]);
//     $correo =  modeloprincipal::limpiar_cadena($_POST["email"]);
//     // Se verifica que no se hayan recibido campos vacíos.
//     modeloPrincipal::validar_campos_vacios([$nombre,$correo]);

//     if (modeloprincipal::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}",$nombre)) {
//         alert_model::alert_of_format_wrong("NOMBRE");
//         exit();
//     }
//     if (modeloprincipal::verificar_datos("[A-Za-zÁÉÍÚÓáéíóúñÑ@.0-9]{11,100}",$correo)) {
//         alert_model::alert_of_format_wrong("CORREO");
//         exit();
//     }
    
//     // Se actualizara la información personal del usuario
//     try {
//         $actualizar = modeloPrincipal::UpdateSQL("usuario","cedula = '$cedula', nombre = '$nombre', apellido = '$apellido', correo = '$correo', telefono = '$telefono', direccion = '$direccion'", "id_usuario = $id_usuario");
        
//         if (!$actualizar) {
//             alert_model::alerta_simple("Ha ocurrido un error!", "ocurrio un error al actualizar la información personal del usuario.", "error");
//             exit();
//         }

//         alert_model::alert_mod_success();
//         exit();
//     } catch (Exception $e) {
//         alert_model::alert_mod_error();
//         exit();
//     }
    
// }







// modulo para Modificar contraseña de un usuario

// if($modulo === "modificar_contraseña_usuario"){
    
//     $contraseña_actual = modeloprincipal::limpiar_cadena($_POST["current_password"]);
    
//     modeloprincipal::validar_campos_vacios([$_POST["current_password"], $_POST['password2'], $_POST['password']]); // se verifica si se recibieron campos vacios
    
//     $hash_guardado_en_bd = mysqli_fetch_assoc(modeloprincipal::consultar("SELECT contraseña FROM usuario WHERE id_usuario = '$id_usuario'"))["contraseña"];
    
//     // se verifica que la contraseña coincida con la guardad en la base de datos
//     if(!password_verify($contraseña_actual, $hash_guardado_en_bd)){
//         alert_model::alerta_simple(
//             "¡Ocurrio un error!", 
//             "La contraseña actual que ingresaste es incorrecta, verifique e intente nuevamente.",
//             "error"
//         );
//         exit();
//     }

//     $contraseña_nueva = modeloprincipal::limpiar_cadena($_POST["password"]);
//     $contraseña_nueva2 = modeloprincipal::limpiar_cadena($_POST['password2']);
    
//     if($contraseña_nueva !== $contraseña_nueva2){
//         alert_model::alerta_simple(
//             "¡Ocurrió un error!",
//             "Las contraseñas que ingresaste no coinciden. Por favor, verifica que las hayas escrito correctamente.",
//             "error"
//         );
//         exit();
//     }

    
//     if (modeloprincipal::verificar_datos("[!@#$%A-Za-z0-9\-]{".$configuracion['caracteres'].",60}", $contraseña_nueva)) {
//         // alert_model::alert_of_format_wrong("'contraseña nueva'");
//         alert_model::alerta_simple(
//             "Ocurrio un error!", 
//             "La contraseña no cumple con los requisitos de seguridad, Puede contener menos 1 número y 1 letra, Puede contener al menos ".$configuracion['simbolos']." de estos caracteres:!@#$% y Debe tener entre ".$configuracion['caracteres']." y 60 caracteres., verifique e intente nuevamente.",
//             "error"
//         );
//         exit();
//     }

//     // Contar símbolos (no alfanuméricos)
//     $simbolosContraseña = preg_match_all("/\W/", $contraseña_nueva);
//     if($simbolosContraseña < $configuracion['simbolos']){
//         alert_model::alerta_simple(
//             "¡Ocurrio un error!",
//             "la contraseña no cumple con la cantidad de simbolos mínima de ".$configuracion['simbolos'].", verifique e intente nuevamente.",
//             "error"
//         );
//         exit();
//     }

//     // Contar números
//     $numeros = preg_match_all("/[0-9]/", $contraseña_nueva);

//     if($numeros < $configuracion['numeros']){
//         alert_model::alerta_simple(
//             "¡Ocurrio un error!", 
//             "la contraseña no cumple con la cantidad mínima de números de ".$configuracion['numeros'].", verifique e intente nuevamente.",
//             "error"
//         );
//         exit();
//     }

//     try {

//         $contraseña = modeloPrincipal::hashear_contrasena($contraseña_nueva);

//         $actualizar = modeloprincipal::UpdateSQL(
//             "usuario",
//             "contraseña = '$contraseña'",
//             "id_usuario = $id_usuario"
//         );

//         if (!$actualizar) {
//             alert_model::alerta_simple(
//                 "Ha ocurrido un error!", 
//                 "ocurrio un error al guardar la nueva contraseña .", 
//                 "error"
//             );
//             exit();
//         }

//         model_user::bitacora_modificacion_contraseña();

//         alert_model::alert_mod_success();

//         exit();

//     } catch (Exception $e) {
        
//         alert_model::alert_mod_error();
//         exit();
//     }
// }









// modulo para modificar preguntas de seguridad de un usuario

// if ($modulo === "modificar_preguntas_seguridad") {

//     $id_usuario = $_SESSION['id_usuario']; // ID del usuario actual
//     $id_usuario = modeloprincipal::limpiar_cadena($id_usuario); // Limpiar el ID del usuario

//     // Obtener la cantidad de preguntas configuradas en el sistema
//     $configuracion = modeloPrincipal::consultar("SELECT c_preguntas FROM configuracion");
//     if (!$configuracion || mysqli_num_rows($configuracion) == 0) {
//         alert_model::alerta_simple(
//             "Ha ocurrido un error!", 
//             "No se pudo obtener la configuración de preguntas de seguridad.", 
//             "error"
//         );
//         exit();
//     }

//     $cantidad_preguntas = intval(mysqli_fetch_array($configuracion)['c_preguntas']);
    
//     // Obtener las preguntas y respuestas enviadas por el usuario
//     $preguntas = $_POST['pregunta'] ?? [];
//     $respuestas = $_POST['respuesta'] ?? [];

//     model_user::validar_preguntas_de_seguridad($preguntas,$respuestas);

//     // Validar que las preguntas y respuestas sean la cantidad correcta
//     if (count($preguntas) < $cantidad_preguntas || count($respuestas) < $cantidad_preguntas) {
//         alert_model::alerta_simple(
//             "Ha ocurrido un error!", 
//             "Debe completar todas las preguntas de seguridad.", 
//             "error"
//         );
//         exit();
//     }

//     // Validar que las preguntas y respuestas no estén vacías
//     try {
//         modeloPrincipal::validar_campos_vacios([$preguntas, $respuestas]);
        
//         if (count($preguntas) !== count(array_unique($preguntas))) {
//             alert_model::alerta_simple(
//                 "Ha ocurrido un error!", 
//                 "Las preguntas de seguridad no pueden estar repetidas.", 
//                 "error"
//             );
//             exit();
//         }
//         if (count($preguntas) !== count(array_unique($respuestas))) {
//             alert_model::alerta_simple(
//                 "Ha ocurrido un error!", 
//                 "Las respuestas de seguridad no pueden estar repetidas.", 
//                 "error"
//             );
//             exit();
//         }
//     } catch (Exception $e) {
//         alert_model::alerta_simple(
//             "Ha ocurrido un error!", 
//             "Debe completar todas las preguntas de seguridad.", 
//             "error"
//         );
//         exit();
//     }

//     $id_seguridad = [];
//     $id_preguntas = [];

//     // se obtiene las id de las preguntas de seguridad
//     try {
        
//         for ($i = 0; $i < $cantidad_preguntas; $i++) {
//             // Obtener la pregunta actual
//             $pregunta_encriptada = modeloPrincipal::encryption($preguntas[$i]);
                    
//             $pregunta_encriptada = trim($pregunta_encriptada);
//             $pregunta_encriptada = stripslashes($pregunta_encriptada);
//             $pregunta_encriptada = str_ireplace(" ", "", $pregunta_encriptada);
//             $pregunta_encriptada = stripslashes($pregunta_encriptada);
//             $pregunta_encriptada = trim($pregunta_encriptada);

//             $id_seguridades = modeloPrincipal::consultar("SELECT id_seguridad FROM seguridad WHERE pregunta = '$pregunta_encriptada'");

//             if (!$id_seguridades || mysqli_num_rows($id_seguridades) == 0) {
//                 alert_model::alerta_simple(
//                     "Ha ocurrido un error!", 
//                     "ocurrio un error al consultar la ID de la pregunta de seguridad.", 
//                     "error"
//                 );
//                 exit();
//             }
            
//             $id_seguridades = mysqli_fetch_array($id_seguridades)['id_seguridad'];
            
//             $id_seguridad[$i] = $id_seguridades;

//         }
//     } catch (Exception $e) {
//         alert_model::alerta_simple(
//             "Ha ocurrido un error!", 
//             "No se pudo obtener la ID de las preguntas de seguridad.", 
//             "error"
//         );
//         exit();
//     }
    
//     // 2. Borrar todos las preguntas y respuestas del usuario
//     modeloPrincipal::DeleteSQL(
//         "preguntas_secretas", 
//         "id_usuario = $id_usuario"
//     );
    
//     try {

//         $numero_pregunta = 1;
//         for ($i = 0; $i < $cantidad_preguntas; $i++) {

//             // Encriptar la nueva respuesta
//             $respuesta_encriptada = modeloPrincipal::limpiar_mayusculas_encriptar($respuestas[$i]);
            
//             $actualizar = modeloPrincipal::InsertSQL(
//                 "preguntas_secretas", 
//                 "id_pregunta, respuesta, numero_pregunta, id_usuario", 
//                 "".$id_seguridad[$i].", '$respuesta_encriptada', $numero_pregunta, $id_usuario"
//             );
            
//             $numero_pregunta++;
            
//             if (!$actualizar) {
//                 alert_model::alerta_simple(
//                     "Ha ocurrido un error!", 
//                     "ocurrio un error al actualizar la pregunta de seguridad.", 
//                     "error"
//                 );
//                 exit();
//             } 
//         }

        
//         // Registrar la modificación en la bitácora
//         bitacora::bitacora(
//         "Modificación exitosa del perfil de usuario",
//         '<p class="mb-3 h2 text-primary-emphasis text-center"><i class="bi bi-exclamation-circle-fill"></i>&nbsp;El usuario actualizó sus preguntas de seguridad.</p>'
//         );
        
//             // Mostrar mensaje de éxito
//         alert_model::alert_mod_success();
//         exit();

//     } catch (Exception $e) {

//         alert_model::alerta_simple(
//             "¡Error inesperado!", 
//             "Ocurrió un error al actualizar las preguntas de seguridad. Por favor, intente nuevamente.",
//             "error"
//         );
//         exit();
//     }
// }








// modulo para modificar las caracteristicas de acceso de un usuario

if ($modulo === 'caracteristicas_de_acceso'){
    // caracteristicas a actualizar del usuario
    $id_usuario = modeloPrincipal::decryptionId($_POST['UIDTM']);
    $id_usuario = modeloPrincipal::LimpiarCadenaTexto($id_usuario);

    $nuevo_estado = modeloPrincipal::LimpiarCadenaTexto($_POST['cambiar_estado']);

    $nombre = modeloPrincipal::LimpiarCadenaTexto($_POST['nombre_completo']); 
    $telefono = modeloPrincipal::LimpiarCadenaTexto($_POST['telefono_user']);

    // se evaluan los campos y que no estén vacíos
    modeloPrincipal::validar_campos_vacios([$id_usuario, $nuevo_estado, $nombre, $telefono]);
    
    // se evaluan que los campos cumplan con el formato establecido
    if (modeloprincipal::verificar_datos("[0-1]{1}",$nuevo_estado)) {
        alert_model::alert_of_format_wrong("'estado'");
        exit();
    }
    

    // se actualizan las caracteristicas del usuario
    try {
        
        $actualizar_usuario = model_user::actualizar_usuario_por_su_id ("state = $nuevo_estado",$id_usuario);
        
        if (!$actualizar_usuario) {
            alert_model::alerta_simple("Ha ocurrido un error!", "ocurrio un error al actualizar las características de acceso del usuario.", "error");
            exit();
        }

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }
}







// modulo para resetear el acceso de un usuario

if ($modulo === 'resetear_contraseña'){

    // caracteristicas a actualizar del usuario
    $id_usuario = modeloPrincipal::decryptionId($_POST["UID"]);
    
    modeloPrincipal::validar_campos_vacios([$id_usuario]);

    $existe_usuario = model_user::consulta_usuario_id("correo", $id_usuario);

    if (mysqli_num_rows($existe_usuario) < 1) {
        alert_model::alerta_simple("¡Ocurrió un error inesperado!","No se encontraron datos del usuario asegúrese de que esté se encuentre registrado en el sistema, por favor verifique e intente nuevamente","error");
    }
    
    $existe_usuario = mysqli_fetch_assoc($existe_usuario);
    $correo = $existe_usuario['correo'];
    
    $correo = modeloPrincipal::hashear_contrasena($correo);

    try {
        $desbloquear_usuario = modeloPrincipal::UpdateSQL("users", "password = '$correo', state = 1", "id = '$id_usuario'");

        if (!$desbloquear_usuario) {
            alert_model::alerta_simple("¡Ocurrió un error inesperado!","No se pudo desbloquear al usuario debido a un error interno o alteracion de la información ya registrada, por favor verifique e intente nuevamente","error");
        }

        alert_model::alert_mod_success();
        exit();
    } catch (Exception $e) {
        alert_model::alert_mod_error();
        exit();
    }

    
}
