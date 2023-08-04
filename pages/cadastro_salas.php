<?php
session_start();


include_once("../includes/menu.php");

require_once("../includes/pop-ups/pop_ups_verification_sala/pop_ups_verification_sala.php");
                    

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
                $_POST['nome_sala']
               
            );
            if ($obj_sala -> cadastrar())
            {
                //die('teste');

                //var_dump($_FILES);exit;
                if (!empty($_FILES['imagem_sala']['name']))
                {
                    //var_dump($_FILES);exit;
                    $nome_arquivo = $_FILES['imagem_sala']['name'];
                    $nova_string = uniqid();
                    
                    //se o arquivo que o usuario inserir for valido (jpg, jpeg, png, gif)
                    if (preg_match('/\.(png|jpe?g|gif)$/i', $nome_arquivo, $matches))
                    {
                        // $matches =  array(2) { [0]=> string(4) ".jpg" [1]=> string(3) "jpg" }
                        // ela armazena a extensao da imagem 
                        $extensao_encontrada = $matches[0]; // jpg, jpeg, png
                        $aleatorizador = $nova_string.$extensao_encontrada;
                        $novo_nome_arquivo = str_replace($extensao_encontrada,
                                                         $aleatorizador,
                                                         $nome_arquivo); //nome_da_imagem 
                        
                        $from = $_FILES['imagem_sala']['tmp_name'];
                        //KKKKKKKKKKKKKKKKKKKKK nao tava funcionando por causa de uma barrafinal KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK
                        $to = '../storage/salas/';
    
                        //echo $from . '<br>' . $to . '<br>' . $novo_nome_arquivo;exit;
                        move_uploaded_file($from, $to.$novo_nome_arquivo);//movendo o arquivo para pasta
    
                        //return true  
                    }
                    else
                    {
                        die('este tipo de arquivo nao e aceito');
                    }
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/cadastro_edicao_salas.css"> 
    <script src="https://code.jquery.com/jquery-3.7.0.js"integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="crossorigin="anonymous"></script>
    <script src="../includes/pop-ups/pop_ups_verification_sala/pop_ups_verification_sala.js"></script>
    <link rel="stylesheet" href="../includes/pop-ups/pop_ups_verification_sala/pop_ups_verification_sala.css">
    
</head>

<body class="tela-cadastro-salas"> 
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

                    <!-- <div class="wrap-input margin-top-35 margin-bottom-35">



                        <div class="input_group field">
                            <input type="input" name="andar_sala">
                            <label for="name" class="input_label">Andar Da Sala</label> <!--Alterar para o nome do input-->
                        <!-- </div>



                    </div> --> 

                    <div class="dropdown-ck">

                        <select name="andar_sala" class="option">

                            <option type="input" name="andar_sala">Primeiro Andar</option>
                            <option type="input" name="andar_sala">Segundo Andar</option>
                            <option type="input" name="andar_sala">Terceiro Andar</option>
                            <option type="input" name="andar_sala">Quarto Andar</option>
                            <option type="input" name="andar_sala">Quinto Andar</option>

                            
                        </select> 
                    
                    
                    </div>

                    <div class="barra"></div>

                    
                    <div class="dropdown-ck">

                        <select name="checklist" class="option">

                            <?=$options?>
                            
                        </select> 

                        
                    
                    
                    </div>

                        <div class="barra"></div>
                       

                    
                    <div class="img-area"> 
                        
                        <div class="text-area">
                            <span id=descrição>Descrição</span>
    
                            <textarea  placeholder="Area de texto " name="descricao_sala" id="" cols="70" rows="10" class="text-descricao" maxLength="255" ></textarea>
                        </div>
                        <div class="cor-sala">
                            <div class="alinar-img">
                                <span id="img-text"> Insira a imagem : </span>
                                <div class="area-anexo">

                                    
                                    <img id="camera_imagem" class="imagem_aparecer" src="../assets/imgs/others/camera.png" alt="">

                                    <img  id="imagem_agora_vai" class="novo_css_imagem" src="" alt="">

                                </div>
                            </div>    
                            <div class="alinar-botao-cor">
                                <span id="selecao-cor-text">Cor da sala : </span> 
                                <input class="botao-cor" name="cor_sala" type="color">
                            </div>
                        </div>
      
                        <label id="botão-img" for="arquivo" >Enviar Fotos</label>

                        <input type="file" name="imagem_sala" id="arquivo" >
                            
                                                                                                           
                    </div>
                    
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                            <a href="#"><input type="submit" class="botao-voltar-submit"  value="VOLTAR"></a>
                        </div>
                        
                        <div class="botao-padrao-cadastrar">
                            <a href="#"><input name="btn_submit" type="submit" class="botao-cadastrar-submit" id="botao-cadastrar-submit" value="CADASTRAR" onclick="openPopupSala()"></a>
                        </div>
                        

                    </div>  

                    
                </form>  
            </div>
        </div>
    </section>


<script>




const remover = document.querySelector(".imagem_aparecer");
const novo_css = document.querySelector(".novo_css_imagem");
$(document).ready(function() {
    $('#arquivo').on('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var aceitados = ['jpg', 'jpeg', 'gif', 'png'];
            if (aceitados.includes(fileExtension)) {
                $('#imagem_agora_vai').attr('src', e.target.result);
                remover.classList.add("active");
                novo_css.classList.add("active");
            } else {
                // Caso a extensão do arquivo não seja suportada, você pode adicionar um comportamento específico aqui, como exibir uma mensagem de erro.
                console.log('Extensão de arquivo não suportada.');
            }
        }
        reader.readAsDataURL(file);
    });
});
</script>


    
</body>
</html>