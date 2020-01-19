<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');
include('../includes/global.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$sql_logo = mysql_query("SELECT * FROM cms_logo");
while($row = mysql_fetch_assoc($sql_logo)){
    $arrayLogo[$row['id']] = [
        "nome_logo" => $row['nome_logo'],
        "extensao" => $row['extensao'],
        "status" => $row['status']
    ];
}
$sql_logo_rows = mysql_num_rows($sql_logo);

$sql_logo_active = mysql_query("SELECT * FROM cms_logo WHERE status = 1");
$row_logo = mysql_fetch_assoc($sql_logo_active); 
$logo_active = $row_logo['id'];

if(isset($_POST['BreveHistoria']) && !empty($_POST['BreveHistoria'])){
    if($num_rows == 0){
        $texto_historia = $_REQUEST['BreveHistoria'];
        $sql = mysql_query("INSERT INTO cms (id, cms_historia) VALUES (1, '$texto_historia')");
        header('location: cms.php');
        $_SESSION["message"] = "Texto inserido com sucesso!";
    }else{
        if(empty($verifica_campo) || !empty($verifica_campo)){
            $texto_historia = $_REQUEST['BreveHistoria'];
            $sql = mysql_query("UPDATE cms SET cms_historia = '$texto_historia' WHERE id = 1");
            header('location: cms.php');
            $_SESSION["message"] = "Texto atualizado com sucesso!";
        }
    }
}else if(isset($_POST['BreveHistoria']) && empty($_POST['BreveHistoria'])){
    $sql = mysql_query("UPDATE cms SET cms_historia = ' ' WHERE id = 1");
    header('location: cms.php');
    $_SESSION["message"] = "Texto atualizado com sucesso!";
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
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr 1fr 1fr;
                grid-template-areas: ". . ." ". . ." ". . .";
                margin-left: 70px;
            }
            .logo{
                margin-bottom: 20px;
                text-align: center;
            }

            .text-center{
                text-align: center;
            }

            .button_center{
                float: none!important;
                display: inline-block!important;
            }

            .button_a{
                color: black; 
                font-size: 13px;
                padding: 1px 10px;
            }

            .button_center{
                float: none!important;
                display: inline-block!important;
            }
        </style>

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
                $("#novaLogo").click(function(){
                    window.location = 'logoform.php';
                });

                $("#listaLogo").click(function(){
                    window.location.href = 'logolista.php';
                });

                $(".message").delay(2000).fadeOut("slow");

                $('#busca').click(function(){
                    /*$('#pesquisa').html('<div style="width:100%; text-align:center;"><img src="../imagens/loader.gif"/></div>');*/
                    var menu   = $('#menu').val();
                    if(menu == "1"){
                        $('.1').show();
                        $('.2').hide();
                        $('.3').hide();

                        $("#salvar_logo").click(function(){
                            var verfica_campos = document.querySelector('input[name="campanhas_saude"]:checked');
                            if(verfica_campos != undefined){
                                var id_logo = document.querySelector('input[name="campanhas_saude"]:checked').value;
                                if(confirm('Atenção, deseja realmente inserir essa imagem como Logo para o site?')){
                                    $.post('../actions/action.cms.php', {id_logo:id_logo, method: "salvar_logo"}, function(data) {
                                        if(data){
                                            window.location.href = "cms.php";
                                        }
                                    },"json");
                                }
                            }else{
                                alert("Atenção, nenhum campo foi selecionado.");
                            }
                        })
                    }else if(menu == "2") {
                        $('.1').hide();
                        $('.2').show();
                        $('.3').hide();

                        $('.excluir_slide').click(function(){
                            var id_slide = $(this).data('value');
                            if(confirm('Atenção, deseja realmente excluir essa imagem do slide?')){
                                $.post('../actions/action.slide.php', {id_slide:id_slide, method: "excluir_slide"}, function(data) {
                                    if(data){
                                        window.location.href = "cms.php";
                                    }
                                },"json");
                            }
                        })
                    }else if(menu == "3") {
                        $('.1').hide();
                        $('.2').hide();
                        $('.3').show();
                    }else{
                        $('.1').hide();
                        $('.2').hide();
                        $('.3').hide();
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
                        <h2>Sistema de Gestão de Conteúdo</h2>
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
                        <?php if (isset($mensagem))  { ?>
                        <div class="message">
                            <?= $mensagem; ?>
                        </div>
                        <?php }?>
                    </div>

                    <div class="1" style="display: none;">
                        <div id="novaLogo" class="box-1">
                            <div class="box-image center">
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Nova Logo</p>
                            </div>
                        </div>

                        <div id="listaLogo" class="box-1">
                            <div class="box-image center">
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Lista de Logos</p>
                            </div>
                        </div>

                        <hr class="clear"/>
                        
                        <?php if (isset($mensagem))  { ?>
                            <div class="message">
                                <?= $mensagem; ?>
                            </div>
                        <?php }?>

                        <?php if(!empty($sql_logo_rows) && $sql_logo_rows > 0) { ?>
                            <fieldset>
                                <form action="" method="post">
                                <h3>Home: </h3>
                                <h4 style="margin-left: 72px;">Logo:</h4>
                                    <div class="grid-container">
                                        <?php foreach($arrayLogo AS $id_logo => $values) { ?>
                                            <div class="logo">
                                                <img src="cms_logo_images/<?php echo $id_logo; ?>.<?php echo $values['extensao']; ?>" alt="" width="100px;">
                                                <p class="text-center">
                                                    <input class="campanha" type="radio" name="campanhas_saude" value="<?php echo $id_logo; ?>" <?= $id_logo == $logo_active ? 'checked' : '' ;?>> <?php echo $values['nome_logo']; ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                        <br>
                                    </div>
                                    <p class="controls"> 
                                        <input id="salvar_logo" type="submit" name="salvar_logo" value="SALVAR" class="button">
                                    </p>
                                </form>                    
                            </fieldset>
                        <?php } else { ?>
                            <h4>Nenhum logo cadastrado</h4>
                        <?php } ?>
                    </div>

                    <div class="2" style="display: none;">
                        <hr/>

                        <?php if (isset($mensagem))  { ?>
                            <div class="message">
                                <?= $mensagem; ?>
                            </div>
                        <?php }?>
                        <form action="" method="post">
                            <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagem</th>
                                        <th colspan="3">AÇÃO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $class = (($i++ % 2) == 0) ? "even" : "odd";
                                        { ?>
                                        <tr class="<?php echo $class ?>">
                                        <tr>
                                            <td class="center">1</td>
                                            <?php
                                                $sql = "SELECT * FROM cms_slides WHERE id_img = 1";
                                                $result = mysql_query($sql); 
                                                while($row = mysql_fetch_assoc($result)){
                                                    $arrayRow1[$row['id_img']] = [
                                                        "extensao" => $row['extensao'],
                                                        "nome_imagem" => $row['nome_imagem'],
                                                    ];
                                                }
                                            ?>
                                            
                                            <?php if(mysql_num_rows($result)) { ?>
                                                <?php foreach($arrayRow1 AS $id_img => $val) { ?>
                                                    <td class="center"><?php echo $val['nome_imagem']; ?></td>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <td class="center"> - </td>
                                            <?php } ?>
                                            
                                            <?php if(mysql_num_rows($result) == 1) { ?>
                                                <td class="center">
                                                    <a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank">
                                                        <button class="button text-center button_center">VISUALIZAR</button>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <button type="submit" class="excluir_slide button text-center button_center icon" data-value="1">EXCLUIR</button>
                                                </td>

                                            <?php } else { ?>
                                                <td class="center" colspan='2'>
                                                    <a class="button_a button button_center" href="../adm/slideform.php?imagem=1" >
                                                        INSERIR
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <tr>
                                            <td class="center">2</td>
                                            <?php 
                                                $sql2 = "SELECT * FROM cms_slides WHERE id_img = 2"; 
                                                $result2 = mysql_query($sql2); 
                                                while($row = mysql_fetch_assoc($result2)){
                                                    $arrayRow2[$row['id_img']] = [
                                                        "extensao" => $row['extensao'],
                                                        "nome_imagem" => $row['nome_imagem'],
                                                    ];
                                                }
                                            ?>

                                            <?php if(mysql_num_rows($result2)) { ?>
                                                <?php foreach($arrayRow2 AS $id_img => $val) { ?>
                                                    <td class="center"><?php echo $val['nome_imagem']; ?></td>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <td class="center"> - </td>
                                            <?php } ?>
                                            
                                            <?php if(mysql_num_rows($result2) == 1) { ?>
                                                <td class="center">
                                                    <a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank">
                                                        <button class="button text-center button_center">VISUALIZAR</button>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <button type="submit" class="excluir_slide button text-center button_center icon" data-value="2">EXCLUIR</button>
                                                </td>
                                            <?php } else { ?>
                                                <td class="center" colspan='2'>
                                                    <a class="button_a button button_center" href="../adm/slideform.php?imagem=2" >
                                                        INSERIR
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <tr>
                                            <td class="center">3</td>
                                            <?php 
                                                $sql3 = "SELECT * FROM cms_slides WHERE id_img = 3"; 
                                                $result3 = mysql_query($sql3); 
                                                while($row = mysql_fetch_assoc($result3)){
                                                    $arrayRow3[$row['id_img']] = [
                                                        "extensao" => $row['extensao'],
                                                        "nome_imagem" => $row['nome_imagem'],
                                                    ];
                                                }
                                            ?>

                                            <?php if(mysql_num_rows($result3)) { ?>
                                                <?php foreach($arrayRow3 AS $id_img => $val) { ?>
                                                    <td class="center"><?php echo $val['nome_imagem']; ?></td>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <td class="center"> - </td>
                                            <?php } ?>

                                            <?php if(mysql_num_rows($result3) == 1) { ?>
                                                <td class="center">
                                                    <a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank">
                                                        <button class="button text-center button_center">VISUALIZAR</button>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <button type="submit" class="excluir_slide button text-center button_center icon" data-value="3">EXCLUIR</button>
                                                </td>
                                            <?php } else { ?>
                                                <td class="center" colspan='2'>
                                                    <a class="button_a button button_center" href="../adm/slideform.php?imagem=3">
                                                       INSERIR
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="3" style="display: none">
                        <form action="" method="POST">
                            <script type="text/javascript">
                                $(document).ready(function(){       
                                    CKEDITOR.replace('BreveHistoria',
                                        {
                                        toolbar : [
                                        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                                        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                                        '/',
                                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                                        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                                        '/',
                                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                                        { name: 'others', items: [ '-' ] },
                                        { name: 'about', items: [ 'About' ]},
                                        ],
                                        mode : 'wysiwyg',
                                        height: 500,        
                                    });    
                                });

                                /*$.fck.config = {path: 'fckeditor/'};
                                $('textarea#observacao').fck({height:700, width:770});*/
                            </script>

                            <?php
                                $sql = mysql_query("SELECT cms_historia FROM cms");
                                $row = mysql_fetch_assoc($sql);
                                $texto_historia = $row['cms_historia'];   
                            ?>

                            <hr/>

                            <?php if (isset($mensagem))  { ?>
                                <div class="message">
                                    <?= $mensagem; ?>
                                </div>
                            <?php }?>

                            <fieldset>
                                <legend>Dados: </legend>
                                <p>
                                    <label class="first2">Texto:</label>
                                    <textarea class="BreveHistoria" name="BreveHistoria" ><?php echo $texto_historia; ?></textarea>
                                </p>
                                <input type="submit" value="SALVAR" class="button" />
                            </fieldset>
                        </form>
                    </div>
                </div> 
            </section>
          
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>