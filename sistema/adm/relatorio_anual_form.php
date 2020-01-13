<?php include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/global.php');
$sql = mysql_query("SELECT * FROM unidades  WHERE status = 1 ORDER BY nome") or die(mysql_error());

if (isset($_REQUEST['gravar'])) {
    $unidade = $_REQUEST['unidade'];
    $subtipo = $_REQUEST['subtipo'];
    $ano = $_REQUEST['ano'];
    $arquivo = $_FILES['arquivo'];
    $tipo = 2;

// relatorio anual
    $size = 1024 * 1024 * 15;
// limite para arquivo = 15MB
    $pasta = "rel_anual/";
    $nome = "{$unidade}_{$tipo}_{$subtipo}_{$ano}.pdf";
    $sql_uni = mysql_query("SELECT *  FROM unidades WHERE id_unidade = '{$unidade}'") or die(mysql_error());
    $row_uni = mysql_fetch_assoc($sql_uni);
    $nome_uni = $row_uni['nome'];
    if ($subtipo == 1) {
        $nome_subtipo = 'Relatório';
    }
    if ($subtipo == 2) {
        $nome_subtipo = 'Balancete';
    }
    if ($subtipo == 3) {
        $nome_subtipo = 'Inventário';
    }
    if ($arquivo['size'] > $size) {
        $estilo = 'danger';
        $texto = 'Arquivo não pode ter mais que 15 MB';
    }
    if (file_exists($pasta . "/" . $nome)) {
        unlink($pasta . "/" . $nome);
        $move_new = move_uploaded_file($arquivo['tmp_name'], $pasta . "/" . $nome);
        if ($move_new) {
            $estilo = 'info';
            $texto = "<u>{$nome_subtipo}/{$ano}</u> da unidade <u>{$nome_uni}</u> cadastrado com sucesso";
        }
    } else {
        $move = move_uploaded_file($arquivo['tmp_name'], $pasta . "/" . $nome);
        $insere = mysql_query("INSERT INTO relatorio (id_unidade, subtipo, ano, status, tipo) VALUES ({$unidade}, {$subtipo}, {$ano}, 1, 2)") or die(mysql_error());
        if (($move) && ($insere)) {
            $estilo = 'info';
            $texto = "<u>{$nome_subtipo}/{$ano}</u> da unidade <u>{$nome_uni}</u> cadastrado com sucesso";
        } else {
            $estilo = 'danger';
            $texto = 'Erro ao Cadastrar Arquivo';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Expires" content="-1"/>
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <title>Administração de Candidatos</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
    <link href="../resources/css/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"/>
    <link href="../resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>
    <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
    <script src="../resources/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="../resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>
    <script>            $(function () {
            $("#form2").validationEngine();
        });        </script>
    <style>            .danger {
            background: #FBD3B1;
            border: 1px solid #F7CBA3;
            color: #CE2700;
        }

        .info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        #box {
            font-family: Tahoma;
            font-weight: bold;
            padding: 10px 20px;
            margin: 10px 0;
        }                                </style>
</head>
<body>
<div class="main">
    <div id="header"><h1>ADMINISTRAÇÃO DE CANDIDATOS</h1></div>
    <nav>            <?php include('../includes/menu_adm.php'); ?>            </nav>
    <section>
        <form name="cadastro" action="" method="post" enctype="multipart/form-data" id="form2">
            <div id="conteudo">
                <div class="blocos"><h3>Cadastro de Relatório de Anual</h3>
                    <hr/>
                    <?php if(isset($_POST['gravar'])) { ?>
                        <div class="<?php echo $estilo; ?>"
                            id="box"> <?php echo $texto; ?> </div>
                        <?php }else { ?>
 
                        <?php } ?>
                    <fieldset>
                        <legend>Dados</legend>
                        <p><label class="first2">Unidade:</label> <select name="unidade" id="unidade"
                                                                          class="validate[required,custom[select]]">
                                <option value="-1">Selecione</option> <?php while ($row = mysql_fetch_assoc($sql)) { ?>
                                    <option value="<?php echo $row['id_unidade']; ?>"><?php echo $row['nome']; ?></option>                                        <?php } ?>
                            </select></p>
                        <p><label class="first2">Tipo:</label> <select id="subtipo" name="subtipo">
                                <option value="-1" selected="selected">Selecione</option>
                                <option value='1'>Relátorio</option>
                                <option value='2'>Balancete</option>
                                <option value='3'>Inventário</option>
                            </select></p>
                        <p><label class="first2">Ano
                                Referente:</label> <?php echo montaSelect(anosArray(2012, date("Y"), array("-3" => "Selecione o ano")), null, "id='ano' name='ano' class='validate[required,custom[select]]'"); ?>
                        </p>
                        <p><label class="first2" style="font-size: 0.75em; color: red">Tamanho max 15Mb</label> <input
                                    type="file" name="arquivo" id="arquivo"
                                    class="validate[required,custom[arquivo15MbPdf]]"/></p>
                        <p class="controls"><input type="submit" name="gravar" value="Cadastrar" class="button"/></p>
                    </fieldset>
                </div>
            </div>
        </form>
    </section>
    <section id="footer"><p>Todos os direitos reservados</p></section>
</div>
</body>
</html>