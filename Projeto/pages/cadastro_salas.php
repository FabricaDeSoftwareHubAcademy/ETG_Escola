<?php
include_once("../includes/menu.php");

if (isset($_POST['nome_sala'],
          $_POST['andar_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
          $_POST['nome_sala'],
))

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
    <link rel="stylesheet" href="menu.js">

    
</head>
<html>

<body class="tela-cadastro-salas"> 

    <section class="container">
        
        <div class="container-cadastro-salas">

            
            
            <div class="wrap-cadastro-salas">

                <form class="cadastro-sala-form" method="POST" action="">
                    <div class="titulo_de_cadastro">

                        <h1> Cadastro de salas </h1>
                        
                    </div>
                    
                    <div class="wrap-input margin-top-35 margin-bottom-35">



                        <div class="input_group field">
                            <input type="input" name="nome_sala" class="input_field" placeholder="Name" required="" name="nome_sala">
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

                        <input type="text" class="textbox-ck"
                        placeholder="Selecione o Checklist" readonly>
                        
                        <div class="option">
                            <div onmouseover="show('Checklist 1')" class="ops" > Checklist 1</div>
                            <div onmouseover="show('Checklist 2')" class="ops" > Checklist 2</div>
                            <div onmouseover="show('Checklist 3')" class="ops" > Checklist 3</div>
                            <div onmouseover="show('Checklist 4')" class="ops" > Checklist 4</div>
                            <div onmouseover="show('Checklist 5')" class="ops" > Checklist 5</div>
                        </div>
                        <script>
                        function show(anything){
                            document.querySelector('.textbox-ck').value = anything
                        }
                        let dropdown = document.querySelector('.dropdown-ck');
                        dropdown.onclick = function(){
                            dropdown.classList.toggle('active');
                            
                        }
                    </script> 
                    </div>  
                    
                    <div class="img-area">
                        



                        <div class="text-area">
                            <span id=descrição>Descrição</span>
    
                            <textarea  placeholder="Area de texto " name="descricao_sala" id="" cols="70" rows="10" class="text-descricao"></textarea>
                        </div>
                        <div class="cor-sala">
                            <div class="alinar-img">
                                <span id="img-text"> Insira a imagem : </span>
                                <div class="area-anexo"> <img src="../assets/imgs/others/camera.png" alt="" id="icon-fotos">  </div>
                            </div>    
                            <div class="alinar-botao-cor">
                                <span id="selecao-cor-text">Cor da sala : </span> 
                                <input class="botao-cor" type="color" name="btn_cor">
                            </div>
                        </div>
                        
                        
                        
                        
                        <label id="botão-img"for="arquivo" >Enviar Fotos</label>

                        <input type="file" name="ft_sala" id="arquivo">
                            

                            

                               
        
                                

                    </div>
                    
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                            <a href="#"><input type="reset" class="botao-voltar-submit"  value="VOLTAR"></a>
                        </div>
                        
                        <div class="botao-padrao-cadastrar">
                            <a href="#"><input type="submit" class="botao-cadastrar-submit"  value="CADASTRAR"></a>
                        </div>
                        
                    </div>





                    
                
                </form>  
            </div>
        </div>
    </section>





    
</body>


</html>