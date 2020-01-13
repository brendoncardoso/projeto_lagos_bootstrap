<?php

include('includes/conecte.php');

session_start();



$dir_move = "/arquivos/regulamentos/";

$dir = dirname(__FILE__) . $dir_move;



$contratacao = $dir."regime_contratacao.pdf";



$qr_estadosA = mysql_query("SELECT B.uf FROM editalpessoal AS A

                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                WHERE data_fim >= NOW() AND A.status = 1

                GROUP BY B.uf ORDER BY B.uf");

$to_estadosA = mysql_num_rows($qr_estadosA);



$qr_estadosF = mysql_query("SELECT YEAR(data_ini) AS ano FROM editalpessoal AS A

                                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                                WHERE data_fim <= NOW() OR A.status = 2

                                GROUP BY YEAR(data_ini)

                                ORDER BY YEAR(data_ini) DESC");

$to_estadosF = mysql_num_rows($qr_estadosF);

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



        <script src="resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <script>

            $(function(){

                <?php if(isset($_SESSION['Message'])){ ?>alert("<?php echo $_SESSION['Message']?>");<?php session_destroy();} ?>

                $(".bt_edital").click(function(){

                    var id = $(this).attr('data-key');

                    $("#edital").val(id);

                    $("#form1").submit();

                });

                $(".bt-old").css('cursor','pointer');

                $(".bt-old").click(function(){

                    var id = $(this).data("key");

                    $.post("actions/action.editalpessoal.php",

                            {ano:id, method:"listaAno"},

                            function(resposta){

                                $('#pesquisa').html(resposta);

                            },"html");

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

                <form method="post" action="candidato.php" name="form1" id="form1">

                    <input type="hidden" name="edital" id="edital" value="" />

                    <div id="conteudo">

                        <div class="blocos">

                            <h2>Vagas Abertas</h2>

                            <?php 

                            if($to_estadosA > 0){ 

                                $html = "<ul>";

                                while($estados = mysql_fetch_array($qr_estadosA)){

                                    $html .= "<li>{$estados['uf']}</li><ul>";

                                    $qr_vagasAb = mysql_query("SELECT * FROM editalpessoal AS A

                                                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                                                    WHERE data_fim >= NOW() AND A.status = 1 AND B.uf = '{$estados['uf']}'

                                                    ORDER BY B.nome");

                                    while($vagasAb = mysql_fetch_array($qr_vagasAb)){

                                        $html .= "<li><a href=\"javascript:;\" data-key=\"{$vagasAb['id_editalpessoal']}\" class=\"bt_edital\">{$vagasAb['nome']}</a>";

                                        if($vagasAb['prorrogado']) $html .= "&nbsp; &nbsp;<span style=\"color:red\">(Prorrogado)</span>";

                                        $html .= "</li>";

                                    }

                                    $html .= "</ul>";

                                }

                                $html .= "</ul>";

                                echo $html;

                            }else{

                                echo "<h4>Nenhum processo seletivo aberto</h4>";

                            }

                            ?>

                        </div>

                        <br/>

                        <div class="blocos">

                            <h2>Processos seletivos encerrados</h2>

                            <?php 

                            if($to_estadosF > 0){ 

                                $html = "<ul>";

                                while($estados = mysql_fetch_array($qr_estadosF)){

                                    $html .= "<li class=\"bt-old\" data-key=\"{$estados['ano']}\">{$estados['ano']}</li>";

                                }

                                $html .= "</ul>";

                                echo $html;

                            }else{

                                echo "<h4>Nenhum processo seletivo encerrado</h4>";

                            }

                            ?>

                            <div id="pesquisa"></div>

                        </div>

                        

                        <br/>

                        

                        <div class="blocos">

                            <h2>Regulamento do regime de contratação</h2>

                            <?php if(is_file($contratacao)){ ?>

                            <p><a href="arquivos/regulamentos/regime_contratacao.pdf" target="_banck">baixar arquivo pdf</a></p>

                            <?php } ?>

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

