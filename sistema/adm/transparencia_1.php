<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');
include('../includes/global.php');

$sql_t = mysql_query("SELECT A.*, B.nome AS nome_unidade
                FROM relatorio_execucao AS A
                LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                WHERE A.status = 1                
                ORDER BY A.ano, B.nome, A.mes") or die(mysql_error());
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
                    window.location = 'relatorio_exec_form.php';
                });                                
                
                $(".icon-excluir").click(function(){
                    var id = $(this).data("key");
                    var file = $(this).data("file");
                    var del = $(this).data("del");                    
                    
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir esse relatório?')){
                        $.ajax({
                            url:"exclui_file.php",
                            type:"POST",
                            dataType:"json",
                            data:{
                                id:id,
                                file: file,
                                method:"exclui_relatorio"
                            },
                            success:function(data){
                                if(data.status){
                                    $("."+del).remove();
                                }
                            }
                        });
                    }
                });
                
                $(".lnk").click(function(){
                    var key = $(this).data("key");
                    var ano = $(this).data("ano");
                    $(".uni"+key+"_"+ano).toggle();
                });
            });
        </script>
    </head>

    <body>
        <div class="main">
            <div id="header">
                <h1 class="title1">ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
                <li><a href="../adm/relatorios.php">RELATÓRIOS_1</a> <!--relatorios.php--></li>
            </nav>

           <!-- <section>
                <form method="post" action="" name="form1" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h2>Relatório de Execução</h2>

                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>" />

                            <div id="novo" class="box-1">
                                <div class="box-image center">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Novo Relatório</p>
                                </div>
                            </div>

                            <hr class="clear"/>

                            <?php if (isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>

                            <?php
                            if (mysql_num_rows($sql_t) == 0) {
                                echo "<h4>Nenhuma relatório cadastrado</h4>";
                            } else {
                                ?>
                                <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">                                    
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $ano = "";
                                        $unidade = "";
                                        while ($row = mysql_fetch_assoc($sql_t)) {
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                            
                                            if($ano != $row['ano']){
                                                $ano = $row['ano'];
                                            ?>
                                        <tr>
                                            <td colspan="3" class="center bk"><?php echo $row['ano']; ?></td>
                                        </tr>
                                        <?php                                         
                                            }
                                            
                                            if($unidade != $row['nome_unidade']){
                                                $unidade = $row['nome_unidade'];
                                        ?>
                                        <tr class="odd">
                                            <td colspan="3" class="lnk" data-ano="<?php echo $row['ano']; ?>" data-key="<?php echo $row['id_unidade']; ?>"><?php echo $row['nome_unidade']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        
                                            <tr class="some uni<?php echo $row['id_unidade']; ?>_<?php echo $row['ano']; ?> rel<?php echo $row['id_execucao']; ?>">
                                                <td><?php echo mesesArray($row['mes']); ?></td>
                                                <td><a href="rel_execucao/<?php echo $row['id_unidade']."_".$row['mes']."_".$row['ano'].".pdf"; ?>" target="_blank">Visualizar arquivo</a></td>
                                                <td class="f_left">
                                                    <a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row['id_execucao'] ?>" data-file="<?php echo $row['id_unidade']."_".$row['mes']."_".$row['ano'].".pdf"; ?>" data-del="rel<?php echo $row['id_execucao']; ?>">&nbsp;</a>
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>
                                    </tbody>
                                    <?php echo $html_pagina ?>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </section> -->
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>
