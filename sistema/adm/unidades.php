<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

/* PAGINAÇÃO */
$limite = 20;
$pagina = (isset($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina - 1) * $limite : 0;
$sql = "SELECT * FROM unidades ORDER BY nome";
$qr_unidade = mysql_query($sql . " LIMIT $inicio,$limite");

$html_pagina = geraPaginacao($pagina, $limite, $sql, "");
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
        <script src="../resources/js/global.js" type="text/javascript"></script>

        <script>
            $(function(){
                $("#novo").click(function(){
                    window.location = 'unidadesform.php';
                });
                $(".message").delay(5000).fadeOut("slow");
                $(".icon-editar").click(function(){
                    $("#id").val($(this).attr("data-key"));
                    $("#form1").attr("action","unidadesform.php");
                    $("#form1").submit();
                });
                $(".icon-excluir").click(function(){
                    var id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir essa Unidade?')){
                        $.post('../actions/action.unidades.php', {unidade:id, method:"exclui"} ,function(data) {
                            if(data){
                                window.location = "unidades.php";
                            }
                        },"json");
                    }
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
                <form method="post" action="" name="form1" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h2>Unidades</h2>

                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>" />

                            <div id="novo" class="box-1">
                                <div class="box-image center">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Nova Unidade</p>
                                </div>
                            </div>

                            <hr class="clear"/>

                            <?php if (isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>

                            <?php
                            if (mysql_num_rows($qr_unidade) == 0) {
                                echo "<h4>Nenhuma unidade encontrada</h4>";
                            } else {
                                ?>
                                <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Endereço</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th>Estado</th>
                                            <th colspan="2">AÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysql_fetch_assoc($qr_unidade)) {
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                            ?>
                                            <tr class="<?php echo $class ?>">
                                                <td><?php echo $row['nome'] ?></td>
                                                <td><?php echo $row['endereco'] ?></td>
                                                <td><?php echo $row['bairro'] ?></td>
                                                <td><?php echo $row['cidade'] ?></td>
                                                <td class="center"><?php echo $row['uf'] ?></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row['id_unidade'] ?>" >&nbsp;</a></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row['id_unidade'] ?>" >&nbsp;</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php echo $html_pagina ?>
                                </table>
                            <?php } ?>

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
