<?php 
include("../includes/conecte.php");
$sql = mysql_query("SELECT A.*, B.nome AS nome_unidade
        FROM relatorio AS A
        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
        WHERE A.ano = '{$_REQUEST['anos']}' AND A.status = 1 AND A.tipo = 1
        ORDER BY B.nome") or die(mysql_error());

        while ($row = mysql_fetch_assoc($sql)){
            $uni[$row['id_unidade']]["unidade"] = $row['nome_unidade'];
            $uni[$row['id_unidade']]["dados"][$row['mes']] = $row['id_unidade'] ."_". $row['mes'] ."_". $row['ano'] . ".pdf";
        }
?>


<table class="table table-sm table-bordered table-striped" id="tabela<?php echo $_REQUEST['ano']?>a" style="display: block">
    <?php if(!empty($sql)) { ?>
        <thead>
            <tr>
                <th>Unidade</th>
                <th>Relatório</th>
                <th>Balancete</th>
                <th>Inventário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($uni as $k => $link){ ?>
                <tr>
                    <td><?php echo $uni[$k]['unidade']; ?></td>
                    <?php for($i = 1; $i <= 3; $i++) { ?>
                        <td class="text-center">
                            <?php if (!empty($uni[$k]['dados'][$i])) { ?>
                                <a href="../sistema/adm/real_anual/<?php echo $uni[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>   
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    <?php } else { ?>
        <div class="alert alert-warning alert<?php echo $ano; ?>a" role="alert<?php echo $ano; ?>a" style="display: none;" >
            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
        </div>
    <?php } ?>
</table> 