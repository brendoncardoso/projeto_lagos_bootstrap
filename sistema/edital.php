<?php

include('includes/conecte.php');

session_start();



/*if (!isset($_REQUEST['id_compra'])) {

    //header("Location: editais.php");

}*/




if (isset($_REQUEST['enviar']) && !empty($_REQUEST['enviar'])) {



    $nome = trim(str_replace("'","",$_REQUEST['nome']));

    $razao = trim(str_replace("'","",$_REQUEST['razao']));

    $cnpj = $_REQUEST['cnpj'];

    $im = $_REQUEST['im'];

    $ie = $_REQUEST['ie'];

    $email = $_REQUEST['email'];

    $edital = $_REQUEST['id_compra'];

    $data = date("Y-m-d H:i:s");



    if (mysql_query("INSERT INTO empresa (id_edital, nome, razao, cnpj, im, ie, email,data) VALUES ('{$edital}', '{$nome}', '{$razao}', '{$cnpj}', '{$im}', '{$ie}', '{$email}','{$data}')")) {

        $_SESSION['Message'] = "Empresa cadastrado com sucesso!";

        

        $res = mysql_query("SELECT * FROM compras WHERE id_compra = '{$edital}'");

        $rowedt = mysql_fetch_assoc($res);

        $filename = $rowedt['edital'];

        $fname = "Edital_".$rowedt['proc_adm'].".pdf";

        

        echo "<!DOCTYPE html><html lang=\"pt\"><head><meta charset=\"utf-8\"><meta http-equiv=\"Expires\" content=\"-1\" /><meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\" />

        <meta http-equiv=\"Pragma\" content=\"no-cache\" /><title>Trabalhe Conosco</title><link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\"><link href=\"resources/css/site.css\" type=\"text/css\" rel=\"stylesheet\"/>";

        

        echo "<body><div class=\"main\"><p class=\"txcenter\"><a href=\"$filename\" >Download do edital</a></p>";

        echo "<p><a href=\"editais.php\">Continuar</a></p>";

        echo "</div></body></html>";

        exit;

        /*

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        header("Cache-Control: no-store, no-cache, must-revalidate");

        header("Cache-Control: post-check=0, pre-check=0", false);

        header("Pragma: no-cache");

        header("Content-type: application/x-msdownload");

        header("Content-Length: ".filesize($filename));

        header("Content-Disposition: attachment; filename={$fname}");

        flush();

        readfile($filename);*/

        

    }

}



$qr_edital = mysql_query("SELECT * FROM compras AS A

                            INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                            WHERE id_compra = '{$_REQUEST['id_compra']}'");

$edital = mysql_fetch_assoc($qr_edital);

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

        <link href="resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>



        <script src="resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <script src="resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>

        <script src="resources/js/jquery.validationEngine.js" type="text/javascript"></script>

        <script src="resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>

        <script src="resources/js/maskedinput.js" type="text/javascript"></script>

        <script>

            $(function(){

                $('.maskdata').mask('99/99/9999');

                $('#telefone').mask('(99) 9999-9999');

                $('#cnpj').mask('99.999.999/9999-99');

                

                $("#form1").validationEngine();

                

                $(".bt_edital").click(function(){

                    var id = $(this).val();

                    $("#edital").val(id);

                    $("#form1").submit();

                });

            })

        </script>



    </head>



    <body>

        <div class="main">

            <div id="header">

                <h1 class="title1">Trabalhe Conosco</h1>

            </div>

            <section>

                <form method="post" action="edital.php?id_compra=<?php echo $edital['id_compra']; ?>" name="form1" id="form1" enctype="multipart/form-data" >

                    <input type="hidden" name="edital" id="edital" value="<?php echo $_REQUEST['edital'] ?>" />

                    <input type="hidden" name="unidade" id="unidade" value="<?php echo $edital['id_unidade'] ?>" />

                    <div id="conteudo">

                        <h2><?php echo $edital['numero']." - ".$edital['nome']; ?> </h2>

                        <div class="mensagem"><?php echo $edital['observacao'] ?></div>

                        <br/>

                        <p>O download do edital será liberado após o cadastro.</p>

                        <br/>

                        <fieldset>

                            <legend>Dados:</legend>

                            <p><label class="first2">Nome:</label><input type="text" name="nome" id="nome" value="" class="validate[required]" /></p>

                            <p><label class="first2">Razão:</label><input type="text" name="razao" id="razao" value="" class="validate[required]" /></p>

                            <p><label class="first2">CNPJ:</label><input type="text" name="cnpj" id="cnpj" value="" class="validate[required]" /></p>

                            <p><label class="first2">IM:</label><input type="text" name="im" id="im" value="" /></p>

                            <p><label class="first2">IE:</label><input type="text" name="ie" id="ie" value="" /></p>

                            <p><label class="first2">Email:</label><input type="text" name="email" id="email" value="" class="validate[required,custom[email]]" /></p>

                            <p class="controls"> 

                                <input type="submit" name="enviar" value="Enviar" class="button" />

                                <input type="button" name="voltar" value="Voltar" class="button" onclick="javascript:history.go(-1);" />

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

