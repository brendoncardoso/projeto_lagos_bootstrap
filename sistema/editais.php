<?php

include('includes/conecte.php');



session_start();



$dir = "http://www.institutolagosrio.com.br/sistema/arquivos/regulamentos/";



$compras = $dir."regime_compras.pdf";



$qr_estadosA = mysql_query("SELECT B.uf FROM compras AS A

                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                WHERE data_fim >= NOW() AND A.status = 1

                GROUP BY B.uf ORDER BY B.uf");

$to_estadosA = mysql_num_rows($qr_estadosA);



$qr_estadosF = mysql_query("SELECT YEAR(data_ini) AS ano FROM compras AS A

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

        <title>Editais de Compras / Serviços</title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <link href="resources/css/site.css" type="text/css" rel="stylesheet"/>



        <script src="resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <script>

            $(function(){

                <?php if(isset($_SESSION['Message'])){ ?>alert("<?php echo $_SESSION['Message']?>");<?php unset($_SESSION['Message']);} ?>

                $(".bt_edital").click(function(){

                    var id = $(this).data('key');

                    $("#edital").val(id);

                    $("#form1").submit();

                });

                $(".bt-old").css('cursor','pointer');

                $(".bt-old").click(function(){

                    var bt = $(this);

                    var id = bt.attr("data-key");

                    var st = bt.attr("data-st");

                    if(st=="0"){

                        $("#loading").show();

                        $.post("actions/action.edital.php",

                                {ano:id, method:"listaAno"},

                                function(resposta){

                                    $('#pesquisa').html(resposta);

                                    $("#loading").hide();

                                },"html");

                        bt.attr('data-st',1);

                    }else if(st=="1"){

                        $("#pesquisa").hide();

                        bt.attr('data-st',2);

                    }else if(st=="2"){

                        $("#pesquisa").show();

                        bt.attr('data-st',1);

                    }

                });

            })

        </script>

        

    </head>



    <body>

        <div class="main">

            <div id="header">

                <h1 class="title1">Editais de Compras / Serviços</h1>

            </div>



            <section>

                <form method="post" action="edital.php" name="form1" id="form1">

                    <input type="hidden" name="edital" id="edital" value="" />

                    <div id="conteudo">

                        <div class="blocos">

                            <h2>Editais Abertos</h2>

                            <?php 

                            if($to_estadosA > 0){ 

                                $html = "<ul>";

                                while($estados = mysql_fetch_array($qr_estadosA)){

                                    $html .= "<li>{$estados['uf']}</li><ul>";

                                    $qr_vagasAb = mysql_query("SELECT * FROM compras AS A

                                                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)

                                                    WHERE data_fim >= NOW() AND A.status = 1 AND B.uf = '{$estados['uf']}'

                                                    ORDER BY B.nome");

                                    while($vagasAb = mysql_fetch_array($qr_vagasAb)){

                                        $html .= "<li><a href=\"javascript:;\" data-key=\"{$vagasAb['id_compra']}\" class=\"bt_edital\">{$vagasAb['nome']}</a>";

                                        $html .= "</li>";

                                    }

                                    $html .= "</ul>";

                                }

                                $html .= "</ul>";

                                echo $html;

                            }else{

                                echo "<h4>Nenhum edital aberto</h4>";

                            }

                            ?>

                        </div>

                        <br/>

                        <div class="blocos">

                            <h2>Editais encerrados</h2>

                            <?php 

                            if($to_estadosF > 0){ 

                                $html = "<ul>";

                                while($estados = mysql_fetch_array($qr_estadosF)){

                                    $html .= "<li class=\"bt-old\" data-key=\"{$estados['ano']}\" data-st=\"0\">{$estados['ano']}</li>";

                                }

                                $html .= "</ul>";

                                echo $html;

                            }else{

                                echo "<h4>Nenhum edital encerrado</h4>";

                            }

                            ?>

                            <div id="pesquisa">

                                

                            </div>

                            <img id="loading" src="resources/images/loading_peq.gif" style="display: none;" />

                        </div>

                        

                        <br/>

                        

                        <div class="blocos">

                            <h2>Regulamento do regime de compras</h2>

                            <?php if(is_file($compras)){ ?>

                            <p><a href="<?php echo $compras ?>" target="_banck">baixar arquivo pdf</a></p>

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