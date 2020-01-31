<?php

include('../includes/conecte.php');
include('../includes/restricao.php');


if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}


$act = 1;
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
       $result = mysql_query("SELECT * FROM editalnoticias WHERE id_editalnoticia = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);

        $id = $row['id_editalnoticia'];
        $nome__edital = $row['nome_edital'];

    } else {

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/editalnoticia.php");

    }

}else {

    $act = 2;
    $id = "";
    $nome__edital = "";

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

                $('#cep').mask('99999-999');
                $("#form1").validationEngine();
                $("#selecione").click(function(){
                    if($(this).is(':checked')){
                        $("input[type=checkbox]").attr("checked","checked");
                    }else{
                        $("input[type=checkbox]").removeAttr("checked");
                    }
                });

                /*$('.excluir_img').on('click', function(){
                    var id_noticia = $(this).data('id_noticia');
                    if(confirm("Tem certeza que deseja Exluir a Imagem da notícia do id = "+ id_noticia +" ?")){
                        $.post('../actions/action.noticias.php', {id_noticia:id_noticia, method: "excluir_thumb"}, 
                        function(data) {
                            if(data){
                                window.location.href = "noticias.php";
                            }
                        },"json");
                    }
                });*/

                $("input[name=cancelar]").click(function(){
                    window.location = 'noticiasform.php';
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
                <form name="cadastro" action="../actions/action.editalnoticias.php" method="post" enctype="multipart/form-data" id="form1">
                    <?php if ($act == 1 || $act == 2) { ?>
                        <div id="conteudo">
                            <div class="blocos">
                                <h3>Cadastro de Edital de Notícias</h3>
                               

                                <?php if (isset($mensagem))  { ?>
                                    <div class="message">
                                        <?= $mensagem; ?>
                                    </div>
                                <?php }?>
                                
                                <hr class="clear"/>
                                

                                <fieldset>
                                    <legend>Dados</legend>
                                    <!--<p><label class="first2">Nível:</label>
                                        <select name="nivel" id="nivel" class="validate[required,custom[select]]">
                                            <option value="-1">« Selecione »</option>
                                            <?php
                                            $qr_nivel = mysql_query("SELECT * FROM niveis");
                                            while ($row_nivel = mysql_fetch_assoc($qr_nivel)):
                                                $selected = ($nivel == $row_nivel['id_nivel']) ? "selected='selected'" : "";
                                                ?>
                                                <option value="<?php echo $row_nivel['id_nivel']; ?>" <?php echo $selected ?>><?php echo $row_nivel['nome']; ?></option>
                                                <?php
                                            endwhile;
                                            ?>
                                        </select>
                                    </p>-->

                                    <p><label class="first2">Nome do Edital:</label><input type="text" name="nome_edital" id="nome_edital" value="<?= $nome__edital;?>" class="validate[required]" /></p>


                                    <p class="controls"> 
                                        <?php if ($act == 1) { ?>
                                            <input type="submit" name="enviar" value="Salvar" class="button" />
                                            <input type="hidden" name="id" value="<?= $id; ?>" />
                                        <?php } else { ?>
                                            <input type="submit" name="enviar" value="Cadastrar" class="button" />
                                        <?php } ?>
                                        <input type="button" name="cancelar" value="Cancelar" class="button" />
                                    </p>
                                </fieldset>
                            </div>
                        </div>

                        <?php } else { ?>
                        <div id="conteudo">
                            <div class="blocos">
                                <h2>Unidade: <?php echo $unidade['nome'] ?></h2>
                                <h4>Selecione os cargos que fazem parte do quadro de cargos da unidade</h4>
                                <hr />
                                <p><label><input type="checkbox" name="selecione" id="selecione" value="" > Selecionar Todos </label></p>
                                <br />

                                <hr class="clear"/>

                                <p class="controls">
                                    <input type="submit" name="enviar" value="Salvar" class="button" />
                                    <input type="hidden" name="id" value="<?php echo $_REQUEST['relacionar']; ?>" />
                                    <input type="hidden" name="relacionar" value="sim" />
                                    <input type="button" name="cancelar" value="Cancelar" class="button" />
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </form>

            </section>

            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>