<?php

class portafolioModel extends modeloPrincipal {
    

    private static function getTable(string $section) {  
        $table = [
            "hero" => "hero",
            "about" => "about",
            "store" => "store",
            "services" => "servicio",
            "contact" => "contacto",
        ];

        return $table[$section] ?? "";
    }

    public static function getPortafolioData(string $section) {
        $table = self::getTable($section);
        $query = $section == 'hero' || $section == 'about' ? mysqli_fetch_array(modeloPrincipal::consultar("SELECT * FROM $table where id = 1")) : modeloPrincipal::consultar("SELECT * FROM $table");
        return $query;
    }


}
