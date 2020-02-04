<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

/* PAGINAÇÃO */
$limite = 20;
$pagina = (isset($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina - 1) * $limite : 0;
/*$sql = "SELECT *, DATE_FORMAT(DATA, '%d/%m/%Y - %H:%i') AS datar
FROM noticias AS A
LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia)
ORDER BY DATA DESC";*/

$sql = "SELECT *
FROM eventos AS A
ORDER BY A.DATA DESC";

$qr_eventos = mysql_query($sql . " LIMIT $inicio,$limite");

$html_pagina = geraPaginacao($pagina, $limite, $sql, "");
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
        <script src="../resources/js/global.js" type="text/javascript"></script>

        <script>
            $(function(){
                $("#novo").click(function(){
                    window.location = 'eventosform.php';
                });

                $(".message").delay(5000).fadeOut("slow");

                $(".icon-editar").click(function(){
                    $("#id").val($(this).attr("data-key"));
                    $("#form1").attr("action","eventosform.php");
                    $("#form1").submit();
                });
                $(".icon-excluir").click(function(){
                    var id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir esse Evento?')){
                        $.post('../actions/action.eventos.php', {id:id, method:"exclui"} ,function(data) {
                            if(data){
                                window.location = "eventos.php";
                            }
                        },"json");
                    }
                });
            });
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
                <form method="post" action="" name="form1" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h2>Eventos</h2>

                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>" />

                            <div id="novo" class="box-1">
                                <div class="box-image center">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Novo Evento</p>
                                </div>
                            </div>

                            <hr class="clear"/>

                            <?php if (isset($mensagem)) { ?> 
                                <div class='message'>
                                    <?= $mensagem; ?>
                                </div> 
                            <?php } ?>

                            <?php if (mysql_num_rows($qr_eventos) == 0) { ?>
                                <h4>Nenhuma evento encontrada</h4>
                            <?php } else { ?> 
                                <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Data - Hora</th>
                                            <th>Nome Evento</th>
                                            <th>Imagem</th>
                                            <!--<th>Assunto</th>-->
                                            <th colspan="2">AÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?> 

                                        <?php while($row = mysql_fetch_assoc($qr_eventos)) { ?>
                                            <?php $class = (($i++ % 2) == 0) ? "even" : "odd";?>
                                            <tr class="<?php echo $class ?>">
                                                <td class="center"><?php echo $row['id'] ?></td>
                                                <td class="center"><?php echo $row['data'] ?></td>
                                                <td class="center"><?php echo $row['nome_evento'] ?></td>
                                                <td class="center" > - </td>
                                                <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row['id'] ?>" >&nbsp;</a></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row['id'] ?>" >&nbsp;</a></td>
                                            </tr>
                                       
                                       <!-- while ($row = mysql_fetch_assoc($qr_unidade)) {
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                            ?>
                                            <tr class="<?php echo $class ?>">
                                                <td><?php echo $row['id_noticia'] ?></td>
                                                <td><?php echo $row['datar'] ?></td>
                                                <td><?php echo $row['titulo'] ?></td>
                                                <td><?php echo $row['subtitulo'] ?></td>
                                                <td class="center"> 
                                                    <?php if($row['status_img'] == 1) { ?>
                                                        <a href="cms_img_noticias/<?php echo $row['img_noticia']; ?>" target="_blank" rel="">Visualizar</a>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row['id_noticia'] ?>" >&nbsp;</a></td>
                                                <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row['id_noticia'] ?>" >&nbsp;</a></td>
                                            </tr>-->
                                        <?php } ?>
                                    </tbody>
                                    <?php echo $html_pagina ?>
                                </table>
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
