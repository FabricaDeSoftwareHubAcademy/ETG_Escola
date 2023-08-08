<?php
session_start();
ob_start();
 

if(!isset($_SESSION['num_matricula_logado'])){
 
    header('Location: ../');
}
 
require __DIR__."/../vendor/autoload.php";
use App\Entity\Sala;

require_once("../includes/menu.php");




$salas = "";
$dados = Sala::getSalas();
 
$count = 0;
foreach($dados as $sala){

    if($count == 0){


        $salas .= '<div class="card_sala">
    
                        <div class="border_card_sala" style="
                        border: 2px solid '.$sala['cor'].'"></div>
                        <a class="click_sala" href="visualizar_sala.php?id_sala='.$sala['id_cadastro_sala'].'"><img class="img_card_sala" src="../storage/salas/'.$sala['imagem'].'" alt=""></a>
                        <a href="editar_salas.php?id_sala='.$sala['id_cadastro_sala'].'"><img class="icon_editar_sala" src="../assets/imgs/icons/btn_editar.png" alt=""></a>
                        <div class="area_title_sala">
    
                            <h1 class="title_sala">Laboratório 303 da cozinha par d</h1>
                        </div>
    
                    </div>';

        $count = 1;
    }else{

        $salas .= '<div class="card_sala">
    
                    <div class="border_card_sala2" style="
                    border: 2px solid '.$sala['cor'].'"></div>
                    <a class="click_sala" href="visualizar_sala.php?id_sala='.$sala['id_cadastro_sala'].'"><img class="img_card_sala" src="../storage/salas/'.$sala['imagem'].'" alt=""></a>
                    <a href="editar_salas.php?id_sala='.$sala['id_cadastro_sala'].'"><img class="icon_editar_sala" src="../assets/imgs/icons/btn_editar.png" alt=""></a>
                    <div class="area_title_sala2">

                        <h1 class="title_sala2">Laboratório 303 da cozinha par d</h1>
                    </div>

                </div>';
        $count = 0;
    }

}



?>

<!-- nome da sala cabe 32 caracteres  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/listar_salas.css"> 
</head>
<body class="body_listar_salas">

    <h1 class="title_listar_salas">Salas</h1>

    <div class="area_salas">

        <?=$salas?>

    </div>

        <!--Botão IR PARA MURAL DE AVISOS-->
        <div class="centralizar_btn">
            <div class="botao-padrao-mural-aviso">
                <a href="#"><input type="submit" class="botao-mural-aviso-submit"  value="MURAL DE AVISOS"></a>
            </div>
        </div>


    
</body>
</html>