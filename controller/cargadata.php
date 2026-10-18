<?php 
session_start();

require_once "../config/SERVER.php";
require_once "../model/mainModel.php"; // se incluye el model principal
require_once "../model/alertModel.php"; // se incluye el model de alertas

    /* 
    I am DJ for +6 years | Content Creator
    Events | Bars | Private Party`s
    ./view/img/logo.webp
    ./view/img/djsander2.webp
    */

    $titulo = "I am DJ for +6 years | Content Creator";
    $subtitulo = "Events | Bars | Private Party`s";
    $imageLogo = "./view/img/ce9abf00f5498e45b7140862f8fa327b.webp";
    $imageBg = "./view/img/9d9f4f8fd267ae311bc613e19fd6c8fd.webp";

$actualizar = modeloPrincipal::UpdateSQL(
    "hero", 
    "titulo = '$titulo', subtitulo = '$subtitulo', logo = '$imageLogo', bg_image = '$imageBg'", 
    "id = 1");
