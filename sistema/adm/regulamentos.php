<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$dir_move = "/arquivos/regulamentos/";
$dir = dirname(dirname(__FILE__)) . $dir_move;

$pessoal = $dir."regime_contratacao.pdf";
$compras = $dir."regime_compras.pdf";

if(isset($_REQUEST['method']) && !empty($_REQUEST['method'])){
    if($_REQUEST['method'] == "contratacao"){
        $re = array("ok"=>true);
        if(!unlink($pessoal)){
            $re = array("ok"=>false);
        }
        echo json_encode($re);exit;
    }elseif ($_REQUEST['method'] == "compras") {
        $re = array("ok"=>true);
        if(!unlink($compras)){
            $re = array("ok"=>false);
        }
        echo json_encode($re);exit;
    }
}

if(isset($_REQUEST['enviar']) && !empty($_REQUEST['enviar'])){
    if (!empty($_FILES)) {
        
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        if(isset($_FILES['contratacao']) && !empty($_FILES['contratacao']['tmp_name'])){
            $tmp_name = $_FILES['contratacao']['tmp_name'];

            if (!move_uploaded_file($tmp_name, $pessoal)) {
                $_SESSION["message"] = "Erro ao mover o arquivo de contratação";
                header("Location: ../adm/regulamentos.php");
            }
        }
        if(isset($_FILES['compras']) && !empty($_FILES['compras']['tmp_name'])){
            $tmp_name = $_FILES['compras']['tmp_name'];

            if (!move_uploaded_file($tmp_name, $compras)) {
                $_SESSION["message"] = "Erro ao mover o arquivo de compras";
                header("Location: ../adm/regulamentos.php");
            }
        }
    }
    header("Location: ../adm/regulamentos.php");
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
        <script src="../resources/js/global.js" type="text/javascript"></script>

        <script>
            $(document).ready(function(){
                $.validationEngineLanguage.allRules["funOnlyPdf"] = {
                    "alertText":"Somente PDF."
                };
                
                $("#form1").validationEngine();
            });
            
            function remover(arquivo){
                if(confirm("Essa ação é irreversível, deseja continuar?")){
                    $.post("regulamentos.php", {method:arquivo}, 
                    function(resposta){
                        if(resposta.ok){
                            window.location = 'regulamentos.php';
                        }else{
                            alert("Erro ao remover o arquivo");
                        }
                    },"json");
                }
            }
            
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
                <form method="post" action="" name="form1" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <?php if (isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>
                            <h2>Regulamentos</h2>
                            
                            <h3>» Regulamento do regime de contratação</h3>
                            <?php if(is_file($pessoal)){ ?>
                            <p><a href="../arquivos/regulamentos/regime_contratacao.pdf" target="_banck">baixar arquivo</a></p>
                            <p><a href="javascript:remover('contratacao');">remover arquivo</a></p>
                            <?php }else{ ?>
                            <p><input type="file" name="contratacao" id="contratacao" class="validate[funcCall[onlyPdf]]" /> <span class="exemplo">Somente arquivo PDF</span></p>
                            <?php } ?>
                            
                            <br/><br/>
                            
                            <h3>» Regulamento do regime de compras</h3>
                            <?php if(is_file($compras)){ ?>
                            <p><a href="../arquivos/regulamentos/regime_compras.pdf" target="_banck">baixar arquivo</a></p>
                            <p><a href="javascript:remover('compras')">remover arquivo</a></p>
                            <?php }else{ ?>
                            <p><input type="file" name="compras" id="compras" class="validate[funcCall[onlyPdf]]" /> <span class="exemplo">Somente arquivo PDF</span></p>
                            <?php } ?>
                            
                            <br/><br/>
                            
                            <p class="controls"> 
                                <input type="submit" name="enviar" value="Salvar" class="button" />
                                <input type="button" name="cancelar" value="Cancelar" class="button" />
                            </p>
                            
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
