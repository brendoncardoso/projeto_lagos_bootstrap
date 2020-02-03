<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

$act = 1;
$qr_unidades = mysql_query("SELECT * FROM unidades");
if (isset($_REQUEST['id'])) {
    $result = mysql_query("SELECT * FROM compras WHERE id_compra = '{$_REQUEST['id']}'");
    if(mysql_num_rows($result)>0){
        $row = mysql_fetch_assoc($result);
        $numero = $row['numero'];
        $proc_adm = $row['proc_adm'];
        $licitatorio = $row['licenciatorio'];
        $edital = $row['edital'];
        $unidadeDb = $row['id_unidade'];
        $observacao = $row['observacao'];
        $data_ini = date("d/m/Y", strtotime($row['data_ini']));
        $data_fim = date("d/m/Y", strtotime($row['data_fim']));
        $hora_ini = date("H:i", strtotime($row['data_ini']));
        $hora_fim = date("H:i", strtotime($row['data_fim']));
        
        if($row['status']==1){
            $status1="checked='checked'";
            $status2="";
        }else{
            $status1="";
            $status2="checked='checked'";
        }
        
    }else{
        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";
        header("Location: ../adm/editais.php");
    }
} else {
    $act = 2;
    $numero = "";
    $proc_adm = "";
    $licitatorio = "";
    $edital = "";
    $unidadeDb = "";
    $data_ini = "";
    $hora_ini = "00:00";
    $data_fim = "";
    $hora_fim = "00:00";
    $observacao = "";
    $status1 = "checked='checked'";
    $status2 = "";
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
        <script src="../resources/js/jquery.FCKEditor.js" type="text/javascript" ></script>
        <script>
            $(document).ready(function(){
                $.fck.config = {path: 'fckeditor/'};
                $('textarea#observacao').fck({height:700, width:770});
                
                $('.maskdata').mask('99/99/9999');
                $('.hora').mask('99:99').attr('style','width: 50px;');
                $.validationEngineLanguage.allRules["funOnlyPdf"] = {
                    "alertText":"Somente PDF."
                };
                $("#form1").validationEngine();
                $(".datepicker").datepicker({dateFormat:"dd/mm/yy"});
                
                $("input[name=cancelar]").click(function(){
                    window.location = 'editais.php';
                });
            });
            function onlyPdf(field, rules, i, options){
                var filename = field.val();
                if(filename!=""){
                    var extension = filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
                    if (extension != "pdf") {
                        return options.allrules.funOnlyPdf.alertText;
                    }
                }
            }
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
                <form action="../actions/action.edital.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Cadastrar Edital de Compras</h3>
                            <hr/>

                            <fieldset>
                                <legend>Dados</legend>
                                <p><label class="first2">Nº Edital:</label><input type="text" name="numero" id="numero" value="<?php echo $numero ?>" class="validate[required]" /></p>
                                <p><label class="first2">Nº do Processo Administrativo:</label><input type="text" name="proc_adm" id="proc_adm" value="<?php echo $proc_adm ?>" class="validate[required]" /></p>
                                <!--<p><label class="first2">Nº do Processo Licitatório:</label><input type="text" name="licitatorio" id="licitatorio" value="<?php // echo $licitatorio ?>" class="validate[required]" /></p>-->
                                <p><label class="first2">Unidade:</label> 
                                    <select name="unidade" id="unidade" class="validate[required,custom[select]]" style="width: 400px;" >
                                        <option value="-1" >« Selecione »</option>
                                        <?php
                                        while ($unidade = mysql_fetch_assoc($qr_unidades)) {
                                            $selected = "";
                                            if ($unidadeDb == $unidade['id_unidade']) {
                                                $selected = " selected=\"selected\"";
                                            }
                                            echo "<option value=\"{$unidade['id_unidade']}\"{$selected} >{$unidade['uf']} - {$unidade['nome']}</options>";
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p><label class="first2">Data e Hora de Início:</label><input type="text" name="data_ini" id="data_ini" value="<?php echo $data_ini ?>" class="validate[required,custom[dateBr]] datepicker maskdata" /> <input type="text" name="hora_ini" id="hora_ini" value="<?php echo $hora_ini ?>" class="hora" /> </p>
                                <p><label class="first2">Data e Hora de Encerramento:</label><input type="text" name="data_fim" id="data_fim" value="<?php echo $data_fim ?>" class="validate[required,custom[dateBr]] datepicker maskdata" /> <input type="text" name="hora_fim" id="hora_fim" value="<?php echo $hora_fim ?>" class="hora" /> </p>
                                <p><label class="first2">Chamamento:</label>
                                <textarea name="observacao" id="observacao" rows="12" cols="52" class="validate[required]"><?php echo $observacao ?></textarea></p>
                                <p><label class="first2">Edital:</label>
                                    <?php if ($act == 1) { ?>
                                        <span><a href="<?php echo $edital ?>" target="_blank">Baixar Edital</a></span>
                                    <?php } else { ?>
                                        <input type="file" name="file" id="file" class="validate[required,funcCall[onlyPdf]]" /> <span class="exemplo">Somente arquivo PDF</span>
                                    <?php } ?>
                                </p>
                                <p><label class="first2">Status:</label> <label><input type="radio" name="status" <?php echo $status1 ?> value="1" > ABERTO</label> <label><input type="radio" name="status" <?php echo $status2 ?> value="2"> ENCERRADO</label> </p>
                                <p class="controls"> 
                                    
                                    <?php if($act==1){?>
                                    <input type="submit" name="enviar" value="Salvar" class="button" />
                                    <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" >
                                    <?php }else{?>
                                    <input type="submit" name="enviar" value="Cadastrar" class="button" />
                                    <?php } ?>
                                    
                                    <input type="button" name="cancelar" value="Cancelar" class="button" />
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