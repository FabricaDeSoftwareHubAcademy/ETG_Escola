<?php
namespace App\Entity;

use App\Db\Banco;
use App\Entity\CadastroChecklist; 
use PDO;
use PDOException;

class Checklist
{
    public
    $id_checklist;

    public function __construct($id_checklist = null)
    {
        $this -> id_checklist = $id_checklist;
    
    }

    public function cadastrar($dados = array())
    {
        $obj_banco = new Banco('responder_check');
        $obj_banco -> insert($dados);                  
    }

    public static function getLastCheck($id){

        $obj_banco = new Banco('responder_check');
        // select * from responder_check where id_usuario = 36 ORDER BY id DESC LIMIT 1;
        return $obj_banco -> select('id_sala = "'.$id.'"', 'id DESC',1)->fetchAll(PDO::FETCH_ASSOC);
  
    }

    public static function getData() {
        $obj_banco = new Banco('responder_check');
        $data = $obj_banco -> select() -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getDoneCheck($inicio = 0) {
        $obj_banco = new Banco('check_concluidas');
        $data = [$obj_banco -> select(limit: "$inicio, 5") -> fetchAll(PDO::FETCH_ASSOC), $obj_banco -> select(campos: 'count(*) as total') -> fetch(PDO::FETCH_ASSOC)];
        return $data;
    }
    public static function getChecklist()
    {
        $obj_banco = new Banco('cadastro_checklist');
        $dados = $obj_banco->select(order:"id DESC");
        if($dados)
        {
            return $dados->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        } 
    }

    
    public function updateChecklist($ids_perguntas, $nome = null){

        try{
            if($nome != null && strlen($nome) > 0){ 
                 $this->updateNameChecklist($nome); 
            }
 
            $this->updateChecklistRelacao($ids_perguntas);
             
        }catch(PDOException $e){

            return $e->getMessage();

        }
 
    }

    

    private function updateNameChecklist( $nome){
        
        try{ 
            $banco = new Banco('cadastro_checklist');
            $dados = [ 
                'nome' => $nome
            ]; 
            $banco->update('id = "'.$this->id_checklist.'"', $dados);
            return true;

        }catch(PDOException $e){ 
            return $e->getMessage(); 
        }


    }

    private function updateChecklistRelacao($id_perguntas){
        
        try{ 
            $obBanco = new Banco('relacao_pergunta_checklist'); 
            $obBanco->delete($this->id_checklist,'id_check'); 
    
            return CadastroChecklist::cadastrarPergunta($id_perguntas,$this->id_checklist);

        }catch(PDOException $e){ 
            return $e->getMessage(); 
        }


    }


    public static function checklistResp($id_checklist){
        // se o checklist ja foi repondido retorna true, caso contrario false 
        try {
            $obBanco = new Banco('responder_check');
            if($obBanco->select('id_checklist = "'.$id_checklist.'"')->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    public static function getChecklistById($id_check)
    {
        $obj_banco = new Banco('cadastro_checklist');
        $dados = $obj_banco->select(order:"id DESC",where:"id = '".$id_check."'");
        if($dados)
        {
            return $dados->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        } 
    }

    public static function deleteChecklist($id_checklist){

        $obj_banco = new Banco('responder_check');  

        if($obj_banco->select('id_checklist = "'.$id_checklist.'"') -> rowCount() == 0){
            try{


                $obRelacao = new Banco('relacao_pergunta_checklist');
                $obRelacao->delete($id_checklist,'id_check');

                $obCadCheck = new Banco('cadastro_checklist');
                $obCadCheck->delete($id_checklist,'id');

                return true;


            }catch(PDOException $e){

                return $e->getMessage();
            }

        }



    }
    public static function getDataById($id) {
        $obj_banco = new Banco('responder_check');
        $data = $obj_banco -> select(where:'id = '.$id.'') -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }



}