<?php
    include('sistema/includes/conecte.php');
    function nomeMes($numeroMes) {
        switch ($numeroMes) {
            case "01":    $mes = "Janeiro";     break;
            case "02":    $mes = "Fevereiro";   break;
            case "03":    $mes = "Mar�o";       break;
            case "04":    $mes = "Abril";       break;
            case "05":    $mes = "Maio";        break;
            case "06":    $mes = "Junho";       break;
            case "07":    $mes = "Julho";       break;
            case "08":    $mes = "Agosto";      break;
            case "09":    $mes = "Setembro";    break;
            case "10":    $mes = "Outubro";     break;
            case "11":    $mes = "Novembro";    break;
            case "12":    $mes = "Dezembro";    break; 
        }

        return $mes;
    }

    $data = date("d");
    $mes = date("m");
    $ano = date("Y");

    $unidadesComEscala = mysql_query("SELECT U.id_unidade, U.nome, E.setor FROM escala E INNER JOIN unidades U ON U.id_unidade = E.id_unidade WHERE mes = $mes OR mes = ($mes + 1) AND ano = $ano
    GROUP BY U.id_unidade, E.setor");

    $unidadesComEscala_rows = mysql_num_rows($unidadesComEscala);
?>

<?php include_once('header.php'); ?>
    
<!--HEADER MENU-->
    <div class="borda_menu"></div>
    <div class="page_title">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <h4>ESCALA MÉDICA</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Escala Médica</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <img class="escala_medica_imagem" src="assets/images/escala_medica.jpg" width="100%" class="img-fluid" alt="Responsive image">
    </div>

    <div class="container">
        <div class="col-sm-12 p-0">
            <div class="text-center title_escala_medica">
                <h5 class="text-align text-white m-0 p-3">ESCALA MÉDICA DAS UNIDADES</h5>
            </div>
            <?php if(isset($unidadesComEscala_rows) && $unidadesComEscala_rows > 0) { ?>
                <form action="" method="post">
                    <table class="table table-bordered table-white">
                        <thead class="thead text-white" style="background-color: #4DB1E2">
                            <tr class="text-center">
                                <th>Unidade</th>
                                <th>Setor</th>
                                <th><?php echo nomeMes(date('m'));?></th>
                                <th><?php echo nomeMes(date('m') + 1); ?></th>
                            </tr>
                        </thead>
                            <?php while($row = mysql_fetch_assoc($unidadesComEscala)) { ?>
                                <tr class="text-center">
                                    <td><?php echo $row['nome']; ?></td>
                                    <td><?php echo $row['setor']; ?></td>
                                    <?php for($i = 0; $i < 2; $i++) { ?>
                                        <td>
                                            <?php 
                                                $sql = mysql_query("SELECT mes FROM escala WHERE id_unidade = " . $row['id_unidade'] . " AND mes = " . (date('m') + $i) . " AND setor = '" . $row['setor'] . "'");
                                                $num_rows = mysql_num_rows($sql);
                                            ?>
                                            <?php if($num_rows > 0) { ?>
                                                <a href="escala_tabela.php?id_unidade=<?php echo $row['id_unidade']; ?>&mes=<?php echo (date('m') + $i); ?>&setor=<?php echo $row['setor']; ?>" target="_blank" title="Visualizar">
                                                    <i class="fa fa-calendar-check-o text-success" aria-hidden="true"></i>
                                                </a>
                                            <?php } else { ?>
                                                <i class="fa fa-calendar-times-o text-danger" aria-hidden="true"></i>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                    </table>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert" style="border-radius: 0px">
                    <strong>Atenção!</strong> Não existe nenhuma escala registrada. 
                </div>
            <?php } ?>
        </div>
    </div>

<?php include_once('footer.php'); ?>