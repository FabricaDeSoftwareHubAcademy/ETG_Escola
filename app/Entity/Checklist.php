<?php
namespace App\Entity;

use App\Db\Banco; 
use PDO;
use PDOException;

class Checklist
{
    public
    $id_usuario,
    $id_sala,
    $data_fechamento;

    public function __construct()
    {
        $this -> id_usuario      = null;
        $this -> id_sala         = null;
        $this -> data_fechamento = null;
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


}