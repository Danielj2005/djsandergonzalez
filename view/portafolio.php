<?php
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/userModel.php";
// Obtener el user agent del cliente
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';


$hero = mysqli_fetch_array(modeloPrincipal::consultar("SELECT hero FROM portafolio"));
$hero = json_decode($hero['hero'], true);

$about = mysqli_fetch_array(modeloPrincipal::consultar("SELECT about FROM portafolio"));
$about = json_decode($about['about'], true);

$store = mysqli_fetch_array(modeloPrincipal::consultar("SELECT store FROM portafolio"));
$store = json_decode($store['store'], true);
$store = $store['img'];


$service = modeloPrincipal::consultar("SELECT * FROM servicio");
$contact = modeloPrincipal::consultar("SELECT * FROM contacto");

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
            <a class="btn btn-outline-secondary mb-3" href="./">
                <i class="bi bi-chevron-left"></i>
                <span>Volver al Panel Principal</span>
            </a>
            <h1 class="dark:text-slate-400 text-center fs-1 my-1">Portafolio DjsanderGonzalez</h1>
        </div>

        <section class="section dashboard">
            <div id="containerListProducts" class="text-center col-12 mb-3">

                <div class="p-3 mb-3 animate-slide-up bg-[#fff] dark:bg-slate-800 duration-500 group overflow-hidden rounded-2xl dark:shadow-cyan-500/20 shadow-slate-800/20 shadow-xl transition-all">

                    <section class="mb-3 ">
                        <h2 class="text-xl text-slate-800 dark:text-slate-200">Portada Principal</h2>
                        <hr class="mb-3 border-slate-800 dark:border-slate-200 border-[2.5px] rounded-full">
                        <div class="row ">

                            <div class="col-12 col-md-6 text-start mb-2 flex items-start justify-start">
                                <label class="absolute text-md  text-slate-800 dark:text-slate-200">Título</label>
                                <input value="<?= $hero['title'] ?>" type="text" id="id" name="name" placeholder="placeholder" readonly
                                    class=" text-slate-800 dark:text-slate-400 mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                            </div>
                            <div class="col-12 col-md-6 text-start mb-2 flex items-start justify-start">
                                <label class="absolute text-md  text-slate-800 dark:text-slate-200">Subtitulo</label>
                                <input value="<?= $hero['subtitle'] ?>" type="text" id="id" name="name" placeholder="placeholder" readonly
                                    class=" text-slate-800 dark:text-slate-400  mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                            </div>
                            <div class="col-12 mb-3 text-center">
                                
                                <div class="mb-4 text-start">
                                    <label class="text-md text-slate-800 dark:text-slate-200">Imagenes</label>
                                </div>
                                <div class="flex flex-wrap items-center justify-center gap-3">
                                    <div class="mb-4">
                                        <img src="<?= str_replace("./view/", "./", $hero['logo']) ?>" style="width: 15rem; height:15rem; "
                                            class="mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />

                                    </div>

                                    <div class="mb-4">
                                        <img src="<?= str_replace("./view/", "./", $hero['bg-img']) ?>" style="width: 15rem; height:15rem; "
                                            alt="..."
                                            class="d-block mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2 flex items-center justify-center">

                                <div class="mb-2">
                                    <button em_size="modal-xl" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/portafolio/hero.php" em_title="Modificar Información de la portada"
                                        type="button" class="w-[15rem] rounded-full em_trigger text-sx btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
                                        <i class="bi bi-pencil-square"></i>&nbsp;
                                        <span class="text-sm">Modificar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="mb-3 ">
                        <h2 class="text-xl text-slate-800 dark:text-slate-200">Sobre mí</h2>
                        <hr class="mb-3 border-slate-800 dark:border-slate-200 border-[2.5px] rounded-full">
                        <div class="row ">

                            <div class="col-12 col-md-6 text-start mb-4 flex items-start justify-start">
                                <label class="absolute text-sm text-slate-800 dark:text-slate-200">Subtitulo</label>
                                <input value="<?= $about['subtitle'] ?>" type="text" id="id" name="name" placeholder="placeholder" readonly
                                    class="mt-4 text-slate-800 dark:text-slate-400 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                            </div>
                            <div class="col-12 col-md-6 text-start mb-4 flex items-start justify-start">
                                <label class="absolute text-sm text-slate-800 dark:text-slate-200">Slogan</label>
                                <textarea value="<?= $about['slogan'] ?>" type="text" id="id" name="name" placeholder="placeholder" readonly
                                    class="h-full mt-4 text-slate-800 dark:text-slate-400 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent"><?= $about['slogan'] ?></textarea>
                            </div>
                            <div class="col-12 col-md-8 text-start mt-4 mb-2 flex items-start justify-start">
                                <label class="absolute text-sm text-slate-800 dark:text-slate-200">Incluye</label>
                                <ul class="mt-4">
                                    <?php foreach ($about['incluye'] as $incluye): ?>
                                        <li class=" text-slate-800 dark:text-slate-400 "><i class="bi bi-chevron-right"></i>&nbsp; <?= $incluye ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-12 col-md-4 mt-4 mb-2 flex items-center justify-center">
                                <img src="<?= str_replace("./view/", "./", $about['img']) ?>" style="width: 15rem; height:15rem; "
                                    class="mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                            </div>

                            <div class="mt-4 mb-2 flex items-center justify-center">

                                <div class="mb-2">
                                    <button em_size="modal-md" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/usuario/editar.php?UID=" em_title="Modificar Usuario"
                                        type="button" class="w-[15rem] rounded-full em_trigger text-sx btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
                                        <i class="bi bi-pencil-square"></i>&nbsp;
                                        <span class="text-sm">Modificar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="mb-3 ">
                        <h2 class="text-xl text-slate-800 dark:text-slate-200">Tienda</h2>
                        <hr class="mb-3 border-slate-800 dark:border-slate-200 border-[2.5px] rounded-full">
                        <div class="flex items-center justify-center ">
                            <label class="absolute text-md text-slate-800 dark:text-slate-200">Imagenes</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-center justify-center w-full">
                            
                            <?php foreach ($store as $src) : ?>


                                <div class="mb-4 flex items-center justify-center">
                                    <img src="<?= str_replace("./view/", "./", $src) ?>" style="width: 15rem; height:15rem; "
                                        class="mt-4 w-full border border-slate-200 rounded-lg py-2 px-2 outline-none bg-transparent" />
                                </div>

                            <?php endforeach; ?>
                            </div>

                        </div>
                        <div class="col-12 mb-2 flex items-center justify-center">

                            <div class="mb-2">
                                <button em_size="modal-md" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/usuario/editar.php?UID=" em_title="Modificar Usuario"
                                    type="button" class="w-[15rem] rounded-full em_trigger text-sx btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
                                    <i class="bi bi-pencil-square"></i>&nbsp;
                                    <span class="text-sm">Modificar</span>
                                </button>
                            </div>
                        </div>
                    </section>

                    <section class="mb-3 ">
                        <h2 class="text-xl text-slate-800 dark:text-slate-200">Servicios</h2>
                        <hr class="mb-3 border-slate-800 dark:border-slate-200 border-[2.5px] rounded-full">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 items-start justify-start text-start">
                            <?php while ($input = mysqli_fetch_array($service)) : ?>

                                <div class="p-3 mb-3 group card shadow-xl hover:shadow-2xl shadow-emerald-500/20 mb-3 bg-gray-800 rounded-3xl border-[2px] hover:border-emerald-500 transition delay-150 ease-in-out ">
                                    <label class="text-sm text-slate-800 dark:text-slate-200">Nombre</label>
                                    <p class="text-sm text-slate-500"><?= $input['nombre'] ?></p>

                                    <label class="text-sm text-slate-800 dark:text-slate-200">Subtitulo</label>
                                    <p class="text-sm text-slate-500"><?= $input['subtitulo'] ?></p>
                                    
                                    <label class="text-sm text-slate-800 dark:text-slate-200">Incluye</label>
                                    <ul class="mb-3">
                                        <?php 
                                        $input['incluye'] = explode(",",$input['incluye']);
                                        
                                        foreach ($input['incluye'] as $incluye): ?>
                                            <li class="text-xs text-slate-800 dark:text-slate-400 "><i class="bi bi-chevron-right"></i>&nbsp; <?= $incluye ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    
                                    <div class="mb-2">
                                        <button em_size="modal-md" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/usuario/editar.php?UID=" em_title="Modificar Usuario"
                                            type="button" class="w-[15rem] rounded-full em_trigger text-sx btn btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
                                            <i class="bi bi-pencil-square"></i>&nbsp;
                                            <span class="text-sm">Modificar</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endwhile; ?>

                        </div>
                    </section>

                    <section class="mb-3">
                        <h2 class="text-xl text-slate-800 dark:text-slate-200">Mí Contacto</h2>
                        <hr class="mb-3 border-slate-800 dark:border-slate-200 border-[2.5px] rounded-full">
                        <div class=" ">
                            
                            <div class="p-3 mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-14">
                                
                                <?php while ($data = mysqli_fetch_array($contact)): ?>
                                    <div class="flex gap-4 group" bis_skin_checked="1">
                                        <div class="p-4 w-12 h-12 rounded-2xl dark:bg-slate-900 border border-slate-600 flex items-center justify-center transition-all duration-300 shadow-sm" bis_skin_checked="1">
                                            <i class="dark:text-slate-200 bi <?= strtolower($data['icon']) ?>"></i>
                                        </div>
                                        <div class="flex flex-col justify-center" bis_skin_checked="1">
                                            <p class="text-slate-800 dark:text-slate-200 text-[9px] font-bold uppercase tracking-[0.2em] mb-1"><?= $data['nombre'] ?></p>
                                            <input readonly type="text" class="border border-slate-500 dark:bg-slate-400 p-2 text-slate-800 rounded-full font-extrabold text-xs sm:text-sm leading-tight tracking-tight" value="<?= $data['url'] ?>" />
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>

                            <div class="mb-2 flex items-center justify-center">

                                <div class="mb-2">
                                    <button em_size="modal-md" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/usuario/editar.php?UID=" em_title="Modificar Usuario"
                                        type="button" class="w-[15rem] rounded-full em_trigger text-sx btn btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
                                        <i class="bi bi-pencil-square"></i>&nbsp;
                                        <span class="text-sm">Modificar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


        </section>
    </main>

    <!-- modal Section -->
    <?php
    // modal usuario Section
    require_once './modal/usuario/registrar.php';

    // se incluye el footer / pie de pagina a la vista
    include_once "./inc/footer.php";
    // se incluyen los script de javascript a la vista 
    include_once "./inc/scripts_include.php";
    ?>
</body>

</html>