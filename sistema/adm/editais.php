<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if(isset($_SESSION['message'])){
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <title>Administração de Candidatos</title>
        <script>
            $(function(){
                $("#novoEdital").click(function(){
                    window.location = 'editalform.php';
                });
                $(".message").delay(5000).fadeOut("slow");
                $(".icon-editar").click(function(){
                    $("#id").val($(this).data("key"));
                    $("#formEdit").submit();
                });
                $(".icon-excluir").click(function(){
                    var id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir esse Edital?')){
                        $.post('../actions/action.edital.php', {compra:id, method:"exclui"} ,function(data) {
                            if(data){
                                window.location = "editais.php";
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
                <div id="conteudo">
                    <div class="blocos">
                        <h2>Edital de Compras</h2>

                        <div id="novoEdital" class="box-1">
                            <div class="box-image center">
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Novo Edital</p>
                            </div>
                        </div>
                        <form method="post" action="editalform.php" id="formEdit">
                            <input type="hidden" name="id" id="id" value="" />
                        </form>
                        <hr class="clear"/>
                        
                        <?php if(isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>
                        
                        <h3>Editais Abertos</h3>
                        
                        <?php
                        $abertos = mysql_query("SELECT A.id_compra,A.numero,B.nome,date_format(data_ini, \"%d/%m/%Y %H:%i\") AS dt_ini,date_format(data_fim, \"%d/%m/%Y %H:%i\") AS dt_fim FROM compras AS A
                                                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                                    WHERE A.status=1 ORDER BY A.id_compra DESC");
                        if (mysql_num_rows($abertos) == 0) {
                            echo "<h4>Nenhum edital aberto</h4>";
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>Nº EDITAL</th>
                                    <th>Unidade</th>
                                    <th>Data de Inicio</th>
                                    <th>Data de Encerramento</th>
                                    <th colspan="2">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($dados_editab = mysql_fetch_assoc($abertos)) {
                                    $class = (($i++ % 2) == 0) ? "even" : "odd";
                                    ?>
                                    <tr class="<?php echo $class ?>">
                                        <td><?php echo $dados_editab['numero'] ?></td>
                                        <td><?php echo $dados_editab['nome'] ?></td>
                                        <td><?php echo $dados_editab['dt_ini'] ?></td>
                                        <td><?php echo $dados_editab['dt_fim'] ?></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $dados_editab['id_compra'] ?>" >&nbsp;</a></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $dados_editab['id_compra'] ?>" >&nbsp;</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        
                        <br/>
                        <hr />
                        
                        <h3>Editais encerrados</h3>
                        <?php
                        $encerrado = mysql_query("SELECT A.id_compra,A.numero,B.nome,date_format(data_ini, \"%d/%m/%Y %H:%i\") AS dt_ini,date_format(data_fim, \"%d/%m/%Y %H:%i\") AS dt_fim FROM compras AS A
                                                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                                    WHERE A.status=2 ORDER BY A.id_compra DESC");
                        if (mysql_num_rows($encerrado) == 0) {
                            echo "<h4>Nenhum edital encerrado</h4>";
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>Nº EDITAL</th>
                                    <th>Unidade</th>
                                    <th>Data de Inicio</th>
                                    <th>Data de Encerramento</th>
                                    <th colspan="2">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($dados_editab = mysql_fetch_assoc($encerrado)) {
                                    $class = (($i++ % 2) == 0) ? "even" : "odd";
                                    ?>
                                    <tr class="<?php echo $class ?>">
                                        <td><?php echo $dados_editab['numero'] ?></td>
                                        <td><?php echo $dados_editab['nome'] ?></td>
                                        <td><?php echo $dados_editab['dt_ini'] ?></td>
                                        <td><?php echo $dados_editab['dt_fim'] ?></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $dados_editab['id_compra'] ?>" >&nbsp;</a></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $dados_editab['id_compra'] ?>" >&nbsp;</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        
                    </div>
                </div>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>

    </body>
</html>
