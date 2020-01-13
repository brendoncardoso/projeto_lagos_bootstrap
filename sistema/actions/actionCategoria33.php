<?php
include("../includes/conecte.php");
session_start();

    $sql = mysql_query("SELECT A.id, A.id_pasta, A.id_unidade, A.id_empresa, B.nome_empresa, A.nome_arquivo
    FROM prestacao_categoria3 AS A
    INNER JOIN empresas_prestador AS B ON (A.id_empresa = B.id)
    WHERE A.id_pasta = '{$_REQUEST['id_pasta']}' AND A.id_unidade = '{$_REQUEST['id_unidade']}' AND A.id_empresa = '{$_REQUEST['id_empresa']}'");
    
    while($row = mysql_fetch_assoc($sql)){
        $arrTeste2[$row['id']][$row['id_unidade']][$row['id_empresa']] = [
            "nome_arquivo" => $row['nome_arquivo']
        ];
    }
?>

<?php foreach($arrTeste2 AS $id => $rows1) { ?>
    <?php foreach($rows1 AS $id_unidade => $rows2) { ?>
        <?php foreach($rows2 AS $id_empresa => $values) { ?>
            <li class="lista_css" style="margin-left: 60px;">
                <a href="sistema/adm/atas_documentos/<?= $id.'_'.$_REQUEST['id_pasta'].'_'.$id_unidade.'_'.$_REQUEST['id_empresa'].'.pdf'; ?>" target="_blank"><?php echo $values['nome_arquivo']?></a>
            </li>
        <?php } ?>
    <?php }?>
<?php } ?>




