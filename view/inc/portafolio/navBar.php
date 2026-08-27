
<nav id="navmenu" class="navmenu">
    <ul id="toggleNavbar" class="backdrop-blur-md bg-gray-700/30 flex flex-column items-center p-0 pt-4 rounded-3xl sm:w-[15rem] md:w-[5rem] delay-200 ease-in-out transition-all">
        <li class="d-none d-md-block">
            <button id="btnToggleNav" onclick="toggleNavbar()" class="bg-gray-700/80 delay-200 ease-in-out group h-[56px] hover:bg-[#0563bb] mb-2 rounded-full transition-all w-[56px]">
                <i class="group-hover:text-white text-blue-400 bi bi-arrow-right navicon"></i>
            </button>
        </li>
        <li class="">
            <a href="#hero" class="active group sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white bi bi-house navicon"></i>
                <span class="d-block d-md-none text-white">Página Principal</span>
            </a>
        </li>
        <li>
            <a href="#about" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white text-gray-400 bi bi-person navicon"></i>
                <span class="d-block d-md-none text-white">Sobre mí</span>
            </a>
        </li>
        <li>
            <a href="#services" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white text-gray-400 bi bi-file-earmark-text navicon"></i>
                <span class="d-block d-md-none text-white">Servicios</span>
            </a>
        </li>
        <li>
            <a href="./catalogo.php" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white text-gray-400 bi bi-cart navicon"></i>
                <span class="d-block d-md-none text-white">Tienda</span>
            </a>
        </li>
        <li>
            <a href="login.php" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white text-gray-400 bi bi-person-circle navicon"></i>
                <span class="d-block d-md-none text-white">Login</span>
            </a>
        </li>
        <li>
            <a href="#contact" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="group-hover:text-white text-gray-400 bi bi-envelope navicon"></i>
                <span class="d-block d-md-none text-white">Contacto</span>
            </a>
        </li>
        <li>
            <a id="lightModeButton" class="group bg-gray-700/80 rounded-full sm:max-w-[15rem] md:max-w-14">
                <i class="text-amber-400 bi bi-sun-fill navicon"></i>
                <span class="d-block d-md-none text-white">light Mode</span>
            </a>
        </li>

    </ul>
</nav>