<?php 

require __DIR__."/../../vendor/autoload.php";
use App\Entity\Pergunta; 


$pergunta = filter_input(INPUT_POST, 'nova_pergunta', FILTER_SANITIZE_SPECIAL_CHARS);
 
$obPergunta = new Pergunta($pergunta);
$resposta = '';

if(isset($_POST['antes_da_aula'],$_POST['depois_da_aula'])){
    // ambas 
    $resposta = $obPergunta->cadastrar('2');

}elseif(isset($_POST['antes_da_aula'])){
    // apenas antes 
    $resposta =   $obPergunta->cadastrar('0');


}elseif(isset($_POST['depois_da_aula'])){
    // apenas depois 
    $resposta =  $obPergunta->cadastrar('1');
}

$resp ='';
if($resposta){
    $resp = ['status' => 'OK'];
}else{
    $resp = ['status' => false];
}

echo json_encode($resp);

?>