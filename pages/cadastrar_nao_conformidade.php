<?php
session_start();
require __DIR__."/../vendor/autoload.php";
include_once("../includes/menu.php"); 
$titulo_page = 'cadastrar nao conformidade';
require("../includes/header/header.php");
require("../includes/main/main_cadastrar_nao_conformidade.php");
//REGRAS DE NEGOCIO ABAIXO



//FIM DAS REGRAS DE NEGOCIO
require("../includes/footer/footer.php");

?>
