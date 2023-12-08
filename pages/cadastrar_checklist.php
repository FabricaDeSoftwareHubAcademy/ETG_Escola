<?php
session_start();
require __DIR__ ."/../vendor/autoload.php";
$titulo_page = 'Cadastrar Checklist';
include_once("../includes/menu.php");


use App\Entity\Pergunta;
use App\Entity\CadastroChecklist;
use App\Entity\Funcoes;



$dados = Pergunta::getPerguntas();
$trpre = "";
$trpos = ""; 
foreach ($dados as $rowdados) {
    if ($rowdados['tipo'] == '0' || $rowdados['tipo'] == '2') {
        $trpre .= "    <tr> 
                        <td><input type='checkbox'  id='checkbox' name='perguntas[]' value='" . $rowdados['id'] . "'></td>
                        <td>" . $rowdados['descricao'] . "</td>   
                    </tr>";
    } 
    
    if ($rowdados['tipo']== '1' || $rowdados['tipo'] == '2') {
        $trpos .= "    <tr> 
                        <td><input type='checkbox'  id='checkbox' name='perguntas[]' value='" . $rowdados['id'] . "'></td>
                        <td>" . $rowdados['descricao'] . "</td>   
                    </tr>";
    }
}

if (isset($_POST['btn_cadastrar']) && isset($_POST['nome_checklist'])) {
    $check = new CadastroChecklist();
    $check->nome = $_POST['nome_checklist'];
    $id = $check->cadastrar($_POST['perguntas']);
}





require("../includes/header/header.php");
require("../includes/main/main_cadastrar_checklist.php");
