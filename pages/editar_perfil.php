<?php
session_start();
require __DIR__."/../vendor/autoload.php";
$titulo_page = 'Editar Perfil';
require("../includes/header/header.php");


use App\Entity\Perfil;
$objeto_perfil = new Perfil();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
}
//Se o botao_salvar e o nome do cargo estiverem setados

$dados = $objeto_perfil -> getDadosById($id);
$nome = $dados[0] ['nome'];
$gerenciar_perguntas = $dados[0] ['gerenciar_perguntas'];
$gerenciar_salas = $dados[0] ['gerenciar_salas'];
$realizar_acao_corretiva = $dados[0] ['realizar_acao_corretiva'];
$realizar_checklist = $dados[0] ['realizar_checklist'];
$gerenciar_checklist = $dados[0] ['gerenciar_checklist'];
$gerenciar_recados = $dados[0] ['gerenciar_recados'];
$gerenciar_notificacoes = $dados[0] ['gerenciar_notificacoes'];
$gerenciar_usuarios = $dados[0] ['gerenciar_usuarios'];
$gerenciar_perfis = $dados[0] ['gerenciar_perfis'];


include_once("../includes/menu.php"); 
require("../includes/main/main_editar_perfil.php");
require("../includes/footer/footer.php");
?>