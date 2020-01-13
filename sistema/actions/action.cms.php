<?php
    include('../includes/conecte.php');
    $pagina = $_REQUEST['pagina'];
?>



<script src="../adm/ckeditor/ckeditor.js" type="text/javascript"></script>

<style>
    .removeLineHeight{
        line-height: 10px!important;
    }

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
</style>

<div class="conteudo">
    <div class="blocos">
        <div class="col-sm-12">
            <?php if ($pagina == 1) { ?>
                <script type="text/javascript">
                    $(function(){
                        $('#enviar1').click(function(){
                    
                            var campanhas_saude = $("input[name='campanhas_saude']:checked").val();
                            
                            $.ajax({
                                url: '../actions/cms_logo/insertLogo.php?campanhas_saude='+campanhas_saude,
                                data: {campanhas_saude: campanhas_saude},
                                success: function(data){
                                   window.location.href="cms.php"
                                }, 
                                error: function(){
                                    alert("ERROR");
                                }
                            });
                                                    
                        });
                    });
                </script>
                <fieldset>
                    <form action="#" method="post">
                        <h3>Home: </h3>
                        <h4 style="margin-left: 72px;">Logo:</h4>
                    <div class="grid-container">
                            <?php
                                $sql = mysql_query("SELECT id_logo FROM cms_logo");
                                $row = mysql_fetch_assoc($sql);
                                $logo = $row['id_logo'];
                            ?>
                            <div class="logo">
                                <img src="../../assets/images/0.png" alt="" width="100px;">
                                <p class="text-center"><input id="campanha" type="radio" name="campanhas_saude" value="0" <?= $logo == '0' ? 'checked' : '' ;?>> Normal</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/1.png" alt="" width="100px;">
                                <p class="text-center"><input id="campanha" type="radio" name="campanhas_saude" value="1" <?= $logo == '1' ? 'checked' : '' ;?> > Branco</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/2.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="2" <?= $logo == '2' ? 'checked' : '' ;?>> Roxo/Laranja</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/3.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="3" <?= $logo == '3' ? 'checked' : '' ;?>> Azul</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/4.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="4" <?= $logo == '4' ? 'checked' : '' ;?>> Verde/Azul</p>
                            </div>

                            <!--<div class="logo">
                                <img src="../../assets/images/5.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="5" <?= $logo == '5' ? 'checked' : '' ;?>> Amarelo</p>
                            </div>-->

                            <div class="logo">
                                <img src="../../assets/images/6.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="6" <?= $logo == '6' ? 'checked' : '' ;?>> Vermelho/laranja</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/7.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="7" <?= $logo == '7' ? 'checked' : '' ;?>> Amarelo</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/8.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="8" <?= $logo == '8' ? 'checked' : '' ;?>> Dourado</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/14.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="14" <?= $logo == '14' ? 'checked' : '' ;?>> Verde</p>
                            </div>
                            
                            <div class="logo">
                                <img src="../../assets/images/10.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="10" <?= $logo == '10' ? 'checked' : '' ;?>> Rosa</p>
                            </div>

                            <!--<div class="logo">
                                <img src="../../assets/images/11.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="11" <?= $logo == '11' ? 'checked' : '' ;?>> Azul</p>
                            </div>-->

                            <div class="logo">
                                <img src="../../assets/images/12.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="12" <?= $logo == '12' ? 'checked' : '' ;?>> Vermelho</p>
                            </div>

                            <div class="logo">
                                <img src="../../assets/images/13.png" alt="" width="100px;">
                                <p class="text-center"><input class="campanha" type="radio" name="campanhas_saude" value="13" <?= $logo == '13' ? 'checked' : '' ;?>> Preto</p>
                            </div>
                        
                        <br>
                    </div>
                    <p class="controls"> 
                        <input id="enviar1" type="submit" name="enviar" value="SALVAR" class="button">
                    </p>
                </form>                    
                </fieldset>
        </div>
        <?php } else if ($pagina == 2) { ?>
            <script type="text/javascript">
                $(function(){
                    $('.icon').click(function(){
                        var valor = $(this).data('value');
                        if(confirm("Deseja realmente excluir essa imagem de Slide?")){
                            $.ajax({
                                url: '../actions/cms_slides/deleteslide.php',
                                data: {valor: valor},
                                success: function(url){
                                    window.location.href="cms.php";
                                }
                            });
                        }else{
                            return false;
                        }
                    });
                });
            </script>
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
                                <td class="center"><a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank"><button class="button text-center button_center">VISUALIZAR</button></a></td>
                                <!--<td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-value="1" >&nbsp;</a></td>-->
                                <td class="center"><button class="button text-center button_center icon" data-value="1">EXCLUIR</button></td>

                            <?php } else { ?>
                                <td class="center" colspan='2'><a href="../adm/inserirSlide.php?imagem=1" ><button id="imagem1" class="button text-center button_center" name="imagem">INSERIR</button></a></td>
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
                                <td class="center"><a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank"><button class="button text-center button_center">VISUALIZAR</button></a></td>
                                <!--<td class="center"><a class="icon icon-excluir" title="Excluir" data-value="2" >&nbsp;</a></td>-->
                                <td class="center"><button class="button text-center button_center icon" data-value="2">EXCLUIR</button></td>
                            <?php } else { ?>
                                <td class="center" colspan='2'><a href="../adm/inserirSlide.php?imagem=2" ><button id="imagem2" class="button text-center button_center" name="imagem">INSERIR</button></a></td>
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
                                <td class="center"><a href="../adm/cms_slides/<?php echo $id_img;?>.<?php echo $val['extensao']; ?>" target="_blank"><button class="button text-center button_center">VISUALIZAR</button></a></td>
                                <!--<td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-value="3" >&nbsp;</a></td>-->
                                <td class="center"><button class="button text-center button_center icon" data-value="3">EXCLUIR</button></td>
                            <?php } else { ?>
                                <td class="center" colspan='2'><a href="../adm/inserirSlide.php?imagem=3"><button id="imagem3" class="button text-center button_center" name="imagem">INSERIR</button></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else if ($pagina == 3) { ?>
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

                <fieldset>
                    <legend>Dados: </legend>
                    <p>
                        <label class="first2">Texto:</label>
                        <textarea class="BreveHistoria" name="BreveHistoria" ><?php echo $texto_historia; ?></textarea>
                    </p>
                    <input type="submit" value="Salvar" class="button" />
                </fieldset>

            </form>
            <?php ?>
        <?php } ?>
    </div>
</div>