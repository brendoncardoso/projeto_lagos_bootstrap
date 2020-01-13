<?php
    include ('sistema/includes/conecte.php');

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
    
        
    if(isset($_GET['id_unidade']) && !empty($_GET['id_unidade']) && isset($_GET['mes']) && !empty($_GET['mes']) && isset($_GET['setor']) && !empty($_GET['setor'])){
        $unidade = $_GET['id_unidade'];
        $mes = $_GET['mes'];
        $setor = $_GET['setor'];
        $ano = date('Y');
        $carga_horaria = isset($_GET['carga_horaria']);
        
        $sql = mysql_query("SELECT dia_da_semana, profissional, carga_horaria FROM escala WHERE mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade);
        $registros_rows = mysql_num_rows($sql);

        while($row = mysql_fetch_assoc($sql)) {
            $arrayDiaDaSemana[$row['dia_da_semana']][] = $row['profissional'];
        }

        $sql = mysql_query("SELECT setor, mes, ano, nome_unidade FROM escala WHERE mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade);
        $registros = mysql_fetch_assoc($sql);

        /*echo '<pre>';
        print_r($arrayDiaDaSemana);
        echo '</pre>';*/
    }
?>
<title>Escala de Unidades</title>
<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
<link href="assets/css/escala_tabela.css" type="text/css" rel="stylesheet"/>


<!--FONT-AWESOME-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <div class="btn">  
        <button class="danger"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
        <button class="gris"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar/Imprimir</button>
    </div>
<?php if (isset($registros_rows) && $registros_rows > 0) { ?>
    <div class="container">
        <div class="escala_css">
            <h2><?php echo strtoupper($registros['nome_unidade']); ?></h2> 
            <span style="font-size: 18px;"><?php echo strtoupper($registros['setor']); ?></span><br>
            <span><?php echo nomeMes($mes); ?></span><br>
            <span><?php echo $registros['ano']; ?></span><br>
        </div>
        <div class="center">
            <div id="table-escala-unidade">
                <table border="1">
                    <tr>
                        <th>Domingo</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['domingo']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['domingo'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['domingo'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['domingo'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1" >
                    <tr>
                        <th>Segunda-Feira</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['segunda']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['segunda'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['segunda'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['segunda'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1">
                    <tr>
                        <th>Terça-Feira</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['terca']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['terca'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['terca'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['terca'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1">
                    <tr>
                        <th>Quarta-Feira</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['quarta']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['quarta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['quarta'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['quarta'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1">
                    <tr>
                        <th>Quinta-Feira</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['quinta']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['quinta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['quinta'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['quinta'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1">
                    <tr>
                        <th>Sexta-Feira</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['sexta']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['sexta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['sexta'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['sexta'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <table border="1">
                    <tr>
                        <th>Sábado</th>
                    </tr>
                    <?php for($i = 1; $i < count($arrayDiaDaSemana['sabado']); $i++) { ?>
                        <tr>
                            <td <?php echo (substr($arrayDiaDaSemana['sabado'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['sabado'][$i], 0, 3) == '24H') ? " style='background-color: #ace4f9; font-weight: bold;' ": ''; ?>>
                                <?php echo $arrayDiaDaSemana['sabado'][$i]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php } ?>

<!--JavaScript--><!--JQUERY-->        
<script src="assets/js/jquery.3-4-1.js"></script> 
<script src="assets/js/document_jquery_tabela.js"></script>

</body>

