<?php

include('../includes/conecte.php');

include('../includes/restricao.php');



$act = 1;

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {

    $result = mysql_query("SELECT * FROM cargos WHERE id_cargo = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);



        $cargo = $row['cargo'];

        $nivel = $row['id_nivel'];

    } else {

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/cargos.php");

    }

} else if (isset($_REQUEST['relacionar']) && !empty($_REQUEST['relacionar'])) {

    $act = 3;

    

    $qr_unidade = mysql_query("SELECT * FROM unidades WHERE id_unidade = {$_REQUEST['relacionar']}");

    if(mysql_num_rows($qr_unidade) > 0){

        $unidade = mysql_fetch_assoc($qr_unidade);

        $ar_edicao = array();

        $qr_edicao = mysql_query("SELECT id_cargo FROM unidades_cargos WHERE id_unidade = {$_REQUEST['relacionar']}");

        while ($rows_ed = mysql_fetch_assoc($qr_edicao)) {

            array_push($ar_edicao, $rows_ed['id_cargo']);

        }



        $qr_cargos = mysql_query("SELECT * FROM cargos AS A

                                    INNER JOIN niveis AS B ON (B.id_nivel=A.id_nivel)

                                    ORDER BY B.nome,A.cargo");

        $cartosTo = mysql_num_rows($qr_cargos);

    }else{

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/cargos.php");

    }

} else {



    $act = 2;

    $cargo = "";

    $nivel = "";

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

                

                $("input[name=cancelar]").click(function(){

                    window.location = 'cargos.php';

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

                <form name="cadastro" action="../actions/action.cargos.php" method="post" enctype="multipart/form-data" id="form1">

                    <?php if ($act == 1 || $act == 2) { ?>

                        <div id="conteudo">

                            <div class="blocos">

                                <h3>Cadastro de Cargos</h3>

                                <hr/>

                                <fieldset>

                                    <legend>Dados</legend>

                                    <p><label class="first2">Nível:</label>

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

                                        </select></p>

                                    <p><label class="first2">Cargo:</label><input type="text" name="cargo" id="cargo" value="<?php echo $cargo ?>" class="validate[required]" /></p>



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

                        <?php } else { ?>

                        <div id="conteudo">

                            <div class="blocos">

                                <h2>Unidade: <?php echo $unidade['nome'] ?></h2>

                                <h4>Selecione os cargos que fazem parte do quadro de cargos da unidade</h4>

                                <hr />

                                <p><label><input type="checkbox" name="selecione" id="selecione" value="" > Selecionar Todos </label></p>

                                <br />

                                <?php

                                $i = 1;

                                echo "<ul class=\"ulShowCargos\">";

                                while ($row = mysql_fetch_assoc($qr_cargos)) {

                                    $checked = (in_array($row['id_cargo'], $ar_edicao)) ? " checked=\"checked\"" : "";

                                    echo "<li><label><input type=\"checkbox\" name=\"cargos[]\" value=\"{$row['id_cargo']}\"{$checked} > {$row['nome']} - {$row['cargo']} </label></li>";

                                    if ($i++ == ($cartosTo / 2) + 1) {

                                        $i = 1;

                                        echo "</ul><ul class=\"ulShowCargos\">";

                                    }

                                }

                                echo "</ul>";

                                ?>

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