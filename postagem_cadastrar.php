<?php
    require_once('inc/classes.php');

    if(isset($_POST['btnCadastrar'])){
       $Postagem = new Postagem();
       $Postagem->cadastrar($_POST);
       header('location:'.URL.'/postagens.php');     
    }
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
            <h1> CADASTRAR POSTAGEM </h1>
            <form action="?" method="POST">
                <!-- CAMPO OCULTO -->
                <input type="hidden" name="id_usuario" value="6">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="descricao" >Descrição</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label" for="foto" >Foto</label>
                        <input class="form-control" type="File" name="Foto" id="foto" >
                    </div>
                    <div class="offset-11 col-md-2 mt-3">
                        <input class="btn btn-success" type="submit"  name="btnCadastrar" value="Cadastrar">
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