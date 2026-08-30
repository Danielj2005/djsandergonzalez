<aside id="sidebar" class="sidebar dark:bg-slate-800 dark:shadow-md dark:shadow-slate-300">

    <ul id="sidebar-nav" class="sidebar-nav">
        <!-- apartado de página principal -->
        <li class="nav-item ">
            <a class="bg-[#f6f9ff] dark:bg-slate-800 dark:shadow-slate-300/80 dark:text-slate-300 flex gap-2 hover:bg-slate-600 p-2 rounded-3 shadow-md" href="./">
                <i class="bi bi-speedometer2"></i>
                <span>Panel de Control</span>
            </a>
        </li>

        <li class="nav-item position-relative">
            <details class="group">
                <!-- Encabezado / Botón disparador -->
                <summary class=" bg-[#f6f9ff] dark:bg-slate-800 justify-between dark:shadow-slate-300/80 dark:text-slate-300 gap-2 rounded-3 shadow-md flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center space-x-3">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Inventario</span>
                    </div>
                    <!-- Flecha que rota al abrir -->
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200 group-open:rotate-180"></i>
                </summary>

                <!-- Contenido colapsable -->
                <ul class="bg-[#f6f9ff] -translate-y-2 dark:bg-slate-800 dark:text-slate-300 delay-300 pb-2 pl-2 pt-2 rounded-bottom-3 shadow-md dark:shadow-slate-500 space-y-1 transition-all">
                    
                    <li class="hover:bg-slate-500/40 p-1 rounded-xl group">
                        <a class="dark:text-white hover:text-slate-200 text-slate-800" href="./gestion_productos.php">
                            <i class="bi bi-caret-right text-sm"></i>
                            <span>Gestión de Productos</span>
                        </a>
                    </li>
                    
                    <li class="d-none hover:bg-slate-500/40 p-1 rounded-xl group">
                        <a class="hover:text-slate-800 text-slate-800" href="./entrada_de_productos.php">
                            <i class="bi bi-caret-right"></i>
                            <span>Registro de Compras</span>
                        </a>
                    </li>

                    <li class="d-none hover:bg-slate-500/40 p-1 rounded-xl group">
                        <a class="hover:text-slate-800 text-slate-800" href="./proveedor.php">
                            <i class="bi bi-caret-right"></i>
                            <span>Gestión de Proveedores</span>
                        </a>
                    </li>
                </ul>
            </details>
        </li>

        <li class="nav-item position-relative d-none">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-currency-dollar"></i>
                <span>Caja / Ventas</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="./generar_venta.php">
                            <i class="bi bi-circle"></i>
                            <span>Generar venta</span>
                        </a>
                    </li>

                    <li>
                        <a href="./venta.php">
                            <i class="bi bi-circle"></i>
                            <span>Historial de Ventas</span>
                        </a>
                    </li>

            </ul>
        </li>

        <li class="nav-item position-relative">
            <details class="group">
                <!-- Encabezado / Botón disparador -->
                <summary class=" bg-[#f6f9ff] dark:bg-slate-800 dark:shadow-slate-300/80 dark:text-slate-300 gap-2 rounded-3 shadow-md flex items-center justify-between p-2 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center space-x-3">
                    <i class="bi bi-people-fill"></i>
                    <span>Gestión de Usuarios</span>
                    </div>
                    <!-- Flecha que rota al abrir -->
                    <i class="bi bi-chevron-down text-sm transition-transform duration-200 group-open:rotate-180"></i>
                </summary>

                <!-- Contenido colapsable -->
                <ul class=" bg-[#f6f9ff] -translate-y-2 dark:bg-slate-800 dark:text-slate-300 delay-300 pb-2 pl-2 pt-2 rounded-bottom-3 shadow-md dark:shadow-slate-500 space-y-1 transition-all">
                    
                    
                    <!-- modulo de clientes -->
                    <li class="d-none hover:bg-slate-500/40 p-1 rounded-xl "> 
                        <a class="hover:text-slate-800 text-slate-800" href="./cliente.php">
                            <i class="bi bi-caret-right"></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                    
                    <li class="hover:bg-slate-500/40 p-1 rounded-xl "> 
                        <a class="dark:text-white hover:text-slate-200 text-slate-800" href="./usuarios.php">
                            <i class="bi bi-caret-right"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>


                    <li class="d-none hover:bg-slate-500/40 p-1 rounded-xl "> 
                        <a class="hover:text-slate-800 text-slate-800" href="./roles.php">
                            <i class="bi bi-caret-right"></i>
                            <span>Gestión de Roles</span>
                        </a>
                    </li>

                </ul>
            </details>
        </li>

        <!-- apartado del perfil de usuario  -->
        <li class="nav-item ">
            <a class="bg-[#f6f9ff] dark:bg-slate-800 dark:shadow-slate-300/80 dark:text-slate-300 flex gap-2 hover:bg-slate-600 p-2 rounded-3 shadow-md" href="./mi_perfil.php"> <i class="bi bi-person-fill"></i> <span>Mi Perfil</span> </a>
        </li>

        <li class="nav-item position-relative d-none">
            <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-gear-fill"></i> <span>Configuración General</span> <i class="bi bi-chevron-down ms-auto"></i> </a>

            <ul id="setting-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="./configuracion.php">
                            <i class="bi bi-circle"></i>
                            <span>Ajustes del Sistema</span>
                        </a>
                    </li>

                    <li>
                        <a href="./bitacora.php">
                            <i class="bi bi-circle"></i>
                            <span>Bitácora</span>
                        </a>
                    </li>
            </ul>
        </li>

        <li class="nav-item"> <button class="bg-[#f6f9ff] dark:bg-slate-800 dark:shadow-slate-300/80 dark:text-slate-300 flex gap-2 hover:bg-slate-600 p-2 rounded-3 shadow-md btn-exit-system"> <i class="bi bi-box-arrow-right"></i> <span>Cerrar Sesión</span> </button> </li>
    </ul>
</aside>