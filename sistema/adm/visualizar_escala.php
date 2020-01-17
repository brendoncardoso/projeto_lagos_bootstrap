<?php
    require '../includes/conecte.php';
    require '../includes/restricao.php';

    $numeroMes = $_GET['mes'];
    function nomeMes($numeroMes) {
        switch ($numeroMes) {
            case "1":    $mes = "Janeiro";     break;
            case "2":    $mes = "Fevereiro";   break;
            case "3":    $mes = "Março";       break;
            case "4":    $mes = "Abril";       break;
            case "5":    $mes = "Maio";        break;
            case "6":    $mes = "Junho";       break;
            case "7":    $mes = "Julho";       break;
            case "8":    $mes = "Agosto";      break;
            case "9":    $mes = "Setembro";    break;
            case "10":    $mes = "Outubro";     break;
            case "11":    $mes = "Novembro";    break;
            case "12":    $mes = "Dezembro";    break; 
            default;
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
       
        $max_array = max($arrayDiaDaSemana);
        $max_string = count($max_array) - 1;
        $sql = mysql_query("SELECT setor, mes, ano, nome_unidade FROM escala WHERE mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade);
        $registros = mysql_fetch_assoc($sql);
} 

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Escala Médica</title>
        <!--ICON-->
        <link rel="shortcut icon" href="../../assets/images/favicon.png" type="image/x-icon" />
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../assets/css/estrutura.css" rel="stylesheet" type="text/css">
        <link href="../../assets/css/style-print.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/js/jquery.3-4-1.js"></script>
        <script src="../../assets/js/print.js" type="text/javascript"></script>
        
        <style>
        
            #content {
                width: 800px;
                margin: 0 auto;
            }

            .logo {
                float: left;
                margin: 5px 0 0 5px;
            }

            #title {
                float: left;
                padding: 20px 0 0 25px;
            }

            hr {
                border: none;
            /*   border-top: 1px solid #333;*/
            }

            .fleft {
                float: left;
            }

            .fright {
                float: right;
            }

            .box {
                border: 2px solid #000;
                padding: 10px;
                margin-top: 10px;
            }

            .txright {
                text-align: right;
            }

            .txcenter {
                text-align: center;
            }

            .legenda {
                font-size: 10px;
                padding: 0;
                margin: 0;
                float: left;
            }

            .clear {
                clear: both;
                padding: 0;
                margin: 0;
                line-height: 16px;
            }

            .txleft {
                text-align: left;
            }

            table {
                /*width: 100%;*/
            /*border-left: 1px solid #333;*/
                /*margin-bottom: 10px !important;*/
                
            }

            td {
                padding: 1px 5px;
            /*   border-right: 1px solid #333; */

            
            /*   border-bottom: 1px solid #333; */
            }

            td.bl {
                border-left: none !important;
            }

            tr.bf td {
                border-bottom: none !important;
            }

            tr.bt td {
                border-top: none !important;
            }

            p {
                font-size: 13px;
                padding: 5px;
            }

            table thead tr th {
                font-size: 14px;
                font-weight: bold;
            }

            table tbody tr td {
                padding: 1px 5px;
                font-size: 13px !important;
            }

            table.grid {
                border-top: 1px solid #333;
            /*    border-left: 1px solid #333; */
            }

            table.grid tr td {
            /*  border-bottom: 1px solid #333; */
            /* border-right: 1px solid #333;*/
            }

            table.grid tr th {
            /*  border-bottom: 1px solid #333;*/
                /*background: #F0F0F0;*/
            }

            table.grid tr th:last-child {
            /*  border-right: 1px solid #333; */
            }

            #sigilo {
                width: 200px !important;
                float: right;
            }

            span {
            /*  color: red;*/
            }
            
            .tdquadrado{
                font-family: arial;
                font-size: 11px!important;
                border: 1px solid!important;
            }
            
            .removeBorderBottom {
                border-bottom: none!important;
            }
            
            .removeBorderTop {
                border-top: none!important;
            }
            
            .removeAmbosBorders{
                border-bottom: none!important;
                border-top: none!important;
            }
            
            .removeBorders{
                border: 0px!important;
            }
            
            .quadrado{
                width: 5%;
                border: 1px solid black;
            }

            .altura_quadrado{
                height: 70px;
            }
        </style>
    </head>
        <body>
            <nav class="navbar justify-content-center fixed-top navbar-light bg-light">
                    <div class="">
                        <button type="button" id="imprimir" class="btn btn-success navbar-btn"><i class="fa fa-print"></i>
                            Imprimir
                        </button>
                        <a href="escala.php" class="btn btn-info navbar-btn"><i class="fa fa-undo"></i> Voltar</a>
                    </div>
                </div>
            </nav>
                
            <div class="teste">
                <table border="1" width="100">
                    <thead>
                        <tr>
                            <th colspan="8" align="center" style="background-color: #0A88CD; color: white;">
                                <?= $registros['nome_unidade']; ?>
                                <br>
                                <?= $registros['setor']; ?>
                                <br>

                                <?php
                                    switch($mes){
                                        case "1":    $mes = "Janeiro";     break;
                                        case "2":    $mes = "Fevereiro";   break;
                                        case "3":    $mes = "Março";       break;
                                        case "4":    $mes = "Abril";       break;
                                        case "5":    $mes = "Maio";        break;
                                        case "6":    $mes = "Junho";       break;
                                        case "7":    $mes = "Julho";       break;
                                        case "8":    $mes = "Agosto";      break;
                                        case "9":    $mes = "Setembro";    break;
                                        case "10":    $mes = "Outubro";     break;
                                        case "11":    $mes = "Novembro";    break;
                                        case "12":    $mes = "Dezembro";    break; 
                                        default;
                                    }
                                ?>

                                <?= $mes; ?>
                                <br>
                                <?= $registros['ano']; ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($k = 0; $k <= $max_string; $k++) { ?>
                            <tr>
                                <?php foreach($arrayDiaDaSemana as $i => $values) { ?>
                                    <td class="altura_quadrado" align="center" <?= $k == 0 ? "style= 'background-color: #F2F9F9'" : "";?> <?= $k == 1 ? "style= 'background-color: #ACE4F9'" : "";?> >
                                        <?php if(!empty($values[$k])) { ?>
                                            <?= $values[$k]; ?>
                                        <?php } else { ?>
                                            ...
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
