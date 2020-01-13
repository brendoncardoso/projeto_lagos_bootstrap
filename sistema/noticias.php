<?php

include('includes/conecte.php');

$pagina = 1;



if (isset($_REQUEST['id_noticia']) && !empty($_REQUEST['id_noticia'])) {

    $pagina = 2;

    $rq_noticia = mysql_query("SELECT * FROM noticias WHERE id_noticia = {$_REQUEST['id_noticia']}");

    $noticia = mysql_fetch_assoc($rq_noticia);

}



$rq_noticias = mysql_query("SELECT id_noticia,titulo,date_format(data, \"%d/%m/%Y\")as datar FROM noticias ORDER BY data DESC");

$to_noticias = mysql_num_rows($rq_noticias);

?>



<html xmlns="http://www.w3.org/1999/xhtml">

    <head profile="http://gmpg.org/xfn/11">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script src="resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <style>

            body{font-family: Trebuchet MS; font-size: 11px; line-height: 18px;}

            div.noticias{font-size: 1.26em; color: #84878E;}

            a{text-decoration: none;}

            

        </style>

        <script>

            $(document).ready(function(){

                $(".alink").click(function(){

                    var id = $(this).data('key');

                    $("#id_noticia").val(id);

                    $("#form1").submit();

                });

            });

        </script>

    </head>

    <body>

        <?php if ($pagina == 1) { ?>

            <form name="form1" id="form1" method="post" action="">

                <input type="hidden" name="id_noticia" id="id_noticia" value="" />

                <div class="noticias">

                    <p><strong>Últimas Notícias:</strong></p>



                    <?php

                    if ($to_noticias > 0) {

                        while ($row = mysql_fetch_assoc($rq_noticias)) {

                            echo "<p><a href=\"javascript:;\" data-key=\"{$row['id_noticia']}\" class=\"alink\" target=\"_self\">[{$row['datar']}] - {$row['titulo']}</a></p>";

                        }

                    }

                    ?>

                </div>

            </form>

        <?php } else { ?>



            <h2><?php echo $noticia['titulo'] ?></h2>

            <h3><?php echo $noticia['subtitulo'] ?></h3>

            <div>

                <?php echo $noticia['texto'] ?>

            </div>



            <br/><br/>



            <p><strong>Fonte: </strong><?php echo $noticia['fonte'] ?></p>

            <p><strong>Link: </strong><a href="<?php echo $noticia['link'] ?>" target="_blank"><?php echo $noticia['link'] ?></a></p>

            

            

            <br/><br/>

            <a href="noticias.php">« Voltar</a>

        <?php } ?>

    </body>

</html>