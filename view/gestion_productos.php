<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/productModel.php"; 
require_once "../model/categoryModel.php"; 
// Obtener el user agent del cliente
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

$estado = $_POST['estado'] ?? 1;

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
                <div class="pagetitle d-flex justify-content-start align-items-center gap-4">
                    <a class="btn btn-outline-secondary mb-3" href="./">
                        <i class="bi bi-chevron-left"></i> 
                        <span>Volver al Panel Principal</span>
                    </a>
                    <h1 class="dark:text-slate-400 text-center fs-1 my-1">Gestión de Productos</h1>
                </div>

                <section class="section dashboard">
                    <div class="row m-0"> 
                        <div id="card_gestion_productos" class="col-12 mb-3 pagetitle text-center flex justify-around gap-2">
                            
                            <div class="dark:bg-slate-800 card rounded-2 mb-2 p-2" id="acordeon_categorias">
                                <h2 class="dark:text-slate-400 text-center text-blue-900 fw-bold my-2 text-2xl"> Categorías</h2>
                                <div class="flex flex-wrap justify-around px-1 py-2 gap-2">
                                    <div class="text-center">
                                        <button modal="registrarCategoria" type="button" data-bs-toggle="modal" data-bs-target="#registrar_categoria" class="text-sm mb-2 btn btn-success">
                                            <i class="bi bi-plus-circle"></i> Registrar nueva
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <button em_size="modal-lg" em_trigger="list" em_icon="bi-list-columns-reverse" em_url="../api/lista_categorias.php" em_title="Lista de Categorías" 
                                            id="btn_ver_listas_categoria" type="button" class="em_trigger text-sm btn btn btn-secondary" 
                                            data-bs-toggle="modal" data-bs-target="#em_lists">
                                                <i class="bi bi-list-columns-reverse"></i> Ver Lista
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-none dark:bg-slate-800 card rounded-2 mb-2 p-2" id="acordeon_presentacion">
                                <h2 class="dark:text-slate-400 text-center text-blue-900 fw-bold my-2 text-2xl"> Presentaciones</h2>
                                <div class="flex flex-wrap justify-around gap-2 px-1 py-2">
                                    <div class="text-center">
                                        <button modal="registrarPresentacion" type="button" data-bs-toggle="modal" data-bs-target="#modal" class="text-sm mb-2 btn btn-success">
                                            <i class="bi bi-plus-circle"></i> Registrar nueva
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <button em_url="../api/lista_presentaciones.php"
                                            id="btn_ver_listas_presentacion" 
                                            type="button" 
                                            class="text-sm btn btn btn-secondary em_trigger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#em_lists">
                                            <i class="bi bi-list-columns-reverse"></i> Ver Lista
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none dark:bg-slate-800 card rounded-2 mb-2 p-2" id="acordeon_marcas">
                                <h2 class="dark:text-slate-400 text-center text-blue-900 fw-bold my-2 text-2xl"> Marcas</h2>
                                <div class="flex flex-wrap justify-around px-1 py-2 gap-2">
                                    <div class="text-center">
                                        <button modal="registrarMarca" type="button" data-bs-toggle="modal" data-bs-target="#modal" class="text-sm mb-2 btn_modal btn btn-success">
                                            <i class="bi bi-plus-circle"></i> Registrar nueva
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <button modal="listaMarca" id="btn_ver_listas_marca" type="button" class="text-sm btn_modal btn btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal">
                                            <i class="bi bi-list-columns-reverse"></i> Ver Lista
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- registro y listado de productos -->

                        <div class="col-12 pagetitle text-center">
                            <div class="dark:bg-slate-800 card rounded-2 p-2">
                                <div class="car-body row">
                                    <div class="setCol text-center col-md-6 col-12 mb-3">
                                        <button data-bs-target="#registrar_producto" data-bs-toggle="modal" type="button" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Registrar Productos 
                                        </button>
                                    </div>

                                    <div class="setCol text-center col-md-6 col-12 mb-3">
                                        <form action="#!" method="post">        
                                            <input type="hidden" name="estado" value="<?= $estado == 1 ? 0 : 1; ?>">
                                            <button type="submit" class="btn <?= $estado == 1 ? 'btn-danger' : 'btn-success'; ?> "> <i class="bi  <?= $estado == 1 ? 'bi-x-circle' : 'bi-check-circle'; ?> "></i> Ver Productos <?= $estado == 1 ? 'inactivos' : 'activos'; ?> </button>
                                        </form>
                                    </div>
                                    
                                    <?php if (!preg_match('/iPhone|Android/i', $userAgent)) { ?>

                                        <div id="containerTableListProducts" class="justify-content-between align-items-center table table-responsive dark:text-slate-200">
                                            <table class="table example mb-3 dark:text-slate-200" id="example">
                                                <thead>
                                                    <tr>
                                                        <th class="col text-center" scope="col">N.º</th>
                                                        <th class="col text-center" scope="col">Producto</th>
                                                        <th class="col text-center" scope="col">Precio</th>
                                                        <th class="col text-center" scope="col">Imagenes</th>
                                                        <th class="col text-center" scope="col">Acciones de producto</th>
                                                        <th class="col text-center" scope="col">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    <?php producto_model::lista($estado); ?>
                                                </tbody>
                                            </table>
                                        </div> 
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <?php if (preg_match('/iPhone|Android/i', $userAgent)) { 
                            require_once './inc/view_mobile.php';
                        } ?>
                        
                    </div>
                </section>
            </main>


            <!-- modal Section -->
            <?php 
                // modal category Section
                require_once './modal/categoria/registrar.php';
                // modal product Section
                require_once './modal/producto/registrar.php';
                require_once './modal/producto/editar.php'; 
                
                // se incluye el footer / pie de pagina a la vista
                include_once "./inc/footer.php";
                // se incluyen los script de javascript a la vista 
                include_once "./inc/scripts_include.php"; 
            ?>
        </body>
    </html>