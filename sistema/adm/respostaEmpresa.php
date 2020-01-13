<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    $id_pasta = $_REQUEST['id_pasta'];
    $id_unidade = $_REQUEST['id_unidade'];
    $id_empresa = $_REQUEST['id_empresa'];

    $sql_abrir_empresa = mysql_query("SELECT *
    FROM prestacao_categoria3
    WHERE id_pasta = $id_pasta AND id_unidade = $id_unidade AND id_empresa = $id_empresa;");
    

    $sql_upa = mysql_query("SELECT DISTINCT C.nome AS upa , B.nome_empresa
    FROM prestacao_categoria3 AS A
    INNER JOIN empresas_prestador AS B ON (A.id_empresa = B.id)
    INNER JOIN unidades AS C ON (A.id_unidade = C.id_unidade)
    WHERE A.id_pasta = id_pasta AND A.id_unidade = $id_unidade AND A.id_empresa = $id_empresa;");

    $sql_abrir_empresa_rows = mysql_num_rows($sql_abrir_empresa);
?>

<?php if (isset($sql_abrir_empresa_rows) && $sql_abrir_empresa_rows > 0) { ?>
    <form name="" action="" method="post" enctype="multipart/form-data" id="form1">
        <table width="100%" class="grid mt-5" cellspacing="0" cellpadding="0" border="0">
            <thead>
                <?php while($row = mysql_fetch_assoc($sql_upa)) { ?>
                    <tr>
                        <th colspan="4"><?php echo mb_strtoupper($row['upa'])?> - <?php echo $row['nome_empresa']?></th>
                    </tr>
                <?php } ?>

                <tr>
                    <th>ID</th>
                    <th hidden>Nome da Unidade(ID)</th>
                    <th>Nome do Arquivo</th>
                    <th>Arquivo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                <?php while ($row = mysql_fetch_assoc($sql_abrir_empresa)) { ?>
                    <?php $class = (($i++ % 2) == 0) ? "even" : "odd"; ?>
                    <tr class="<?php echo $class; ?>">
                        <td class="center"><?php echo $row['id']; ?></td>
                        <td class="center"><?php echo $row['nome_arquivo']; ?></td>
                        <td class="center">
                            <a href="atas_documentos/<?= $row['id']."_".$id_pasta."_".$id_unidade."_".$id_empresa;?>.pdf" target="_blank"><?php echo $row['arquivo']?></a>
                        </td>
                        <td>
                            <a type="submit" href="deletearquivo3.php?id=<?php echo $row['id']?>&&id_unidade=<?php echo $id_unidade; ?>&&id_pasta=<?php echo $id_pasta?>&&id_empresa=<?php echo $id_empresa; ?>" class="button">Excluir</a>
                            <a href="atas_documentos/<?= $row['id']."_".$id_pasta."_".$id_unidade."_".$id_empresa;?>.pdf" target="_blank">
                                <button type="button" name="" data-empresa="<?php echo $row['id_empresa']; ?>" class="button">Abrir</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
<?php } ?>
