<link rel="stylesheet" href="https/cdnjs.cloudflare.comlibs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<link rel="stylesheet" href="../assets/css/cadastrar_editar_sala.css"> 
<script src="https://code.jquery.com/jquery-3.7.0.js"integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="crossorigin="anonymous"></script>

<body class="tela-cadastro-salas"> 

    <section class="container">
        
        <div class="container-cadastro-salas">

            
            
            <div class="wrap-cadastro-salas">

                <form class="cadastro-sala-form" method="POST" enctype="multipart/form-data">
                    <div class="titulo_de_cadastro">

                        <h1> Editar Sala </h1>
                        
                    </div>
                    



                    <div class="cadastro_codigo">


                        <div class="wrap-input margin-top-35 margin-bottom-35">


 
                            <div class="input_group field">
                                <input value="<?=$dados_sala[0]['nome']?>" type="input" class="input_field toguroo" placeholder="Name" required="" name="nome" maxLength="32">
                                <label for="name" class="input_label">Nome Da Sala</label> <!--Alterar para o nome do input-->
                            </div>



                        </div>

                        <div class="wrap-inputx margin-top-35 margin-bottomx-35">



                            <div class="input_group field ">
                                <input type="input" value="<?=$dados_sala[0]['codigo']?>" class="input_field toguro" placeholder="Name" required="" name="codigo" maxLength="8">
                                <label for="name" class="input_label toguro" > Código </label> <!--Alterar para o nome do input-->
                            </div>



                        </div>
                    </div>
                    
                    <div class="dropdown-ck">

                        <select name="checklist" class="option">
                        <?php
                                foreach ($checklists as $id => $nome)
                                {
                                    if ($id == $dados_sala[0]['id'])
                                    {
                                        echo "<option name=\"checklist\" value='$id' selected>$nome</option>";
                                    }
                                    else
                                    {
                                        echo "<option name=\"checklist\" value='$id'>$nome</option>";
                                    }
                                }
                            ?>
                        </select> 

                    </div>

                        <div class="barra"></div>



                    
                        <h3 class="alinar_titulo_h3">Dias De Funcionamento </h3>

                        <div class="area_Dos_check_box">
                            
                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Segunda</p>
                                <input name="segunda" class="espaco_check_box" type="checkbox" <?=($funcionamento['segunda'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Terça</p>
                                <input name="terca" class="espaco_check_box" type="checkbox" <?=($funcionamento['terca'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Quarta</p>
                                <input name="quarta" class="espaco_check_box" type="checkbox" <?=($funcionamento['quarta'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Quinta</p>
                                <input name="quinta" class="espaco_check_box" type="checkbox" <?=($funcionamento['quinta'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Sexta</p>
                                <input name="sexta" class="espaco_check_box" type="checkbox" <?=($funcionamento['sexta'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Sábado</p>
                                <input name="sabado" class="espaco_check_box" type="checkbox" <?=($funcionamento['sabado'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            
                        </div>


                        <h3 class="alinar_titulo_h3">Turnos De Funcionamento </h3>
                        <div class="area_Dos_check_box">

                            
                            
                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Matutino</p>
                                <input name="matutino" class="espaco_check_box" type="checkbox" <?=($funcionamento['turnos']['matutino'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Vespertino</p>
                                <input name="vespertino" class="espaco_check_box" type="checkbox" <?=($funcionamento['turnos']['vespertino'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                            <div class="Check_Box_individual">
                                <p class="coisa_tag_p">Noturno</p>
                                <input name="noturno" class="espaco_check_box" type="checkbox" <?=($funcionamento['turnos']['noturno'] == 'sim' ? 'checked' : NULL)?>/>
                            </div>

                        </div>
                        
                
                       

                    
                    <div class="img-area"> 
                        



                        <div class="text-area">
                            <span id=descrição>Descrição</span>

                            <textarea placeholder="Area de texto " name="descricao" id="textareajs" cols="70" rows="10" class="text-descricao" maxlength="254"><?=$dados_sala[0]['descricao']?></textarea>
                        </div>
                        <div class="cor-sala">
                            <div class="alinar-img">

                                <div class="coisas_enilda">
                                    <span id="img-text"> Insira a imagem : </span>

                                    <label id="botão-img" for="arquivo" >Selecionar Foto</label>
                                </div>
                                
                                <input type="file" name="img_sala" id="arquivo" >

                                <div class="area-anexo"> 

                                    
                                    <img id="camera_imagem" class="imagem_aparecer_editar" src="../storage/salas/<?=$dados_sala[0]['img_sala']?>" alt="">

                                    <img  id="imagem_agora_vai" class="novo_css_imagem" src="" alt="">

                                </div>
                            </div>    
                            <div class="alinar-botao-cor">
                                <span id="selecao-cor-text">Cor da sala : </span> 
                                <input value="<?=$dados_sala[0]['cor_itens']?>" class="botao-cor" name="cor_itens" type="color">
                            </div>
                        </div>
                    </div>
                    
                    <div class="alinar-botoes">

                        <div class="botao-padrao-voltar">
                            <a href="listar_salas.php" class="botao-voltar-link">VOLTAR</a>
                        </div>
                        
                        <div class="botao-padrao-cadastrar">
                            <a><input name="btn_submit" type="submit" class="botao-cadastrar-submit"  value="SALVAR" ></a>
                        </div>
                        
                    </div>
                
                </form>  
            </div>
        </div>
    </section>
    <script>
const remover = document.querySelector(".imagem_aparecer_editar");
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
                title: 'editado com sucesso!', //TITULO DO POP_UP DE ACORDO COM SUA TELA 
                icon: 'success', // success, error e warning
                confirmButtonColor: '#609437', // DEFINE A COR DO BOTÃO OK
                confirmButtonText: 'OK'
            });
        }



</script>
    
</body>


</html>