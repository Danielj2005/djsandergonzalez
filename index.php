<?php 
require_once "./config/SERVER.php"; 
require_once "./model/mainModel.php"; 
?>

<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <!-- meta tags -->
    <?php require_once './view/inc/portafolio/meta_tag.php'; ?>
    
    <!-- tittle  -->
    <title><?= TITTLE ?></title>
    
    <!-- Favicons -->
    <link href="./view/img/logo.webp" rel="shortcut icon" type="image/x-icon">
    
    <!-- css styles -->
    <?php require_once './view/inc/portafolio/css.php'; ?>

</head>

<body  id="page-top" class="dark:bg-gray-900 bg-gray-900/20 index-page overflow-x-hidden relative">

    <!-- header Section -->
    <?php require_once './view/inc/portafolio/header.php'; ?>        
    <!-- /header Section -->

    <main id="main" class="main">

        <!-- Hero Section -->
        <?php require_once './view/inc/portafolio/hero.php'; ?>
        <!-- /Hero Section -->

        <!-- About Section -->
        <?php require_once './view/inc/portafolio/about_me.php'; ?>
        <!-- /About Section -->

        <!-- shop Section -->
        <?php require_once './view/inc/portafolio/shop.php'; ?>
        <!-- /shop Section -->

        <!-- services Section -->
        <?php require_once './view/inc/portafolio/service.php'; ?>
        <!-- /services Section -->

        <!-- Contact Section -->
        <?php require_once './view/inc/portafolio/contact.php'; ?>
        <!-- /Contact Section -->

        <!-- footer Section -->
        <?php require_once './view/inc/portafolio/footer.php'; ?>
        <!-- /footer Section -->
        
    </main>
    <!-- Scroll Top -->
    <div class="bg-slate-800/60 d-md-none fixed-bottom flex gap-2 h-24 items-center justify-around mt-2 right-0 w-full">
        
        <a href="./catalogo.php" class="bg-gray-700/80 btn flex group h-20 hover:bg-blue-500 items-center justify-center p-3 rounded-full transition w-20">
            <i class="group-hover:text-white text-blue-400 bi bi-cart"></i>
        </a> 

        <a href="#hero" class="bg-gray-700/80 btn flex group h-20 hover:bg-blue-500 items-center justify-center p-3 rounded-full transition w-20">
            <i class="group-hover:text-white bi bi-house navicon"></i>
        </a>

        <a id="lightModeButton" class="bg-gray-700/80 btn flex group h-20 hover:bg-blue-500 items-center justify-center p-3 rounded-full transition w-20">
            <i class="text-amber-400 bi bi-sun-fill navicon"></i>
        </a>
    </div>
    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- scripts Section -->
    <?php require_once './view/inc/portafolio/scripts.php'; ?>
    <!-- /scripts Section -->
</body>

</html>