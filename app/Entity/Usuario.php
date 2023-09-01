<?php

namespace App\Entity;
use App\Db\Banco;
use PDO;
use PDOException;


class Usuario
{
    private $num_matricula,
            $email,
            $senha;
             
    public function __construct($num_matricula = null,
                                $email         = null,
                                $senha         = null    
                               )
    {      
        $this -> num_matricula = $num_matricula;
        $this -> email         = $email;
        $this -> senha         = $senha;
    }


    //CREATE
    public function cadastrar($nome = null , $email = null, $num_matricula = null, $senha = null, $id_perfil = null)
    {
        $obj_banco = new Banco('cadastro_usuario');
        $validacao_email = $obj_banco -> select('email = "'.$email.'"') -> fetchAll(PDO::FETCH_ASSOC);
        
        if ($validacao_email)
        {
            die('email ja existe'); //modal para email errado return false
        }
        
        $validacao_matricula = $obj_banco -> select('matricula = '.$num_matricula) -> fetchAll(PDO::FETCH_ASSOC);
        
        if ($validacao_matricula)
        {
            die('num_matricula ja existe'); //modal para num_matricula errado return false
        }
        else if (!$validacao_email && !$validacao_matricula)
        {
            $obj_banco -> insert(['nome'            =>      $nome,
                                'email'             =>      $email,
                                'matricula'         =>      $num_matricula, 
                                'senha'             =>      $senha,
                                'id_perfil'         =>      $id_perfil
              
        ]);
        //die('qwghkglda');
            return true;
        }
    }

    //READ
    public function getDados() : array 
    {
        $obj_banco = new Banco('cadastro_usuario');
        
        $dados = $obj_banco -> select() -> fetchAll(PDO::FETCH_ASSOC);
        
        return $dados;
    }


    //UPDATE
    public function setDados($email, $senha)
    {
        $objBanco = new Banco('cadastro_usuario');
        $objBanco -> update('email = "'.$email.'"',['senha' => $senha]);
    }

    public function setPasswordByEmail($email, $senha)
    {
      $obj_banco = new Banco('cadastro_usuario');
      $obj_banco -> update('email = "'.$email.'"', ['senha' => $senha]);
  }



  //OUTROS

    public function emailValidate($email) : bool
    {
        $objBanco = new Banco('cadastro_usuario');
        
        $dados = $objBanco -> select('email = "'.$email.'"');

        if ($dados -> rowCount())
        {
            return true;
        
        }
        else
        {
            return false;
        }
   }
   
   public function senhaValidate($senha, $email) : bool
   {
       $obj_banco = new Banco('cadastro_usuario');
       
       $dados = $obj_banco -> select('senha = "'.$senha.'" AND email = "'.$email.'"');

       if ($dados -> rowCount())
       {
            return true;
       }
       else
       {
           return false;
       }
       
    }
public function logar()
{
    $obj_banco = new Banco("cadastro_usuario");
    $rowUser = $obj_banco -> select('email = "'.$this->email.'" AND senha = "'.$this->senha.'" AND num_matricula = "'.$this->num_matricula.'"')
                          ->fetchAll(PDO::FETCH_ASSOC);

    if($rowUser)
    {
        session_start();
        $_SESSION['num_matricula_logado'] = $rowUser[0]['num_matricula'];
        return true;
    }
    else
    {
        return false;
    }
}
}
