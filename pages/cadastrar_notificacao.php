<?php
require __DIR__."/../vendor/autoload.php";
require("../includes/header/header.php");

use app\Entity\Notificacao;
use app\Entity\Usuario;


//REGRAS DE NEGOCIO ABAIXO

if (isset($_POST['btn_submit']))
{
    die('btn setado');
    $id_remetente = '1'; //VAI PEGAR DA SESSION O ID DO USUARIO
    $email_destinatario = $_POST['email_destinatario']; //email 
    $texto = $_POST['descricao'];
} 

$usuarios = Usuario::getDados();
var_dump($usuarios);exit;

//Notificacao::getDados()


// Notificacao::cadastrar($id_remetente);


//FIM DAS REGRAS DE NEGOCIO
include_once("../includes/menu.php"); 
require("../includes/main/main_cadastrar_notificacao.php");
require("../includes/footer/footer.php");
?>