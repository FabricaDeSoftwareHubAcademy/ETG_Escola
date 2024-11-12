<link rel="stylesheet" href="../assets/css/detalhes_relatorio.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="../assets/js/imagem_preview.js" defer></script>
<body class="tela_detalhes">
    <div class="titulo">
        <p class="texto_titulo">Detalhes Das Não Conformidades</p>
    </div>

    <section class="todas_nao_conf">


         
        <?= $dados_responsavel ?> <div class="area_nao_conformidade">
            <?= $nao_conformidade ?>
             


        </div>
    </section>
    <div class="area_botões">
        

        <div class="gerar_relatorio">
            <div class="imprimir">
                <button class="botao-cadastrar-link" onclick="actionImprimir()">IMPRIMIR</button>
                 
            </div>
              
            
        </div>
    </div>
     
</body>
<script>

function actionImprimir(){

    document.body.classList = ''
    $(".darkmode-background").remove()
    $(".darkmode-layer").remove()
    $(".darkmode-toggle").remove()
    darkModeProject('#fff')
    print()

}


</script>



</html>