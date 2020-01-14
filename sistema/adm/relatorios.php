<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');
include('../includes/global.php');
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="-1"/>
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>
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
                            <br>
                            <a href="../adm/relatorio_anual.php"><h2> Relatório Anual </h2></a>
                            <a href="../adm/relatorio_de_execucao.php"><h2> Relatório de Execução </h2></a>
                            <a href="../adm/prestacao_de_contas.php"><h2> Prestação de Contas </h2></a>
                        
                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>" />
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