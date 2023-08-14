<?php
session_start();
if(!isset($_SESSION['num_matricula_logado'])){
 
    header('Location: ../');
}
include_once("../includes/menu.php");

require ("../vendor/autoload.php");
use App\Entity\Perfil;

//pegando dados perfil
$objPerfil = new Perfil;
$dados_perfil = $objPerfil -> getDados();

$imprimir = '';
//var_dump($usuario_perfil);exit;
foreach ($dados_perfil as $row_perfil)
{
    $imprimir .= '
                    <li>
                        <div class="titulo_gp">
                            <div class="card_perfil">
                                <img src="../assets/imgs/icons/profile.png" alt="icone_perfil" id="icone_perfil">
                                <div class="card_nome">
                                    <h2 class="tipo_perfil">'.$row_perfil['nome_cargo'].'</h2>
                                </div>
                                
                                <a href="../pages/edicao_perfil.php?id='.$row_perfil['id_cadastro_perfil'].'"><img src="../assets/imgs/icons/icon_editar.png" alt="icone_editar" class="icone_editar"></a> 
                                <i class="bi bi-trash" onclick="openPopup_Conf('.$row_perfil['id_cadastro_perfil'].')"></i>
                            </div>
                        </div>
                    </li> 
                ';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerencimento_perfis</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilo_gerenc_perfis.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../includes/pop-ups/pop_ups_confirm_excluir_perfil/pop_ups_confirmacao.css">
        <script src="../includes/pop-ups/pop_ups_confirm_excluir_perfil/pop_ups_confirmacao.js"></script>
        <script src="../assets/js/deletar_perfil.js"></script>
        <link rel="stylesheet" href="../includes/pop-ups/pop_ups verification_excluir/pop_ups verification_excluir.css">
        <script src="../includes/pop-ups/pop_ups verification_excluir/pop_ups verification_excluir.js"></script>
    
    </head>
    <body class="tela_gerenciam_perfis">
        <main class="pai-de-todos">
                <?php
                //toma essa gambiarra ass luiz
                include_once("../includes/menu.php"); 
                include_once ("../includes/pop-ups/pop_ups_confirm_excluir_perfil/pop_ups_confirmacao.php");
                include_once("../includes/pop-ups/pop_ups verification_excluir/pop_ups verification_excluir.php")
                ?>
            <form action="cadastro_perfil.php" method="GET">
                <div class="container_gp">
                        <h1 class="Perfis">Perfis</h1>
                            <ul class="cardsgerenc">
                                <?=$imprimir?>
                            </ul>
                
                </div>
                <div class="container_gp2">
                        
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                        <a href="listar_salas.php" class="botao-voltar-submit">VOLTAR</a>
                        </div>

                        <div class="botao-padrao-cadastrar">
                            <a href="./cadastro_perfil.php"><input name="btn_submit" type="submit" class="botao-cadastrar-submit"  value="CADASTRAR"></a>
                        </div>
                    </div>  
                        
                </div> 
            </form>
        </main>
    </body>
</html>