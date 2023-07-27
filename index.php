<?php
session_start();
// pull 
 
 


// require na class Usuario 
// include_once("./app/entity/Usuario.php");

require __DIR__.'/vendor/autoload.php';
use App\Entity\Usuario;



if(isset($_SESSION['num_matricula_logado'])){
    header("Location: pages/listar_perfil.php");
}
    

// usuario clicou no botao de login?
if(isset($_POST['btn_sub'])){
    
    // pegando email, matricula e senha 
    if(isset($_POST['email'],$_POST['matricula'],$_POST['senha'])){
        // esta setado 

        $objUser = new Usuario($_POST['matricula'],$_POST['email'],$_POST['senha']);

        if($objUser->logar()){

            $_SESSION['msg'] = 'logado com sucesso!';
            header("Location: pages/mural.php");

        }else{

            // mensagem de usuario ou senha invalidos
            echo("Senha IN VA LI DA !!!");

        }

    
    }else{
        // nao esta setado -> modal ou pop up, notificando que nao esta setado!
        
    
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
    
    
    <section class="area_login">

    <img class="wave_login" src="assets/imgs/waves/wave (4).png" alt="">
    <img class="wave_login wave2" src="assets/imgs/waves/wave 2.png" alt="">
    <img class="wave_login wave3" src="assets/imgs/waves/wave 2.png" alt="">
    <img class="img_logo_login" src="assets/imgs/icons/logo.png" alt="">
         

        <div class="quadrado_input_login"></div>
        <div class="area_inputs_tela_login">

            <form class="content_input" method="POST" action="">

                <div class="area_input">
                    <div class="area_img_input">

                        <img class="img_input perfil" src="assets/imgs/icons/icon_profile.png" >

                    </div>
                    <div class="input_person">

                        <input type="text" name="email" class="input_default_login" required="" >
                        <label for="" class="label_for_input_login">E-mail</label>
                        <div class="line_login"></div>

                    </div>

                </div>

                

                <div class="area_input">
                    <div class="area_img_input">

                        <img class="img_input matricula" src="assets/imgs/icons/icon_matricula.png" >

                    </div>
                    <div class="input_person">

                        <input type="text" name="matricula" class="input_default_login" required="" >
                        <label for="" class="label_for_input_login">Matrícula</label>
                        <div class="line_login"></div>
                    </div>

                </div>

                <div class="area_input">
                    <div class="area_img_input">

                        <img class="img_input password" src="assets/imgs/icons/icon_password.png" >

                    </div>
                    <div class="input_person">

                        <input type="password" name="senha" class="input_default_login" required="" >
                        <label for="" class="label_for_input_login">Senha</label>
                        <div class="line_login"></div>
                         
                    </div>

                </div>

                <div class="area_link">
                    <a href="">Esqueci minha senha</a>
                </div>
                
                
                 <div class="area_btn_sub_login">
                     
                    <input type="submit" value="Entrar" name="btn_sub" class="btn_sub_login">

                 </div>

            </form>

        </div>
    </section>
      


    
</body>
</html>
