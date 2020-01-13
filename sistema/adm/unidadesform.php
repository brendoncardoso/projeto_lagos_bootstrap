<?php

include('../includes/conecte.php');

include('../includes/restricao.php');

$act = 1;

if (isset($_REQUEST['id'])) {

    $result = mysql_query("SELECT * FROM unidades WHERE id_unidade = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);



        $nome = $row['nome'];

        $endereco = $row['endereco'];

        $bairro = $row['bairro'];

        $cidade = $row['cidade'];

        $cep = $row['cep'];

        $uf = $row['uf'];

        

    } else {

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/unidade.php");

    }

} else {

    $act = 2;

    $nome = "";

    $endereco = "";

    $bairro = "";

    $cidade = "";

    $cep = "";

    $uf = "";

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

                

                $("input[name=cancelar]").click(function(){

                    window.location = 'unidades.php';

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

                <form name="cadastro" action="../actions/action.unidades.php" method="post" enctype="multipart/form-data" id="form1">

                    <div id="conteudo">

                        <div class="blocos">

                            <h3>Cadastro de Processo Seletivo</h3>

                            <hr/>

                            <fieldset>

                                <legend>Dados</legend>

                                <p><label class="first2">Nome:</label><input type="text" name="nome" id="nome" value="<?php echo $nome ?>" class="validate[required]" /></p>

                                <p><label class="first2">Endereço:</label><input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>" /></p>

                                <p><label class="first2">Bairro:</label><input type="text" name="bairro" id="bairro" value="<?php echo $bairro ?>" class="validate[required]" /></p>

                                <p><label class="first2">Cidade:</label><input type="text" name="cidade" id="cidade" value="<?php echo $cidade ?>" class="validate[required]" /></p>

                                <p><label class="first2">Estado:</label><input type="text" name="uf" id="uf" value="<?php echo $uf ?>" class="validate[required]" maxlength="2" /></p>

                                <p><label class="first2">CEP:</label><input type="text" name="cep" id="cep" value="<?php echo $cep ?>" maxlength="9" /></p>



                                <p class="controls"> 

                                    <?php if ($act == 1) { ?>

                                        <input type="submit" name="enviar" value="Salvar" class="button" />

                                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />

                                    <?php } else { ?>

                                        <input type="submit" name="enviar" value="Cadastrar" class="button" />

                                    <?php } ?>

                                    <input type="button" name="cancelar" value="Cancelar" class="button" />

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