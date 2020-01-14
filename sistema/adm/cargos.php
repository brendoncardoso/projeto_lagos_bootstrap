<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$pagina = "";

$qr_cargos = mysql_query("SELECT id_cargo,cargo,nome 
                            FROM cargos AS A
                            INNER JOIN niveis  AS B ON(B.id_nivel=A.id_nivel)
                            ORDER BY A.cargo");
$qr_unidades = mysql_query("SELECT * FROM unidades");
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
                    window.location = 'cargosform.php';
                });
                $(".message").delay(5000).fadeOut("slow");
                $(".icon-editar").click(function(){
                    $("#id").val($(this).attr("data-key"));
                    $("#form1").attr("action","cargosform.php");
                    $("#form1").submit();
                });
                $("#retorno").on("click",".icon-excluir",function(){
                    var id = $(this).attr("data-key");
                    var unida = $("#unidade").val();
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente remover esse Cargo da Unidade selecionada?')){
                        $.post('../actions/action.cargos.php', {cargo:id, unidade: unida, method:"delAssoc"} ,function(data) {
                            if(data){
                                window.location = "cargos.php";
                            }
                        },"json");
                    }
                });
                $("#busca").click(function(){
                    var selected = $("#unidade").val();
                    if(selected != "-1"){
                        $.post('../actions/action.cargos.php', {unidade:selected, method:"listar"} ,function(data) {
                            if(data){
                                $("#retorno").html(data);
                            }
                        },"html");
                    }
                });
                $("#bt-vercargos").click(function(){
                    if ($("#verCargos").is(".hidden"))
                        $("#verCargos").removeClass("hidden");
                    else
                        $("#verCargos").addClass("hidden");
                    
                });
            });
            
            var cargoUnidade = function(unidade){
                $("#relacionar").val(unidade);
                $("#form1").attr("action","cargosform.php");
                $("#form1").submit();
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
                <form method="post" action="" name="form1" id="form1">
                    <input type="hidden" name="id" id="id" value="" />
                    <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>" />
                    <input type="hidden" name="relacionar" id="relacionar" value="" />

                    <div id="conteudo">
                        <div class="blocos">
                            <?php if (isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>
                            <h2>Associação de Cargos a Unidades</h2>

                            <fieldset class="clear">
                                <legend>Filtro</legend>
                                <p>
                                    <label class="first">Unidade:</label><select name="unidade" id="unidade" style="width: 400px;">
                                        <option value="-1">« Selecione »</option>
                                        <?php while ($row_unidade = mysql_fetch_assoc($qr_unidades)) { ?>
                                            <option value="<?php echo $row_unidade['id_unidade']; ?>"><?php echo $row_unidade['uf']; ?> - <?php echo $row_unidade['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                                <p class="controls">
                                    <input type="button" name="buscar" value="BUSCAR" id="busca" class="button" />
                                </p>
                            </fieldset>
                            <br/>
                            <div id="retorno">

                            </div>
                            <br/>
                            <hr />
                        </div>
                        <div class="blocos">
                            <h2>Cargos</h2>

                            <div id="novo" class="box-1">
                                <div class="box-image center">
                                    <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                    <p class="center">Novo Cargo</p>
                                </div>
                            </div>

                            <hr class="clear"/>

                            <?php
                            if (mysql_num_rows($qr_cargos) == 0) {
                                echo "<h4>Nenhum cargo encontrado</h4>";
                            } else {
                                ?>
                                <p><a href="javascript:;" id="bt-vercargos">Visualizar/Esconder cargos</a></p>
                                <div id="verCargos" class="hidden">
                                    <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                        <thead>
                                            <tr>
                                                <th>Nível</th>
                                                <th>Cargo</th>
                                                <th colspan="2">AÇÃO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = mysql_fetch_assoc($qr_cargos)) {
                                                $class = (($i++ % 2) == 0) ? "even" : "odd";
                                                ?>
                                                <tr class="<?php echo $class ?>">
                                                    <td><?php echo $row['nome'] ?></td>
                                                    <td><?php echo $row['cargo'] ?></td>
                                                    <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row['id_cargo'] ?>" >&nbsp;</a></td>
                                                    <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row['id_cargo'] ?>" >&nbsp;</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
