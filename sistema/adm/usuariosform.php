<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
$act = 1;

$sql = mysql_query("SELECT id_unidade, nome AS nome_unidade, status FROM unidades WHERE status = 1");
while($row_sql = mysql_fetch_assoc($sql)){
    $arrayUnidades[$row_sql['id_unidade']] = [
        "id_unidade" => $row_sql['id_unidade'],
        "nome_unidade" => $row_sql['nome_unidade']
    ];
}

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $result = mysql_query("SELECT * FROM usuarios WHERE usu_id = '{$_REQUEST['id']}'");
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_assoc($result);
        $login = $row['login'];
        $id_unidade = $row['id_unidade'];
        $setor = $row['setor'];
    } else {
        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";
        header("Location: ../adm/usuario.php");
    }

} else {
    $act = "";
    $login = "";
    $id_unidade = "";
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
                $("#form1").validationEngine();
                
                $("input[name=cancelar]").click(function(){
                    window.location = 'usuarios.php';
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
                <form name="cadastro" action="../actions/action.usuarios.php" method="post" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Criação de Usuário</h3>
                            <hr/>

                            <fieldset>
                                <legend>Dados</legend>
                                <p><label class="first2">Login:</label><input type="text" name="login" id="login" value="<?php echo $login ?>" class="validate[required]" /></p>
                                <?php if (empty($act)) { ?>
                                    <p><label class="first2">Senha:</label><input type="password" name="senha" id="senha" value="" class="validate[required]" /></p>
                                <?php } ?>
                                <p><label class="first2">Unidade: </label>
                                    <select name="unidade" id="" style="width: 400px;" class="validate[required]">
                                        <option value="-1">« Selecione »</option>
                                        <?php foreach ($arrayUnidades AS $unidade => $values) { ?>
                                            <option value="<?= $values['id_unidade']; ?>" <?=  $values['id_unidade'] == $id_unidade ? 'selected' : '';?>><?= $values['nome_unidade']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p><label class="first2">Setor: </label>
                                    <select name="setor" id="" style="width: 400px;" class="validate[required]">
                                        <option value="-1">« Selecione »</option>
                                        <option value="1" <?= $setor == 1 ? 'selected' : ''; ?>>Administrativo</option>
                                        <option value="0" <?= $setor == 0 ? 'selected' : ''; ?>>Escala</option>
                                    </select>
                                </p>

                                <?php if($act == 1) { ?>
                                    <p>
                                        <label for="" class="first2">
                                        <small><b style="color: red">Atenção!</b></small></label>
                                        <small><i>Esqueceu a Senha? Mande uma mensagem para: <b>brendon.carvalho@f71.com.br</b></i></small>
                                    </p>
                                <?php } ?>

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