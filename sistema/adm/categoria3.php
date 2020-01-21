<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');
    
    if (isset($_SESSION['message'])) {
        $mensagem = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    //echo $id_unidade_id['id_unidade'];

    if(isset($_POST['id_opcao_pasta']) && !empty($_POST['id_opcao_pasta']) && 
        isset($_POST['id_opcao_unidade']) && !empty($_POST['id_opcao_unidade']) && 
        isset($_POST['id_opcao_empresa']) && !empty($_POST['id_opcao_empresa']) &&
        isset($_POST['nome_arquivo']) && !empty($_POST['nome_arquivo']) &&
        isset($_FILES['arquivo']['name']) && !empty($_FILES['arquivo']['name'])){
        //SE PREENCHER TODO FORMULÁRIO, FAÇA:

        $id_pasta = intval($_POST['id_opcao_pasta']);
        $id_unidade = intval($_POST['id_opcao_unidade']);
        $id_empresa = intval($_POST['id_opcao_empresa']);;
        $nome_arquivo = addslashes($_POST['nome_arquivo']);
        $arquivo = addslashes($_FILES['arquivo']['name']);
        $pasta = "atas_documentos/";

        if($sql = mysql_query("INSERT INTO prestacao_categoria3 (id_pasta, id_unidade, id_empresa, nome_arquivo, arquivo) VALUES ('$id_pasta', '$id_unidade', '$id_empresa', '$nome_arquivo', '$arquivo');")){
            $id = mysql_insert_id();
            $nome_final = "{$id}_{$id_pasta}_{$id_unidade}_{$id_empresa}.pdf";

            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$nome_final)){
                $sql_status = mysql_query("UPDATE pasta SET status = 4 WHERE status = 1 AND id = $id_pasta;");

                echo "<script>alert('Arquivo enviado com Sucesso!');</script>"; 

            }else{
                echo "<script>alert('Error');</script>"; 
            };
        };

        $sql_status = mysql_query("UPDATE pasta SET status = 4 WHERE status = 1 AND id = $id_pasta;");

    } else {
        
    }

    $sql = mysql_query("SELECT * FROM pasta WHERE status IN (1,4)");
    while($row = mysql_fetch_assoc($sql)){
        $array_nomes[] = [
            "id" => $row['id'],
            "nome" => $row['nome']
        ];
    }

    if(isset($_POST['buscar']) && !empty($_POST['buscar'])){
        $id_pasta = intval($_POST['id_opcao_pasta2']);

        $sql_unidades = mysql_query("SELECT DISTINCT
        A.id AS id,
        B.id AS id_pasta,
        A.id_unidade AS id_unidade,
        C.nome AS nome_unidade, 
        COUNT(DISTINCT D.nome_empresa) AS quantidade_empresas 
        FROM prestacao_categoria3 AS A 
        INNER JOIN pasta AS B ON (B.id = A.id_pasta)
        INNER JOIN unidades AS C ON (C.id_unidade = A.id_unidade)
        INNER JOIN empresas_prestador AS D ON (D.id = A.id_empresa) 
        WHERE A.id_pasta = '$id_pasta' GROUP BY A.id_unidade;");
        
        $sql_pesquisa_rows = mysql_num_rows($sql_unidades);
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
                $(".message").delay(2000).fadeOut("slow");

                $(".excluir_unidade_categoria3").on('click', function(){
                    var id_pasta = $(this).data('id_pasta');
                    var id_unidade =  $(this).data('id_unidade');

                    if(confirm("Tem certeza que deseja Excluir a unidade dessa pasta?")){
                        $.post('../actions/action.prestacaocontas.php', {id_pasta:id_pasta, id_unidade:id_unidade, method: "excluir_unidade_categoria3"}, 
                        function(data) {
                            if(data){
                                window.location.href = "categoria.php";
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
                <div id="conteudo">
                    <div class="blocos">
                        <form name="" action="" method="post" enctype="multipart/form-data" id="form1">
                            <h3>Categoria 3</h3>
                            <fieldset>
                            
                                <legend>Categoria 3</legend>

                                <p>
                                    <label class="first2">Selecione a Pasta:</label>
                                    <select name="id_opcao_pasta" id="edital1" style="width: 300px;">
                                        <option value="-1"> « Selecione » </option>
                                        <?php
                                            $sql = mysql_query("SELECT * FROM pasta");
                                            while($row = mysql_fetch_assoc($sql)){
                                                $arrayNomes[] = [
                                                    "id" => $row['id'],
                                                    "nome" => $row['nome']
                                                ];
                                            }
                                        ?>
                                        <?php foreach($arrayNomes as $pasta) { ?>
                                            <option value="<?php echo $pasta['id']?>"><?php echo $pasta['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p>
                                    <label class="first2">Selecione a Unidade:</label>
                                    <select name="id_opcao_unidade" id="edital2" style="width: 300px;">
                                        <option value="-1"> « Selecione » </option>
                                        <?php
                                            $sql = mysql_query("SELECT * FROM unidades WHERE status = 1");
                                            while($row = mysql_fetch_assoc($sql)){
                                                $arrayUnidades[] = [
                                                    "id_unidade" => $row['id_unidade'],
                                                    "nome" => $row['nome']
                                                ];
                                            }
                                        ?>
                                        <?php foreach($arrayUnidades as $unidades) { ?>
                                            <option value="<?php echo $unidades['id_unidade']?>"><?php echo $unidades['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                                
                                <p>
                                    <label class="first2">Selecione a Empresa:</label>
                                    <select name="id_opcao_empresa" id="edital3" style="width: 300px;">
                                        <option value="-1"> « Selecione » </option>

                                        <?php
                                            $sql = mysql_query("SELECT * FROM empresas_prestador ORDER BY nome_empresa ASC;");
                                            while($row = mysql_fetch_assoc($sql)){
                                                $arrayEmpresas[] = [
                                                    "id" => $row['id'],
                                                    "nome_empresa" => $row['nome_empresa']
                                                ];
                                            }
                                        ?>
                                        <?php foreach($arrayEmpresas as $empresas) { ?>
                                            <option value="<?php echo $empresas['id']?>"><?php echo $empresas['nome_empresa']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p>
                                    <label class="first2">Nome do Arquivo:</label>
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
                                    <label for="" class="first">Pasta: </label>
                                    <select name="id_opcao_pasta2" id="" style="width: 400px;">
                                        <option value="-1"> « Selecione » </option>
                                            <?php 
                                                $sql = mysql_query("SELECT DISTINCT A.id_pasta, B.nome FROM prestacao_categoria3 AS A 
                                                INNER JOIN pasta AS B ON (B.id = A.id_pasta) 
                                                INNER JOIN unidades AS C ON (C.id_unidade = A.id_unidade)
                                                INNER JOIN empresas_prestador AS D ON (D.id = A.id_empresa)");

                                                while($row = mysql_fetch_assoc($sql)){
                                                    $arrayPastasCriadas[] = [
                                                        "id_pasta" => $row['id_pasta'],
                                                        "nome" => $row['nome']
                                                    ];
                                                }
                                            ?>
                                            <?php foreach($arrayPastasCriadas as $pastasCriadas) { ?>
                                                <option value="<?php echo $pastasCriadas['id_pasta']?>" 
                                                    <?= (isset($_POST['id_opcao_pasta2'])) && $pastasCriadas['id_pasta'] == $_POST['id_opcao_pasta2'] ? 'selected':''?> 
                                                    <?= (isset($_POST['abrir'])) && $pastasCriadas['id_pasta'] == $_POST['abrir'] ? 'selected': ''?>
                                                    <?= (isset($_POST['empresa'])) && $pastasCriadas['id_pasta'] != $_POST['empresa']? 'selected':''?>>
                                                    <?php echo $pastasCriadas['nome']?>
                                                </option>
                                            <?php } ?>
                                        <p class="controls">
                                            <input type="submit" name="buscar" value="BUSCAR" id="buscar" class="button">
                                        </p>
                                    </select>
                                </p>
                            </fieldset>
                        </form>
                    </div>

                    <?php if (isset($mensagem)) { ?> 
                        <div class='message'>
                            <?= $mensagem; ?>
                        </div> 
                    <?php } ?>
                    
                    <form name="" action="" method="post" enctype="multipart/form-data" id="form2">
                        <?php if (isset($sql_pesquisa_rows) && $sql_pesquisa_rows > 0)  { ?>
                            <div id="respostaCategoria">
                                <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>ID_UNIDADE</th>
                                            <th>Unidade</th>
                                            <th>Quantidade de Empresas</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php while ($row = mysql_fetch_assoc($sql_unidades)) { ?>
                                            <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                                                <tr class="<?php echo $class; ?>">
                                                    <td class="center"><?php echo $row['id_unidade']; ?></td>
                                                    <td class="center"><input type="hidden" name="pegar_id_unidade" value="<?php echo $row['id_unidade']?>"><?php echo $row['nome_unidade']?></td>
                                                    <td class="center"><?php echo $row['quantidade_empresas']?></td>
                                                    <td class="center">
                                                        <button type="button" class="abrirUnidade button" data_id_unidade="<?php echo $row['id_unidade']?>" data_pasta="<?php echo $id_pasta?>"> Abrir </button>-->
                                                        <button type="button" class="abrirUnidade button button_center" data_id_unidade="<?php echo $row['id_unidade']?>" data_pasta="<?php echo $id_pasta?>"> Abrir </button>
                                                        <input type="submit" class="excluir_unidade_categoria3 button button_a button_center" value="Excluir" data-id_pasta="<?php echo $row['id_pasta']?>" data-id_unidade=<?php echo $row['id_unidade']?>>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="respostaUnidade"></div>
                            <div id="respostaEmpresa"></div>
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
<script src="../../assets/js/document_jquery.js"></script>
