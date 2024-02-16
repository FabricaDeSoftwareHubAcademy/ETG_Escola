<?php
session_start();
require __DIR__."/../vendor/autoload.php";
$titulo_page = 'Cadastrar Usuario';
require("../includes/header/header.php");
include_once("./../includes/menu.php"); 
if(!$ifuser){
    header('Location: ./listar_recados.php');
}


use App\Entity\Perfil;
$objCadastroPerfil = new Perfil();

use App\Entity\Usuario;
$objUsuario = new Usuario();


$dados = $objCadastroPerfil -> getDados();
//die("teste");

$options = '';
foreach ($dados as $row_check ){
    //var_dump($row_check);exit;
    $options .= '<option  class="ops" value="'.$row_check['id'].'"> '.$row_check['nome'].' </option>'; 
}
// }

if(isset(
    $_POST['btn_submit'],
    $_POST['nome'],
    $_POST['id_perfil'],
    $_POST['num_matricula'],
    $_POST['senha'],
    ))  {
            $objUsuario -> cadastrar(
            $_POST['nome'],
            $_POST['email'],
            $_POST['num_matricula'],
            $_POST['senha'],
            $_POST['id_perfil']);
            
            // echo '<script>openModalConfirmed();</script>';

        }
        

//  VALUES ('$nome', '$email', '$matricula', '$senha', '$id_perfil')";
// echo($objUsuario -> cadastrar($nome,$email,$matricula,$senha,$id_perfil)); 
include_once("./../includes/main/main_cadastrar_usuario.php");
// require("./includes/footer/footer.php");
?>