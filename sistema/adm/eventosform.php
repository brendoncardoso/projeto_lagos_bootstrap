<?php
include('../includes/conecte.php');

include('../includes/restricao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$act = 1;
if (isset($_REQUEST['id'])) {

    $result = mysql_query("SELECT * FROM eventos WHERE id = '{$_REQUEST['id']}'");

    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);

        $id = $row['id'];
        $subtitulo = $row['subtitulo'];
        $nome_evento = $row['nome_evento'];
        $data = $row['data'];
        $nome_local = $row['nome_local'];
        $descricao = $row['descricao'];
        $programacao = $row['programacao'];
        $participantes = $row['participantes'];
        $inscricao = $row['inscricao'];
        $regulamento = $row['regulamento'];
        $data_ini = date("d/m/Y", strtotime($row['data']));
        $hora_ini = $row['hora_ini'];
        $hora_fim = $row['hora_fim'];
    } else {
        $_SESSION["message"] = "Erro ao tentar editar, tente mais tarde";
        header("Location: ../adm/eventos.php");
    }

} else {

    /*$id_editalnoticia_noticia = "";

    $id_noticia = "";

    $act = 2;

    $titulo = "";

    $subtitulo = "";

    $texto = "";

    $fonte = "";

    $link = "";

    $status_img = "";

    $tags = "";*/

    $id = "";
    $subtitulo = "";
    $nome_evento = "";
    $nome_local = "";
    $descricao = "";
    $programacao = "";
    $participantes = "";
    $inscricao = "";
    $regulamento = "";
    $data_ini = "";
    $hora_ini = "00:00";
    $hora_fim = "00:00";
    $act = 2;
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
        <script src="../resources/js/jquery.FCKEditor.js" type="text/javascript" ></script>


        <style>

            .ocultar{
                display: none!important;
            }
        </style>

        <script type="text/javascript">

            jQuery(document).ready(function($){            

                /*CKEDITOR.replace('fckExemplo',

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
                });*/

                $.fck.config = {path: 'fckeditor/'};
                $('textarea#descricao').fck({height:700, width:770});
                $('textarea#programacao').fck({height:700, width:770});
                $('textarea#participantes').fck({height:700, width:770});
                $('textarea#inscricao').fck({height:700, width:770});
                $('textarea#regulamento').fck({height:700, width:770});
            

                 $(".message").delay(5000).fadeOut("slow");

                /*$('.status_novo_assunto').on('click', function(){
                    var val = $(this).val();
                    if(val == 1){
                        $('.novo_assunto').prop("disabled", false);
                        $('.assuntos').prop("disabled", true);
                        $('.assuntos').attr('value', '');
                    }else{
                        $('.novo_assunto').prop("disabled", true);
                        $('.assuntos').prop("disabled", false);
                    }
                 });*/

                /*$('.excluir_img').on('click', function(){
                    var id_noticia = $(this).data('id_noticia');
                    if(confirm("Tem certeza que deseja Exluir a Imagem da notícia do id = "+ id_noticia +" ?")){
                        $.post('../actions/action.noticias.php', {id_noticia:id_noticia, method: "excluir_thumb"}, 
                        function(data) {
                            if(data){
                                window.location.href = "noticias.php";
                            }
                        },"json");
                    }
                });*/

                /*$('.cadastraredital').click(function(){
                    window.location = "editalnoticiaform.php";
                })

                $('.listaedital').click(function(){
                    window.location = "editalnoticia.php";
                })*/

                /*$('input[type=radio]').change(function() {
                    $('input[type=radio]:checked').not(this).prop('checked', false);
                });*/

                $('.maskdata').mask('99/99/9999');
                $('.hora').mask('99:99').attr('style','width: 50px;');
                $(".datepicker").datepicker({dateFormat:"dd/mm/yy"});


                $('.descricao').hide();
                $('.programacao').hide();
                $('.participantes').hide();
                $('.inscricao').hide();
                $('.regulamento').hide();

                var a = $('textarea#descricao').val();
                var b = $('textarea#programacao').val();
                var c = $('textarea#participantes').val();
                var d = $('textarea#inscricao').val();
                var e = $('textarea#regulamento').val();

                if(a == ''){
                    $('.descricao').hide();
                    
                }else{
                    $('.descricao').show();
                }

                if(b == ''){
                    $('.programacao').hide();
                }else{
                    $('.programacao').show();
                }

                if(c == ''){
                    $('.participantes').hide();
                }else{
                    $('.participantes').show();
                }

                if(d == ''){
                    $('.inscricao').hide();
                }else{
                    $('.inscricao').show();
                }

                if(e == ''){
                    $('.regulamento').hide();
                }else{
                    $('.regulamento').show();
                }

                $("input[name='descricao_radio'][value='1']").click(function(){
                    $('iframe#descricao___Frame').show();
                    $('.descricao').show();
                });
                
                $("input[name='descricao_radio'][value='2']").click(function(){
                    $('iframe#descricao___Frame').hide();
                    $('.descricao').hide();
                });

                $("input[name='programacao_radio'][value='1']").click(function(){
                    $('iframe#programacao___Frame').show();
                    $('.programacao').show();
                });
                
                $("input[name='programacao_radio'][value='2']").click(function(){
                    $('iframe#programacao___Frame').hide();
                    $('.programacao').hide();
                });

                $("input[name='participantes_radio'][value='1']").click(function(){
                    $('iframe#participantes___Frame').show();
                    $('.participantes').show();
                });
                
                $("input[name='participantes_radio'][value='2']").click(function(){
                    $('iframe#participantes___Frame').hide();
                    $('.participantes').hide();
                });

                $("input[name='inscricao_radio'][value='1']").click(function(){
                    $('iframe#inscricao___Frame').show();
                    $('.inscricao').show();
                });
                
                $("input[name='inscricao_radio'][value='2']").click(function(){
                    $('iframe#inscricao___Frame').hide();
                    $('.inscricao').hide();
                });

                $("input[name='regulamento_radio'][value='1']").click(function(){
                    $('iframe#regulamento___Frame').show();
                    $('.regulamento').show();
                });
                
                $("input[name='regulamento_radio'][value='2']").click(function(){
                    $('iframe#regulamento___Frame').hide();
                    $('.regulamento').hide();
                });
          
          
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



    <body>
        <div class="main">
            <div id="header">
                <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
            </nav>



            <section>
                <form name="" action="../actions/action.eventos.php" method="post" enctype="multipart/form-data" id="form1">
                    <div id="conteudo">
                        <div class="blocos">
                            <h3>Cadastro de Eventos</h3>
                            <!--<div id="novo" class="box-1">
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

                            <hr class="clear" />-->
                            
                            <?php if (isset($mensagem)) { ?> 
                               <div class='message'>
                                   <?php echo $mensagem; ?>
                               </div> 
                            <?php } ?>
                            
                            <fieldset>
                                <legend>Dados</legend>
                                <p><label class="first2">Título:</label>
                                <input type="text" name="nome_evento" id="nome_evento" value="<?php echo $nome_evento ?>" class="validate[required]" /></p>

                                <p><label class="first2">Subtítulo:</label>
                                <input type="text" name="subtitulo" id="subtitulo" value="<?php echo $subtitulo ?>" class="validate[required]" /></p>
                                
                                <p><label class="first2" for="">Data e Hora: </label>
                                <!--<input type="text" name="data_ini" id="data_ini" value="" class="validate[required,custom[dateBr]] datepicker maskdata hasDatepicker"></p>-->
                                <input type="text" name="data_ini" id="data_ini" value="<?php echo $data_ini ?>" class="validate[required,custom[dateBr]] datepicker maskdata" /> 
                                <input type="text" name="hora_ini" id="hora_ini" value="<?php echo $hora_ini ?>" class="hora" /> às <input type="text" name="hora_fim" id="hora_fim" value="<?php echo $hora_fim ?>" class="hora" /> </p>
                                <!--<p><label class="first2">Nome do Local:</label>
                                <input type="text" name="nome_local" id="nome_local" value="" />  &nbsp; </p>-->
                                <p><label class="first2">Local:</label>
                                <input type="text" name="nome_local" id="nome_local" value="<?php echo $nome_local?>" />  &nbsp; </p>

                                <p><label class="first2 ">Adicionar Descrição? </label>
                                    <input class="" type="radio" name="descricao_radio" value="1" <?= isset($_REQUEST['id']) && !empty($descricao) ? 'checked' : ''?>> Sim &nbsp; 
                                    <input class="" type="radio" name="descricao_radio" value="2" <?= isset($_REQUEST['id']) && empty($descricao) || !isset($_REQUEST['id']) && empty($descricao) ? 'checked' : ''?>> Não &nbsp; 
                                </p>

                                <p class="descricao"><label class="first2 ">Descrição:</label>
                                <textarea name="descricao" id="descricao" rows="12" cols="52"><?php echo $descricao; ?></textarea></p>

                                <p><label class="first2">Adicionar Programação? </label>
                                    <input class="" type="radio" name="programacao_radio" value="1" <?= isset($_REQUEST['id']) && !empty($programacao) ? 'checked' : ''?>> Sim &nbsp; 
                                    <input class="" type="radio" name="programacao_radio" value="2" <?= isset($_REQUEST['id']) && empty($programacao) || !isset($_REQUEST['id']) && empty($programacao) ? 'checked' : ''?>> Não &nbsp; 
                                </p>
                                <p class="programacao"><label class="first2 ">Programação:</label>
                                <textarea name="programacao" id="programacao" rows="12" cols="52"><?php echo $programacao; ?></textarea></p>

                                <p><label class="first2">Adicionar Participantes? </label>
                                    <input class="" type="radio" name="participantes_radio" value="1" <?= isset($_REQUEST['id']) && !empty($participantes) ? 'checked' : ''?>> Sim &nbsp; 
                                    <input class="" type="radio" name="participantes_radio" value="2" <?= isset($_REQUEST['id']) && empty($participantes) || !isset($_REQUEST['id']) && empty($participantes) ? 'checked' : ''?>> Não &nbsp; 
                                </p>
                                <p class="participantes"><label class="first2 ">Participantes:</label>
                                <textarea name="participantes" id="participantes" rows="12" cols="52"><?php echo $participantes; ?></textarea></p>

                                <p><label class="first2">Adicionar Inscrição? </label>
                                    <input class="" type="radio" name="inscricao_radio" value="1" <?= isset($_REQUEST['id']) && !empty($inscricao) ? 'checked' : ''?>> Sim &nbsp; 
                                    <input class="" type="radio" name="inscricao_radio" value="2" <?= isset($_REQUEST['id']) && empty($inscricao) || !isset($_REQUEST['id']) && empty($inscricao) ? 'checked' : ''?>> Não &nbsp; 
                                </p>
                                <p class="inscricao"><label class="first2 ">Inscrição:</label>
                                <textarea name="inscricao" id="inscricao" rows="12" cols="52"><?php echo $inscricao; ?></textarea></p>

                                <p><label class="first2">Adicionar Regulamento? </label>
                                    <input class="" type="radio" name="regulamento_radio" value="1" <?= isset($_REQUEST['id']) && !empty($regulamento) ? 'checked' : ''?>> Sim &nbsp; 
                                    <input class="" type="radio" name="regulamento_radio" value="2" <?= isset($_REQUEST['id']) && empty($regulamento) || !isset($_REQUEST['id']) && empty($regulamento) ? 'checked' : ''?>> Não &nbsp; 
                                </p>
                                <p class="regulamento"><label class="first2 ">Regulamento:</label>
                                <textarea name="regulamento" id="regulamento" rows="12" cols="52"><?php echo $regulamento; ?></textarea></p>
                               
                                <!--<p>
                                        
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
                                </p>-->

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

                                <!--<p><label class="first2">Texto:</label><textarea name="fckExemplo" id="fckExemplo"><?php echo $texto ?></textarea></p>-->

                                <!--<p>
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
                                </p>-->

                                <!--<p>
                                    <label class="first2">Tags:</label>
                                    <input type="text" name="tag" id="tag" value="<?php echo $tags; ?>" />
                                    <small>
                                        <i>
                                            <b>Exemplo:</b> Tag1, Tag2, Tag3 ...
                                        </i>
                                    </small>
                                </p>--> 
                                <!--<p><label class="first2">Fonte:</label><input type="text" name="fonte" id="fonte" value="<?php echo $fonte ?>" /></p>-->
                                <!--<p><label class="first2">Link:</label><input type="text" name="link" id="link" value="<?php echo $link ?>" /></p>-->

                                <p class="controls"> 
                                    <?php if ($act == 1) { ?>
                                        <input type="submit" name="enviar" value="Salvar" class="button" />
                                        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
                                    <?php } else { ?>
                                        <input type="submit" name="enviar" value="Cadastrar" class="button" />
                                    <?php } ?>
                                   <a href="eventos.php"><input type="button" name="cancelar" value="Cancelar" class="button" /></a>
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