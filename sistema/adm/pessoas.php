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
                $("#upa").change(function(){
                    $('#nivel').val("-1");
                    $('#cargo').html("");
                });

                $('#cadastrar_estado').click(function(){
                    window.location.href= "estadosform.php";
                });

                $('#lista_estado').click(function(){
                    window.location.href= "estados.php";
                });

                $('#nivel').change(function(){
                    var edital = $("#edital").val();
                    var nivel_id = $(this).val();
                    $.ajax({
                        url: '../actions/action.cargos.php?method=pessoa&nivel='+nivel_id+'&edital='+edital,
                        success: function(resposta){
                            $('#cargo').html(resposta);
                        }
                    });
                });
                
                $('#busca').click(function(){
                    /*$('#pesquisa').html('<div style="width:100%; text-align:center;"><img src="../resources/images/loader.gif"/></div>');*/
                    var nivel = $('#nivel').val();
                    var estado = $('#estado').val();
                    var edital = $('#edital').val();
                    var cargo = $('#cargo').val();
                    var pagina = $('#pagina').val();
                    var defi = $('#defi').val();
                    $.post("../actions/action.pessoa.php",
                            {nivel:nivel, edital:edital, cargo:cargo,pagina:pagina,deficiente:defi, estado: estado},
                            function(resposta){
                                $('#pesquisa').html(resposta);
                            },"html");	
                });
                
                $("#pesquisa").on("click", ".icon-excluir", function(){
                    var nome = $(this).parent().parent().children("td:first").html();
                    var id = $(this).attr("data-key");
                    if(confirm('Excluir o currículo do(a) '+nome)){
                        $.post('../actions/action.pessoa.php', 
                        {pessoa:id, method:"exclui"} ,
                        function(data) {
                            if(data){
                                $('#busca').trigger("click");
                            }
                        },"json");
                    }
                    return false;
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
                        <h2>Currículos</h2>

                        <input type="hidden" name="id" id="id" value="" />
                        <div id="cadastrar_estado" class="box-1 " style="margin-bottom: 10px!important">
                            <div class="box-image center" >
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Cadastrar Estado</p>
                            </div>
                        </div>

                        <div id="lista_estado" class="box-1 " style="margin-bottom: 10px!important">
                            <div class="box-image center" >
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Lista de Estado</p>
                            </div>
                        </div>
                            
                        <hr class="clear"/>

                        <fieldset>
                            <legend>Busca</legend>
                            <p>
                                <label class="first">Edital:</label>
                                <select name="edital" id="edital" style="width: 300px;">
                                    <option value="-1"> « Selecione » </option>
                                    <?php
                                    $qr_edital = mysql_query("SELECT A.id_editalpessoal,A.num_edital,B.nome FROM editalpessoal AS A
                                                            INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                                            WHERE A.`status` = 1");
                                    while ($rowEdital = mysql_fetch_assoc($qr_edital)){?>
                                        <option value="<?php echo $rowEdital['id_editalpessoal']; ?>"><?php echo $rowEdital['num_edital']." - ".$rowEdital['nome']; ?> </option>
                                    <?php } ?>

                                </select>
                            </p>

                            <p>
                                <label class="first">Estados:</label>
                                <select name="estado" id="estado" style="width: 300px;">
                                    <option value="-1"> « Selecione » </option>
                                        <?php
                                           $qr_estados = mysql_query("SELECT * FROM estados");
                                           while ($row_estado = mysql_fetch_assoc($qr_estados)):
                                               ?>
                                               <option value="<?php echo $row_estado['id']; ?>"><?php echo $row_estado['sigla']?> - <?php echo $row_estado['estado']; ?></option>
                                               <?php
                                           endwhile;
                                        ?>
                                </select>
                            </p>

                            <p>
                                <label class="first">Nível:</label>
                                <select name="nivel" id="nivel">
                                    <option value="-1"> « Selecione » </option>
                                    <?php
                                    $qr_nivel = mysql_query("SELECT * FROM niveis");
                                    while ($row_nivel = mysql_fetch_assoc($qr_nivel)):
                                        ?>
                                        <option value="<?php echo $row_nivel['id_nivel']; ?>"><?php echo $row_nivel['nome']; ?></option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>
                            </p>
                            <p><label class="first">Cargo:</label> <select name="cargo" id="cargo"></select></p>
                            <p>
                                <label class="first">Deficiente?</label>
                                <select name="defi" id="defi">
                                    <option value="-1"> TODOS </option>
                                    <option value="1"> SIM </option>
                                    <option value="0"> NÃO </option>
                                </select>
                            </p>
                            <p class="controls">
                                <input type="hidden" name="uf" id="uf" value="<?php echo $uf; ?>">
                                <input type="hidden" name="pagina" id="pagina" value="1">
                                <input type="button" name="buscar" value="BUSCAR" id="busca" class="button" />
                            </p>
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
