

<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sander González | DJ & Producer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./view/img/logo.webp" rel="shortcut icon" type="image/x-icon">

    <!-- sweet-alert 2 -->
    <link href="./view/css/sweetalert2.min.css" rel="stylesheet">
    <link href="./view/css/toastify.css" rel="stylesheet">

    <link href="./view/css/bootstrap.min.css" rel="stylesheet">
    <link href="./view/css/bootstrap-icons.css" rel="stylesheet">
    <link href="./view/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="./view/css/animate.min.css" rel="stylesheet">
    
    <link href="./view/css/my_resume_styles.css" rel="stylesheet">

    <script src="./view/js/tailwind.min.js"></script>
    <script>
        // Se ejecuta al instante antes de pintar el body
        const savedTheme = localStorage.getItem('theme') ?? 'dark';
        document.documentElement.classList.add(savedTheme);
    </script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: { 950: '#020617', },
                        purple: { 400: '#c084fc', 500: '#a855f7', 600: '#9333ea', },
                        fuchsia: { 500: '#d946ef', 600: '#c026d3', 700: '#a21caf', },
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'], },
                }
            }
        }
    </script>
</head>

<body  id="page-top" class="dark:bg-gray-900 bg-gray-900/20 index-page overflow-x-hidden relative">

    
    <header id="header" class="header d-flex flex-column justify-content-center ">
        <i class="header-toggle d-xl-none bi bi-list"></i>

        <?php require_once './view/inc/portafolio/navBar.php'; ?>

    </header>

    <main id="main" class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="https://images.unsplash.com/photo-1598387181032-a3103a2db5b3?q=80&w=2076" alt="wallpaper de VENTOI">

            <div class="container" data-aos="zoom-out">
                <div class="row justify-content-center">
                    <div class="col-lg-9">

                        <h1 class="text-7xl md:text-9xl font-black uppercase italic leading-none mb-4">Sander<br><span class="text-cyan-500">González</span></h1>
                        <p>I'm <span >DJ for +6 years | Content Creator</span></p>
                        <p class="text-gray-400 text-lg md:text-xl tracking-widest mb-10">Events | Bars | Private Party`s</p>
                        
                        <div class="">
                            
                            <div class="mt-2 d-flex justify-content-start gap-2">
                                <a target="_blank" class="btn border-success rounded-full" href="https://api.whatsapp.com/send?phone=5491172041071"><i class="text-white bi bi-whatsapp"></i></a>
                                                    
                                <a target="_blank" class="btn border-primary rounded-full" href="#"><i class="text-white bi bi-facebook"></i></a>
                                <a target="_blank" class="btn border-pink-500 rounded-full" href="#"><i class="text-white bi bi-instagram"></i></a>
                                <a target="_blank" class="btn border-black rounded-full" href="#"><i class="text-white bi bi-tiktok"></i></a>
                                <a target="_blank" class="btn border-danger rounded-full" href="#"><i class="text-white bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
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

        <footer id="footer" class="bg-blue-900 dark:bg-gray-900 footer">
            <div class="p-3 text-center">                
                <h2 class="d-flex align-items-center justify-content-center gap-3 mb-3 ">
                    <img class="logo rounded-circle bg-gray-300" src="./view/img/logo.webp" alt="Logo de Ventoi">
                </h2>
    
                <div class="flex items-center justify-center">
                    <p class="text-white text-md mb-3 text-balance w-[35rem]">El control de tus finanzas es nuestro trabajo. Tu crecimiento, es tu prioridad.
                        VENTOI es un Sistema seguro y confiable para que cada transacción cuente, sin perder un solo dato.</p>
                    
                </div>
                <hr class="text-white">
    
                <div class="container ">
                    <div class="copyright text-white mb-2">
                        &copy; <strong class="px-1 sitename">DJ Sander Gonzalez</strong> <span>All Rights Reserved</span>
                        <p>DESAROLLADO POR: DANIEL BARRUETA</p>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <script src="./view/js/nice_admin_scripts/main.js"></script>
    <!-- jquery -->
    <script src="./view/js/jquery-3.6.0.min.js"></script>
    <script src="./view/js/bootstrap.bundle.min.js"></script>
    
    <script src="view/js/dark_mode.js"></script>

    <script src="./view/vendor/aos/aos.js"></script>
    <script src="./view/js/main.js"></script>
    <script src="./view/js/toggleNavbar.js"></script>

</body>

</html>