<?php
 require_once('inc/classes.php');
 $Postagem = new Postagem();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAGRAN</title>
    <!-- CSS -->
    <?php
        require_once('inc/css.php');
    ?>
    <!-- /CSS -->
    <!-- JS -->
    <?php
        require_once('inc/js.php'); 
    ?>
    <!-- /JS -->
</head>
<body>
    <div class="container">
        <!-- MENU --> 
        <?php
            require_once('inc/menu.php');            
        ?>             
        <!-- /MENU -->
        <!-- CONTEUDO -->
        <div>
            <h1> POSTAGENS 
                -
                <a class="btn btn-dark" href="<?php echo URL; ?>/postagem_cadastrar.php">
                <i class="bi bi-person-plus-fill"></i>    
                Nova Postagem
                  
                </a>
            </h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Gostei</th>
                        <th>Não Gostei</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $postagens = $Postagem->listar();
                        foreach ($postagens as $postagem) {
                            
                        
                    ?>
                    <tr>
                        <td><a class="btn btn-success" href="<?php echo URL ?>/postagem_atualizar.php?id=<?php echo $postagem->id_postagem ?>"><i class="bi bi-pencil-square"></i>Editar</a>
                        <br>
                        <a class="btn btn-danger mt-1" href="<?php echo URL ?>/postagem_deletar.php?id=<?php echo $postagem->id_postagem ?>"><i class="bi bi-trash"></i>Deletar</a></td>
                        <td>
                        <?php     
                        if($postagem->foto != '')
                        { echo '<img class="img-thumbnail" src="'.URL.'imagens/'.$postagem->foto.'" width="50%">';}    
                        ?>
                        </td>
                        <td><?php echo $postagem->id_postagem; ?></td>
                        <td><?php echo $postagem->id_usuario; ?></td>
                        <td><?php echo $postagem->dt; ?></td>
                        <td><?php echo nl2br($postagem->descricao); ?></td>
                        <td><?php echo $postagem->gostei; ?></td>
                        <td><?php echo $postagem->naogostei; ?></td>
                        
                    </tr>
                    <?php
                        } // fecha foreach
                    ?>
                </tbody>

            </table>
        </div>
        <!-- /CONTEUDO -->
        <!-- RODAPE -->
        <?php
            include_once('inc/rodape.php');
        ?>
        <!-- /RODAPE -->    
    </div>    
</body>
</html>