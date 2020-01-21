<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');
    $id_pasta = $_REQUEST['id_pasta'];
    $id_unidade = $_REQUEST['id_unidade'];

    $sql_abrir = mysql_query("SELECT A.id, A.id_pasta, D.nome, A.id_unidade, C.nome AS nome_unidade, id_empresa, nome_empresa, COUNT(arquivo) AS quantidade_arquivos
    FROM prestacao_categoria3 AS A
    INNER JOIN empresas_prestador AS B ON (A.id_empresa = B.id)
    INNER JOIN unidades AS C ON (A.id_unidade = C.id_unidade)
    INNER JOIN pasta AS D ON (A.id_pasta = D.id)
    WHERE A.id_pasta = $id_pasta AND A.id_unidade = $id_unidade GROUP BY id_empresa");

    $sql_abrir_rows = mysql_num_rows($sql_abrir);


    $sql_upa = mysql_query("SELECT DISTINCT C.nome AS upa FROM prestacao_categoria3 AS A
    INNER JOIN empresas_prestador AS B ON (A.id_empresa = B.id)
    INNER JOIN unidades AS C ON (A.id_unidade = C.id_unidade)
    WHERE A.id_pasta = $id_pasta AND A.id_unidade = $id_unidade;");

?>

<script>
    $(document).ready(function(){
        $('.excluir_empresa_categoria3').on('click', function(){
            var id = $(this).data('id');
            var id_unidade = $(this).data('id_unidade');
            var id_pasta = $(this).data('id_pasta');
            var id_empresa = $(this).data('id_empresa')
            if(confirm("Tem certeza que deseja Excluir a Empresa dessa pasta?")){
                $.post('../actions/action.prestacaocontas.php', {id:id, id_unidade:id_unidade, id_pasta:id_pasta, id_empresa: id_empresa, method: "excluir_empresa_categoria3"}, 
                function(data) {
                    if(data){
                        window.location.href = "categoria.php";
                    }
                },"json");
            }
        })
    });
</script>
<?php if (isset($sql_abrir_rows) && $sql_abrir_rows > 0) { ?>
    <form name="" action="" method="post" enctype="multipart/form-data" id="form1">
        <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
            <thead>
                <?php while($row = mysql_fetch_assoc($sql_upa)) { ?>
                    <tr>
                        <th colspan="4"><?php echo mb_strtoupper($row['upa'])?></th>
                    </tr>
                <?php } ?>

                <tr>
                    <th>ID_EMPRESA</th>
                    <th hidden>Nome da Unidade(ID)</th>
                    <th>Empresas</th>
                    <th>Quantidade de Arquivos</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                <?php while ($row = mysql_fetch_assoc($sql_abrir)) { ?>
                    <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                    <tr class="<?php echo $class; ?>">
                        <td class="center"><?php echo $row['id_empresa']; ?></td>
                        <input type="hidden" name="pegar_id_pasta" value="<?php echo $row['id_pasta']?>">
                        <input type="hidden" name="pegar_id_unidade" value="<?php echo $row['id_unidade']?>">
                        <td class="center"><?php echo $row['nome_empresa']; ?></td>
                        <td class="center"><?php echo $row['quantidade_arquivos']?></td>
                        <td class="center">
                            <button type="button" name="empresa" data-id_empresa="<?php echo $row['id_empresa']; ?>" class="button abrirEmpresa button_center">Abrir</button>
                            <input type="submit" class="excluir_empresa_categoria3 button button_a button_center" value="Excluir" data-id_empresa="<?php echo $row['id_empresa']; ?>" data-id="<?php echo $row['id']?>" data-id_unidade="<?php echo $id_unidade; ?>" data-id_pasta="<?php echo $id_pasta?>">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
<?php } ?>