<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/productModel.php"; // se incluye el model producto
require_once "../model/categoryModel.php"; // se incluye el model de categorias


$estado = (!isset($_POST['estado_rol'])) ? '1' : $_POST['estado_rol'];
$catalogo = modeloPrincipal::consultar("SELECT id FROM productos WHERE state = 1"); 


$titleCards = [
    "Usuarios",
    "Inventario",
    "Ventas",
    "Bitácora",
    "Configuración"
];
$iconCards = [
    "bi-people",
    "bi-box-seam-fill ",
    "bi-currency-dollar",
    "bi-clock-history",
    "bi-gear"
];


$cantRegCards = [
    "1",   
    "46",   
    "44",  
    "100",
    "1"
];

$footerCard = [
    "Usuarios registrados",
    "Productos registrados",
    "Ventas registradas",
    "Movimientos del sistema.",
    "Configuración del sistema"
];

$path = [
    "/user",
    "/plan",
    "/payments",
    "/binnacle",
    "/setting"
];

if ($_SESSION['logged_in'] === true) { ?>

    <!DOCTYPE html>
    <html lang="es" class="dark">

    <head>
        
        <?php require_once "./inc/meta.php"; ?>
        <!-- titulo -->
        <title><?= TITTLE ?></title>

        <?php require_once "./inc/css.php"; ?>
    </head>

    <body class="">
        
        <?php
            require_once "./inc/header.php";
            require_once "./inc/adminSideBar.php";
        ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1> Panel de Control </h1>
            </div>

            <section class="dashboard">
                <div class="row">
                    <?php foreach($titleCards as $index => $title) {  ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card bg- text-">
                                <div class="card-body">
                                    <h5 class="card-title "> <a href="<?= $path[$index]; ?>"> <?= $title; ?> </a> </h5>
                                    
                                    <h2 class="card-text">
                                        <i class="fs-1 bi <?= $iconCards[$index]; ?>"></i>&nbsp; <?= $cantRegCards[$index]; ?>
                                    </h2>
                                    <p class="card-text"><small><?= $footerCard[$index]; ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </section>
        </main>


        <div class="msjFormSend"></div>

        
        <?php
        //   include_once "./modal/plantillaModalCustom.php";

        include_once "./inc/footer.php";
        include_once "./inc/scripts_include.php";

        // model_user::validar_sesion_activa($id_usuario);

        //   config_model::verificar_actualizacion_configuracion(); 
        ?>
    </body>

    </html>
<?php }else{
    header("location: ../");
}
?>
