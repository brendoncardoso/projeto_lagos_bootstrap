<?php require_once 'includes/conecte.php'; ?>

<!DOCTYPE HTML>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="resources/css/validationEngine.jquery.css">

        <style type="text/css">

            body{  margin: 0px; }

            .indent{ margin: 10px;}

            .descTrabalhe{ width: 530px;}

            .titulo{ font-family: arial; font-size: 16px; color: #01265D; text-transform: uppercase;}

            .textoPreto, .first{font-family: arial; font-size: 12px; color: #666; }

            .first{ display:block ; font-size: 12px;}

            .input{ width: 500px; padding: 6px 8px;}

            .select{ width: 200px; padding: 6px;}

            .button{ width: 100px; padding: 5px; }

            .message{ width: 100%; height: 30px; background: red; color: #fff; padding: 5px; margin: 0px; }

        </style>

        <script type="text/javascript" src="resources/js/jquery-1.8.2.min.js" ></script>

        <script type="text/javascript" src="resources/js/jquery.validationEngine-pt.js" ></script>

        <script type="text/javascript" src="resources/js/jquery.validationEngine.js" ></script>

        <script type="text/javascript" src="resources/js/maskedinput.js" ></script>

        <script type="text/javascript">

            $(function() {

                $(".categoria").click(function(){

                    var categoria = $(this).data("cat");

                    $('#conteins').load('sistema/noticias.php',{"categoria":categoria});

                    $("#titulo span").html(categoria);

                });

                

                $("#form1").validationEngine({promptPosition : "topLeft"});

                $(".showForm").click(function(){

                    //MOSTRA O FORM

                    //$(".trabalheConosco").fadeIn(500);

                    //AJUSTA O TAMANHO DO PARAGRAFO COM O TEXTO

                    $(".descTrabalhe p").css({width:"370px"});

                });

                $("#telefone").mask("(99)9999-9999?9");

                

                $(".message").fadeOut(5000);

                

            });

        </script>



    <div class="indent">

        <div id="titulo">

            <h2 class="titulo">FAÇA PARTE DO GRUPO INSTITUTO LAGOS RIO</h2>

        </div>

        <div id="conteins">

            <div class="descTrabalhe">

                <p class="textoPreto">

                    Trabalhar aqui é viver em um ambiente muito alegre e

                    agradável, onde todos buscam contribuir não só para um

                    bom serviço, como também para o cumprimento de nossa

                    missão.

                </p>

                <!--<button type="button" class="button showForm">Enviar Currículo</button>-->

            </div>

            <div class="trabalheConosco">

                <form method="post" action="actions/cadastro_curriculo.php" name="form1" id="form1" enctype="multipart/form-data">

                    <div class="box">

                        <p> <label class="first">Nome:</label> <input type="text" name="nome" id="nome" class="input validate[required]"/> </p>

                        <p> <label class="first">Telefone:</label> <input type="text" name="telefone" id="telefone" class="input validate[required]"/> </p>

                        <p> <label class="first">E-mail:</label> <input type="text" name="email" id="email" class="input validate[required,custom[email]]"/> </p>

                        <p> 

                            <label class="first">Cargo pretendido:</label> 

                            <select name="cargo" class="select validate[required]">

                                <option value="-1">Selecione um cargo

                                    <?php

                                    $sql = mysql_query("SELECT * FROM cargos");

                                    while ($linha = mysql_fetch_assoc($sql)) {

                                        ?> 

                                    <option value="<?php echo $linha['id_cargo']; ?>"><?php echo $linha['cargo']; ?>



                                    <?php } ?>

                            </select>

                        </p>

                        <p> <label class="first">Anexar Currículo (DOC,PDF):</label> <input type="file" name="curriculo" id="curriculo" class="file validate[required,custom[arquivoTxt]]"/> </p>

                    </div>

                    <input type="submit" name="enviar" id="enviar" value="Enviar" class="button" /> 

                    <div id="msg"></div>

                </form> 

            </div>

        </div>



    </div>

