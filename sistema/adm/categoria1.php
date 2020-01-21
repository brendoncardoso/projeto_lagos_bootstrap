<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    if (isset($_SESSION['message'])) {
        $mensagem = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    if(isset($_POST['id_opcao1']) && !empty($_POST['id_opcao1']) && isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){
        $id_opcao1 = intval($_POST['id_opcao1']);
        $arquivo = addslashes($_FILES['arquivo']['name']);
        $pasta = "atas_documentos/";
        
        $sql_select = mysql_query("SELECT * FROM prestacao_categoria1 WHERE id_pasta = $id_opcao1;");
        $sql_rows = mysql_num_rows($sql_select);

        if($sql_rows < 1){
            if($sql = mysql_query("INSERT INTO prestacao_categoria1 (id_pasta, arquivo) VALUES ('$id_opcao1', '$arquivo');")){
                $id = mysql_insert_id();
                $nome_final = "{$id}.pdf";

                if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$nome_final)){
                    $sql_status = mysql_query("UPDATE pasta SET status = 2 WHERE status = 1 AND id = $id_opcao1;");
                    echo "<script>alert('Arquivo enviado com Sucesso!');</script>"; 
                }else{
                    echo "<script>alert('Error');</script>"; 
                };
            };
        }else{
            echo "<script>alert('Atenção! Nessa categoria não pode ter mais de UM arquivo na mesma pasta');</script>";
        }
    }

    $sql = mysql_query("SELECT * FROM pasta WHERE status = 1");
    while($row = mysql_fetch_assoc($sql)){
        $array_nomes[] = [
            "id" => $row['id'],
            "nome" => $row['nome']
        ];
    }

    if(isset($_POST['buscar']) && !empty($_POST['buscar'])){
       
        $id = intval($_POST['nome_pasta']);
        $sql_select = mysql_query("SELECT A.id, A.id_pasta, A.arquivo, A.status FROM prestacao_categoria1 AS 
        A INNER JOIN pasta AS B ON (B.id = A.id_pasta) WHERE B.status = 2 AND id_pasta = '$id';");

        $sql_pesquisa_rows = mysql_num_rows($sql);
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

    <script>
        $(document).ready(function(){
            $(".message").delay(2000).fadeOut("slow");

            $('.excluir_arquivo_categoria1').on('click', function(){
                var id_pasta = $(this).data('id_pasta');
                if(confirm("Tem certeza que deseja excluir esse arquivo dessa pasta?")){
                        $.post('../actions/action.prestacaocontas.php', {id_pasta:id_pasta, method: "excluir_arquivo_categoria1"}, 
                        function(data) {
                            if(data){
                                window.location.href = "categoria1.php";
                            }
                        },"json");
                    }
            });
        });
    </script>

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
                        <form name="" action="" method="post" enctype="multipart/form-data">
                            <h3>Categoria 1</h3>
                            <fieldset>
                                <legend>Categoria 1</legend>

                                <p>
                                    <label class="first2">Selecione a Pasta:</label>
                                    <select class="pasta validate[required]" name="id_opcao1" id="" style="width: 300px;">
                                        <option value="-1"> « Selecione » </option>
                                        <?php foreach($array_nomes as $pasta) { ?>
                                            <option value="<?php echo $pasta['id']?>"><?php echo $pasta['nome']; ?></option>
                                        <?php } ?> 
                                    </select>
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
                        </form>
                        <form method="post">

                            <fieldset>
                                <legend>Busca</legend>
                                <p>
                                    <label for="" class="first">Nome: </label>
                                    <select name="nome_pasta" id="" style="width: 400px;">
                                        <option value="-1"> « Selecione » </option>                                        
                                        <?php 
                                            $sql = mysql_query("SELECT DISTINCT A.id_pasta, B.nome, A.status FROM prestacao_categoria1 AS A 
                                            INNER JOIN pasta AS B ON (B.id = A.id_pasta) WHERE B.status = 2;");

                                            while($row = mysql_fetch_assoc($sql)){
                                                $arrayPastasCriadas[] = [
                                                    "id_pasta" => $row['id_pasta'],
                                                    "nome" => $row['nome']
                                                ];
                                            }
                                        ?>
                                        <?php foreach($arrayPastasCriadas as $pastasCriadas) { ?>
                                            <option value="<?php echo $pastasCriadas['id_pasta']?>" <?= (isset($_POST['nome_pasta'])) && ($pastasCriadas['id_pasta']) == $_POST['nome_pasta'] ? 'selected':''?>> 
                                                <?php echo $pastasCriadas['nome']?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    
                                    <p class="controls">
                                        <input type="submit" name="buscar" value="BUSCAR" id="buscar" class="button">
                                    </p>
                                </p>
                            </fieldset>
                        </form>
                    </div>

                    <?php if (isset($mensagem)) { ?> 
                        <div class='message'>
                            <?= $mensagem; ?>
                        </div> 
                    <?php } ?>

                    <form action="" method="post">
                        <?php if (isset($sql_pesquisa_rows) && $sql_pesquisa_rows > 0) { ?>
                            <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pastas</th>
                                        <th colspan="2">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php while ($row = mysql_fetch_assoc($sql_select)) { ?>
                                        <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td class="center"><?php echo $row['id']; ?></td>
                                            <td class="center"><a href="../adm/atas_documentos/<?php echo $row['id']; ?>.pdf" target="_blank"><?php echo $row['arquivo']; ?></a></td>
                                            <td class="center">
                                                <input class="excluir_arquivo_categoria1 button button_a button_center" type="submit" value="Excluir" data-id_pasta="<?php echo $row['id_pasta']?>">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </form>
                </div>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>