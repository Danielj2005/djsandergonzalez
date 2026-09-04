<?php

/*----------  Datos del servidor  ----------*/
const SERVER="localhost";
const DB="djsander";
const USER="root";
const PASS="";


// const SERVER="sql300.infinityfree.com";
// const DB="if0_42834236_djsander";
// const USER="if0_42834236";
// const PASS="HZnAGXHXUj9dM";

/*----------  Nombre de la empresa o compañia ----------*/
const PHONE = "5491172041071";
const COMPANY ="DjSanderGonzález";
const TITTLE ="Sander González | DJ & Content Creator";
const SLOGAN ="Todo lo que buscas en un solo lugar";


/*----------  Datos de la encriptacion (No modificar) ----------*/
const METHOD ="AES-256-CBC";
const SECRET_KEY = 'CTS_PRO_2026_SECURITY_99';
const SECRET_IV ='102791';

/*----------  Datos de la conexión PDO (No modificar) ----------*/
const DBA="mysql:host=".SERVER.";dbname=".DB;
$conn = new PDO(DBA, USER, PASS);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
