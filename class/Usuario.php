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
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (:nome, :email, :senha)");
    
        // tratar os dados
        $nome = trim(strtoupper($dados['nome']));
        $email = trim(strtolower($dados['email']));
        $senha = md5($dados['senha']);

        // mesclar os dados
        $sql->bindParam(':nome',$nome);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':senha',$senha);

        //executar
        $sql->execute();

        return $this->pdo->lastInsertId();
    }

    /*Atualizar o usuario
    * 
    * 
    */
    public function atualizar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE  usuarios SET 
                                        nome = :nome,
                                        email = :email,
                                        senha = :senha 
                                    WHERE 
                                        id_usuario = :id_usuario
                                    LIMIT 1"
                                    );
    
        // tratar os dados
        $nome = trim(strtoupper($dados['nome']));
        $email = trim(strtolower($dados['email']));
        $senha = md5($dados['senha']);

        // mesclar os dados
        $sql->bindParam(':nome',$nome);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':senha',$senha);
        $sql->bindParam(':id_usuario',$dados['id_usuario']);

        //executar
        $sql->execute();
    }

    public function apagar(int $id_usuario) 
    {
      $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
      $sql->bindParam(':id_usuario', $id_usuario);
      $sql->execute();  

      
    }

    public function mostrar(int $id_usuario)
    {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
        
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

}



?>