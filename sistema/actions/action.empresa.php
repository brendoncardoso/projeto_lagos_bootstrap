<?php
include('../includes/conecte.php');

if (isset($_GET['unidade'])) {
    $upa_id = mysql_real_escape_string($_GET['unidade']);
    $qr_upa = mysql_query("SELECT * FROM unidades WHERE id_unidade = '$upa_id'");
    $upa = mysql_fetch_assoc($qr_upa);
    
    $qr_compra = mysql_query("SELECT * FROM compras WHERE id_compra = '$upa_id'");
    $compra = mysql_fetch_assoc($qr_compra);
    
    ?>

    <h2><?php echo $compra['numero']?> - <?php echo $upa['nome']; ?> - <?php echo $upa['cidade']; ?></h2>
    <h3><?php echo $compra['observacao']?></h3>
    <?php
    $qr_empresa = mysql_query(" SELECT * FROM empresa WHERE id_edital = '$upa_id'");
    if (mysql_num_rows($qr_empresa) == 0) {
        echo '<h4>Nenhuma empresa cadastrada.</h4>';
    } else {
        ?>
        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
            <thead>
                <tr>
                    <th>RAZÃO</th>
                    <th>UPA</th>
                    <th>CNPJ</th>
                    <th>E-MAIL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row_empresa = mysql_fetch_assoc($qr_empresa)):
                    $class = ($i++ % 2 ) ? 'even' : 'odd';
                    ?>	
                    <tr class="<?php echo $class; ?>">
                        <td><?php echo $row_empresa['razao'] ?></td>
                        <td><?php echo $row_empresa['nome']; ?></td>
                        <td><?php echo $row_empresa['cnpj'] ?></td>
                        <td><?php echo $row_empresa['email'] ?></td>            
                    </tr>	

                    <?php
                endwhile;
                ?>
            </tbody>
            <?php
        }
    }
    ?>
</table>