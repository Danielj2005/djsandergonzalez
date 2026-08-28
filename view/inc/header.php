<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="./" class="logo d-flex align-items-center">
      <img src="img/logo.jpeg" alt="">
      <span class="d-none d-lg-block"><?= COMPANY ?></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <?php //if ($_SESSION['dataUsuario']["primer_inicio"] == '0') { ?>
    <?php //} ?>

  </div>


  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Buscar productos" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div> 


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">


      <li class="nav-item">
          <a id="lightModeButton" class="w-full group shadow-md  hover:shadow-cyan-500 bg-gray-700/80 dark:bg-slate-500 transition p-[10px] rounded-full mx-3 cursor-pointer">
              <i class="bi bi-sun-fill navicon rounded-full text-amber-400"></i> 
          </a>
      </li>
      <li class="nav-item dropdown pe-3">

        <button class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2">USER<?php // $_SESSION['dataUsuario']['nombre']." ".$_SESSION['dataUsuario']['apellido']; ?></span>
        </button>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>USER NAME<?php // $_SESSION['dataUsuario']['nombre']." ".$_SESSION['dataUsuario']['apellido']; ?></h6>
            <span>ROL USER<?php // $_SESSION['dataUsuario']['nombreRolUsuario']; ?></span>
          </li>

          <li> <hr class="dropdown-divider"> </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="./mi_perfil.php">
              <i class="bi bi-person"></i>
              <span>Mi Pefil</span>
            </a>
          </li>

          <li> <hr class="dropdown-divider"> </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="./configuracion.php">
              <i class="bi bi-gear-fill"></i>
              <span>Configuración</span>
            </a>
          </li>

          <li> <hr class="dropdown-divider"> </li>

          <li>
            <a class="dropdown-item d-flex align-items-center btn-exit-system" href="#!">
              <i class="bi bi-box-arrow-right"></i>
              <span>Cerrar Sesión</span>
            </a>
          </li>

        </ul>
      </li>
    </ul>
  </nav>
</header>

<div class="msjFormSend"></div>
