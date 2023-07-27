<?php
 
// require autoload = 0 bugs 
require __DIR__."/../vendor/autoload.php";
use App\Entity\Usuario;



// teste 
// $obUser = new Usuario(2,'joao@gmail.com',123);
// $obUser->getRecados();

// require menu 
require_once("../includes/menu.php");


// pegando informações dos recados 
$user = new Usuario('2','joao@gmail.com','123');
    $recados = $user->getRecados()->fetchAll(PDO::FETCH_ASSOC) ?  $user->getRecados()->fetchAll(PDO::FETCH_ASSOC) : "";

    $cards_recados = '';

    foreach($recados as $row_recados){

        $cards_recados .= '<div class="card">
                                <p class="msg_aviso">'.$row_recados['descricao'].'</p>
                                <div class="area_bot">

                                    <div class="bloco_bot">

                                        <a href="editar.php?id_recado='.$row_recados['id_recado'].'"><img src="../assets/imgs/icons/btn_editar.png"></a>
                                        <a href="excluir.php?id_recado='.$row_recados['id_recado'].'"><img src="../assets/imgs/icons/icon_trash.png"></a>

                                    </div>

                                </div>
                            </div>';


     }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural de Recados</title>
    <link rel="stylesheet" href="../assets/css/mural.css"> 
    
</head>
<body class="body_mural">

<div class="area_cards_recados_mural">
    
    <!-- cards recados  -->
    <?=$cards_recados?>

    <!-- botão para add recado caso seja adm(requer condicional)   -->
    <div class="area_btn_add">
    
        <a href="add_aviso.php"><img class="img_btn_add" src="../assets/imgs/icons/btn_add.png" alt=""></a>

    </div>
</div>
<div class="centralizar_btn">

    <div class="botao-padrao-inicio">
        <a href="#"><input type="reset" class="botao-inicio-submit"  value="INÍCIO"></a>
    </div>

</div>

</body>
</html>