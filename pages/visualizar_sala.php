<?php
session_start();
require __DIR__."/../vendor/autoload.php";
include_once("../includes/menu.php"); 
$titulo_page = 'Visualizar Sala';
require("../includes/header/header.php");


 
use App\Entity\Sala;
use App\Entity\Checklist;

 
if(isset($_GET['id_sala'])){
    
    $id_sala = $_GET['id_sala'];

    $dados = Sala::getDadosById($id_sala);
 
}

$btn_checklist = '';

$objCheck = new Checklist();
$teste = $objCheck->getLastCheck($id_sala);
$status = Sala::getDados(col:'status,responsavel',where:'id = '.$id_sala);
$responsavel=$status[0]["responsavel"];


$data_hora = $objCheck->validar_40_minutos($id_sala,$responsavel);
var_dump($data_hora);
$data_abertura=$data_hora[0]["data_abertura"];
// var_dump($data_hora[0]["NOW()"]);
$hora_atual=$data_hora[0]["NOW()"];
var_dump($hora_atual);







// Duas timestamps de exemplo
$timestamp1 = strtotime($data_abertura);
$timestamp2 = strtotime($hora_atual);

// Calcula a diferença em segundos
$diferenca_segundos = abs($timestamp2 - $timestamp1);

// Converte a diferença para minutos
$diferenca_minutos = $diferenca_segundos / 60;

// Verifica se a diferença é maior ou igual a 40 minutos
// if ($diferenca_minutos >= 40) {
//     echo "A diferença entre as timestamps é igual ou maior que 40 minutos.";
// } 





//A partir da qui é antes do copiar e colar. 

if($status[0]['status']=='L'){
    $btn_checklist = '
    <div class="botao-padrao-fazer-checklist">
        <a href="../pages/cadastrar_checklist_preaula.php?id_sala='.$_GET['id_sala'].'">
            <input type="submit" class="botao-fazer-checklist-submit" value="FAZER CHECKLIST">
        </a>
    </div>';
}
elseif($status[0]['status']=='A'){
    


    // Aqui está uma gambiarra para resolver diferença de hora kkkkkkk
    // print($diferenca_minutos);
    $diferenca_minutos=$diferenca_minutos-60;
    print($diferenca_minutos);
    if(($status[0]['responsavel'] == $_SESSION['id_user'] || $ifreaac) && $diferenca_minutos >= 40 ){
        print("entrou no if ");
        $btn_checklist = '
                <div class="botao-padrao-fazer-checklist">
                    <a href="../pages/cadastrar_checklist_posaula.php?id_sala='.$_GET['id_sala'].'"><input type="submit" class="botao-fazer-checklist-submit"  value="PÓS AULA"></a>
                </div>';
    }
    else{
        return json_encode(true);
    };
    
}

$funcionamento = json_decode($dados[0]['horarios'], true);
// print_r($funcionamento);

$segunda = $funcionamento['segunda'] == 'sim' ? 'Segunda' : '';
$terca = $funcionamento['terca'] == 'sim' ? 'Terça' : '';
$quarta = $funcionamento['quarta'] == 'sim' ? 'Quarta' : '';
$quinta = $funcionamento['quinta'] == 'sim' ? 'Quinta' : '';
$sexta = $funcionamento['sexta'] == 'sim' ? 'Sexta' : '';
$sabado = $funcionamento['sabado'] == 'sim' ? 'Sábado' : '';
$matutino = $funcionamento['turnos']['matutino'] == 'sim' ? 'Matutino' : ' ';
$vespertino = $funcionamento['turnos']['vespertino'] == 'sim' ? 'Vespertino' : ' ';
$noturno = $funcionamento['turnos']['noturno'] == 'sim' ? 'Noturno' : ' ';

require("../includes/main/main_visualizar_sala.php");
require("../includes/footer/footer.php");
?>