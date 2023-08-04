

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/estilo_enviar_notificacao.css">

</head>
<body class="pai_de_todos">
    <?php

    include_once("../includes/menu.php")

    ?> 
    <div class="tudo">   
    
        <div class="pagina">
            <section class="Enviar-notificacao">
                <h1>Enviar Notificação</h1>
            </section>
            
            <!--Input-->

            <section class="centralizar-inputs-tela-enviar-notificacao">

                <div class="input_group field">
                    <input type="input" class="input_field" placeholder="Name" required="">
                    <label for="name" class="input_label">Para:</label> <!--Alterar para o nome do input-->
                </div>

                <!--Textarea-->
                <div class="textarea">
                    <label class="titulo-notificacao" for="story">Notificação:</label>
                    <textarea class="quadrado_text" name="story" rows="5" cols="33"></textarea>
                </div>

            </section>

            <!--Botões-->

            <section class="centralizar_botoes_enviar_notificacao">
                    
                    <!--Botão Voltar-->
                <div class="botao-padrao-voltar">
                    <a href="#"><input type="submit" class="botao-voltar-submit"  value="VOLTAR"></a>
                </div>

                    <!--Botão Confirmar-->
                <div class="botao-padrao-confirmar">
                    <a href="#"><input type="submit" class="botao-confirmar-submit"  value="CONFIRMAR"></a>
                </div>

            </section>

        </div>
    </div>
  
</body>
</html>