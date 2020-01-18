<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}
    $sql = mysql_query("SELECT A.usu_id, A.id_unidade, B.nome AS nome_unidade, A.login, A.senha, A.adm, A.setor, A.status
                        FROM usuarios AS A
                        INNER JOIN unidades AS B ON (A.id_unidade = B.id_unidade) ORDER BY A.id_unidade ASC;");

    $sql_rows = mysql_num_rows($sql);
    
    while($row = mysql_fetch_assoc($sql)){
        $arrayUsu[$row['usu_id']] = [
            "id_unidade" => $row['id_unidade'],
            "nome_unidade" => $row['nome_unidade'],
            "login" => $row['login'], 
            "setor" => $row['setor']
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
                $("#novo").click(function(){
                    window.location = 'usuariosform.php';
                });

                $(".message").delay(5000).fadeOut("slow");

                $('.icon-editar').click(function(){                    
                    $("#id").val($(this).attr("data-key"));
                    $("#form1").attr("action","usuariosform.php");
                    $("#form1").submit();
                });

                $(".icon-excluir").click(function(){
                    var usu_id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir essa Unidade?')){
                        $.post('../actions/action.usuarios.php', {id_usuario:usu_id, method:"exclui"}, function(data) {
                            if(data){
                                window.location = "usuarios.php";
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
                            <h2>Usuários</h2>

                            <input type="hidden" name="id" id="id" value="" />
                            <div id="novo" class="box-1">
                                <div class="box-image center">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Novo Usuário</p>
                                </div>
                            </div>
                            
                            <hr class="clear"/>

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
                                            <th>Unidade</th>
                                            <th>Login</th>
                                            <th>Setor</th>
                                            <th colspan="2">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                        ?>
                                        <?php foreach($arrayUsu as $id_usu => $values) { ?>
                                            <tr class="<?php echo $class ?>">
                                                <td class="center"><?= $id_usu; ?></td>
                                                <td class="center"><?= $values['nome_unidade']; ?></td>
                                                <td class="center"><?= $values['login']; ?></td>
                                                <td class="center">
                                                    <?php if($values['setor'] == 1) { ?>
                                                        Administrativo
                                                    <?php } else { ?>
                                                        Escala
                                                    <?php } ?>
                                                </td>
                                                <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $id_usu; ?>" >&nbsp;</a></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $id_usu; ?>" data-login="<?php echo $values['login']?>" >&nbsp;</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <h4>Nenhum usuário cadastrado.</h4>
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
