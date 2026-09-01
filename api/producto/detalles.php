<?php

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') {
        $details = $_GET['details'] ?? false;

        // detalles de un producto
        if ($details): 
            $id = $_GET['UID'];
            $path = $_GET['path'] ?? null;
                        
            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = $id");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = $products[0];

            // Ruta de la carpeta de imágenes
            $imagenes = mysqli_fetch_array(modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id_producto = $id")); 
            // $files = explode(",",$products['images']);  
            $quety = $products;
            
        ?>
            <div class="col-12 col-md-6 mb-3">
                <div class="custom-carousel">
                    <div class="carousel-track-container">
                        <ul class="carousel-track" id="carouselTrack">
                            <?php foreach ($imagenes as $img => $val) { ?>
                                <li class="carousel-slide ${active}">
                                    <img src="<?= $val ?>" onerror="this.src='ruta/imagen-no-encontrada.jpg'">
                                </li>
                            <?php  } ?>
                        </ul>
                    </div>
                    <?php if (count($imagenes) > 1) { ?>
                        <button class="carousel-button prev-btn" id="prevBtn">&#10094;</button>
                        <button class="carousel-button next-btn" id="nextBtn">&#10095;</button>
                    <?php  } ?>
                </div>
            </div>

            <div class="col-12 col-md-6 p-3 text-start border border-slate-800 rounded-3" style="height: fit-content;">
                <h3 class="dark:text-slate-200 fw-bold mb-4 text-xl">
                    <?= modeloPrincipal::convert_to_utf8($quety['nombre']) ?>
                </h3>
                <div class="mb-3">
                    <div class="bg_badge_precio badge border border-white rounded-5">
                        <span class="fs-5">$ <?= $quety['precio'] ?></span>
                    </div>
                </div>
                
                <p class="dark:text-slate-200 col-12 fw-bold mb-4 "><?= modeloPrincipal::convert_to_utf8($quety['description']) ?></p>
            </div>

        <?php endif;            
    }

    
} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>