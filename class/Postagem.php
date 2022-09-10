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
    
        public function cadastrar(Array $dados = null, $foto)
        {

              
            // $extensao = end(explode('.', $foto['name']));
            $novoNome = rand(1,100000).date('dmYHis').'.'.end(explode('.', $foto['name']));     
            $ok = move_uploaded_file($foto['tmp_name'],'./imagens/'.$novoNome);
            
            if ($ok ) 
            {    
                $imagem = $novoNome;   
            }
            else
            {
                $imagem = null;
            }

           
            $sql = $this->pdo->prepare("INSERT INTO postagens (id_usuario,descricao,dt,foto) VALUES (:id_usuario, :descricao, :dt, :foto)");
        
            // tratar os dados
            $id_usuario = $dados['id_usuario'];
            $descricao = $dados['descricao'];
            $dt = date('Y-m-d H:i');
    
            // mesclar os dados
            $sql->bindParam(':id_usuario',$id_usuario);
            $sql->bindParam(':descricao',$descricao);
            $sql->bindParam(':dt',$dt);
            $sql->bindParam(':foto',$imagem);
    
            //executar
            $sql->execute();
    
            return $this->pdo->lastInsertId();
        }
    
        /*Atualizar o postagem
        * 
        * 
        */
        public function atualizar(array $dados, $foto )
        {
            if($foto['name'] != '')
            {
                $novoNome = rand(1,100000).date('dmYHis').'.'.end(explode('.', $foto['name']));     
                $ok = move_uploaded_file($foto['tmp_name'],'./imagens/'.$novoNome);
            
                 if ($ok) 
                     $imagem = $novoNome;   

                else
                    $imagem = $dados['foto_atual'];
                
            }
            else
                {
                    $imagem = $dados['foto_atual'];
                }
            
            

            $sql = $this->pdo->prepare("UPDATE  postagens SET 
                                            descricao = :descricao,
                                            dt = :dt,
                                            foto = :foto 
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
            $sql->bindParam(':id_postagem',$dados['id_postagem']);
            $sql->bindParam(':foto', $imagem);
    
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