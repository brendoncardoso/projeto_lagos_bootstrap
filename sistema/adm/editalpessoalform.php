<?php

include('../includes/conecte.php');

include('../includes/restricao.php');



if (isset($_SERVER['HTTP_REFERER'])) {

    $ar = explode("/", $_SERVER['HTTP_REFERER']);

    array_pop($ar);

    array_pop($ar);

    $dirDownload = implode("/", $ar);

}



$act = 1;

$qr_unidades = mysql_query("SELECT * FROM unidades");



if (isset($_REQUEST['id'])) {

    $result = mysql_query("SELECT * FROM editalpessoal WHERE id_editalpessoal = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);



        $num_edital = $row['num_edital'];

        $num_proc_adm = $row['num_proc_adm'];

        $data_ini = date("d/m/Y", strtotime($row['data_ini']));

        $data_fim = date("d/m/Y", strtotime($row['data_fim']));

        $hora_ini = date("H:i", strtotime($row['data_ini']));

        $hora_fim = date("H:i", strtotime($row['data_fim']));

        $unidadeDb = $row['id_unidade'];

        $observacao = $row['observacao'];

        $edital = ($row['edital']!="")? $dirDownload . $row['edital']: "";

        $anexos = $row['anexos'];



        if ($row['status'] == 1) {

            $status1 = "checked='checked'";

            $status2 = "";

        } else {

            $status1 = "";

            $status2 = "checked='checked'";

        }

        

        $rs_prorro = mysql_query("SELECT date_format(data_fim, \"%d/%m/%Y %H:%i:%s\")as data FROM edital_prorrogacoes WHERE id_pessoal = '{$_REQUEST['id']}'");

        

    } else {

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/editais.php");

    }

} else {

    $act = 2;

    $num_edital = "";

    $num_proc_adm = "";

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

        <link href="../resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>



        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>

        <script src="../resources/js/jquery.validationEngine.js" type="text/javascript"></script>

        <script src="../resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>

        <script src="../resources/js/maskedinput.js" type="text/javascript"></script>

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

                

                $("input[name=cancelar]").click(function(){

                    window.location = 'editalpessoal.php';

                });

                

                $(".datepicker").datepicker({dateFormat:"dd/mm/yy"});

                

                $("#unidade").change(function(){

                    var select = $(this);

                    var data = {unidade: select.val(),method:"loadcargos"<?php if ($act == 1) { ?>,edit:<?php echo $_REQUEST['id'];} ?>};

                    if(select.val()!="-1"){

                        $.post("../actions/action.editalpessoal.php",

                        data,

                        function(resposta){

                            $('#showCargos').html(resposta);

                        },"html");

                    }else{

                        $('#showCargos').html("selecione o cargo");

                    }

                }).trigger("change");

                

                $(".blocos").on("click", ".add-anexo", function(){

                    var botao = $(this);

                    var input = botao.prev();

                    if(input.val()==""){

                        alert("Favor selecionar um arquivo antes de adicionar outro anexo");

                    }else{

                        var count = $(".anexos").length + 1;

                        var html = "<p><label class=\"first2\"></label> <input type=\"file\" name=\"anexos[]\" id=\"anexo_" + count + "\" class=\"validate[funcCall[onlyPdf]] anexos\" /> <a hraf=\"javascript:;\" class=\"icon icon-add add-anexo\">&nbsp;</a> </p>";

                        

                        $("#dv-anexos").append(html);

                        botao.fadeOut(700, function(){botao.remove();});

                    }

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

                <form name="cadastro" action="../actions/action.editalpessoal.php" method="post" enctype="multipart/form-data" id="form1">

                    <div id="conteudo">

                        <div class="blocos">

                            <h3>Cadastro de Processo Seletivo</h3>

                            <hr/>

                            <fieldset>

                                <legend>Dados</legend>

                                <p><label class="first2">Nº do Edital:</label><input type="text" name="num_edital" id="num_edital" value="<?php echo $num_edital ?>" class="validate[required]" /></p>

                                <p><label class="first2">Nº do Processo Administrativo:</label><input type="text" name="num_proc_adm" id="num_proc_adm" value="<?php echo $num_proc_adm ?>" class="validate[required]" /></p>

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

                                <hr />

                                <p><label class="first2">Cargos:</label></p>

                                <div id="showCargos">



                                </div>

                                <hr />

                                <p><label class="first2">Data e Hora de Início:</label><input type="text" name="data_ini" id="data_ini" value="<?php echo $data_ini ?>" class="validate[required,custom[dateBr]] datepicker maskdata" /> <input type="text" name="hora_ini" id="hora_ini" value="<?php echo $hora_ini ?>" class="hora" /> </p>

                                <p><label class="first2">Data e Hora de Encerramento:</label><input type="text" name="data_fim" id="data_fim" value="<?php echo $data_fim ?>" class="validate[required,custom[dateBr]] datepicker maskdata" /> <input type="text" name="hora_fim" id="hora_fim" value="<?php echo $hora_fim ?>" class="hora" /> </p>

                                <?php if ($act == 1) { 

                                    if(mysql_num_rows($rs_prorro) > 0){

                                        echo "<p><label class=\"first2\">Prorrogações:</label></p><ul class=\"first2\">";

                                        while($prorro = mysql_fetch_assoc($rs_prorro)){

                                            echo "<li>{$prorro['data']}</li>";

                                        }

                                        echo "</ul>";

                                    }

                                    ?>

                                    

                                    <p><label class="first2">Prorrogar Encerramento:</label><input type="text" name="prorrogacao_data" id="prorrogacao_data" value="" class="validate[custom[dateBr]] datepicker maskdata" /> <input type="text" name="prorrogacao_hora" id="prorrogacao_hora" value="<?php echo $hora_fim ?>" class="hora" /> </p>

                                <?php } ?>

                                <p><label class="first2">Chamamento:</label><textarea name="observacao" id="observacao" rows="12" cols="52" class="validate[required]"><?php echo $observacao ?></textarea></p>

                                <p><label class="first2">Status:</label> <label><input type="radio" name="status" <?php echo $status1 ?> value="1" > ABERTO</label> <label><input type="radio" name="status" <?php echo $status2 ?> value="2"> ENCERRADO</label> </p>

                                <p><label class="first2">Edital:</label>

                                    <?php if ($act == 1 && $edital != "") { ?>

                                        <span><a href="<?php echo $edital ?>" target="_blank">Baixar Edital</a> - <input type="checkbox" name="remove_ed" id="remove_ed" value="1"> Remover o Edital</span>

                                    <?php } else { ?>

                                        <input type="file" name="file" id="file" class="validate[required,funcCall[onlyPdf]]" /> <span class="exemplo">Somente arquivo PDF</span>

                                    <?php } ?>

                                </p>



                                <?php

                                if ($act == 1) {

                                    echo "<div id=\"dv-anexos\"> <input type=\"hidden\" name=\"num_anexos\" value=\"{$anexos}\" /> ";

                                    if ($anexos > 0) {

                                        for ($i = 1; $i <= $anexos; $i++) {

                                            $anexo = $dirDownload . "/editaispdf/" . $_REQUEST['id'] . "-Anexo-" . $i . ".pdf";

                                            echo "<p><label class=\"first2\"></label><a href=\"$anexo\" data-key=\"{$i}\" target=\"_blank\">Baixar Anexo</a> </p>"; //<a hraf=\"javascript:;\" class=\"icon icon-excluir\" title=\"Remover Anexo\">&nbsp;</a>

                                        }

                                    }

                                    echo "<p><label class=\"first2\">Anexos:</label> <input type=\"file\" name=\"anexos[]\" id=\"anexo_0\" class=\"validate[funcCall[onlyPdf]] anexos\" /> <a hraf=\"javascript:;\" class=\"icon icon-add add-anexo\">&nbsp;</a></p>";

                                    echo "</div>";

                                }

                                ?>



                                <p class="controls"> 

                                    <?php if ($act == 1) { ?>

                                        <input type="submit" name="enviar" value="Salvar" class="button" />

                                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />

                                    <?php } else { ?>

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