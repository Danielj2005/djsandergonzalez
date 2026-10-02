<?php require_once "./config/SERVER.php"; ?>

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
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- scripts Section -->
    <?php require_once './view/inc/portafolio/scripts.php'; ?>
    <!-- /scripts Section -->
</body>

</html>