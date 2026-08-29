<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/productModel.php"; // se incluye el model producto
require_once "../model/categoryModel.php"; // se incluye el model de categorias

$dataCards = [
    [
        "titulo" => "Usuarios", 
        "icon" => "bi-people", 
        "footer" => "Usuarios registrados", 
        "tabla" => "users", 
        "url" => "./usuarios.php"
    ],
    [
        "titulo" => "Productos",
        "icon" =>  "bi-box-seam-fill ", 
        "footer" => "Productos registrados",
        "tabla" => "productos", 
        "url" => "./gestion_productos.php"
    ]
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

    <body class="dark:bg-gray-900 bg-gray-400/20 ">
        
        <?php
            require_once "./inc/header.php";
            require_once "./inc/adminSideBar.php";
        ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1 class="dark:text-slate-400 "> Panel de Control </h1>
            </div>

            <section class="dashboard">
                <div class="row">
                    <?php 
                        foreach($dataCards as $index => $data) {  
                            $query = modeloPrincipal::consultar("SELECT id FROM ".$data['tabla'].""); 
                            $cant_reg = mysqli_num_rows($query); 

                    ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="dark:bg-slate-200 card">
                                <div class="card-body">
                                    <h5 class="card-title "> <a href="<?= $data["url"]; ?>"> <?= $data["titulo"]; ?> </a> </h5>
                                    
                                    <h2 class="card-text fs-1">
                                        <i class=" bi <?= $data["icon"]; ?>"></i>&nbsp; <?= $cant_reg; ?>
                                    </h2>
                                    <p class="card-text"><small><?= $data["footer"]; ?></small></p>
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
