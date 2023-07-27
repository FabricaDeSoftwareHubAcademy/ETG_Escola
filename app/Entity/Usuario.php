<?php

namespace App\Entity;
use PDO;
use PDOException;


class Usuario{

    // criando variaveis privadas 
    private $num_matricula,
            $email,
            $senha;
            

    // metodo construct 
    public function __construct(
        
        $num_matricula ,
        $email ,
        $senha ,
        
    ){

        // variaveis privadas recebem valores        
        $this->num_matricula = $num_matricula;
        $this->email = $email;
        $this->senha = $senha;

    }


    public function logar(){

       
        $obBanco = new Banco("cadastro_usuario");
         
        $rowUser = $obBanco->select('email = "'.$this->email.'" AND senha = "'.$this->senha.'" AND num_matricula = "'.$this->num_matricula.'"')->fetchAll(PDO::FETCH_ASSOC);
        if($rowUser){
            
            $_SESSION['num_matricula_logado'] = $rowUser[0]['num_matricula'];
            
            return true;

        }else{

            return false;
        }

    }
    
    public function getRecados(){

        $obBanco = new Banco("recado");
        
        $dados = $obBanco->select(NULL,"id_recado DESC");
        if($dados->rowCount() > 0){

            return $dados;

        }else{

            return false;

        }
    }

}
