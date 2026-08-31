<?php

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') {
        $details = $_GET['details'] ?? false;

        // detalles de un producto
        if ($details): 
            $id = $_GET['UID'];
            $path = $_GET['path'] ?? null;
            
            // $phone = $conn->prepare("SELECT telefono FROM users WHERE id = 2");
            // $phone->execute();
            // $number = $phone->fetchAll(PDO::FETCH_ASSOC);
            // $phone = $number[0];
            
            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = $id");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = $products[0];

            // Ruta de la carpeta de imágenes
            $files = explode(",",$products['images']);  
            $quety = $products;
            
        ?>
            <div class="custom-carousel">
                <div class="carousel-track-container">
                    <ul class="carousel-track" id="carouselTrack">
                        <?php foreach ($files as $file) { ?>
                            <li class="carousel-slide ${active}">
                                <img src=".<?= $file ?>" onerror="this.onerror=null; this.src='./img/404.png';" onerror="this.src='ruta/imagen-no-encontrada.jpg'">
                            </li>
                        <?php  } ?>
                    </ul>
                </div>
                <?php if (count($files) > 1) { ?>
                    <button class="carousel-button prev-btn" id="prevBtn">&#10094;</button>
                    <button class="carousel-button next-btn" id="nextBtn">&#10095;</button>
                <?php  } ?>
            </div>

            
            <hr class="md:hidden mt-5 mb-3">
            <div class="p-3 text-start border border-slate-800 rounded-3" style="height: fit-content;">
                <h3 class="fw-bold mb-4 text-xl">
                    <?= modeloPrincipal::convert_to_utf8($quety['nombre']) ?>
                </h3>
                <div class="">
                    <div class="bg_badge_precio badge border border-white rounded-5">
                        <span class="fs-5"><?= $quety['precio'] ?></span>
                    </div>
                </div>
                
                <p class="col-12 fw-bold text-muted mb-4 "><?= modeloPrincipal::convert_to_utf8($quety['description']) ?></p>
            </div>

        <?php endif;            
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>