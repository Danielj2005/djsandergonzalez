<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/userModel.php"; 

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

				<div class="pagetitle">
					<a class="btn btn-outline-secondary mb-3" href="./">
						<i class="bi bi-chevron-left"></i> 
						<span>Volver al Panel Principal</span>
					</a>
					<h1 class="dark:text-slate-400 text-center fs-1 my-1">Gestión de Usuarios</h1>
				</div>

				<section class="section dashboard">
					<div class="dark:bg-slate-800 card rounded-2 p-2 text-center">

						<h2 id="" class="dark:text-slate-400 mb-3 fs-2 col-12 fw-bold card-title">Lista de Usuarios</h2>

						
						<div class="row text-center p-2 justify-content-center">
							<div class="col-12 mb-3 col-md-6">
								<button class="btn btn-success" data-bs-target="#registrar_usuario" data-bs-toggle="modal">
									<i class="bi bi-plus-circle"></i>
									Registrar un Usuario
								</button>
							</div>
							<div class="col-12 mb-3 col-md-6">
								<button em_size="modal-lg" em_trigger="list" em_icon="bi-list-columns-reverse" em_url="../api/usuario/lista.php?UID=0" em_title="Lista de Usuarios Inactivos" 
									type="button" class="em_trigger text-sm btn btn btn-danger" 
									data-bs-toggle="modal" data-bs-target="#em_lists">
										<i class="bi bi-list-columns-reverse"></i>
										<span>Ver Usuarios Inactivos</span>
								</button>
							</div>
						</div>

						<hr>

						<div class="card-body pb-3">
							<div class="justify-content-between align-items-center table table-responsive dark:text-slate-200">
								<table class="table example mb-3 dark:text-slate-200" id="example">
									<thead>
										<tr>
											<th class="text-center col" scope="col">#</th>
											<th class="text-center col" scope="col">Nombre y Apellido</th>
											<th class="text-center col" scope="col">Correo</th>
											<th class="text-center col" scope="col">Teléfono</th>
											<th scope="col" class="text-center col">Modificar</th>
											<th scope="col" class="text-center col">Estado</th>
										</tr>
									</thead>
									<tbody>
										<?php model_user::lista_de_usuarios(2); ?>  
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</section>
			</main>
			
            <!-- modal Section -->
            <?php 
                // modal usuario Section
                require_once './modal/usuario/registrar.php';
                
                // se incluye el footer / pie de pagina a la vista
                include_once "./inc/footer.php";
                // se incluyen los script de javascript a la vista 
                include_once "./inc/scripts_include.php"; 
            ?>
		</body>
	</html>