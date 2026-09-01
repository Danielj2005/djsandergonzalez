<header id="header" class="gap-3 align-items-center d-flex fixed-top header justify-content-around px-3 dark:bg-slate-800 dark:shadow-sm dark:shadow-slate-300/20">

    <div class="d-flex align-items-center justify-content-between d-non d-lg-block">
        <a href="./" class="logo d-flex align-items-center">
            <img class="rounded-full" src="./view/img/logo.webp" alt="Logo de <?= COMPANY ?>">
            <span class="dark:text-slate-200 "><?= COMPANY ?></span>
        </a>
    </div>


    <div class="search-br w-100">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input class="dark:bg-slate-200 dark:text-black " type="text" name="query" placeholder="Buscar Productos..." title="buscador de productos" oninput="handleSearch(this.value)">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>


    <div class="w-100">
        <a id="lightModeButton" class="w-100 group shadow-md hover:shadow-slate-500 dark:hover:shadow-amber-500 bg-gray-700/80 dark:bg-slate-500 transition p-[10px] rounded-5 mx-3 cursor-pointer">
            <i class="bi bi-sun-fill navicon rounded-full text-amber-400"></i> 
        </a>
    </div>
    <div class="d-flex align-items-center">
        <a href="./login.php" class="dark:text-slate-200 nav-link d-flex align-items-center">
            <i class="bi bi-person-circle fs-3"></i>
            <span class="ms-2">Login</span>
        </a>
    </div>
</header>
<div class="msjFormSend"></div>
