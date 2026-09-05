<?php 
session_start();

$_SESSION["intentos_sesion"] = 0;

include_once "./config/SERVER.php"; // se incluye el model principal
include_once "./model/mainModel.php"; // se incluye el model principal

?>
<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <!-- meta tags -->
    <?php require_once './view/inc/login/meta.php'; ?>
    
    <!-- tittle  -->
    <title><?= TITTLE ?></title>
    <!-- css styles -->
    <?php require_once './view/inc/login/css.php'; ?>
</head>

<body id="" class="font-sans antialiased" >
    
    <div class="absolute flex h-screen items-center justify-between overflow-hidden w-full flex-wrap">
        <div class="p-2">
            <img class="bg-cover bg-center opacity-20" src="./view/img/djsander2.webp" alt="wallpaper de djsandegonzalez" style="
                background-size: 10rem;
                right: 0;
                left: 0;
                height: 100vh;
                background-position: center;
            ">

        </div>

        <div class="p-2">
            <img class="bg-cover bg-center opacity-20" src="./view/img/djsander1.webp" alt="wallpaper de djsandegonzalez" style="
                background-size: 10rem;
                right: 0;
                left: 0;
                height: 100vh;
                background-position: center;
            ">
        </div>
    </div>

	<nav class="top-0 z-40 bg-slate-950 border-b border-purple-900/20 p-2 relative">
        <div class="max-w-7xl mx-auto d-flex flex-col flex-md-row gap-3 justify-content-between align-items-center">
            <a href="./" class=" flex items-center gap-3 text-center md:text-left">
                <img class="rounded-full w-[5rem]" src="./view/img/logo.webp" alt="Logo de <?= COMPANY ?>">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent"><?= COMPANY ?></h1>
                <p class="d-none text-[10px] text-slate-500 uppercase tracking-widest">Todo lo que buscas en un solo lugar</p>
            </a>

            <div class="flex gap-4 items-center">
                <a href="./catalogo.php" class="d-flex align-items-center text-slate-400 hover:text-cyan-500 transition">
                    <i class="fs-md-2 bi bi-cart me-3"></i>Volver al Catálogo
                </a> 
            </div>
        </div>
    </nav>

    <div id="app" class="min-h-screen ">

        <main class="p-3 relative d-flex items-center justify-center text-center">
            
            <div class="bg-[#020617] border border-slate-800 p-3 rounded-2xl w-md shadow-cyan-500 shadow-2xl">
                <h3 class="font-sans text-md font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">ACCESO ADMINISTRATIVO</h3>
                <form id="login" method="POST" action="./controller/login.php" data-type-form="load" autocomplete="off" class="SendFormAjax text-start ">

                    <div class="text-start mb-3" data-bs-theme="dark">
                        <label for="user" class="form-label fw-bold">Correo Electrónico &nbsp;<span style="color:#f00; font-size: 1.5rem;">*</span></label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text"> <i class="bi bi-person-circle"></i> </span>
                            <input id="user" name="user" type="email" placeholder="Correo" 
                                required class="form-control">
                        </div>
                    </div>

                    <div class="text-start mb-3" data-bs-theme="dark">
                        <label for="pass" class="form-label fw-bold">Contraseña &nbsp;<span style="color:#f00; font-size: 1.5rem;">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"> <i class="bi bi-lock"></i> </span>
                            <input id="pass" name="pass" type="password" placeholder="Contraseña" required class="form-control">
                            <button id="btnEyeIcon" type="button" class="btn btn-secondary input-group-text position-" title="Mostrar contraseña" 
                                onclick="show_password('eyeIcon', 'pass')">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    
                    <div class="text-start mb-4">
                        <p class="w-full text-slate-200 mt-4 text-sm">Los campos con  <span style="color:#f00; font-size: 1rem;">*</span> son obligatorios.</p>
                    </div>

                    <button class="mb-2 w-full bg-blue-600 p-2 rounded-2xl font-bold hover:bg-blue-900 transition shadow-lg shadow-blue-500/20">Entrar</button>
                    
                    <div class="text-center mb-2">
                        <a href="./catalogo.php" class="btn btn-outline-secondary w-full text-slate-200 mt-4 text-sm"><i class="fs-md-2 bi bi-cart me-3"></i> Volver al catálogo</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- modal recuperar contraseña -->
    <div class="modal fade p-5" id="recuperar_contraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="SendFormAjax" method="post" action="./api/recuperar_contraseña">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-white" id="exampleModalLabel"><i class="text-white bi bi-key"></i>&nbsp; Recuperar Contraseña</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-start">
                            <label class="mb-3 text-white text-start" for="selecciona_metodo_de_recuperacion">Selecciona el Método de Recuperación<span style="color:#f00;">*</span></label>
                            <select required name="selecciona_metodo_de_recuperacion" id="selecciona_metodo_de_recuperacion" class="form-select">
                                <option disabled>Selecciona una opción</option>
                                <option value="correo">Recibir un Código por Correo </option>
                                <option value="preguntas">Responder las Preguntas de Seguridad</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="aceptar">Aceptar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="msjFormSend"></div>

    <script type="text/javascript" src="view/js/jquery-3.6.0.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="view/js/sweetalert2.min.js"></script>
    <script src="view/js/hiddenInput.js"></script>
    <script src="view/js/SendForm.js"></script>
    <script> SendFormAjax(); </script>
    <script src="view/js/validator.js"></script>
</body>

</html>