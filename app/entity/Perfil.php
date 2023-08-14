<?php


namespace app\entity;
use App\Db\Banco;
use PDO;
use PDOException;


class Perfil{
    
    /*Estes atributos sao respectivos aos atributos da tabela no banco de dados */
    private $id_cadastro_perfil,
            $nome_cargo,
            $cadastrar_sala,
            $editar_sala,
            $remover_sala,
            $validar_checklist,
            $inserir_item_checklist,
            $remover_item_checklist,
            $desbloquear_checklist,
            $descricao_nao_conformidade,
            $enviar_notificacao
            ;

    //Metodo construtor usado para receber os atributos do novo cargo
    public function __construct($nome_cargo = '',
                                $cadastrar_sala = null,
                                $editar_sala = null,
                                $remover_sala = null,
                                $validar_checklist = null,
                                $inserir_item_checklist = null,
                                $remover_item_checklist = null,
                                $desbloquear_checklist = null,
                                $descricao_nao_conformidade = null,
                                $enviar_notificacao = null
                                ){
        $this -> nome_cargo = $nome_cargo;
        $this -> cadastrar_sala = $cadastrar_sala;
        $this -> editar_sala = $editar_sala;
        $this -> remover_sala = $remover_sala;
        $this -> validar_checklist = $validar_checklist;
        $this -> inserir_item_checklist = $inserir_item_checklist;
        $this -> remover_item_checklist = $remover_item_checklist;
        $this -> desbloquear_checklist = $desbloquear_checklist;
        $this -> descricao_nao_conformidade = $descricao_nao_conformidade;
        $this -> enviar_notificacao = $enviar_notificacao;
        

    }
    
    //So podemos alterar as informacoes do objeto usando um metodo, pois os atributos sao privados
    //Futuramente este metodo vai alterar informacoes do banco de dados
    /*
    public function setDados($nome_cargo,
                             $cadastrar_sala = null,
                             $editar_sala = null,
                             $remover_sala = null,
                             $validar_checklist = null,
                             $inserir_item_checklist = null,
                             $remover_item_checklist = null,
                             $desbloquear_checklist = null,
                             $descricao_nao_conformidade = null,
                             $enviar_notificacao = null
                             ){
        $this -> nome_cargo = $nome_cargo;
        $this -> cadastrar_sala = $cadastrar_sala;
        $this -> editar_sala = $editar_sala;
        $this -> remover_sala = $remover_sala;
        $this -> validar_checklist = $validar_checklist;
        $this -> inserir_item_checklist = $inserir_item_checklist;
        $this -> remover_item_checklist = $remover_item_checklist;
        $this -> desbloquear_checklist = $desbloquear_checklist;
        $this -> descricao_nao_conformidade = $descricao_nao_conformidade;
        $this -> enviar_notificacao = $enviar_notificacao;

        return true;
    }*/

    //Metodo responsavel por inserir dados no banco de dados
    public function cadastrar(){
        //variavel que conecta com o Banco e passa a tabela
        $objBanco = new Banco('cadastro_perfil');
        /*Usando o metodo select do Banco para verificar se ja existe algum perfil cadastrado
        com o mesmo nome, concatenando o nome que foi passado para o objeto e o nome da coluna da tabela*/
        $teste = $objBanco -> select('nome_cargo = "'.$this -> nome_cargo.'"') -> fetchAll(PDO::FETCH_ASSOC);
        
        //condicao (se a variavel $teste conter algo, ou seja, ja existe um nome_cargo na tabela com este nome)
        if ($teste){
            //mensagem de erro/modal/sweet-alert
            return false;
        } else{
            //Passando para o metodo insert do Banco uma array com todos os atributos do objeto em questao
            $this -> id_cadastro_perfil = $objBanco -> insert(['nome_cargo'                 => $this -> nome_cargo,
                                                               'cadastrar_sala'             => $this -> cadastrar_sala,
                                                               'editar_sala'                => $this -> editar_sala,
                                                               'remover_sala'               => $this -> remover_sala,
                                                               'validar_checklist'          => $this -> validar_checklist,
                                                               'inserir_item_checklist'     => $this -> inserir_item_checklist,
                                                               'remover_item_checklist'     => $this -> remover_item_checklist,
                                                               'desbloquear_checklist'      => $this -> desbloquear_checklist,
                                                               'descricao_nao_conformidade' => $this -> descricao_nao_conformidade,
                                                               'enviar_notificacao'         => $this -> enviar_notificacao
                                                             ]);
            return true;
        }
    }

    //Metodo que puxa todos, ou alguns dados do Banco
    //sera usado futuramente para listar os perfis
    public function getDados($where = null, $order = null, $limit = null){
        
        //variavel que conecta com o Banco e passa a tabela
        $objBanco = new Banco('cadastro_perfil');
        //atribuindo o select para a variavel dados, usando o fetchObject 
        $dados = $objBanco -> select($where, $order, $limit) -> fetchAll(PDO::FETCH_ASSOC);
        
        return $dados;
    }
}

