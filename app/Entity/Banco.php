<?php

namespace App\Entity;
use PDO;
use PDOException;


class Banco{
    //Variaveis referentes a conexao com o banco de dados
    const HOST = '192.168.22.9';
    const DB_NAME = 'etg_homologacao';
    const USER = 'fabrica';
    const PASS = 'fabrica@2022';
    private $table;//variavel que vai falar sobre qual tabela do banco esta sendo tratada
    private $conexao;

    //Metodo responsavel por conectar com o banco de dados
    private function conectar(){
        try{
            $this -> conexao = new PDO('mysql:host='.self::HOST.';dbname='.self::DB_NAME, self::USER, self::PASS);
        } catch(PDOException $e){
            die("ERRO: " . $e -> getMessage());
        }
    }

    //Metodo que recebe um comando sql, e valores se necessario e os executa
    private function executarQuery($query, $valores = []){
        try{
            
            //abrindo conexao
            $this -> conectar();

            //criando statement e preparando a query que foi passada como argumento
            $statement = $this -> conexao -> prepare($query);
            $statement -> execute($valores);
        
            
            //fechando conexao
            $this -> conexao = null;
            //var_dump($statement); exit;
            //retornando o resultado da query
            return $statement;
        } catch (PDOException $e){
            echo('Erro3: ' . $e -> getMessage());
            return false;
        }
    }

    //Construtor que recebe uma tabela referente a tabela do banco de dados que ira trabalhar
    public function __construct($table = null){
        $this -> table = $table; 
    }

    //Metodo criado para executar o comando SQL -> `INSERT`
    public function insert($dados = []){
        /*
        recebendo as chaves da array $dados
        ATENCAO!!
        OS PARAMETROS PASSADOS PARA ESTA ARRAY $DADOS COMO CHAVE,
        DEVEM SER REFERENTES AOS NOMES DAS COLUNAS DA TABELA NO BANCO, IDENTICOS.
        !!ATENCAO
        */
        $chaves = array_keys($dados);

        /*atribuindo uma lista a variavel $valores,
        do tamanho da array $chaves,
        preenchida por `?`.
        */
        $valores = array_pad([], count($chaves), '?');

        /*Montando a $query, substituindo o nome da tabela,
        substituindo as chaves usando a funcao implode(),
        substituindo os valores por `?` usando a funcao implode
        */ 
        $query = 'INSERT INTO '.$this -> table.'('.implode(', ', $chaves).') VALUES('.implode(', ', $valores).')';
        //Chamando o metodo `executarQuery` e passando a $query montada e APENAS OS VALORES de `$dados`
        $this -> executarQuery($query, array_values($dados));

        return true;
        
    }

    //Metodo criado pra executar o comando SQL -> `SELECT`
    public function select($where = null, $order = null, $limit = null, $campos = '*'){
        
        /*Usando OPERADOR TERNARIO para concatenar ou nao
        Se o parametro $where tiver mais que uma string, sera concatenado com uma
        string `WHERE`
        Senao $where = ''
        */ 
        $where = strlen($where) ? ' WHERE '.$where: '';
        //Mesma logica
        $order = strlen($order) ? ' ORDER BY '.$order: '';
        //Mesma logica
        $limit = strlen($limit) ? ' LIMIT '.$limit: '';

        /*Montando a query do `SELECT`,
        concatenando o nome da tabela,
        concatenando os parametros por ALGO ou por ''
        */
        $query = 'SELECT '.$campos.' FROM '.$this->table.''.$where.''.$order.''.$limit.'';
       
        
        //preciso usar o fetch all aqui, ainda nao terminei!
        return $this ->  executarQuery($query);



    }
    //Organizar esta funcao direito
/*     public function lastInsert()
    {
        $this -> conectar();
        //die("teste");
        $UltimoID = $this-> conexao -> lastInsertId('id_cadas');
        
        var_dump($UltimoID); exit;
      //return $this -> executarQuery($query) -> fetchAll(PDO::FETCH_ASSOC);
        
    }
 */
}
?>
