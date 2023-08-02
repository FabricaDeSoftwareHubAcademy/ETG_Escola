<?php
session_start();


require __DIR__."/../vendor/autoload.php";
use App\Entity\Sala;
use App\Entity\CadastroChecklist;
use App\Entity\Imagens;

$objCadastroChecklist = new CadastroChecklist();
$dados = $objCadastroChecklist -> getDados();
$options = '';
foreach ($dados as $row_check ){
    $options .= '<option  class="ops" value="'.$row_check['id_cadastro_checklist'].'"> '.$row_check['nome'].' </option>';
}

if (isset($_POST      ['nome_sala'],
          $_POST      ['andar_sala'],
          $_POST      ['checklist'],
          $_POST      ['descricao_sala'],
          $_POST      ['cor_sala'],
          $_POST      ['btn_submit']    
        ))
        {
            
            $obj_sala = new Sala(
                null,
                $_POST['checklist'],
                $_SESSION['num_matricula_logado'],
                $_POST['andar_sala'],
                $_POST['descricao_sala'],
                $_FILES['imagem_sala'],               
                $_POST['cor_sala'],
                null,
                $_POST['nome_sala'],
                null,
                null,
                null
            );
            if ($obj_sala -> cadastrar())
            {
                //die('teste');

                //var_dump($_FILES);exit;
                if (!empty($_FILES['imagem_sala']['name']))
                {
                    $objImagem = new Imagens;
                    $objImagem -> storeImg($_FILES['imagem_sala']['name']);
                    
                }
                else
                {
                    die('a imagem nao foi armazenada!');
                }
                
            }
        }   
        ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de salas</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https/cdnjs.cloudflare.comlibs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/cadastro_edicao_salas.css"> 
    <script src="https://code.jquery.com/jquery-3.7.0.js"integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="crossorigin="anonymous"></script>

    
</head>

<body class="tela-cadastro-salas">
    <?php include_once("../includes/menu.php");?> 
    <section class="container">
        <div class="container-cadastro-salas">
            <div class="wrap-cadastro-salas">

                <form class="cadastro-sala-form" method="POST" enctype="multipart/form-data" >
                    <div class="titulo_de_cadastro">

                        <h1> Cadastro de salas </h1>
                        
                    </div>
                    
                    <div class="wrap-input margin-top-35 margin-bottom-35">



                        <div class="input_group field">
                            <input type="input" class="input_field" placeholder="Name" required="" name="nome_sala">
                            <label for="name" class="input_label">Nome Da Sala </label> <!--Alterar para o nome do input-->
                        </div>



                    </div>

                    <div class="wrap-input margin-top-35 margin-bottom-35">



                        <div class="input_group field">
                            <input type="input" class="input_field" placeholder="Name" required="" name="andar_sala">
                            <label for="name" class="input_label">Andar Da Sala</label> <!--Alterar para o nome do input-->
                        </div>



                    </div>
                    
                    <div class="dropdown-ck">

                        <select name="checklist" class="option">

                            <?=$options?>
                            
                        </select> 

                        
                    
                    
                    </div>

                        <div class="barra"></div>
                       

                    
                    <div class="img-area"> 
                        
                        <div class="text-area">
                            <span id=descrição>Descrição</span>
    
                            <textarea  placeholder="Area de texto " name="descricao_sala" id="" cols="70" rows="10" class="text-descricao"></textarea>
                        </div>
                        <div class="cor-sala">
                            <div class="alinar-img">
                                <span id="img-text"> Insira a imagem : </span>
                                <div class="area-anexo">

                                    
                                    <img id="camera_imagem" class="imagem_aparecer" src="../assets/imgs/others/camera.png" alt="">

                                    <img  class="imagem_agora_vai" src="" alt="">

                                </div>
                            </div>    
                            <div class="alinar-botao-cor">
                                <span id="selecao-cor-text">Cor da sala : </span> 
                                <input class="botao-cor" name="cor_sala" type="color">
                            </div>
                        </div>
      
                        <label id="botão-img" for="arquivo" onclick="removerCSS()" >Enviar Fotos</label>

                        <input type="file" name="imagem_sala" id="arquivo" onchange="previewImagem()">
                            
                        
                        

                            

                               
        
                                

                    </div>
                    
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                            <a href="#"><input type="submit" class="botao-voltar-submit"  value="VOLTAR"></a>
                        </div>
                        
                        <div class="botao-padrao-cadastrar">
                            <a href="#"><input name="btn_submit" type="submit" class="botao-cadastrar-submit"  value="CADASTRAR"></a>
                        </div>
                        
                    </div>  
                </form>  
            </div>
        </div>
    </section>


    <script>

function previewImagem(){

    var imagem = document.querySelector('input[name=imagem_sala]').files[0];
    var preview = document.querySelector('img[class=imagem_agora_vai]');
    var reader = new FileReader();
    const camera = document.querySelector(".imagem_aparecer");
    
    reader.onloadend = function(){
        preview.src = reader.result;
        camera.classList.add("active");
        preview.classList.add("active");
    } 
    if(imagem){
        reader.readAsDataURL(imagem);
        
        
    }else{
        preview.src = "";

    }   
}

// function removerCSS(){

//     var remover = document.getElementById("camera_imagem");
//     remover.classList.remove("imagem_aparecer");

// }

// function adicionarCSS(){

//     var adicionarCSS = document.getElementsByClassName("imagem_agora_vai")
//     adicionarCSS.classList.add("novo_css");
// }

</script>


    
</body>
</html>