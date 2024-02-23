<?php
namespace App\Entity;

use App\Db\Banco;
use App\Entity\NaoConformidade;
use PDOException;

class ResponderChecklist
{


    public static function cadastrar($dadosResp = [], $id_sala = 1, $id_check)
    {
        $responder_check = [
            'id_usuario'     => $_SESSION['id_user'],
            'id_sala'        => $id_sala,
            'id_checklist'   => $id_check
        ];
        $obj_banco = new Banco('responder_check');
        try{
            
            // CADASTRAR NO BANCO QUE RESPONDEU 
            $last_id = $obj_banco -> insertRecoverId($responder_check);
            echo(json_encode($last_id));



        }catch(PDOException $e){
            echo(json_encode($e->getMessage()));
        }
       

        foreach ($dadosResp as $dataResp)
        {
            // se for uma não conformidade 
            
            if($dataResp['status'] == false){
                
                
                $imgs_nc = [];
                
                foreach($dataResp['imgs'] as $img_64){
                    
                    //LOGICA DA IMAGEM
                    list($type, $data) = explode(';', $img_64);
                    list(, $data) = explode(',', $data); 
                    $img2decodificada = base64_decode($data); 
                    $nome2 = uniqid().'_nc.png'; 
                    $caminho_salvar = '../../storage/n_conformidade/'.$nome2;
                    file_put_contents($caminho_salvar, $img2decodificada);
                    
                    array_push($imgs_nc,$nome2);
               }

                

            }
            

            // return ($dataResp);
            
            // //LOGICA DA IMAGEM
            // list($type, $data) = explode(';', $img2_64);
            // list(, $data) = explode(',', $data);
            // $img2decodificada = base64_decode($data);
            // $data = '';
            // $nome2 = uniqid().'_nc.png';
            // $caminho_salvar = '../../storage/n_conformidade/'.$nome2;
            // file_put_contents($caminho_salvar, $img2decodificada);
            
             

            // // cadastrando não conformidade  
            // $nao_conformidade = [
            //     'id_realiza' =>  $last_id,
            //     'id_prof' => $_SESSION['id_user'],
            //     'id_pergu' => $pergunta['id_pergu'],
            //     'descricao_NC' => $pergunta['descricao_NC'],
            //     'img1' => (isset($nome1)) ? $nome1 : '',
            //     'img2' => (isset($nome2)) ? $nome2 : '',
            //     'img3' => (isset($nome3)) ? $nome3 : '',
            // ];
            // NaoConformidade::cadastrar(dados : $nao_conformidade);
        }
        return true;
    }

    public static function cadastrar_pos($dados = [], $id_last_insert = 1)
    {   

        // adicionar valor na data de fechamento do checklist respondido  
        $obj_banco = new Banco('responder_check'); 

        $dados_update  =  [
            'data_fechamento' => date('Y-m-d H:i:s')
        ];

        $obj_banco -> update('id = "'.$id_last_insert.'"',$dados_update);
         

        foreach ($dados as $pergunta)
        {
            $img1_64  = $pergunta['img1'];
            $img2_64  = $pergunta['img2'];
            $img3_64  = $pergunta['img3'];
            $nome1 = null;
            $nome2 = null;
            $nome3 = null;

            
            //LOGICA DA IMAGEM
            if (isset($img1_64))
            {
                //primeira imagem
                list($type, $data) = explode(';', $img1_64);
                list(, $data) = explode(',', $data);
                $img1decodificada = base64_decode($data);
                $data = '';
                $nome1 = uniqid().'_nc.png';
                $caminho_salvar = '../../storage/n_conformidade/'.$nome1;
                file_put_contents($caminho_salvar, $img1decodificada);
            }
            if (isset($img2_64))
            {
                //segunda imagem
                list($type, $data) = explode(';', $img2_64);
                list(, $data) = explode(',', $data);
                $img2decodificada = base64_decode($data);
                $data = '';
                $nome2 = uniqid().'_nc.png';
                $caminho_salvar = '../../storage/n_conformidade/'.$nome2;
                file_put_contents($caminho_salvar, $img2decodificada);
            }
            if (isset($img3_64))
            {
                //terceira imagem
                list($type, $data) = explode(';', $img3_64);
                list(, $data) = explode(',', $data);
                $img3decodificada = base64_decode($data);
                $data = '';
                $nome3 = uniqid().'_nc.png';
                $caminho_salvar = '../../storage/n_conformidade/'.$nome3;
                file_put_contents($caminho_salvar, $img3decodificada);
            }

            unset($img1_64);
            unset($img2_64);
            unset($img3_64);

            
            $nao_conformidade = [
                'id_realiza' =>  $id_last_insert,
                'id_prof' => $_SESSION['id_user'],
                'id_pergu' => $pergunta['id_pergu'],
                'descricao_NC' => $pergunta['descricao_NC'],
                'img1' => (isset($nome1)) ? $nome1 : '',
                'img2' => (isset($nome2)) ? $nome2 : '',
                'img3' => (isset($nome3)) ? $nome3 : '',
            ];
            NaoConformidade::cadastrar(dados : $nao_conformidade);
        }

        
    }
}