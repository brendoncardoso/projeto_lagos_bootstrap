<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}
    $sql = mysql_query("SELECT * FROM estados");

    $sql_rows = mysql_num_rows($sql);
    
    while($row = mysql_fetch_assoc($sql)){
        $arrayEst[$row['id']] = [
            "estado" => $row['estado'],
            "sigla" => $row['sigla']
        ];    
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

        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/global.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                

                $(".message").delay(5000).fadeOut("slow");

                $('.icon-editar').click(function(){                    
                    $("#id").val($(this).attr("data-key"));
                    $("#form1").attr("action","estadosform.php");
                    $("#form1").submit();
                });

                $(".icon-excluir").click(function(){
                    var id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir esse Estado?')){
                        $.post('../actions/action.estados.php', {id:id, method:"exclui"}, function(data) {
                            if(data){
                                window.location = "estados.php";
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
                <form name="form1" action="" method="post" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h2>Lista de Estados</h2>
                            <input type="hidden" name="id" id="id" value="" />
                            <?php if (isset($mensagem))  { ?>
                                <div class="message">
                                    <?= $mensagem; ?>
                                </div>
                            <?php }?>

                            <?php if(!empty($sql_rows) || $sql_rows > 0) { ?>
                                <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Estado</th>
                                            <th>Sigla</th>
                                            <th colspan="2">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                        ?>
                                        <?php foreach($arrayEst as $id_estado => $values) { ?>
                                            <tr class="<?php echo $class ?>">
                                                <td class="center"><?= $id_estado; ?></td>
                                                <td class="center"><?= $values['estado']; ?></td>
                                                <td class="center"><?= $values['sigla']; ?></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $id_estado; ?>" >&nbsp;</a></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $id_estado; ?>" >&nbsp;</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <h4><a href="estadosform.php">Clique aqui</a> para Cadastrar.</h4>
                            <?php } else { ?>
                                <h4>Nenhum estado cadastrado. <a href="estadosform.php">Clique aqui</a> para Cadastrar.</h4>
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
