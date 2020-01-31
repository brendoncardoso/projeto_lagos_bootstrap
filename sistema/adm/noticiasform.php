<?php

include('../includes/conecte.php');

include('../includes/restricao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$act = 1;

if (isset($_REQUEST['id'])) {

    $result = mysql_query("SELECT * FROM noticias WHERE id_noticia = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);

        $id_editalnoticia_noticia = $row['id_editalnoticia'];

        $id_noticia = $row['id_noticia'];

        $titulo = $row['titulo'];

        $subtitulo = $row['subtitulo'];

        $texto = $row['texto'];

        $fonte = $row['fonte'];

        $link = $row['link'];

        $status_img = $row['status_img'];

        $tags = $row['tags'];

        

    } else {

        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";

        header("Location: ../adm/unidade.php");

    }

} else {

    $id_editalnoticia_noticia = "";

    $id_noticia = "";

    $act = 2;

    $titulo = "";

    $subtitulo = "";

    $texto = "";

    $fonte = "";

    $link = "";

    $status_img = "";

    $tags = "";

}

$sql_edital_noticias = mysql_query("SELECT * FROM editalnoticias WHERE status = 1"); 
while($row = mysql_fetch_assoc($sql_edital_noticias)){
    $arrayNoticiasEdital[$row['id_editalnoticia']] = [
        "nome_edital" => $row['nome_edital']
    ];
}

$sql_num_rows_edital_noticias = mysql_num_rows($sql_edital_noticias);


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

        <script src="ckeditor/ckeditor.js" type="text/javascript"></script>

        

        <script type="text/javascript">

            jQuery(document).ready(function($){            

                CKEDITOR.replace('fckExemplo',

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

                var limite = 52;
                var caracteresDigitados = $('input[name=subtitulo]').val().length;
                if(caracteresDigitados > 52){
                    $('.caracteres').text(limite+"/"+limite);
                }else{
                    $('.caracteres').text(caracteresDigitados+"/"+limite);
                }
                                  
                 $(document).on("input", "#subtitulo", function() {
                    var caracteresDigitados = $(this).val().length;
                    var caracteresRestantes = limite - caracteresDigitados;
                    
                    if (caracteresDigitados >= 0) {
                        var comentario = $("input[name=subtitulo]").val();
                        $("input[name=subtitulo]").val(comentario.substr(0, limite));
                        $('.caracteres').text(caracteresDigitados +"/"+limite);
                        if(caracteresDigitados <= limite){
                        }else{
                            $('.caracteres').text(limite+"/"+limite);
                        }
                    } else {
                        $('.caracteres').text(caracteresDigitados +"/"+limite);
                    }
                 });

                 $(".message").delay(5000).fadeOut("slow");

                 $('.status_novo_assunto').on('click', function(){
                    var val = $(this).val();
                    if(val == 1){
                        $('.novo_assunto').prop("disabled", false);
                        $('.assuntos').prop("disabled", true);
                        $('.assuntos').attr('value', '');
                    }else{
                        $('.novo_assunto').prop("disabled", true);
                        $('.assuntos').prop("disabled", false);
                    }
                 });

                $('.excluir_img').on('click', function(){
                    var id_noticia = $(this).data('id_noticia');
                    if(confirm("Tem certeza que deseja Exluir a Imagem da notícia do id = "+ id_noticia +" ?")){
                        $.post('../actions/action.noticias.php', {id_noticia:id_noticia, method: "excluir_thumb"}, 
                        function(data) {
                            if(data){
                                window.location.href = "noticias.php";
                            }
                        },"json");
                    }
                });

                $('.cadastraredital').click(function(){
                    window.location = "editalnoticiaform.php";
                })

                $('.listaedital').click(function(){
                    window.location = "editalnoticia.php";
                })
//               
            });
        </script>

        <style>
            .button_center{
                float: none!important;
                display: inline-block!important;
            }

            .grid {
                padding: 210px;
                padding-top: 0px;
                padding-bottom: 0px;
            }

            .button_a{
                color: black; 
                font-size: 13px;
                padding: 1px 10px;
            }

        </style>
    </head>

<?php 

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

?>

    <body>

        <div class="main">

            <div id="header">

                <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>

            </div>

            <nav>

            <?php include('../includes/menu_adm.php'); ?>

            </nav>



            <section>

                <form name="" action="../actions/action.noticias.php" method="post" enctype="multipart/form-data" id="form1">
                
                    <div id="conteudo">
                        
                        <div class="blocos">

                            <h3>Cadastro de Processo Seletivo</h3>

                            <div id="novo" class="box-1">
                                <div class="box-image center cadastraredital">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Cadastrar Edital</p>
                                </div>
                            </div>

                            <div id="novo" class="box-1">
                                <div class="box-image center listaedital">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Lista de Edital</p>
                                </div>
                            </div>
                            <hr class="clear" />
                            
                            <?php if (isset($mensagem)) { ?> 
                               <div class='message'>
                                   <?php echo $mensagem; ?>
                               </div> 
                            <?php } ?>
                            
                            <fieldset>

                                <legend>Dados</legend>

                                <p><label class="first2">Título:</label><input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>" class="validate[required]" />

                                <label class="first2">Prioridade:</label><input id="prioridade" name="prioridade" class="prioridade" type="checkbox" value="1"></p>
                                
                                <p><label class="first2">Subtítulo:</label><input type="text" name="subtitulo" id="subtitulo" value="<?php echo $subtitulo ?>" />  &nbsp; <small class="caracteres"> 0/52</small></p>
                                
                               
                                <p>
                                        
                                    <label class="first2">Edital:</label>
                                    <select name="edital_noticias" id="edital_noticias" style="width: 400px;" <?php echo $sql_num_rows_edital_noticias > 0 ? '': 'disabled'?>>
                                        <?php if($sql_num_rows_edital_noticias > 0){ ?>
                                            <option value="-1"> « Selecione o Edital » </option>
                                            <?php foreach($arrayNoticiasEdital AS $id_editalnoticia => $values) { ?>
                                                <option value="<?php echo $id_editalnoticia?>" <?= $id_editalnoticia == $id_editalnoticia_noticia ? 'selected' : ''; ?>><?php echo $values['nome_edital']?></option>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <option value="-1"></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <!--<p>
                                    <label class="first2">Assuntos:</label><input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>" class="validate[required]" />
                                    <select class="assuntos" id="">
                                        <option value=""> « Selecione » </option>
                                    </select>
                                </p>

                                <p><label class="first2">Deseja inserir novo Assunto?</label><input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>" class="validate[required]" />
                                    <input class="status_novo_assunto" type="radio" name="status_novo_assunto" value="1"> Sim
                                    <input class="status_novo_assunto" type="radio" name="status_novo_assunto" value="0" checked> Não
                                </p>
                                <p><label class="first2">Novo Assunto:</label><input type="text" class="novo_assunto" name="novo_assunto" id="novo_assunto" disabled/>-->

                                <p><label class="first2">Texto:</label><textarea name="fckExemplo" id="fckExemplo"><?php echo $texto ?></textarea></p>

                                <p>
                                    <?php if($status_img == 0) { ?>
                                        <label class="first2">Thumbnail:</label><input type="file" name="imagem_noticia" id="" value="" />
                                    <?php }else{ ?>
                                        <?php 
                                            $sql_img_noticia = mysql_query("SELECT * FROM cms_img_noticia WHERE id_noticia = {$id_noticia}");    
                                            $row = mysql_fetch_assoc($sql_img_noticia);
                                            $img_noticia = $row['img_noticia'];
                                        ?>
                                        
                                        <label class="first2">Thumbnail:</label>
                                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Imagem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="even"></tr>
                                                <tr>
                                                    <td class="center"><?php echo $id_noticia; ?></td>
                                                    <td class="center"> 
                                                        
                                                        <a class="button_a button text-center button_center" href="cms_img_noticias/<?php echo $img_noticia; ?>" target="_blank">
                                                            VISUALIZAR
                                                        </a> 
                                                        
                                                        <input type="submit" name="excluir_img" class="button excluir_img text-center button_center" value="EXCLUIR" data-id_noticia="<?php echo $id_noticia; ?>"/>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                    <?php } ?>
                                </p>

                                <p>
                                    <label class="first2">Tags:</label>
                                    <input type="text" name="tag" id="tag" value="<?php echo $tags; ?>" />
                                    <small>
                                        <i>
                                            <b>Exemplo:</b> Tag1, Tag2, Tag3 ...
                                        </i>
                                    </small>
                                </p>
                                <p><label class="first2">Fonte:</label><input type="text" name="fonte" id="fonte" value="<?php echo $fonte ?>" /></p>
                                <p><label class="first2">Link:</label><input type="text" name="link" id="link" value="<?php echo $link ?>" /></p>

                                <p class="controls"> 

                                    <?php if ($act == 1) { ?>

                                        <input type="submit" name="enviar" value="Salvar" class="button" />

                                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />

                                    <?php } else { ?>

                                        <input type="submit" name="enviar" value="Cadastrar" class="button" />

                                    <?php } ?>

                                   <a href="noticias.php"><input type="button" name="cancelar" value="Cancelar" class="button" /></a>
                                   
                                </p>

                            </fieldset>

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