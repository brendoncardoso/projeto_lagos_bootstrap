<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
    
if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

if(isset($_FILES['imagem']['name']) && !empty($_FILES['imagem']['name']) && 
    isset($_POST['nome_imagem']) && !empty($_POST['nome_imagem'])){
    $id_img = $_REQUEST['imagem'];
    $nome_imagem = $_POST['nome_imagem'];
    
    $extensoes = array('jpg', 'png', 'jpeg');
    $pasta = "cms_slides/";

    $extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));
    header('location: slideform.php?imagem='.$_GET['imagem']);

    
    if (array_search($extensao, $extensoes) === false) {
        $_SESSION["message"] = "Extensão não permitida, por favor, tente novamente.";
    } else {
        if(mysql_query("INSERT INTO cms_slides (id_img, extensao, nome_imagem) VALUES ({$id_img}, '{$extensao}', '{$nome_imagem}')")){
            $nome_final = $id_img;
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $nome_final.".".$extensao)) {
                $_SESSION["message"] = "Upload efetuado com sucesso!";            
            } else {
                $_SESSION["message"] = "Não foi possível enviar o arquivo, tente novamente";
            }
        }
    }
} else {
    $_SESSION["message"] = "Houve um erro. Algum dos campos não está sendo preenchido corretamente!";
}


?>

<!DOCTYPE html>

<html lang="pt">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="-1" />
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Administração de Candidatos</title>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery.qtip.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>
        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>
        <script src="../resources/js/maskedinput.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.qtip-2.min.js" type="text/javascript"></script>

        <script>

            $(document).ready(function(){
                $("input[name=cancelar]").click(function(){
                    window.location = 'cms.php';
                });
            });
        </script>
    </head>

    <body>
        <div class="main">
            <div id="header">
                <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
            </nav>

            <section>
                <form name="" method="post" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Slide <?= isset($_GET['imagem']) ? $_GET['imagem'] : '';?></h3>
                            
                            <hr/>

                            <?php if (isset($mensagem))  { ?>
                                <div class="message">
                                    <?= $mensagem; ?>
                                </div>
                            <?php }?>

                            <fieldset>
                                <legend>Dados</legend>
                                <p><label class="first2">Nome:</label><input type="text" name="nome_imagem" id="nome" class="validate[required]" /></p>
                                <p><label class="first2" for="">Imagem <?php echo $_REQUEST['imagem']; ?>:</label><input type="file" name="imagem" ></p>
                                <p class="controls"> 
                                    <input type="submit" name="enviar" value="SALVAR" class="button" />
                                    <input type="button" name="cancelar" value="VOLTAR" class="button" />
                                </p>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>