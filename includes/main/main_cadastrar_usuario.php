<link rel="stylesheet" href="../assets/css/cadastrar_usuario.css">
<!-- <link rel="stylesheet" href="../assets/css/estilo_botoes_padronizados.css"> -->
<!-- <link rel="stylesheet" href="../modais/usuario_cadastrado.php"> -->

<body class="Pai-de-todos">
    
    <main class="tudo_esqueceu_senha1">
        <form method="POST" id="form_cad">
            <section class='titulo_cadastro_usuario'>
                <h1>Cadastrar Usuário</h1>
            </section>
            
            <section class="centralizar_input_cadastrar_usuario">                
                <!-- input nome -->
                <div class="input_group field">
                    <input type="input" maxlength="45" class="input_field" name="nome" id="nomes" placeholder="Name" required="">
                    <label for="name" class="input_label">Nome</label> <!--Alterar para o nome do input-->
                </div>
                
                <!--Input Email-->
                <div class="input_e-mail_group field">
                    <input type="email" class="input_e-mail_field" name="email" id="emails"  placeholder="Name" required="" autocomplete="on">
                    <label for="name" class="input_e-mail_label">E-mail</label> <!--Alterar para o nome do input-->
                </div>
                
                
                <div class="mover_input">
                    <div class="dropdown-ck">
                        <select name="id_perfil" id="options" class="option">
                            <option value="">Selecione seu Perfil</option>
                            <?=$options?>
                            
                        </select> 
                    <div class="barra"></div> 
                </div>

                
                <div class="input_group">
                    <input type="input" class="input_field_matricula" name="num_matricula" id="matricula" placeholder="Name" required="">
                    <label for="name" class="input_label_matricula">N° de Matricula</label> <!--Alterar para o nome do input-->
                </div>
            </div>
                    
            <!--Input Senha-->
            <div class="input_senha_group field">
                <input type="password" class="input_senha_field" name="senha" id="senhas" placeholder="Name" required="">
                <label for="name" class="input_senha_label">Senha</label> <!--Alterar para o nome do input-->
            </div>
        </section>   

        <section class="centralizar_botoes_cadastrar_usuario">
            <!--Botão voltar-->
            <div class="botao-padrao-voltar">
                <a href="listar_recados.php"><input class="botao-voltar-submit" value="VOLTAR"></a>
            </div>
            
            <!--Botão Confirmar-->
            <div class="botao-padrao-confirmar">
                    <a><input type="submit" class="botao-confirmar-submit" id="botao-confirmar-submit" name="btn_submit" value="CONFIRMAR"></a>
                </div>
            </section>
            
        </form>
    </main>
    


<script>

let button =document.getElementById('botao-confirmar-submit')
        
button.addEventListener('click', async (e) =>{
        
    e.preventDefault()
    
    const nomes = document.getElementById('nomes').value;
    const emails = document.getElementById('emails').value;
    const options = document.getElementById('options').value;
    const matricula = document.getElementById('matricula').value;
    const senhas = document.getElementById('senhas').value;
    // console.log(nomes);
    
    // if (nomes.length > 0) {
    //     console.log("Campo de nome preenchido");
    // } 
    // else{
    //     console.log("Campo de nome não preenchido");
    // } 
    
    if (nomes.length > 0 && emails.length > 0 && options.length > 0 && matricula.length > 0 && senhas.length > 0) {
        console.log("Todos os campos estão preenchidos.");

        let form = document.getElementById('form_cad')
        console.log(form)

        let formData = new FormData(form)
        let dados_php = await fetch("../pages/actions/cad_usuario.php",{method:"POST",
            body: formData
        })

        let response = await dados_php.json()

        console.log(response)

        if(response){

            console.log("funfou")

        }
        else{
            console.log("nao funfou")
        }


    } else {
        console.log("Preencha todos os campos.");
    }

});

</script>
    

    
    <?php include_once("./../includes/modais/usuario_cadastrado.php"); ?>
</body>