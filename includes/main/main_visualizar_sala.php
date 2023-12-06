<!-- PARTE DA TELA QUE PEGA A COR DA BOX -->
<style>
        .card{
    border: solid  <?=$dados[0]['cor_itens']?>;
            }
</style>

<!-- LINK DO CSS "visualizar_sala.css" -->
<link rel="stylesheet" href="../assets/css/visualizar_sala.css">


<body class="visualizar_sala">

            <div class="nome_da_sala" id="nome_da_sala"> <h1>Visualizar Sala</h1> </div>
        
            <section class="area_card">
            
                <div class="card">

                    <!-- PARTE QUE PEGA A IMAGEM DA SALA -->
                    <div class="imagem_card">
                        <img src="../storage/salas/<?= $dados[0]['img_sala']?>" alt="" id="img_config">
                    </div>

                    <!-- TUDO O QUE TA ESCRITO CARD-->
                    <div class="texto_card" >

                            <!-- PARTE QUE PEGA O NOME DA SALA -->
                            <h1 class="nome-sala"><?=$dados[0]['nome']?></h1>
            
                            <!-- DESCRIÇÃO -->
                            <div class="paragrafo_card"> 
                                
                                <h2 id="paragrafo_descricao"> Descrição: </h2>

                                <!-- PARTE QUE PEGA A IMAGEM DA SALA -->
                                <p class="texto-descricao"> <?=$dados[0]['descricao']?></p>
                                
                                
                            </div>

                            <!-- DIAS DE FUNCIONAMENTO -->
                            <div class="dias-de-funcionamento">
                                
                                <h2 id="dias-funcionamento"> Dias de Funcionamento: </h2>

                                <!-- PARTE QUE PEGA OS DIAS DE FUNCIONAMENTO DO BANCO -->

                                <p class="dias_funcionamento"> <?php
                                
                                    echo $segunda.'  ';
                                    echo $terca.' ';
                                    echo $quarta.' ';
                                    echo $quinta.' ';
                                    echo $sexta.' ';
                                    echo $sabado.' ';


                                ?></p>
                                
                            </div>

                            <!-- TURNOS DE FUNCIONAMENTO -->
                            <div class="turnos-de-funcionamento">

                                <h2 id="turnos-funcionamento"> Turnos de Funcionamento: </h2>

                                <!-- PARTE QUE PEGA OS TURNOS DE FUNCIONAMENTO DO BANCO -->
                                <p class="turnos_funcionamento"> <?php
                                
                                    echo $matutino.' ';
                                    echo $vespertino.' '; 
                                    echo $noturno.' ';

                                
                                ?></p>
                                
                            </div>                      
                    </div>
                </div>
            </section>
            
            <!-- BOTÕES (voltar e fazer checklist)-->
            <div class="alinhar_botoes">

                <!--Botão Voltar-->
                <a href="./listar_salas.php"><input type="submit" class="botao-voltar-submit"  value="VOLTAR"></a>
    
                <!--Botão Checklist -->
                <a href="../pages/cadastrar_checklist_preaula.php?id_sala=<?=$_GET['id_sala']?>"><input type="submit" class="botao-fazer-checklist-submit"  value="FAZER CHECKLIST"></a>

            </div>
</body>


