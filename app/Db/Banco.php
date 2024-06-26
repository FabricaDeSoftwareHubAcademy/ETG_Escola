<?php
namespace App\Db;
use PDO;
use PDOException;
//die('banco'); 
class Banco{
  
    //Variaveis referentes a conexao com o banco de dados
    private $config;
    private $ini_file_path = __DIR__."/../../config.ini";

    private $db_hostname;
    private $db_name;
    private $db_user;
    private $db_password;
    
    private $table;//variavel que vai falar sobre qual tabela do banco esta sendo tratada
    private $conexao;
    public function __construct($table = null)
    { 
        $this->config = parse_ini_file($this->ini_file_path, true);
        $this->db_hostname = $this->config["database"]["host"];
        $this->db_name = $this->config["database"]["db_name"];
        $this->db_user = $this->config["database"]["user"];
        $this->db_password = $this->config["database"]["password"];
        $this -> table = $table; 
    }
    private function conectar(){
        try
        {
            $string_conexao = "mysql:host=".$this->db_hostname;
            $string_conexao .= ";";
            $string_conexao .= "dbname=".$this->db_name;
            $this -> conexao = new PDO($string_conexao, $this->db_user, $this->db_password);
        }
        catch(PDOException $e)
        {
            die("ERRO: " . $e -> getMessage());
        }
    }

    private function executarQuery($query, $valores = [])
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            // echo('Erro3: ' . $e -> getMessage());
            return false;
        }
    }

    private function executeLastId($query, $valores = [])
    {
        try
        {
            //abrindo conexao
            $this -> conectar();

            //criando statement e preparando a query que foi passada como argumento
            $statement = $this -> conexao -> prepare($query);
            $statement -> execute($valores);
            $id = $this->conexao->lastInsertId();
    
            //fechando conexao
            $this -> conexao = null;
            //var_dump($statement); exit;
            //retornando o resultado da query
            return $id;
        }
        catch (PDOException $e)
        {
            echo('Erro3: ' . $e -> getMessage());
            return false;
        }
    }


    public function insert($dados = [])
    {
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

        
        //echo $query; var_dump(array_values($dados));exit;
        //Chamando o metodo `executarQuery` e passando a $query montada e APENAS OS VALORES de `$dados`
        $this -> executarQuery($query, array_values($dados));

        return true;
    }

    public function insertRecoverId($dados = [])
    {
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
         
        //echo $query;var_dump($dados); exit;
        //Chamando o metodo `executarQuery` e passando a $query montada e APENAS OS VALORES de `$dados`
        $id = $this -> executeLastId ($query, array_values($dados));
        return $id;
    }

    public function delete($valor, $coluna)
    {   
        $query = 'DELETE FROM '.$this->table.' WHERE ' . $coluna . ' = '. $valor; 
        return $this->executarQuery($query);
    }

    public function update($where = '',$dados = [])
    {
        //lista chave valor($dados) 
        //obs: chaves tem que ser o mesmo nome que o nome da coluna
        $setter = "";
        $chaves = array_keys($dados);
        $valores = array_values($dados);

        for ($i=0; $i < count($chaves); $i++) { 
            
            if($i == (count($chaves) - 1)){

                $setter .= $chaves[$i] . " = '". $valores[$i]."'";

            }else{

                $setter .= $chaves[$i] . " = '". $valores[$i]."', ";
            }
        }

        $query = 'UPDATE '.$this->table.'
                  SET '. $setter . '
                  WHERE '. $where;
        // echo $query;exit;
        return $this->executarQuery($query);    
        // terminar............ 
    }

    //Metodo criado pra executar o comando SQL -> `SELECT`
    public function select($where = null, $order = null, $limit = null, $campos = '*')
    {
        /*Usando OPERADOR TERNARIO para concatenar ou nao
        Se o parametro $where tiver mais que uma string, sera concatenado com uma
        string `WHERE`
        Senao $where = ''
        */ 
        //echo $where;exit;
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
        // echo $query;exit;

        //preciso usar o fetch all aqui, ainda nao terminei!
        return $this ->  executarQuery($query);
    }

    public function  selectJoinProfileUser()
    {
        $query = 'SELECT cadastro_usuario.id_perfil AS usuario_id_perfil,
        cadastro_perfil.id AS id_perfil, 
        cadastro_perfil.nome AS nome_perfil
        FROM cadastro_usuario
        JOIN cadastro_perfil ON cadastro_usuario.id_perfil = cadastro_perfil.id';
        return $this ->  executarQuery($query);
    }    

    public function usuario_tem_participacao_fluxo_checklist($id_usuario) : mixed {
        $query = 'SELECT 1 AS result
        WHERE EXISTS (
            SELECT 1
            FROM cadastro_usuario
            RIGHT JOIN etg2.responder_check ON etg2.cadastro_usuario.id = etg2.responder_check.id_usuario
            WHERE etg2.cadastro_usuario.id = '.$id_usuario.'
        )
        OR EXISTS (
            SELECT 1
            FROM cadastro_usuario
            RIGHT JOIN etg2.reg_nc ON etg2.cadastro_usuario.id = etg2.reg_nc.id_user
            WHERE etg2.cadastro_usuario.id = '.$id_usuario.'
        )
        
        OR EXISTS (
            SELECT 1
            FROM cadastro_usuario
            RIGHT JOIN etg2.reg_correcao ON etg2.cadastro_usuario.id = etg2.reg_correcao.id_usuario
            WHERE etg2.cadastro_usuario.id = '.$id_usuario.'
        );';
        return $this -> executarQuery($query);
    }
    public function getdetalhes_amanhecer($id_usuario, $id_checklist){
        $query = "SELECT responder_check.id_usuario, cadastro_usuario.nome AS nome_usuario, cadastro_sala.nome AS nome_sala, responder_check.id, responder_check.data_abertura, responder_check.data_fechamento, reg_nc.*";
        $query .= " FROM responder_check";
        $query .= " INNER JOIN cadastro_usuario ON cadastro_usuario.id = responder_check.id_usuario";
        $query .= " INNER JOIN cadastro_sala ON cadastro_sala.id = responder_check.id_sala";
        $query .= " INNER JOIN reg_nc ON reg_nc.id_realiza = responder_check.id";
        $query .= " WHERE responder_check.id = $id_checklist";
        $query .= " AND responder_check.id_usuario = $id_usuario";
        // die($query);
        return $this->executarQuery($query);
    }
}

?>
