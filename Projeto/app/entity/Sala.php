<?php
require_once("../app/db/Banco.php");

class Sala{
    private $id_cadastro_sala,
            $id_cadastro_checklist,
            $id_cadastro_usuario,
            $andar,
            $descricao,
            $imagem,
            $cor,
            $status_sala,
            $nome,
            $horario_matutino,
            $horario_vespertino,
            $horario_noturno
            ;
    public function __construct($id_cadastro_sala = null,
                                $id_cadastro_checklist = null,
                                $id_cadastro_usuario = null,
                                $andar = null,
                                $descricao = null,
                                $imagem = null,
                                $cor = null,
                                $status_sala = null,
                                $nome = null,
                                $horario_matutino = null,
                                $horario_vespertino = null,
                                $horario_noturno = null
                                ){
        $this -> id_cadastro_sala = $id_cadastro_sala;
        $this -> id_cadastro_checklist = $id_cadastro_checklist;
        $this -> id_cadastro_usuario = $id_cadastro_usuario;
        $this -> andar = $andar;
        $this -> descricao = $descricao;
        $this -> imagem = $imagem;
        $this -> cor = $cor;
        $this -> status_sala = $status_sala;
        $this -> nome = $nome;
        $this -> horario_matutino = $horario_matutino;
        $this -> horario_noturno = $horario_noturno;
    }


    public function cadastrar(){
        $objBanco = new Banco('Cadastro_sala');
        $query = $objBanco -> select();
    }


}
?>