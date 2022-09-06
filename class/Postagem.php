<?php 
    class Postagem 
    {
        public $pdo;

        public function __construct() 
        {
            $this->pdo = Conexao::conexao();
        }
    
        /**
         * listar postagens
         */ 
    
        public function listar()
        {
            // abrir a conexão com BD
            // Montar a consulta 
            $sql = $this->pdo->prepare('SELECT * FROM postagens');
            // executar
            $sql->execute();
            // retornar os dados
            return $sql->fetchAll(PDO::FETCH_OBJ);
    
        }
    
        public function cadastrar(Array $dados = null)
        {
            $sql = $this->pdo->prepare("INSERT INTO postagens (id_usuario,descricao,dt) VALUES (:id_usuario, :descricao, :dt)");
        
            // tratar os dados
            $id_usuario = $dados['id_usuario'];
            $descricao = $dados['descricao'];
            $dt = date('Y-m-d H:i');
    
            // mesclar os dados
            $sql->bindParam(':id_usuario',$id_usuario);
            $sql->bindParam(':descricao',$descricao);
            $sql->bindParam(':dt',$dt);
    
            //executar
            $sql->execute();
    
            return $this->pdo->lastInsertId();
        }
    
        /*Atualizar o postagem
        * 
        * 
        */
        public function atualizar(array $dados)
        {
            $sql = $this->pdo->prepare("UPDATE  postagens SET 
                                            descricao = :descricao,
                                            dt = :dt 
                                        WHERE 
                                            id_postagem = :id_postagem
                                        LIMIT 1"
                                        );
        
            // tratar os dados
            $descricao = $dados['descricao'];
            $dt = date('Y-m-d H:i');
    
            // mesclar os dados
            $sql->bindParam(':descricao',$descricao);
            $sql->bindParam(':dt',$dt);
            $sql->bindParam(':id_usuario',$dados['id_usuario']);
    
            //executar
            $sql->execute();
        }
        
        // Apagar postagem
        public function apagar(int $id_postagem) 
        {
          $sql = $this->pdo->prepare("DELETE FROM postagens WHERE id_postagem = :id_postagem");
          $sql->bindParam(':id_postagem', $id_postagem);
          $sql->execute();  
    
          
        }
    
        public function mostrar(int $id_postagem)
        {
            $sql = $this->pdo->prepare("SELECT * FROM postagens WHERE id_postagem = :id_postagem");
            
            $sql->bindParam(':id_postagem', $id_postagem);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_OBJ);
        }
        
        // incrementa a contagem de gostei

        public function gostei(int $id_postagem)
        {
           $sql = $this->pdo->prepare('UPDATE postagens SET gostei = gostei++
                                        WHERE id_postagem = :id_postagem');

            $sql->bindParam(':id_postagem', $id_postagem);
            $sql->execute();
        }

        //incrementa a contagem não gostei
        
        public function naogostei(int $id_postagem)
        {
           $sql = $this->pdo->prepare('UPDATE postagens SET naogostei = naogostei++
                                        WHERE id_postagem = :id_postagem');

            $sql->bindParam(':id_postagem', $id_postagem);
            $sql->execute();
        }
    }

?>