<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

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

        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/global.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                $('#busca').click(function(){
                    /*$('#pesquisa').html('<div style="width:100%; text-align:center;"><img src="../imagens/loader.gif"/></div>');*/
                    var upa   = $('#upa').val();
                    if(upa != "-1"){
                        $.ajax({
                            url: '../actions/action.empresa.php?unidade='+upa,
                            success: function(resposta){
                                $('#pesquisa').html(resposta);
                            }
                        });
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
                <div id="conteudo">
                    <div class="blocos">
                        <h2>Empresas</h2>

                        <fieldset>
                            <legend>Buscar</legend>
                            <p>
                                <label class="first">Edital / Unidade:</label> 
                                <select name="upa_id" id="upa" style="width: 400px;">
                                    <option value="-1"> « Selecione » </option>
                                    <?php
                                    $qr_upa = mysql_query("SELECT * FROM compras AS A INNER JOIN unidades AS B ON (A.id_unidade=B.id_unidade) WHERE A.status = 1");
                                    while ($row_upa = mysql_fetch_assoc($qr_upa)):
                                        ?>
                                        <option value="<?php echo $row_upa['id_compra']; ?>"><?php echo $row_upa['numero']." - ".$row_upa['nome']; ?> </option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>
                            </p>
                            <p class="controls"><input name="buscar" type="button" value="BUSCAR" id="busca" class="button" /></p>
                        </fieldset>

                        <div id="pesquisa"></div>
                    </div>
                </div> 
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>

    </body>
</html>
