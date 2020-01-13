<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if(isset($_SESSION['message'])){
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

function prorrogacao($id){
    $rs_prorro = mysql_query("SELECT date_format(data_fim,'%d/%m/%Y - %H:%i')as data FROM edital_prorrogacoes WHERE id_pessoal = '{$id}' ORDER BY data_fim DESC LIMIT 1");
    $prorro = mysql_fetch_assoc($rs_prorro);
    return $prorro['data'];
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
                    window.location = 'editalpessoalform.php';
                });
                $(".message").delay(5000).fadeOut("slow");
                $(".icon-editar").click(function(){
                    $("#id").val($(this).attr("data-key"));
                    $("#formEdit").submit();
                });
                $(".icon-excluir").click(function(){
                    var id = $(this).attr("data-key");
                    if(confirm('Atenção, essa ação é irreversível, deseja realmente excluir esse Edital?')){
                        $.post('../actions/action.editalpessoal.php', {edital:id, method:"exclui"} ,function(data) {
                            if(data){
                                window.location = "editalpessoal.php";
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
                        <h2>Editais de Pessoal</h2>

                        <div id="novoEdital" class="box-1">
                            <div class="box-image center">
                                <a hraf="javascript:;" class="icon-grande icon-novo-grande">&nbsp;</a>
                                <p class="center">Novo Edital</p>
                            </div>
                        </div>
                        <form method="post" action="editalpessoalform.php" id="formEdit">
                            <input type="hidden" name="id" id="id" value="" />
                        </form>
                        <hr class="clear"/>
                        
                        <?php if(isset($mensagem)) echo "<div class='message'>{$mensagem}</div>"; ?>
                        
                        <h3>Editais Abertos</h3>
                        
                        <?php
                        $abertos = mysql_query("SELECT 
                                                    A.id_editalpessoal,
                                                    A.num_edital,
                                                    A.num_proc_adm,
                                                    B.nome,
                                                    date_format(A.data_ini,'%d/%m/%Y - %H:%i') AS data_ini,
                                                    date_format(A.data_fim,'%d/%m/%Y - %H:%i') AS data_fim,
                                                    prorrogado
                                                FROM editalpessoal AS A
                                                INNER JOIN unidades AS B ON (A.id_unidade=B.id_unidade)
                                                WHERE A.status=1 ORDER BY data_ini DESC");
                        if (mysql_num_rows($abertos) == 0) {
                            echo "<h4>Nenhum edital aberto</h4>";
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>Cod.</th>
                                    <th>Nª Edital</th>
                                    <th>Nª Proc. Adm.</th>
                                    <th>Unidade</th>
                                    <th>Inicio Em</th>
                                    <th>Encerramento Em</th>
                                    <th colspan="2">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($row_ab = mysql_fetch_assoc($abertos)) {
                                    $class = (($i++ % 2) == 0) ? "even" : "odd";
                                    ?>
                                    <tr class="<?php echo $class ?>">
                                        <td class="center"><?php echo $row_ab['id_editalpessoal'] ?></td>
                                        <td><?php echo $row_ab['num_edital'] ?></td>
                                        <td><?php echo $row_ab['num_proc_adm'] ?></td>
                                        <td><?php echo $row_ab['nome'] ?></td>
                                        <td><?php echo $row_ab['data_ini'] ?></td>
                                        <td><?php if($row_ab['prorrogado'] == 0){ echo $row_ab['data_fim']; }else{ echo prorrogacao($row_ab['id_editalpessoal']); } ?></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row_ab['id_editalpessoal'] ?>" >&nbsp;</a></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row_ab['id_editalpessoal'] ?>" >&nbsp;</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        
                        <br/>
                        <hr />
                        
                        <h3>Editais encerrados</h3>
                        <?php
                        $encerrado = mysql_query("SELECT 
                                                    A.id_editalpessoal,
                                                    A.num_edital,
                                                    A.num_proc_adm,
                                                    B.nome,
                                                    date_format(A.data_ini,'%d/%m/%Y - %H:%i') AS data_ini,
                                                    date_format(A.data_fim,'%d/%m/%Y - %H:%i') AS data_fim,
                                                    prorrogado
                                                FROM editalpessoal AS A
                                                INNER JOIN unidades AS B ON (A.id_unidade=B.id_unidade)
                                                WHERE A.status=2 ORDER BY data_ini DESC");
                        if (mysql_num_rows($encerrado) == 0) {
                            echo "<h4>Nenhum edital encerrado</h4>";
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>Cod.</th>
                                    <th>Nª Edital</th>
                                    <th>Nª Proc. Adm.</th>
                                    <th>Unidade</th>
                                    <th>Inicio Em</th>
                                    <th>Encerramento Em</th>
                                    <th colspan="2">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($row_fc = mysql_fetch_assoc($encerrado)) {
                                    $class = (($i++ % 2) == 0) ? "even" : "odd";
                                    ?>
                                    <tr class="<?php echo $class ?>">
                                        <td class="center"><?php echo $row_fc['id_editalpessoal'] ?></td>
                                        <td><?php echo $row_fc['num_edital'] ?></td>
                                        <td><?php echo $row_fc['num_proc_adm'] ?></td>
                                        <td><?php echo $row_fc['nome'] ?></td>
                                        <td><?php echo $row_fc['data_ini'] ?></td>
                                        <td><?php echo $row_fc['data_fim'] ?></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-editar" title="Editar" data-key="<?php echo $row_fc['id_editalpessoal'] ?>" >&nbsp;</a></td>
                                        <td class="center"><a href="javascript:;" class="icon icon-excluir" title="Excluir" data-key="<?php echo $row_fc['id_editalpessoal'] ?>" >&nbsp;</a></td>
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