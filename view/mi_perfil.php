<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/userModel.php"; 

?>

<!DOCTYPE html>
<html lang="es" class="dark" data-bs-theme="light">

<head>
    
    <?php require_once "./inc/meta.php"; ?>
    <!-- titulo -->
    <title><?= TITTLE ?></title>

    <?php require_once "./inc/css.php"; ?>
</head>

<body class="dark:bg-gray-900 bg-gray-400/20 ">
    <?php
        // se incluye el header / encabezado a la vista
        include_once "./inc/header.php";
        // se incluye el menu lateral a la vista 
        include_once "./inc/adminSideBar.php";
    ?>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1 class="dark:text-slate-200 display-4 fw-bold text-start mb-3"> <i class="bi bi-person-circle me-3 dark:text-slate-200 text-blue-500"></i> Mi Perfil de Usuario </h1>
      </div>

      <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="dark:bg-slate-800 card">
                  <div class="card-body pb-3">
                    <fieldset class="row mb-3">
                        <legend class="dark:text-slate-200 col-12 mb-2"><i class="bi bi-person"></i> &nbsp;Información personal</legend>
                        <div class="col-12 col-md-4 mb-3">
                          <div class="form-group">
                            <label class="dark:text-slate-200 control-label">Nombres</label>
                            <input type="text" pattern="[A-Za-zÁÉÍÚÓáéíóúñÑ ]{3,30}" class="bg-secondary-subtle form-control" value="<?= $_SESSION['dataUser']['nombre']; ?>" id="nombres" name="nombres" readOnly="true" maxlength="30">
                          </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                          <div class="form-group">
                            <label class="dark:text-slate-200 control-label">Correo</label>
                            <input type="email" pattern="[A-Za-zÁÉÍÚÓáéíóúñÑ\@\.\0-9]{3,30}" class="bg-secondary-subtle form-control" value="<?= $_SESSION['dataUser']['correo']; ?>" id="email" name="email" readOnly="true" maxlength="30">
                          </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label class="dark:text-slate-200 control-label">Teléfono</label>
                                <input type="text" pattern="[0-9]{11}" class="bg-secondary-subtle form-control" value="<?= $_SESSION['dataUser']['telefono']; ?>" id="telefono" name="telefono"  readOnly="true" maxlength="11">
                            </div>
                        </div>
                        <div class="col-12 mb-3 text-center d-flex justify-content-end">
                            <button type="button" class="dark:text-slate-200 btn_modal btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#editar_info_usuario">
                              <i class='bi bi-person-circle'></i> Actualizar Información
                            </button>
                        </div>
                    </fieldset>

                    <hr class="dark:border-slate-200 border-slate-800/20 mb-3">

                    <fieldset class="row mb-4">
                      <div class="col-12 mb-3 justify-content-center row">
                        <legend class="dark:text-slate-200"><i class="bi bi-person-circle"></i> &nbsp; Datos de la Cuenta</legend>
                        <div class="col-12 col-md-6 mb-3">
                          <div class="form-group">
                              <label class="dark:text-slate-200 control-label">Nombre de Usuario</label>
                              <input type="text" pattern="[A-Za-zÁÉÍÚÓáéíóúñÑ\@\.\0-9]{3,30}" class="bg-secondary-subtle form-control" value="<?= modeloPrincipal::ocultar_info($_SESSION['dataUser']['correo']); ?>" id="nombre_usuario" name="nombre_usuario" readOnly="true" maxlength="30">
                          </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label class="dark:text-slate-200 control-label">Tipo de Usuario</label>
                                <input type="text" pattern="[A-Za-zÁÉÍÚÓáéíóúñÑ]{3,30}" class="bg-secondary-subtle form-control" value="<?= $_SESSION['dataUser']['rol'] == 1 ? 'DEV MASTER' : 'Administrador'; ?>" id="tipo_usuario" name="tipo_usuario" readOnly="true" maxlength="30">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2 text-center d-flex justify-content-center">
                            <button type="submit" modal='passwordUser' class="dark:text-slate-200 btn_modal btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#cambiar_contraseña_usuario">
                              <i class='bi bi-key'></i>
                              Actualizar Contraseña
                            </button>
                        </div>
                      </div>

                      <div class="d-none col-12 col-md-6 mb-3 d-inline-block justify-content-center align-items-center">
                          <h5 class="dark:text-slate-200 mb-3"><i class="bi bi-shield-fill"></i> &nbsp; Actualizar Preguntas de Seguridad</h5>
                            
                          <div class="col-12 mb-2 text-center">
                              <button modal="preguntasSeguridad" class="dark:text-slate-200 btn_modal btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">
                                <i class="bi bi-shield"></i> Actualizar Preguntas y Respuestas
                              </button>
                          </div>
                      </div>

                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php 
      
      require_once './modal/usuario/editar_info_personal.php';
      require_once './modal/usuario/cambiar_contraseña.php';
      include_once "./inc/footer.php";

      include_once "./inc/scripts_include.php";
    

    ?>
  </body>
</html>