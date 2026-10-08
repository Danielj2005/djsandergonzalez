<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo de usuario
require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/userModel.php"; 
// Obtener el user agent del cliente
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';


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

						
						<div class="row text-center p-2 justify-content-center">
							<div class="col-12 mb-3">
								<button class="btn btn-success" data-bs-target="#registrar_usuario" data-bs-toggle="modal">
									<i class="bi bi-plus-circle"></i>
									Registrar un Usuario
								</button>
							</div>
						</div>

						<?php if (!preg_match('/iPhone|Android/i', $userAgent)) { ?>

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
						<?php } ?>
					</div>

				
					<?php if (preg_match('/iPhone|Android/i', $userAgent)) { ?>
						
						<div id="containerListProducts" class="text-center col-12 mb-3">
							<div class="grid gap-3 justify-around grid-cols-1 md:grid-cols-4">
								
								<?php 
									$id_usuario = $_SESSION['dataUser']['id'];
									$catalogo = modeloPrincipal::consultar("SELECT * FROM users WHERE id != 1 AND role != 1 AND id != $id_usuario ORDER BY full_name ASC"); 
									$i = 1;
									if (mysqli_num_rows($catalogo) > 0) {
										while ($mostrar = mysqli_fetch_assoc($catalogo)) { ?>


											<div class="bg-[#f6f9ff] mb-3 animate-slide-up border border-slate-800 duration-500 group hover:border-purple-500/50 overflow-hidden rounded-2xl dark:shadow-cyan-500/30 shadow-slate-800/30 shadow-xl transition-all">
												
												<div class="p-3">
													<div class="text-start mb-2 flex items-center justify-between">
														<label class="text-sm dark:text-slate-200 text-slate-700">Nº <?= $i++; ?></label>
														<p class="flex h-[40px] items-center justify-center p-2 rounded-full text-slate-100 w-[40px] <?= ($mostrar["state"] === "1") ? 'bg-emerald-500' : 'bg-red-500' ?>" type="button">
															<i class="bi <?= ($mostrar["state"] === "1") ? 'bi-check-circle' : 'bi-x-circle' ?>"></i>
														</p>
													</div>
													<div class="text-start mb-2 flex items-start justify-start">
														<label class="absolute text-sm text-slate-500">Nombre y apellido: </label>
														<p class="mt-4 text-xl dark:text-slate-200 text-slate-700"><?= $mostrar["full_name"]; ?></p>
													</div>
													<div class="text-start mb-2 flex items-start justify-start">
														<label class="absolute text-sm text-slate-500">Correo: </label>
														<p class="mt-4 text-xl dark:text-slate-200 text-slate-700"><?= $mostrar["correo"]; ?></p>
													</div>
													<div class="text-start mb-3 flex items-start justify-start">
														<label class="absolute text-sm text-slate-500">Teléfono: </label>
														<p class="mt-4 text-xl dark:text-slate-200 text-slate-700"><?= $mostrar["telefono"]; ?></p>
													</div>
													<div class="text-start mb-2 flex items-start justify-start">
														<label class="absolute text-sm text-slate-500">Estado: </label>
														<p class="mt-4 text-xl dark:text-slate-200 text-slate-700"><?= ($mostrar["state"] === "1") ? 'Activo' : 'Inactivo' ; ?></p>
													</div>

													<div class="mb-2 flex items-center justify-center">
														
														<div class="mb-2">
															<button em_size="modal-md" em_trigger="reg" em_icon="bi-pencil-square " em_url="../api/usuario/editar.php?UID=<?= modeloPrincipal::encryptionId($mostrar["id"]); ?>" em_title="Modificar Usuario" 
																type="button" class="rounded-full em_trigger text-sx btn btn btn-warning" data-bs-toggle="modal" data-bs-target="#em_lists">
																	<i class="bi bi-pencil-square"></i>&nbsp;
																	<span class="text-sm">Modificar</span>
															</button>		
														</div>
													</div>
												</div>
											</div>

									<?php }} ?>
								
							</div>
						</div>
					<?php } ?>
					
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