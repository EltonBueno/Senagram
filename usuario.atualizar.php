<?php
    require_once('inc/classes.php');
    $Usuario = new Usuario();
    if(isset($_POST['btnEditar'])){ 
       $Usuario->atualizar($_POST);
       header('location:'.URL.'/usuarios.php');     
    }
    //pegar os dados do usuario,
    //que o ID foi informado pela variavel [id]
    $usuario = $Usuario->mostrar($_GET['id']);
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
            <h1>EDITAR USUÁRIO: <?php echo $usuario->nome; ?> </h1>
            <form action="?" method="POST">
                <!-- CAMPO OCULTO -->
                <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario; ?>">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="nome" >Nome*</label>
                        <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $usuario->nome; ?>" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="email" >Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $usuario->email; ?>" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" required autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ConfirmarSenha" class="form-label">Confirmar Senha</label>
                        <input type="password" name="ConfirmarSenha" id="ConfirmarSenha" class="form-control" required autocomplete="off">
                    </div>
                    <div class="offset-11 col-md-2 mt-3">
                        <input class="btn btn-success" type="submit"  name="btnEditar" value="Editar" required autocomplete="off">
                    </div>
                </div>
            </form>
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