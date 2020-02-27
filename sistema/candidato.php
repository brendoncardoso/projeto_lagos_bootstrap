<?php

include('includes/conecte.php');

session_start();



if (!isset($_REQUEST['edital'])) {

    //header("Location: conosco.php");

}



function trataTxt($var) {

    $var = strtolower($var);

    $var = str_replace(array("á","à","â","ã","ª","Á","À","Â","Ã"), "a", $var);

    $var = str_replace(array("é","è","ê","É","È","Ê"), "e", $var);

    $var = str_replace(array("í","ì","î","Í","Ì","Î"), "i", $var);

    $var = str_replace(array("ó","ò","ô","õ","º","Ó","Ò","Ô","Õ"), "o", $var);

    $var = str_replace(array("ú","ù","û","Ú","Ù","Û"), "u", $var);

    $var = str_replace(array("ç","Ç"), "c", $var);

    return $var;

}



if (isset($_REQUEST['enviar']) && !empty($_REQUEST['enviar'])) {



    $id_edital = $_REQUEST['edital'];

    $id_unidade = $_REQUEST['unidade'];

    $id_estado = $_REQUEST['estado'];

    $nivel = $_REQUEST['nivel'];

    $nome = trim(str_replace("'","",$_REQUEST['nome']));

    $telefone = $_REQUEST['telefone'];

    $email = $_REQUEST['email'];

    $cargos = $_REQUEST['cargos'];

    $deficiente = $_REQUEST['deficiente'];

    $dt = date("Y-m-d H:i:s");

    

    //VERIFICA SE JA EXISTE O E-MAIL CADATRADO NO MESMO EDITAL.. PARA NÃO DUPLICAR REGISTROS

    $qr_verifica = mysql_query("SELECT email FROM pessoa WHERE email='{$email}' AND id_edital='{$id_edital}'");

    $verifica = mysql_num_rows($qr_verifica);

    if ($verifica==0){

        if (mysql_query("INSERT INTO pessoa (id_edital, id_estado, id_unidade, id_nivel, nome, telefone, email, data, deficiente) VALUES ({$id_edital}, {$id_estado}, {$id_unidade}, {$nivel}, '{$nome}', '{$telefone}', '{$email}', '{$dt}', '{$deficiente}');")) {
            $pessoa_id = mysql_insert_id();

            $qr = "INSERT INTO `pessoa_cargo` (`id_pessoa`, `id_cargo`) VALUES ";

            $to_c = count($cargos);

            $i=1;

            foreach($cargos as $value){

                $qr .= "({$pessoa_id}, {$value})";

                if($i < $to_c){

                    $qr .= ",";

                }

                $i++;

            }

            mysql_query($qr);



            $file_name = $pessoa_id . '_' . str_replace(" ", "_", trataTxt($nome));

            $file_real_name = $_FILES['file']['name'];

            $file_tmp_name = $_FILES['file']['tmp_name'];

            $destino = "upload/edital_pessoal_{$id_edital}/";

            if(!is_dir($destino)){

                mkdir($destino, 0777);

            }



            $ext = end(explode(".",$file_real_name));



            $arquivo = $file_name . "." . $ext;

            if (!move_uploaded_file($file_tmp_name, $destino . "" . $file_name . "." . $ext)) {

                $_SESSION['Message'] = "Nãoo foi possível salvar o arquivo!";

                header("Location: conosco.php");

            } else {

                mysql_query("UPDATE pessoa SET anexo = '$arquivo' WHERE id_pessoa = '$pessoa_id' LIMIT 1");

                $_SESSION['Message'] = "Currículo cadastrado com sucesso!";

                header("Location: conosco.php");

            }

        }

    }else{

        $_SESSION['Message'] = "Não foi possivel se cadastrar pois o e-mail informado já está cadastrado!";

        header("Location: conosco.php");

    }

}



