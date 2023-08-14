<?php
namespace app\entity;
use App\Db\Banco;
use PDO;
use PDOException;


session_start();
if(!isset($_SESSION['num_matricula_logado'])){
    // se a sessio nao estiver setado redireciona para a index 
    header('Location: ../');

} 

if(isset($_SESSION['msg'])){

    echo($_SESSION['msg']);
    unset($_SESSION['msg']);
}


require_once("../includes/menu.php");
require_once("../app/entity/Perfil.php");
$objPerfil = new Perfil();
$dados = $objPerfil -> getDados();
var_dump($dados);
?>