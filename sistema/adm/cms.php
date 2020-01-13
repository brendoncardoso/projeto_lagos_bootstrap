<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');
include('../includes/global.php');
$sql_select = mysql_query("SELECT cms_historia FROM cms WHERE id = 1");
$row = mysql_fetch_assoc($sql_select);
$verifica_campo = $row['cms_historia'];
$num_rows = mysql_num_rows($sql_select);

if(isset($_POST['BreveHistoria']) && !empty($_POST['BreveHistoria'])){
    if($num_rows == 0){
        $texto_historia = $_REQUEST['BreveHistoria'];
        $sql = mysql_query("INSERT INTO cms (id, cms_historia) VALUES (1, '$texto_historia')");
    }else{
        if(empty($verifica_campo) || !empty($verifica_campo)){
            $texto_historia = $_REQUEST['BreveHistoria'];
            $sql = mysql_query("UPDATE cms SET cms_historia = '$texto_historia' WHERE id = 1");
        }
    }
}else if(isset($_POST['BreveHistoria']) && empty($_POST['BreveHistoria'])){
    $sql = mysql_query("UPDATE cms SET cms_historia = ' ' WHERE id = 1");
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
        <script src="../resources/js/global.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.FCKEditor.js" type="text/javascript" ></script>
        <script src="ckeditor/ckeditor.js" type="text/javascript" ></script>


        <script type="text/javascript">
       

            $(document).ready(function(){
                $('#busca').click(function(){
                    /*$('#pesquisa').html('<div style="width:100%; text-align:center;"><img src="../imagens/loader.gif"/></div>');*/
                    var menu   = $('#menu').val();
                    console.log(menu);
                    if(menu != "-1"){
                        $.ajax({
                            url: '../actions/action.cms.php?pagina='+menu,
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
                        <h2>Menu</h2>
                    <form action="" method="get">
                        <fieldset>
                            <legend>Buscar</legend>
                            <p>
                                <label class="first">Página:</label> 
                                <select name="menu_id" id="menu" style="width: 400px;">
                                    <option value="-1"> « Selecione » </option>
                                    <option value="1"> Home (Logo/Campanhas)</option>
                                    <option value="2"> Home (Slides)</option>
                                    <option value="3"> Breve História (O Instituto)</option>
                                    <option value="4"> Visão, Missão e Valores (O Instituto)</option>
                                </select>
                            </p>
                            <p class="controls"><input name="buscar" type="button" value="BUSCAR" id="busca" class="button" /></p>
                        </fieldset>
                    </form>
                       
                    </div>
                    <div id="pesquisa"></div>
                </div> 
            </section>
          
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>