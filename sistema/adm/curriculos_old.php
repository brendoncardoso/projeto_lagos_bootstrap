<?php

include('../includes/conecte.php');

include('../includes/restricao.php');

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

                        $qr_pessoas = mysql_query("SELECT *

                                                    FROM curriculos AS A

                                                    INNER JOIN cargos AS B ON (A.cargo = B.id_cargo)

                                                    ORDER BY A.id_curriculo DESC

                                                    ");

                        if (mysql_num_rows($qr_pessoas) == 0) {

                            echo '<h4>Nenhum currículo cadastado.</h4>';

                        } else {

                            ?>

                            <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">

                                <thead>

                                    <tr>

                                        <th>ID</th>

										<th>NOME</th>

                                        <th>CARGO</th>

                                        <th>TELEFONE</th>

                                        <th>E-MAIL</th>

                                        <th>CURRÍCULO</th>

										<th>DATA</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $i = 0;

                                    while ($row_pessoa = mysql_fetch_assoc($qr_pessoas)):

                                        $class = ($i++ % 2 ) ? 'even' : 'odd';

										if($row_pessoa['data_reg'] != "")

										{

											$data_temp = explode("-",$row_pessoa['data_reg']);

											$data = $data_temp[2]."/".$data_temp[1]."/".$data_temp[0];

										}

										else{

											$data = " - ";

										}

                                        ?>	

                                        <tr class="<?php echo $class; ?>">

                                            <td><?php echo $row_pessoa['id_curriculo'] ?></td>

											<td><?php echo $row_pessoa['nome'] ?></td>

                                            <td><?php echo $row_pessoa['cargo']; ?></td>

                                            <td><?php echo $row_pessoa['telefone'] ?></td>

                                            <td><?php echo $row_pessoa['email'] ?></td>

											<td><?php echo $data ?></td>

                                            <td class="center">

                                                <a href="../../novo/curriculos/<?php echo $row_pessoa['arquivo_curriculo'] ?>" class="icon icon-baixar" title="Baixar">&nbsp;</a>

                                            </td>

                                        </tr>

                                        <?php

                                    endwhile;

                                    ?>

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

