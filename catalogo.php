<?php require_once "./config/APP.php"; ?>

<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <!-- meta tags -->
    <?php require_once './view/inc/catalogo/meta.php'; ?>
    
    <!-- tittle  -->
    <title><?= TITTLE ?></title>
    
    <!-- Favicons -->
    <link href="./view/img/logo.webp" rel="shortcut icon" type="image/x-icon">
    
    <!-- css styles -->
    <?php require_once './view/inc/catalogo/css.php'; ?>
    
</head>

<body  class="toggle-sidebar dark:bg-gray-900 bg-gray-900/20 index-page overflow-x-hidden relative">

    <!-- header Section -->

    <?php require_once "./view/inc/catalogo/header.php"; ?>
    <?php require_once "./view/inc/catalogo/loader.php"; ?>    
    <!-- /header Section -->

    <div id="app" style="display: none !important;" >
        <main id="main" class="main">
            <div class="pagetitle mb-5">
                
                <!-- Filtros por Categoría -->
                <div class="dropdown text-center">
                    <button class="btn btn-primary dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sliders" ></i>
                        <span class="" > Filtros  </span>
                        <span id="num_filter" class="d-none badge position-absolute text-bg-danger" style="top: -.8rem;  right: -1rem;"></span>
                    </button>
    
                    <ul id="category-filters" class="dropdown-menu overflow-scroll overflow-x-hidden" style="max-height: 25rem;" data-bs-theme="dark">
                        <li id="dropdown-item-all" class="dropdown-item" >
                            <button onclick="filterByCategory('all', 0)" class="w-100 btn border-0 bg-transparent px-3 category-btn">Todos</button>
                        </li>
                        
                    </ul>
                </div>
            </div>
    
            <section class="section dashboard">
                <div id="producto-cards" class="producto-card-container"></div>
            </section>
    
        </main>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content rounded-4 border border-secondary shadow-lg">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="m-0 p-3 align-items-center justify-content-around modal-body row" id="modalBody">

                </div>
            </div>
        </div>
    </div>


    <!-- scripts Section -->
    <?php require_once './view/inc/catalogo/scripts.php'; ?>
    <!-- /scripts Section -->
    

    <?php include_once "./view/inc/catalogo/footer.php"; ?>
    
</body>

</html>