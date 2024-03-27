<?php
session_start();
require __DIR__."/../../vendor/autoload.php";
use App\Entity\AcaoCorretiva;
use App\Entity\NaoConformidade;
use App\Entity\ResponderChecklist;
use App\Entity\Sala;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//setar
if (isset($_GET["tudo_correto"])) {
    $tudo_correto = $_GET["tudo_correto"];
} else {
    $tudo_correto = false;
}
if (isset($_GET["id_sala"])) {
    $id_sala_get = isset($_GET["id_sala"]);
}
if ($tudo_correto == true) {
    ResponderChecklist::setConf_logis($_GET["id_realizacao"]);
    // die($id_sala);
    // Sala::setStatusSala($id_sala_get, "L");
    header("Location: ../listar_checklist_concluidas.php");
}

function convert_base64_png($img) {
    //LOGICA DA IMAGEM
    list($type, $data) = explode(';', $img);
    list(, $data) = explode(',', $data); 
    $img_decodificada = base64_decode($data); 
    $nome = uniqid().'_acao_corretiva.png'; 
    $caminho_salvar = '../../storage/acao_corretiva/'.$nome;
    file_put_contents($caminho_salvar, $img_decodificada);
    return $nome;
}

$data = json_decode(file_get_contents("php://input"), true);
$response = ["status" => true];

function cadastrarAcaoCorretiva($AcaoCorretiva, $objeto_acao_corretiva) {
    $id_nao_conformidade = $AcaoCorretiva["id_nao_conformidade"];
    $descricao = $AcaoCorretiva["textAreaContent"];
    $img_1 = (isset($AcaoCorretiva["imagesToPHP"][0])) ? $AcaoCorretiva["imagesToPHP"][0] : "";
    $img_2 = (isset($AcaoCorretiva["imagesToPHP"][1])) ? $AcaoCorretiva["imagesToPHP"][1] : "";
    $img_3 = (isset($AcaoCorretiva["imagesToPHP"][2])) ? $AcaoCorretiva["imagesToPHP"][2] : "";

    $img_1 = ($img_1 != "") ? convert_base64_png($img_1) : "";
    $img_2 = ($img_2 != "") ? convert_base64_png($img_2) : "";
    $img_3 = ($img_3 != "") ? convert_base64_png($img_3) : "";
    
    
    $objeto_acao_corretiva->setImg_1($img_1);
    $objeto_acao_corretiva->setImg_2($img_2);
    $objeto_acao_corretiva->setImg_3($img_3);
    $objeto_acao_corretiva->setIdNaoConformidade($id_nao_conformidade);
    $objeto_acao_corretiva->setDescricao($descricao);
    $objeto_acao_corretiva->setIdUsuario($_SESSION['id_user']);

    
    $responseDB = $objeto_acao_corretiva->save();
    // echo json_encode($responseDB);
    
    if(!$responseDB) {
        //ARMAZENAR NO LOG
        return false;
    }
    return true;
}

foreach ($data[0] as $AcaoCorretiva) {
    $objeto_acao_corretiva = new AcaoCorretiva();

    if (isset($AcaoCorretiva["data_nao_conformidade"])) {
        //Cadastrando nao conformdidade
        $nao_conformidade_sem_id = $AcaoCorretiva["data_nao_conformidade"];
        
        $img_1 = (isset($AcaoCorretiva["imagesToPHP"][0])) ? $AcaoCorretiva["imagesToPHP"][0] : "";
        $img_2 = (isset($AcaoCorretiva["imagesToPHP"][1])) ? $AcaoCorretiva["imagesToPHP"][1] : "";
        $img_3 = (isset($AcaoCorretiva["imagesToPHP"][2])) ? $AcaoCorretiva["imagesToPHP"][2] : "";
        
        $img_1 = ($img_1 != "") ? convert_base64_png($img_1) : "";
        $img_2 = ($img_2 != "") ? convert_base64_png($img_2) : "";
        $img_3 = ($img_3 != "") ? convert_base64_png($img_3) : "";
        
        $dados = [
            "id_realiza" => $nao_conformidade_sem_id["id_realizacao"],
            "id_user" => $_SESSION["id_user"],
            "id_pergu" => $nao_conformidade_sem_id["id_pergunta"],
            "descricao_NC" => $nao_conformidade_sem_id["textAreaContent"],
            "img1" => $img_1,
            "img2" => $img_2,
            "img3" => $img_3
        ];
        $id_nao_conformidade = NaoConformidade::saveAndGetLastId($dados);

        //Cadastrando Acao Corretiva
        $AcaoCorretiva["id_nao_conformidade"] = $id_nao_conformidade;
        $response_cadastro = cadastrarAcaoCorretiva($AcaoCorretiva, $objeto_acao_corretiva);
        if (!$response_cadastro){
            $response = ["status" => false];
            break;
        }
        continue;
    }

    cadastrarAcaoCorretiva($AcaoCorretiva, $objeto_acao_corretiva);

    
    
}
//desbloqueando sala
if ($response["status"] == true) {
    // 'conf_logis = "'.$id_responder_checklist.'"'
    ResponderChecklist::setConf_logis($_GET["id_realizacao"]);
    //setar
    Sala::setStatusSala($id_sala_get, "L");
}
echo json_encode($response["status"]);
    





