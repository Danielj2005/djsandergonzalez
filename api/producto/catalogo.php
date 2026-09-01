<?php

require_once "../../config/SERVER.php";
require_once "../../model/mainModel.php"; 
require_once "../../model/productModel.php"; 

try {

    $method = $_SERVER['REQUEST_METHOD'];

    // --- OBTENER PRODUCTOS PARA EDITAR (GET) ---
    if ($method === 'GET') {
        
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $per_page = isset($_GET['per_page']) ? max(1, intval($_GET['per_page'])) : 15;

        $offset = ($page - 1) * $per_page;

        // total de productos
        $total_stmt = modeloPrincipal::consultar("SELECT COUNT(*) AS total FROM productos WHERE state = 1");
        $total_row = mysqli_fetch_assoc($total_stmt);
        $total = intval($total_row['total']);

        $catalogo = mysqli_fetch_all(modeloPrincipal::consultar("SELECT id, nombre, precio FROM productos WHERE state = 1 ORDER BY nombre ASC LIMIT $per_page OFFSET $offset")); 
        
        $stmt_categorias = modeloPrincipal::consultar("SELECT nombre FROM categorias WHERE state = 1 ORDER BY nombre ASC");
        $categorias_lista = array_column(mysqli_fetch_all($stmt_categorias, MYSQLI_ASSOC), 'nombre');
        $productosCategorias = []; 


        
        $productos = [];
        // $images = explode(',', $producto[3]);
        // $images = $images[0];
        foreach ($catalogo as $producto) {
            $id = $producto[0];
            $nombre = $producto[1];
            $precio = $producto[2];

            $imagenes = mysqli_fetch_array(modeloPrincipal::consultar("SELECT img_src FROM producto_image WHERE id_producto = $id"))[0]; 
            // $imgsrc = [];
    
            // while ( $img = mysqli_fetch_array($imagenes)){ 
            //     $imgsrc[] = $img['img_src'];
            // }
            // convertimos el array en string para enviarlo al input hidden
            // $imgsrc = explode(",",$imgsrc); 

            $productos[] = [
                "id" => $id,
                "nombre" => ucwords(strtolower($nombre)),
                "precio" => $precio,
                "images" => $imagenes
            ];

        }

        $data = [
            "status" => "success",
            "productos" => json_encode($productos),
            "categorias" => $categorias_lista,
            "total" => $total,
            "per_page" => $per_page,
            "page" => $page,
            "total_pages" => ceil($total / $per_page)
        ];
    
        echo json_encode($data);
    }
    

} catch(PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}