<?php
include("../includes/conecte.php");
session_start();

    $sql = mysql_query("SELECT DISTINCT A.id_unidade, A.id_pasta, A.id_empresa, B.nome_empresa
    FROM prestacao_categoria3 AS A
    INNER JOIN empresas_prestador AS B ON (A.id_empresa = B.id)
    WHERE A.id_pasta = '{$_REQUEST['id_pasta']}' AND A.id_unidade = '{$_REQUEST['id_unidade']}';");
    
    while($row = mysql_fetch_assoc($sql)){
        $id_empresa =  $row['id_empresa'];
        $arrTeste[$row['id_empresa']] = [
            "id_unidade" => $row['id_unidade'],
            "id_pasta" => $row['id_pasta'],
            "nome_empresa" => $row['nome_empresa']
        ];
    }

?>

<?php foreach($arrTeste as $id_empresa => $values) { ?>
    <li class="lista_css empresa_prestador<?php echo $_REQUEST['id_pasta']?><?php echo $_REQUEST['id_unidade']?>" style="margin-left: 40px" data-id_empresa=<?php echo $id_empresa?> style="display: none">
        <?php echo $values['nome_empresa']?>
    </li>
    <div class="actionCategoria33<?php echo $values['id_unidade']?><?php echo $id_empresa?>"></div>
<?php } ?>
