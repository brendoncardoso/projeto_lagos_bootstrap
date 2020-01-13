<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        //$sql = mysql_query("INSERT INTO pasta (nome) VALUES ('$nome')");
        //echo "INSERT INTO pasta (id_pasta, nome) VALUES ('$id', '$nome')";

        $nome = addslashes($_POST['nome']);
        $sql = mysql_query("INSERT INTO pasta (nome) VALUES ('$nome')");
    }

    $sql_pasta = mysql_query("SELECT * FROM pasta");
    while($row = mysql_fetch_assoc($sql_pasta)){
        $array_nomes[] = [
            "id" => $row['id'],
            "nome" => $row['nome']
        ];
    }

    $sql_pastas_rows = mysql_num_rows($sql_pasta);
   
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
                <form name="" action="" method="post" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Cadastrar Pasta</h3>
                            <fieldset>
                                <legend>Opcao </legend>
                                <p>
                                    <label class="first2">Nome:</label>
                                    <input type="text" name="nome" id="nome" value="" class="validate[required]" />
                                </p>

                                <input type="submit" name="enviar" value="CADASTRAR" class="button" />
                                <a href="prestacao_de_contas.php">
                                    <input  type="button" name="voltar" value="VOLTAR" class="button" />
                                </a>
                            </fieldset>
                        </div>
                        <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pastas</th>
                                    <th colspan="2">Excluir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php  if($sql_pastas_rows > 0) { ?>
                                    <?php $i = 0; ?>
                                    <?php foreach($array_nomes as $pastas) { ?>
                                        <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td class="center"><?php echo $pastas['id']; ?></td>
                                            <td class="center"><?php echo $pastas['nome']; ?></td>
                                            <td class="center"><a href="deletepasta.php?id=<?php echo $pastas['id']; ?>" class="icon icon-excluir" name="excluir" title="Excluir" data-key="83">&nbsp;</a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h4 style="text-align:center;">Nenhuma pasta foi cadastrada.</h4>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>