$qr_edital = mysql_query("SELECT * FROM editalpessoal AS A

                            INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                            WHERE id_editalpessoal = '{$_REQUEST['edital']}'");

$edital = mysql_fetch_assoc($qr_edital);



$qr_cargos = mysql_query("SELECT C.id_nivel,B.id_cargo,B.cargo,C.nome FROM editalpessoal_cargos AS A

                            INNER JOIN cargos AS B ON (B.id_cargo=A.id_cargo)

                            INNER JOIN niveis AS C ON (B.id_nivel=C.id_nivel)

                            WHERE id_edital = '{$_REQUEST['edital']}' 

                            ORDER BY C.nome,B.cargo");

$anexos = $edital['anexos'];

?>

<!DOCTYPE html>

<html lang="pt">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="Expires" content="-1" />

        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />

        <meta http-equiv="Pragma" content="no-cache" />

        <title>Trabalhe Conosco</title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <link href="resources/css/site.css" type="text/css" rel="stylesheet"/>

        <link href="resources/css/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"/>

        <link href="resources/css/jquery.qtip.css" type="text/css" rel="stylesheet"/>

        <link href="resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>



        <script src="resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <script src="resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>

        <script src="resources/js/jquery.validationEngine.js" type="text/javascript"></script>

        <script src="resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>

        <script src="resources/js/maskedinput.js" type="text/javascript"></script>

        <script src="resources/js/jquery.qtip-2.min.js" type="text/javascript"></script>

        <script>

            $(function(){

                $('.maskdata').mask('99/99/9999');

                $('#telefone').mask('(99) 9999-9999');

                $('.hora').mask('99:99').attr('style','width: 50px;');

                

                $.validationEngineLanguage.allRules["funOnlyDoc"] = {

                    "alertText":"Somente PDF, DOC, DOCX, RTF, JPG, PNG ou ODT"

                };

                

                $("#form1").validationEngine();

                

                $(".datepicker").datepicker({dateFormat:"dd/mm/yy"});

                

                $(".bt_edital").click(function(){

                    var id = $(this).val();

                    $("#edital").val(id);

                    $("#form1").submit();

                });

                

                $("#nivel").change(function(){

                    var nivel = $(this).val();

                    if(nivel != "-1"){

                        $("input[type=checkbox]").removeAttr("checked");

                        $("li").addClass("hidden");

                        $(".nivel_"+nivel).removeClass("hidden");

                    }

                });

            })

            

            function onlyDocs(field, rules, i, options){

                var filename = field.val();

                if(filename!=""){

                    var extension = filename.substr(filename.lastIndexOf('.')+1).toLowerCase();

                    if (extension != "pdf" && extension != "doc" && extension != "docx" && extension != "rtf" && extension != "jpg" && extension != "png" && extension != "odt") {

                        return options.allrules.funOnlyDoc.alertText;

                    }

                }

            }

        </script>



    </head>



    <body>

        <div class="main">

            <div id="header">

                <h1 class="title1">Trabalhe Conosco</h1>

            </div>

            <section>

                <form method="post" action="candidato.php" name="form1" id="form1" enctype="multipart/form-data" >

                    <input type="hidden" name="edital" id="edital" value="<?php echo $_REQUEST['edital'] ?>" />

                    <input type="hidden" name="unidade" id="unidade" value="<?php echo $edital['id_unidade'] ?>" />

                    <div id="conteudo">

                        <h2><?php echo $edital['nome']; ?> </h2>

                        <div class="chamamento"><?php echo $edital['observacao'] ?></div>

                        <br/>

                        <p><a href="<?php echo $edital['edital']; ?>" target="_blanck">Download do Edital</a></p>

                        

                        <?php

                        if ($anexos >= 1) {

                            echo "<div id=\"dv-anexos\">";

                            if ($anexos > 0) {

                                for ($i = 1; $i <= $anexos; $i++) {

                                    $anexo = "arquivos/editaispdf/" . $_REQUEST['edital'] . "-Anexo-" . $i . ".pdf";

                                    echo "<p><label class=\"first2\"></label><a href=\"$anexo\" data-key=\"{$i}\" target=\"_blank\">Download do Comunicado $i</a> </p>";

                                }

                            }

                            echo "</div>";

                        }

                        ?>

                        

                        <br/>

                        <fieldset>

                            <legend>Dados:</legend>

                            <p><label class="first2">Nível:</label>

                                <select name="nivel" id="nivel" class="validate[required,custom[select]]">

                                    <option value="-1">« Selecione »</option>

                                    <?php

                                    $qr_nivel = mysql_query("SELECT * FROM niveis");

                                    while ($row_nivel = mysql_fetch_assoc($qr_nivel)) {

                                        echo "<option value=\"{$row_nivel['id_nivel']}\">{$row_nivel['nome']}</option>";

                                    }

                                    ?>

                                </select>

                            </p>

                            <div style="margin-left: 120px;">

                                <h4>Selecione as vagas que pretende concorrer</h4>

                                <?php

                                $i = 1;

                                echo "<ul class=\"ulCargos\">";

                                while ($row = mysql_fetch_assoc($qr_cargos)) {

                                    echo "<li class=\"nivel_{$row['id_nivel']}\"><label><input type=\"checkbox\" name=\"cargos[]\" value=\"{$row['id_cargo']}\" > {$row['nome']} - {$row['cargo']} </label></li>";

                                }

                                echo "</ul>";

                                ?>

                            </div>

                            <p><label class="first2">Vaga Deficiente?</label> <label><input type="radio" name="deficiente" value="1" > SIM</label> <label><input type="radio" name="deficiente" value="0" checked="checked"> NÃO</label> </p>

                            <p><label class="first2">Nome:</label><input type="text" name="nome" id="nome" value="" class="validate[required]" /></p>

                            <p><label class="first2">Telefone:</label><input type="text" name="telefone" id="telefone" value="" class="validate[required]" /></p>

                            <p><label class="first2">Estado:</label>
                                <select name="estado" id="estado" class="validate[required,custom[select]]">
                                <option value="-1">« Selecione »</option>
                                    <?php
                                        $qr_estados = mysql_query("SELECT * FROM estados");
                                        while ($row_estado = mysql_fetch_assoc($qr_estados)) {
                                            echo "<option value=\"{$row_estado['id']}\">{$row_estado['estado']}</option>";
                                        }
                                    ?>
                                </select>
                            </p>

                            <p><label class="first2">Email:</label><input type="text" name="email" id="email" value="" class="validate[required,custom[email]]" /></p>

                            <p><label class="first2">Currículo:</label> <input type="file" name="file" id="file" class="validate[required,funcCall[onlyDocs]]" /></p>

                            <p><label class="first2"></label> <span class="exemplo">Somente arquivos com extensões (.doc, .docx, .rtf, .odt, .pdf, .jpg ou .png)</span></p>

                            <p class="controls"> 

                                <input type="submit" name="enviar" value="Enviar" class="button" />

                                <a href="../selecoes.php">
                                    <input type="button" name="voltar" value="Voltar" class="button" />
                                </a>

                            </p>

                        </fieldset>



                    </div>

                </form>

            </section>

            <section id="footer">

                <p>Todos os direitos reservados</p>

            </section>

        </div>

    </body>

</html>

