<?php
include '../includes/conecte.php';
include '../includes/paginacao.php';

if (isset($_REQUEST['method']) && !empty($_REQUEST['method']) && $_REQUEST['method'] == "exclui") {
    $return = array("data" => true);
    if (!mysql_query("DELETE FROM  pessoa  WHERE pessoa_id = '{$_REQUEST['pessoa']}' ")) {
        $return = array("data" => false);
    }
    echo json_encode($return);
    exit;
}

if (isset($_REQUEST['nivel'])) {
    $nivel_id = mysql_real_escape_string($_REQUEST['nivel']);
    //$upa_id = mysql_real_escape_string($_REQUEST['upa']);
    $edital = mysql_real_escape_string($_REQUEST['edital']);
    $cargo_id = mysql_real_escape_string($_REQUEST['cargo']);
    $deficien = mysql_real_escape_string($_REQUEST['deficiente']);
    $estado = mysql_real_escape_string(intval($_REQUEST['estado']));
    
    $qrCargo = "AND B.id_cargo = '$cargo_id' ";
    if($cargo_id=="-1"){
        $qrCargo = "";
    }
    
    $qrDefici = "AND A.deficiente = ".$deficien;
    if($deficien=="-1"){
        $qrDefici = "";
    }

    $qrEstado = "AND A.id_estado = ".$estado;
    if($estado=="-1"){
        $estado = "";
    }
    
    
    $qr_upa = mysql_query("SELECT A.id_editalpessoal,B.* FROM editalpessoal AS A 
                                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                WHERE A.id_editalpessoal = '$edital'");
    $upa = mysql_fetch_assoc($qr_upa);

    $nome_nivel = @mysql_result(mysql_query("SELECT nome FROM niveis WHERE id_nivel = '$nivel_id'"), 0);
    $nome_cargo = @mysql_result(mysql_query("SELECT cargo FROM cargos WHERE id_cargo = '$cargo_id'"), 0);

    /* PAGINAÇÃO */
    $limite = 20;
    $pagina = (isset($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
    $inicio = ($pagina > 1) ? ($pagina-1) * $limite : 0;
    $sql = "SELECT A.id_pessoa, A.id_estado, D.sigla, A.nome,A.telefone,A.email,A.anexo,IF(A.deficiente=0,\"NÃO\",\"SIM\") as defici,C.cargo 
            FROM pessoa AS A
            INNER JOIN pessoa_cargo AS B ON (B.id_pessoa=A.id_pessoa)
            INNER JOIN cargos AS C ON (C.id_cargo=B.id_cargo)
            LEFT JOIN estados AS D ON (A.id_estado = D.id)
            WHERE   A.id_edital = '$edital' 
            AND     A.id_nivel = '$nivel_id' 
            AND     A.id_estado = '$estado'
            {$qrCargo}
            {$qrDefici} 
            ORDER BY C.cargo,A.nome";

echo "SELECT A.id_pessoa, A.id_estado, D.sigla, A.nome,A.telefone,A.email,A.anexo,IF(A.deficiente=0,\"NÃO\",\"SIM\") as defici,C.cargo 
FROM pessoa AS A
INNER JOIN pessoa_cargo AS B ON (B.id_pessoa=A.id_pessoa)
INNER JOIN cargos AS C ON (C.id_cargo=B.id_cargo)
LEFT JOIN estados AS D ON (A.id_estado = D.id)
WHERE   A.id_edital = '$edital' 
AND     A.id_nivel = '$nivel_id' 
AND     A.id_estado = '$estado'
{$qrCargo}
{$qrDefici} 
ORDER BY C.cargo,A.nome";
    $qr_pessoa = mysql_query($sql . " LIMIT $inicio,$limite");
    
    $html_pagina = geraPaginacao($pagina, $limite, $sql, "pessoas");
    //echo $sql;exit;
    if (mysql_num_rows($qr_pessoa) == 0) {
        echo '<h4 style="text-align:center;">Nenhum candidato encontrado no filtro selecionado.</h4>';
    } else { ?>
        
        <h2><?php echo $upa['nome']; ?> - <?php echo $upa['cidade']; ?></h2>
        <h3>NÍVEL:<?php echo $nome_nivel; ?></h3>
        <h3>CARGO: <?php echo $nome_cargo; ?></h3>

        <table id="userTable" width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Deficiente?</th>
                    <th>Currículo</th>
                    <th>Excluír</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                $c_old = "";
                while ($row_pessoa = mysql_fetch_assoc($qr_pessoa)):
                    if($cargo_id=="-1"){
                        if($row_pessoa['cargo']!=$c_old){
                            echo "<tr><td colspan='6' class='center tdsubtitle'>{$row_pessoa['cargo']}</td></tr>";
                            $c_old = $row_pessoa['cargo'];
                        }
                    }
                    $class = ($i++ % 2 ) ? 'even' : 'odd';
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td><?php echo $row_pessoa['nome']; ?></td>
                        <td><?php echo $row_pessoa['telefone']; ?></td>
                        <td><?php echo $row_pessoa['email']; ?></td>
                        <td class="center"><?php echo $row_pessoa['defici']; ?></td>
                        <td class="center">
                            <a href="../upload/edital_pessoal_<?php echo $edital; ?>/<?php echo htmlentities($row_pessoa['anexo']); ?>" class="icon icon-baixar" title="Baixar" >&nbsp;</a></td>
                        <td class="center">
                            <a href="javascript:;" data-key="<?php echo $row_pessoa['id_pessoa'] ?>" class="icon icon-excluir" title="Excluír">&nbsp;</a>
                        </td>
                    </tr>
                    <?php
                endwhile;
                ?>
            </tbody>
            <?php
            echo $html_pagina;
        }
    }
    ?>
</table>