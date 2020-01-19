<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    if (isset($_SESSION['message'])) {
        $mensagem = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    
    
    if(isset($_POST['nome']) && !empty($_POST['nome']) &&
        isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){

        $pasta = "cms_logo_images";

        if(!is_dir($pasta)){
            mkdir($pasta);
        }

        $extensoes = array('jpg', 'png', 'jpeg');
        $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

        header('location: logoform.php');

        if (array_search($extensao, $extensoes) === false) {
            $_SESSION["message"] = "Extensão não permitida, por favor, tente novamente.";
        }else{
            
            if(mysql_query("INSERT INTO cms_logo (nome_logo, extensao) VALUES ('{$_POST['nome']}', '$extensao')")){
                $id_final = mysql_insert_id();
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta."/".$id_final.".".$extensao)) {
                    $_SESSION["message"] = "Upload efetuado com sucesso!";
                } else {
                    $_SESSION["message"] = "Não foi possível enviar o arquivo, tente novamente";
                }
            }
        }
    }else{
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

                $(".message").delay(2000).fadeOut("slow");
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
                            <h3>Logo</h3>
                            <hr/>

                            <?php if (isset($mensagem))  { ?>
                                <div class="message">
                                    <?= $mensagem; ?>
                                </div>
                            <?php }?>

                            <fieldset>
                                <legend>Dados</legend>
                                <p><label class="first2">Nome:</label><input type="text" name="nome" id="nome" class="validate[required]" /></p>
                                <p><label class="first2" for="">Imagem :</label><input id="arquivo" type="file" name="arquivo" ></p>
                                <p class="controls"> 
                                    <input id="inserir_logo" type="submit" name="enviar" value="INSERIR" class="button" />
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