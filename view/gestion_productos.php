<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/productModel.php"; 
require_once "../model/categoryModel.php"; 

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

                                    <h2 id="titleModuleProducts" class="dark:text-slate-400 mb-3 fs-2 col-12 fw-bold card-title">Inventario de Productos</h2>

                                    <div class="setCol text-center col-md-6 col-12 mb-3">
                                        <button data-bs-target="#registrar_producto" data-bs-toggle="modal" type="button" class="btn btn-success">
                                            <i class="bi bi-plus-circle"></i> Registrar Productos 
                                        </button>
                                    </div>

                                    <div class="setCol text-center col-md-6 col-12 mb-3">
                                        <button em_size="modal-xl" em_trigger="list" em_icon="bi-list-columns-reverse" em_url="../api/lista_productos.php?UID=0" em_title="Lista de Productos Inactivos" 
                                            data-bs-target="#em_lists" data-bs-toggle="modal" type="button" class="em_trigger btn btn-danger">
                                            <i class="bi bi-x-circle"></i> Ver Productos Inactivos
                                        </button>
                                    </div>

                                    <div class="d-none my-3 col-12 text-start">
                                        <p class="text-secondary fs-6 fw-bold mb-1">Los Colores de indicadores en nombres de productos significan: </p>
                                        <ul class="list-unstyled overflow-hidden">
                                            <li class="list-item">
                                                <span class="rounded-5 badge fw-bold text-bg-primary text-primary">.</span>
                                                <span class="fw-bold">Productos con Gran cantidad de stock (50 o más)</span>
                                            </li>
                                            <li class="list-item">
                                                <span class="rounded-5 badge fw-bold text-bg-warning text-warning">.</span>
                                                <span class="fw-bold">Productos con Poca cantidad de stock (30 o menos)</span>
                                            </li>
                                            <li class="list-item">
                                                <span class="rounded-5 badge fw-bold text-bg-danger text-danger">.</span>
                                                <span class="fw-bold">Productos con Baja cantidad de stock (20 o menos)</span>
                                            </li>
                                            <li class="list-item">
                                                <span class="rounded-5 badge fw-bold text-bg-success text-success">.</span>
                                                <span class="fw-bold">Productos Bajo Pedido</span>
                                            </li>
                                            <li class="list-item">
                                                <span class="rounded-5 badge fw-bold text-bg-secondary text-secondary">.</span>
                                                <span class="fw-bold">Productos Cotizados según el pedido</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="tableListProducts" class="justify-content-between align-items-center table table-responsive dark:text-slate-200">
                                        <table class="table example mb-3 dark:text-slate-200" id="example">
                                            <thead>
                                                <tr>
                                                    <th class="col text-center" scope="col">N.º</th>
                                                    <th class="col text-center" scope="col">Producto</th>
                                                    <th class="col text-center" scope="col">Precios</th>
                                                    <th class="col text-center" scope="col">Imagenes</th>
                                                    <th class="col text-center" scope="col">Editar</th>
                                                    <th class="col text-center" scope="col">Desactivar</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php producto_model::lista(); ?>

                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </>
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