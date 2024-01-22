<?php
session_start();
require __DIR__."/../vendor/autoload.php";
include_once("../includes/menu.php"); 
$titulo_page = 'Lista Usuarios';
require("../includes/header/header.php");

use App\Entity\Usuario;

//pegando dados perfil
$obUser = new Usuario;
$dados_user = $obUser -> getDados();
$imprimir = '';

//var_dump($dados_user);exit;
foreach ($dados_user as $row_user)
{
    //var_dump($row_user);exit;
    $imprimir .= '
    <li>
        <div class="titulo_gp">
            <div class="card_perfil">
  
                <div class="card_nome">
                    <h2 class="tipo_perfil">'.$row_user["nome"].'</h2>
                </div>
    
                <a href="/ETG_Escola/pages/editar_usuarios.php?id='.$row_user["id"].'"><img src="../assets/imgs/icons/icon_editar.png" alt="icone_editar" class="icone_editar"></a> 
                <a class="bi bi-trash" href="actions/perfil_delete_action.php?id='.$row_user["id"].'"></a> 
            </div>
        </div>
    </li>';

}
                        
require("../includes/main/main_visualizar_usuarios.php");
require("../includes/footer/footer.php");
?>
