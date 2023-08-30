
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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">

    
</head>

<body class="tela-cadastro-salas">
       

    <section class="container">
   
        <div class="container-cadastro-salas">
            <div class="wrap-cadastro-salas">

                <form class="cadastro-sala-form" method="POST" enctype="multipart/form-data" >

                    

                    <div class="titulo_de_cadastro">

                        <h1> Cadastro De Salas </h1>
                        
                    </div>
                    
                    <div class="wrap-input margin-top-35 margin-bottom-35">



                        <div class="input_group field">
                            <input type="input" class="input_field" placeholder="Name" required="" name="nome_sala" maxLength="32">
                            <label for="name" class="input_label">Nome Da Sala </label> <!--Alterar para o nome do input-->
                        </div>



                    </div>


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
                        <option>Selecione O Checklist </option>

                            <?=$options?>
                            
                        </select> 
                                     
                    </div>

                    <div class="barra"></div>

                    <h3 class="alinar_titulo_h3">Dias De Funcionamento </h3>

                    <div class="area_Dos_check_box">
                        
                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Segunda</p>
                            <input name="segunda" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Terça</p>
                            <input name="terca" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Quarta</p>
                            <input name="quarta" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Quinta</p>
                            <input name="quinta" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Sexta</p>
                            <input name="sexta" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Sábado</p>
                            <input name="sabado" class="espaco_check_box" type="checkbox" />
                        </div>

                        
                    </div>


                    <h3 class="alinar_titulo_h3">Turnos De Funcionamento </h3>
                    <div class="area_Dos_check_box">

                        
                        
                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Matutino</p>
                            <input name="matutino" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Vespertino</p>
                            <input name="vespertino" class="espaco_check_box" type="checkbox" />
                        </div>

                        <div class="Check_Box_individual">
                            <p class="coisa_tag_p">Noturno</p>
                            <input name="noturno" class="espaco_check_box" type="checkbox" />
                        </div>

                    </div>
                    
                    <div class="img-area"> 
                        
                        <div class="text-area">
                            <span id=descrição>Descrição</span>
    
                            <textarea  placeholder="Area de texto " name="descricao_sala" id="" cols="70" rows="10" class="text-descricao" maxLength="254"></textarea>
                        </div>
                        <div class="cor-sala">
                            <div class="alinar-img">

                                <div class="coisas_enilda">
                                    <span id="img-text"> Insira a imagem : </span>

                                    <label id="botão-img" for="arquivo" >Selecionar Foto</label>
                                </div>
                                
                                <input type="file" name="imagem_sala" id="arquivo" >

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
      
                        
                            
                                                                                                           
                    </div>
                    
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                            <a href="#"><input type="submit" class="botao-voltar-submit"  value="VOLTAR"></a>
                        </div>
                        
                        <div class="botao-padrao-cadastrar">
                            <a href="#"><input name="btn_submit" type="submit" class="botao-cadastrar-submit" id="botao-cadastrar-submit" value="CADASTRAR" onclick="abrir_modal()" ></a>
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





        function abrir_modal(){
            Swal.fire({
                title: 'Cadastrado com sucesso!', //TITULO DO POP_UP DE ACORDO COM SUA TELA 
                icon: 'success', // success, error e warning
                confirmButtonColor: '#609437', // DEFINE A COR DO BOTÃO OK
                confirmButtonText: 'OK'
            });
        }
    
</script>


    
</body>
</html>