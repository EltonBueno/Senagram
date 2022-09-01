<?php

class Usuario extends Conexao 
{
    public $pdo;

    public function __construct() 
    {
        $this->pdo = Conexao::conexao();
    }

    /**
     * listar usuários
     */ 

    public function listar()
    {
        // abrir a conexão com BD
        // Montar a consulta 
        $sql = $this->pdo->prepare('SELECT * FROM usuarios');
        // executar
        $sql->execute();
        // retornar os dados
        return $sql->fetchAll(PDO::FETCH_OBJ);

    }

    public function cadastrar(Array $dados = null)
    {
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (:nome,:email,:senha)");
    
        // mesclar os dados
        // ou tratar os dados
        $sql->bindParam(':nome',$dados['nome']);
        $sql->bindParam(':email',$dados['email']);
        $sql->bindParam(':senha',$dados['senha']);

        //executar
        $sql->execute();

        return $this->pdo->lastInsertId();
    }

}



?>