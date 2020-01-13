<?php
//session_start();
setcookie("autorizado", "true", 0, "/");

include('../includes/conecte.php');
include('../includes/restricao.php');

$qr_resumo = "SELECT A.num_proc_adm,D.nome as unidade,C.nome as nivel,COUNT(B.nome) AS total FROM editalpessoal AS A
                LEFT JOIN pessoa AS B ON (A.id_editalpessoal=B.id_edital)
                LEFT JOIN niveis AS C ON (C.id_nivel=B.id_nivel)
                LEFT JOIN unidades AS D ON (A.id_unidade = D.id_unidade)
                WHERE A.status = 1
                GROUP BY A.id_editalpessoal,C.nome";
$result_res = mysql_query($qr_resumo);
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

        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/global.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="main">
            <div id="header">
                <h1 class="title1">ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
            </nav>

            <section>
                <div id="conteudo">
                    <div class="blocos">
                        <h2>Currículos recentes</h2>
                        <?php
                        $qr_pessoas = mysql_query(" SELECT id_edital,id_nivel,anexo,A.nome,B.nome AS unidade,telefone,email 
                                                    FROM pessoa AS A
                                                    INNER JOIN unidades AS B ON (A.id_unidade=B.id_unidade)
                                                    ORDER BY A.id_pessoa DESC
                                                    LIMIT 10");
                        if (mysql_num_rows($qr_pessoas) == 0) {
                        echo '<h4>Nenhum currículo cadastado.</h4>';
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>UNIDADE</th>
                                    <th>TELEFONE</th>
                                    <th>E-MAIL</th>
                                    <th>CURRÍCULO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($row_pessoa = mysql_fetch_assoc($qr_pessoas)):
                                $class = ($i++% 2 ) ? 'even' : 'odd';
                                ?>	
                                <tr class="<?php echo $class; ?>">
                                    <td><?php echo $row_pessoa['nome'] ?></td>
                                    <td><?php echo $row_pessoa['unidade']; ?></td>
                                    <td><?php echo $row_pessoa['telefone'] ?></td>
                                    <td><?php echo $row_pessoa['email'] ?></td>
                                    <td class="center">
                                        <a href="../upload/edital_pessoal_<?php echo $row_pessoa['id_edital'] ?>/<?php echo $row_pessoa['anexo'] ?>" class="icon icon-baixar" title="Baixar">&nbsp;</a>
                                    </td>
                                </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>

                    <hr/>

                    <div class="blocos">
                        <h2>Empresas recentes</h2>

                        <?php
                        $qr_empresa = mysql_query("SELECT razao,cnpj,email,C.nome AS unidade FROM empresa AS A
                                                    INNER JOIN compras AS B ON (A.id_edital=B.id_compra)
                                                    INNER JOIN unidades AS C ON (B.id_unidade=C.id_unidade)
                                                    ORDER BY id_empresa DESC
                                                    LIMIT 10");
                        if (mysql_num_rows($qr_empresa) == 0) {
                        echo '<h4>Nenhuma empresa cadastrada.</h4>';
                        } else {
                        ?>
                        <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>RAZÃO</th>
                                    <th>UNIDADE</th>
                                    <th>CNPJ</th>
                                    <th>E-MAIL</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 0;
                            while ($row_empresa = mysql_fetch_assoc($qr_empresa)):
                            $class = ($i++% 2 ) ? 'even' : 'odd';
                            ?>	
                            <tr class="<?php echo $class; ?>">
                                <td><?php echo $row_empresa['razao'] ?></td>
                                <td><?php echo $row_empresa['unidade']; ?></td>
                                <td><?php echo $row_empresa['cnpj'] ?></td>
                                <td><?php echo $row_empresa['email'] ?></td>            
                            </tr>	

                            <?php
                            endwhile;
                            }
                            ?>
                        </table>
                    </div>

                    <hr/>

                    <h2>Totalizadores</h2>
                    <p>Currículos cadastrados</p>
                    <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                            <tr>
                                <th>PROC. ADMIN.</th>
                                <th>UNIDADE</th>
                                <th>NÍVEL</th>
                                <th>QTDE.</th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        while ($row_res = mysql_fetch_assoc($result_res)){
                        $class = ($i++% 2 ) ? 'even' : 'odd';
                        ?>	
                        <tr class="<?php echo $class; ?>">
                            <td><?php echo $row_res['num_proc_adm'] ?></td>
                            <td><?php echo $row_res['unidade']; ?></td>
                            <td><?php echo $row_res['nivel'] ?></td>
                            <td><?php echo $row_res['total'] ?></td>            
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </section>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>
