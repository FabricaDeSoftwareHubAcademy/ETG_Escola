<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="../assets/js/deletar_perfil.js"></script>

<link rel="stylesheet" href="../assets/css/listar_perfis.css">



<body class="tela_gerenciam_perfis">

        <main class="pai-de-todos">
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
