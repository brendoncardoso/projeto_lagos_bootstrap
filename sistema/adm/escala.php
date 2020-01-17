<?php
    require '../includes/conecte.php';
    require '../includes/restricao.php';
    
    function nomeMes($data) {
        switch ($data) {
            case "01":    $mes = "Janeiro";     break;
            case "02":    $mes = "Fevereiro";   break;
            case "03":    $mes = "Março";       break;
            case "04":    $mes = "Abril";       break;
            case "05":    $mes = "Maio";        break;
            case "06":    $mes = "Junho";       break;
            case "07":    $mes = "Julho";       break;
            case "08":    $mes = "Agosto";      break;
            case "09":    $mes = "Setembro";    break;
            case "10":    $mes = "Outubro";     break;
            case "11":    $mes = "Novembro";    break;
            case "12":    $mes = "Dezembro";    break; 
        }

        return $mes;
    }
    
    if (isset($_POST['importar']) && !empty($_POST['importar'])) {
        
        $arquivo = $_FILES["arquivo_excel"]['name'];
        
        $extensoes_permitidas = array('csv');
        
        $extensao = strtolower(end(explode('.', $_FILES['arquivo_excel']['name'])));
        
        if (in_array($extensao, $extensoes_permitidas) === true) {
       
            if(!is_dir('escala_excel')){
                mkdir('escala_excel');
            }

            if (move_uploaded_file($_FILES['arquivo_excel']['tmp_name'], "escala_excel/" . $arquivo)) {

                /**
                 * ABRINDO ARQUIVO 
                 * PARA LEITURA
                 */
                $delimitador = ',';
                $cerca = '"';
                $rows = 0;

                $num_linhas_arquivoCSV = 20;
                $num_colunas_arquivoCSV = 7;

                while ($rows < $num_colunas_arquivoCSV) {

                    $fopen = fopen("escala_excel/{$arquivo}", "r");

                    while ($dados = fgetcsv($fopen, 0, $delimitador, $cerca)) {

                        if (!empty($dados[$rows])) {

                            $item[] = explode(";", $dados[$rows]);
                        }
                    }

                    $rows++;
                }


    //            echo "<pre>";
    //            print_r($item);
    //            echo "</pre>";
                
                if ($_SESSION['setor'] == "1") {
                    $id_unidade = intval($_POST['unidade']);
                    $_SESSION['id_unidade'] = $id_unidade;
                } else {
                    $id_unidade = $_SESSION['id_unidade'];
                }

                $nome_unidade = $item[0][0];
                $setor = $item[1][0];
                $mes = $item[2][0];
                $ano = $item[3][0];

               

                $sql = mysql_query("SELECT id FROM escala WHERE mes = " . $mes . " AND ano = " . $ano . " AND setor = '" . utf8_encode($setor) . "' AND id_unidade = " . $id_unidade);
                $num_rows_escala = mysql_num_rows($sql);

                if ($num_rows_escala == 0) {

                    for ($i = 4; $i < $num_linhas_arquivoCSV; $i++) {

                        for ($j = 0; $j < $num_colunas_arquivoCSV; $j++) {
                                
                            $profissional = $item[$i][$j];
                            $carga_horaria = $item[5][$j];
                            $dia_semana = $item[4][$j];

                            if (substr($dia_semana, 0, 3) == "Seg" || substr($dia_semana, 0, 3) == "SEG") {
                                $dia_semana = "segunda";
                            } else if (substr($dia_semana, 0, 3) == "Ter" || substr($dia_semana, 0, 3) == "TER") {
                                $dia_semana = "terca";
                            } else if (substr($dia_semana, 0, 3) == "Qua" || substr($dia_semana, 0, 3) == "QUA") {
                                $dia_semana = "quarta";
                            } else if (substr($dia_semana, 0, 3) == "Qui" || substr($dia_semana, 0, 3) == "QUI") {
                                $dia_semana = "quinta";
                            } else if (substr($dia_semana, 0, 3) == "Sex" || substr($dia_semana, 0, 3) == "SEX") {
                                $dia_semana = "sexta";
                            } else if (substr($dia_semana, 2, 6) == "bado" || substr($dia_semana, 2, 6) == "BADO") {
                                $dia_semana = "sabado";
                            } else if (substr($dia_semana, 0, 3) == "Dom" || substr($dia_semana, 0, 3) == "DOM") {
                                $dia_semana = "domingo";
                            }

                            if (!empty($profissional)) {

                                $sql = mysql_query("INSERT INTO escala (id_unidade, nome_unidade, setor, dia_da_semana, carga_horaria, mes, ano, profissional)
                                VALUES ('$id_unidade', '" . utf8_encode($nome_unidade) . "', '" . utf8_encode($setor) . "', '$dia_semana', '$carga_horaria', '$mes', '$ano', '" . utf8_encode(strtoupper($profissional)) . "')");
                            }
                        }
                    }

                    $msg = "Escala importada com sucesso!";
                } else {
                    $msg = "Já existe uma escala para esse setor (".$setor.") nessa competência (mês e ano).";
                }
            }
        } else {
            $msg = "Por favor, somente envie arquivos com a extensão 'CSV'.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="-1" />
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Escala Médica</title>
        <style>
            #btn-excluir {
                background-color: #ff7c7c; 
                border: 1px solid red; 
                font-weight: bold;
                color: #FFF;
                padding: 3px; 
                padding-left: 10px;
                padding-right: 10px;
            }
            
            #btn-excluir:hover {
                background-color: red;
            }

            #btn-visualizar {
                background-color: #4287f5; 
                border: 1px solid blue; 
                font-weight: bold;
                color: #FFF;
                padding: 3px; 
                padding-left: 10px;
                padding-right: 10px;
            }

            #btn-visualizar:hover {
                background-color: blue;
            }
            
            #btn-excluir:hover {
                background-color: red;
            }
            
            #table-historico th, td {
                border: 1px solid #000;
            }
            
            #table-historico td {
                text-align: center;
            }
        </style>
       
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
                <?php if($setor != 1) { ?>
                    <h1>ESCALA MÉDICA</h1>
                <?php } else { ?>
                    <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>
                <?php } ?>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
            </nav>

            <section>
                <div id="conteudo">
                    <div class="blocos">
                        <h2>Importação de Escala</h2><br>
                        <fieldset>
                            <legend>Importando Escala</legend>
                            
                            <form method="POST" enctype="multipart/form-data">
                                
                                <?php if($_SESSION['setor'] == "1") { ?>
                                    <label for="unidade">Nome da unidade:</label><br>
                                    <select name="unidade">
                                        <option>Selecione</option>
                                        <?php 
                                            $sql = mysql_query("SELECT id_unidade, uf, nome FROM unidades WHERE status = 1");

                                            while($row_unidade = mysql_fetch_assoc($sql)) {
                                                ?> 
                                                <option value="<?php echo $row_unidade['id_unidade']; ?>">
                                                    <?php echo $row_unidade['uf'] . " - " . $row_unidade['nome']; ?>
                                                </option>
                                                <?php
                                            }
                                        ?>
                                    </select>

                                    <br><br>
                                <?php } ?>
                                
                                <label for="arquivo_excel">Arquivo Excel:</label><br>
                                <input type="file" id="arquivo_excel" name="arquivo_excel"><br><br>
                                
                                <span>OBS: O arquivo precisar ser um CSV.</span>
                                
                                <br>
                                
                                <span>Modelo do arquivo CSV:</span>
                                <a href="escala_excel/modelo_a_seguir.csv" download>Clique para baixar</a>
                                
                                <br><br>
                                
                                <input type="submit" name="importar" id="importar" class="button" value="Importar Escala" style="float: left; margin-left: 1px;" /><br><br>
                            </form>
                            
                            <?php if (isset($msg)) { ?>
                                <div style="margin-bottom: 10px; background-color: #EEE; height: 40px; margin-top: 20px; color: #000; font-weight: bold;">
                                    <span style="margin-left: 10px; line-height: 40px;"><?php echo utf8_encode($msg); ?></span>
                                </div>
                            <?php } ?>
                        </fieldset>
                        
                        <?php
                            if($_SESSION['setor'] == "1") {
                                $escalasPorUnidade = mysql_query("SELECT id, id_unidade, nome_unidade, mes, setor, ano FROM escala GROUP BY nome_unidade, setor, mes");
                                $escalasPorAno = mysql_query("SELECT DISTINCT ano FROM escala GROUP BY nome_unidade, setor, mes");
                                while($row = mysql_fetch_assoc($escalasPorAno)){
                                    $arrayAno[] = $row['ano'];
                                }

                                if(isset($_POST['escala_ano']) && !empty($_POST['escala_ano'])){
                                    $ano = $_POST['escala_ano'];
                                    $escalasPorUnidade = mysql_query("SELECT id, id_unidade, nome_unidade, mes, setor, ano FROM escala WHERE ano = ". $ano ." GROUP BY nome_unidade, setor, mes");
                                }else{
                                    $escalasPorUnidade = mysql_query("SELECT id, id_unidade, nome_unidade, mes, setor, ano FROM escala GROUP BY nome_unidade, setor, mes");
                                }
                            } else {
                                //$escalasPorUnidade = mysql_query("SELECT nome_unidade, mes, setor, ano FROM escala WHERE id_unidade = " . $_SESSION['id_unidade'] . " GROUP BY setor, mes");
                                
                                $escalasPorAno = mysql_query("SELECT DISTINCT ano FROM escala WHERE id_unidade = " . $_SESSION['id_unidade']);
                                while($row = mysql_fetch_assoc($escalasPorAno)){
                                    $arrayAno[] = $row['ano'];
                                }

                                if(isset($_POST['escala_ano']) && !empty($_POST['escala_ano'])){
                                    $ano = $_POST['escala_ano'];
                                    $escalasPorUnidade = mysql_query("SELECT id, nome_unidade, mes, setor, ano FROM escala WHERE id_unidade = " . $_SESSION['id_unidade'] . " AND ano = ". $ano ." GROUP BY setor, mes");
                                }else{
                                    $escalasPorUnidade = mysql_query("SELECT id, nome_unidade, mes, setor, ano FROM escala WHERE id_unidade = " . $_SESSION['id_unidade'] . " GROUP BY setor, mes");
                                }

                            }
                            
                            $num_rows_escalaPorUnidade = mysql_num_rows($escalasPorUnidade);
                        ?>

                        <br>

                       <?php if($_SESSION['setor'] != "1" || $_SESSION['setor'] == "1") { ?>
                            <h2>Busca por Escala</h2>
                            <form action="" method="post">
                                <fieldset>
                                    <legend>Buscar</legend>
                                    <p>
                                        <label class="first">Ano:</label> 
                                        <select name="escala_ano" id="menu" style="width: 400px;">
                                            <option value="-1"> « Selecione o ano » </option>
                                            <?php foreach($arrayAno as $val => $key) { ?>
                                                <option value="<?php echo $key; ?>" <?= isset($ano) && $key == $ano ? 'selected' : ''; ?>><?php echo $key; ?></option>
                                            <?php } ?>                                        
                                        </select>
                                    </p>
                                    <p class="controls"><input name="buscar" type="submit" value="BUSCAR" id="busca" class="button"></p>
                                </fieldset>
                            </form>
                        <?php } ?>

                        
                        <h2 style="margin-top: 20px;">Histórico de Escala</h2>
                        
                        <?php if (isset($num_rows_escalaPorUnidade) && $num_rows_escalaPorUnidade > 0) { ?> 
                            <table width="100%" id="table-historico" style="font-size: 12px;">
                                <tr style="text-align: center; font-size: 13px;">
                                    <th>Unidade</th>
                                    <th>Setor</th>
                                    <th>Mês</th>
                                    <th>Ano</th>
                                    <th>Ações</th>
                                </tr>
                                <?php while ($row = mysql_fetch_assoc($escalasPorUnidade)) { ?>
                                    <tr>
                                        <td><?php echo $row['nome_unidade']; ?></td>
                                        <td><?php echo $row['setor']; ?></td>
                                        <td><?php echo utf8_encode(nomeMes($row['mes'])); ?></td>
                                        <td><?php echo $row['ano']; ?></td>
                                        <td style="padding: 5px;">
                                            <?php if($_SESSION['setor'] == "1") { ?>
                                                <a id="btn-visualizar" href="visualizar_escala.php?=id_escala=<?php echo $row['id']; ?>&ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>&id_unidade=<?php echo $row['id_unidade']; ?>&setor=<?php echo $row['setor']; ?>">Visualizar</a>
                                                <a id="btn-excluir" href="excluir_escala.php?=id_escala=<?php echo $row['id']; ?>&ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>&id_unidade=<?php echo $_SESSION['id_unidade']; ?>&setor=<?php echo $row['setor']; ?>">Excluir</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } else { ?>
                            <span>Não existe nenhuma escala registrada.</span>
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
