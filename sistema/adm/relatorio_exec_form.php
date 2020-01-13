<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/global.php');

$sql = mysql_query("SELECT *
            FROM unidades
            WHERE status = 1
            ORDER BY nome") or die(mysql_error()
        );

if(isset($_REQUEST['enviar'])){
    $unidade = $_REQUEST['unidade'];
    $mes = $_REQUEST['mes'];
    $ano = $_REQUEST['ano'];
    $arquivo = $_FILES['arquivo'];
    $mes_ext = mesesArray($mes);
    $size = 1024*1024*15; //m�xima 15 MB
    
    $pasta = "rel_execucao/";
    $nome = "{$unidade}_{$mes}_{$ano}.pdf";
    
    $sql_uni = mysql_query("SELECT *
                    FROM unidades
                    WHERE id_unidade = '{$unidade}'") or die(mysql_error()
                );
    
    $row_uni = mysql_fetch_assoc($sql_uni);
    
    $nome_uni = $row_uni['nome'];
    
    if($arquivo['size'] > $size){
        $estilo = 'danger';
        $texto = 'Arquivo não pode ter mais que 15 MB';
    }
    
    if(file_exists($pasta."/".$nome)){
        unlink($pasta."/".$nome);
        $move_new = move_uploaded_file($arquivo['tmp_name'], $pasta . "/" . $nome);
        if($move_new){
            $estilo = 'info';
            $texto = "Relatório <u>{$mes_ext}/{$ano}</u>, unidade <u>{$nome_uni}</u>, cadastrado com sucesso";
        }
    
    }else{
        $move = move_uploaded_file($arquivo['tmp_name'], $pasta . "/" . $nome);
        $insere = mysql_query("INSERT INTO relatorio (id_unidade, mes, ano, status, tipo)
                        VALUES ({$unidade}, {$mes}, {$ano}, 1, 1)") or die(mysql_error()
                    );
        
        if(($move) && ($insere)){
            $estilo = 'info';
            $texto = "Relatório <u>{$mes_ext}/{$ano}</u>, unidade <u>{$nome_uni}</u>, cadastrado com sucesso";
        }else{
            $estilo = 'danger';
            $texto = 'Houve algum erro no cadastro';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Expires" content="-1" />
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Administração de Candidatos</title>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"/>        
        <link href="../resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>
        
        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>
        <script>
            $(function(){
                $("#form1").validationEngine();                                  
            });
        </script>
        
        <style>
            .danger{
                background: #FBD3B1;
                border: 1px solid #F7CBA3;
                color: #CE2700;
            }
            
            .info{
                color: #31708f;
                background-color: #d9edf7;
                border-color: #bce8f1;
            }
            
            #box{
                font-family: Tahoma;
                font-weight: bold;
                padding: 10px 20px;
                margin: 10px 0;
            }                        
        </style>
        
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
                <form name="cadastro" action="" method="post" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Cadastro de Relatório de Execução</h3>
                            <hr/>
                            
                            <?php if(isset($_POST['enviar'])) { ?> 
                                <div class="<?php echo $estilo; ?>" id="box">
                                    <?php echo $texto; ?>
                                </div>
                            <?php } else { ?>
                            <?php } ?>
                            
                            <fieldset>
                                <legend>Dados</legend>
                                <p>
                                    <label class="first2">Unidade:</label>
                                    <select name="unidade" id="unidade" class="validate[required,custom[select]]">
                                        <option value="-1">Selecione</option>
                                        <?php while ($row = mysql_fetch_assoc($sql)){ ?>
                                        <option value="<?php echo $row['id_unidade']; ?>"><?php echo $row['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                                
                                <p>
                                    <label class="first2">Mês Referente:</label>
                                    <?php echo montaSelect(mesesArray(), null, "id='mes' name='mes' class='validate[required,custom[select]]'"); ?>
                                </p>
                                
                                <p>
                                    <label class="first2">Ano Referente:</label>
                                    <?php echo montaSelect(anosArray(2012, date("Y"), array("-1"=>"Selecione o ano")), null, "id='ano' name='ano' class='validate[required,custom[select]]'"); ?>                                    
                                </p>
                                
                                <p>
                                    <label class="first2">Arquivo:</label>
                                    <input type="file" name="arquivo" id="arquivo" class="validate[required,custom[arquivoPdf]]" />
                                </p>
                                
                                <p class="controls">                                                                                                                                                 
                                    <input type="submit" name="enviar" value="Cadastrar" class="button" />                                    
                                </p>
                            </fieldset>
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