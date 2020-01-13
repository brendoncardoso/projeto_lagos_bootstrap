<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    if(isset($_POST['id_opcao1']) && !empty($_POST['id_opcao1']) && isset($_POST['nome_arquivo']) && !empty($_POST['nome_arquivo']) && isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){
        $id_pasta = intval($_POST['id_opcao1']);
        $nome_arquivo = addslashes($_POST['nome_arquivo']);
        $arquivo = addslashes($_FILES['arquivo']['name']);
        $pasta = "atas_documentos/";

        if($sql = mysql_query("INSERT INTO prestacao_categoria2 (id_pasta, nome_arquivo, arquivo) VALUES ('$id_pasta', '$nome_arquivo', '$arquivo')")){
            $id = mysql_insert_id();
            $nome_final = "{$id}_{$id_pasta}.pdf";
            
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$nome_final)){
                $sql_status = mysql_query("UPDATE pasta SET status = 3 WHERE status = 1 AND id = $id_pasta;");

                echo "<script>alert('Arquivo enviado com Sucesso!');</script>"; 

            }else{
                echo "<script>alert('Error');</script>"; 
            };
        };

    }else{
    
    }

    $sql = mysql_query("SELECT * FROM pasta WHERE status IN (1,3)");
    while($row = mysql_fetch_assoc($sql)){
        $array_nomes[] = [
            "id" => $row['id'],
            "nome" => $row['nome']
        ];
    }

    if(isset($_POST['buscar']) && !empty($_POST['buscar'])){
        $id_pasta = intval($_POST['id_opcao2']);

        $sql_select = mysql_query("SELECT A.id, A.id_pasta, A.nome_arquivo, A.arquivo, A.status FROM prestacao_categoria2 AS 
        A INNER JOIN pasta AS B ON (B.id = A.id_pasta) WHERE B.status = 3 AND id_pasta = $id_pasta;");

        $sql_pesquisa_rows = mysql_num_rows($sql_select);
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
                    <div id="conteudo">
                        <div class="blocos">
                            <form name="" action="" method="post" enctype="multipart/form-data" id="form1">
                                <h3>Categoria 2</h3>
                                <fieldset>
                                    <legend>Categoria 2</legend>
                                    <p>
                                        <label class="first2">Selecione a Pasta:</label>
                                        <select class="pasta validate[required]" name="id_opcao1" id="edital" style="width: 300px;">
                                            <option value="-1"> « Selecione » </option>
                                            <?php foreach($array_nomes as $pasta) { ?>
                                                <option value="<?php echo $pasta['id']?>"><?php echo $pasta['nome']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </p>

                                    <p>
                                        <label class="first2">Nome da Arquivo:</label>
                                        <input type="text" name="nome_arquivo" id="nome" value="" class="validate[required]" />
                                    </p>

                                
                                    <p>
                                        <label class="first2">Arquivo:</label>
                                        <input type="file" name="arquivo" id="file" class="validate[required,funcCall[onlyPdf]]"> 
                                        <span class="exemplo">Somente arquivo PDF</span>
                                    </p>

                                    <input type="submit" name="enviar" value="CADASTRAR" class="button" />
                                    <a href="prestacao_de_contas.php">
                                        <input  type="button" name="voltar" value="VOLTAR" class="button" />
                                    </a>
                                </fieldset>

                                <fieldset>
                                    <legend>Busca</legend>
                                    <p>
                                        <label for="" class="first">Nome: </label>
                                        <select name="id_opcao2" id="" style="width: 400px;">
                                            <option value="-1"> « Selecione » </option>
                                            <?php 
                                                $sql = mysql_query("SELECT DISTINCT A.id_pasta, B.nome, A.status FROM prestacao_categoria2 AS A 
                                                INNER JOIN pasta AS B ON (B.id = A.id_pasta) WHERE B.status = 3;");

                                                while($row = mysql_fetch_assoc($sql)){
                                                    $arrayPastasCriadas[] = [
                                                        "id_pasta" => $row['id_pasta'],
                                                        "nome" => $row['nome']
                                                    ];
                                                }
                                            ?>
                                            <?php foreach($arrayPastasCriadas as $pastasCriadas) { ?>
                                                <option value="<?php echo $pastasCriadas['id_pasta']?>" <?= (isset($_POST['id_opcao2'])) && ($pastasCriadas['id_pasta']) == $_POST['id_opcao2'] ? 'selected':''?>> 
                                                    <?php echo $pastasCriadas['nome']?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </p>
                                    <p class="controls">
                                        <input type="submit" name="buscar" value="BUSCAR" id="buscar" class="button">
                                    </p>
                                </fieldset>
                            </form>                
                            <?php if (isset($sql_pesquisa_rows) && $sql_pesquisa_rows >= 1)  { ?>
                                <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome do Arquivo</th>
                                            <th>Anexo</th>
                                            <th colspan="2">Excluir</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php while ($row = mysql_fetch_assoc($sql_select)) { ?>
                                            <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                                            <tr class="<?php echo $class; ?>">
                                                <td class="center"><?php echo $row['id']; ?></td>
                                                <td class="center"><?php echo $row['nome_arquivo']?></td>
                                                <td class="center"><a href="../adm/atas_documentos/<?php echo $row['id']; ?>_<?php echo $row['id_pasta']?>.pdf" target="_blank"><?php echo $row['arquivo']; ?></a></td>
                                                <td class="center"><a href="deletearquivo2.php?id=<?php echo $row['id']?>&&id_pasta=<?php echo $row['id_pasta']?>" class="icon icon-excluir" title="Excluir" data-key="16">&nbsp;</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>