

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
        <nav id="navmenu" class="navmenu">
            <ul id="toggleNavbar" class=" backdrop-blur-md bg-gray-700/30 flex flex-column items-center p-0 pt-4 rounded-3xl w-[5rem] delay-200 ease-in-out transition-all">
                <li class="">
                    <button id="btnToggleNav" onclick="toggleNavbar()" class="bg-gray-700/80 delay-200 ease-in-out group h-[56px] hover:bg-[#0563bb] mb-2 rounded-full transition-all w-[56px]">
                        <i class="group-hover:text-white text-blue-400 bi bi-arrow-right navicon"></i>
                    </button>
                </li>
                <li class="">
                    <a href="#hero" class="active group max-w-14">
                        <i class="group-hover:text-white bi bi-house navicon"></i>
                        <span class="opacity-0 text-white">Página Principal</span>
                    </a>
                </li>
                <li>
                    <a href="#about" class="group bg-gray-700/80 rounded-full max-w-14">
                        <i class="group-hover:text-white text-gray-400 bi bi-person navicon"></i>
                        <span class="opacity-0 text-white">Sobre mí</span>
                    </a>
                </li>
                <li>
                    <a href="#services" class="group bg-gray-700/80 rounded-full max-w-14">
                        <i class="group-hover:text-white text-gray-400 bi bi-file-earmark-text navicon"></i>
                        <span class="opacity-0 text-white">Servicios</span>
                    </a>
                </li>
                <li>
                    <a href="./catalogo.php" class="group bg-gray-700/80 rounded-full max-w-14">
                        <i class="group-hover:text-white text-gray-400 bi bi-cart navicon"></i>
                        <span class="opacity-0 text-white">Tienda</span>
                    </a>
                </li>
                <li>
                    <a href="#contact" class="group bg-gray-700/80 rounded-full max-w-14">
                        <i class="group-hover:text-white text-gray-400 bi bi-envelope navicon"></i>
                        <span class="opacity-0 text-white">Contacto</span>
                    </a>
                </li>
                <li>
                    <a id="lightModeButton" class="group bg-gray-700/80 rounded-full max-w-14">
                        <i class="text-amber-400 bi bi-sun-fill navicon"></i> 
                        <span class="opacity-0 text-white">light Mode</span>
                    </a>
                </li>
                
            </ul>
        </nav>
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
        <?php require_once './view/inc/about_us.php'; ?>
        <!-- /About Section -->

        <!-- services Section -->
        <?php require_once './view/inc/service.php'; ?>
        <!-- /services Section -->

        <!-- Contact Section -->
        <?php require_once './view/inc/contact.php'; ?>
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
    
    <script src="view/js/sweetalert2.min.js"></script>
    <script src="view/js/customSwAlert.js"></script>
    <script src="view/js/renderCatalogo.js"></script>
    <script src="view/js/catalogo.js"></script>
    <script src="view/js/carousell.js"></script>
    <script src="view/js/index.js"></script>
    <script src="view/js/dark_mode.js"></script>

    <script src="./view/vendor/aos/aos.js"></script>
    <script src="./view/js/main.js"></script>


    
    <script type="text/javascript">
        function toggleNavbar() {
            const ul = document.getElementById('toggleNavbar');
            const aUl = document.querySelectorAll('#toggleNavbar a');
            const span_A_Ul = document.querySelectorAll('#toggleNavbar a span');
            const btnToggleNav = document.querySelector('#btnToggleNav i');


            if (ul.classList.contains('w-[5rem]')) {
                // ajuste de width navmenu

                ul.classList.remove('w-[5rem]');
                ul.classList.add('w-[15rem]');

                btnToggleNav.classList.remove('bi-arrow-right');
                btnToggleNav.classList.add('bi-arrow-left');

                aUl.forEach((a) => {
                    a.classList.remove('max-w-14');
                    a.classList.add('max-w-[15rem]');
                });
                
                span_A_Ul.forEach((span) => {
                    span.classList.remove('opacity-0');
                    span.classList.add('show-span');
                });
            }else{
                
                btnToggleNav.classList.add('bi-arrow-right');
                btnToggleNav.classList.remove('bi-arrow-left');

                aUl.forEach((a) => {
                    a.classList.add('max-w-14');
                    a.classList.remove('max-w-[15rem]');
                });
                
                span_A_Ul.forEach((span) => {
                    span.classList.remove('show-span');
                    span.classList.add('opacity-0');
                });

                // ajuste de width navmenu
                ul.classList.add('w-[5rem]');
                ul.classList.remove('w-[15rem]');
            }

        }

    </script>


</body>

</html>