<?php 

include('sistema/includes/conecte.php');

    function nomeMes($numeroMes) {
        switch ($numeroMes) {
            case "01":    $mes = "Janeiro";     break;
            case "02":    $mes = "Fevereiro";   break;
            case "03":    $mes = "Março";       break;
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

    $unidadesComEscala = mysql_query("SELECT U.id_unidade, U.nome, E.setor, E.ano FROM escala E INNER JOIN unidades U ON U.id_unidade = E.id_unidade WHERE mes = " . date('m') . " OR mes = " . (date('m') + 1) . " AND ano = " . date('Y') . "
    GROUP BY U.id_unidade, E.setor");
    
    
    
    $unidadesComEscala_rows = mysql_num_rows($unidadesComEscala);

    if (isset($_GET['id_unidade']) && !empty($_GET['id_unidade']) && 
        isset($_GET['mes']) && !empty($_GET['mes']) && 
        isset($_GET['setor']) && !empty($_GET['setor'])) {

        $unidade = $_GET['id_unidade'];
        $mes = $_GET['mes'];
        $setor = $_GET['setor'];
        $ano = date('Y');

        $sql = mysql_query("SELECT dia_da_semana, profissional FROM escala WHERE ano = ".date('Y')." AND mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade);
        echo "<pre>";
        echo "SELECT dia_da_semana, profissional FROM escala WHERE ano = ".date('Y')." AND mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade;
        echo "</pre>";

        $registros_rows = mysql_num_rows($sql);

        while($row = mysql_fetch_assoc($sql)) {
            $arrayDiaDaSemana[$row['dia_da_semana']][] = $row['profissional'];
        }

        $sql = mysql_query("SELECT setor, mes, ano, nome_unidade FROM escala WHERE ano = ".date('Y')." AND mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade);
        ECHO "SELECT setor, mes, ano, nome_unidade FROM escala WHERE ano = ".date('Y')." AND mes = " . $mes . " AND setor = '" . $setor . "' AND id_unidade = " . $unidade;
        $registros = mysql_fetch_assoc($sql);
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Instituto Lagos Rio</title>
    <link href="css/estilo.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />     
    
    <style>
        table th {
            border: 1px solid #000;
        }

        table td, th {
            text-align: center;
            border: 1px solid #000;
        }
        
        #table-unidades th {
            background-color: #0a88cd;
            color: #FFF;
        }
        
        #table-escala-unidade {
            float: left;
        }
        
        #table-escala-unidade th, 
        #table-escala-unidade td {
            width: 100px;
            height: 61px;
            padding: 5px;
        }
        
        #table-escala-unidade th {
            font-size: 13px;
            background-color: #f2f9f9;
        }
        
        #table-escala-unidade td {
            font-size: 11px;
        }
        
        
        #table-unidades td {
            padding: 10px;
        }
        
        .btn-escala {
            background-color: #12b8ea;
            padding: 5px;
            border: 1px solid #000;
            cursor: pointer;
            font-size: 13px;
            color: #FFF;
            border-radius: 4px;
            text-decoration: none;
        }
        
        .header-escala {
            background-color: #0a88cd;
            width: 766px;
            margin-left: 92px;
            color: #FFF;
            padding: 20px;
            border: 1px solid #000;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>

    </head>

    <body>

        
    <div id="principal">                
        
        <div id="topo">
            
            <div id="logo"><a href="index.php" id="efeito2"><img src="img/logoBlue4.jpg" /></a></div>
            
            <div id="menu">   
                
                <div id="home">
                    <a href="index.php" id="efeito1">logo</a>
                </div>
                
               <div id="menu_home">
                    <ul>                                                                                                    
                        <li class="iten_menu"><a href="selecoes.php" class="a_mn">SeleÃ§Ãµes</a></li>  
                        <li class="iten_menu"><a href="ouvidoria.php" class="a_mn">Ouvidoria</a></li>
                        <li class="iten_menu"><a href="contato.php" class="a_mn">Fale Conosco</a></li>
                        <li class="iten_menu"><a href="noticias.php" class="a_mn">NotÃ­cias</a></li>
                        <li class="iten_menu"><a href="portal.php" class="a_mn">Portal da TransparÃªncia</a></li>
                        <li class="iten_menu"><a href="projetos.php" class="a_mn">Projetos</a></li>
                        <li class="iten_menu"><a href="corpo_tecnico.php" class="a_mn">Corpo TÃ©cnico</a></li>
                        <li class="iten_menu"><a href="instituto.php" class="a_mn">O Instituto</a></li>
                    </ul>
                </div>
            </div><!--menu-->

            <div id="tele">
                <img src="img/tele.jpg" />
            </div>
            
        </div><!--topo-->                       
        
        <div id="corpo">     
            
<!--            <div style="width: 1020px; margin-left: -20px; height: 163px; background-color: #12b8ea; color: #FFF; margin-bottom: 30px;">
                <h1 style="color: #FFF; margin-left: 20px; line-height: 163px;">ESCALA MÉDICA</h1>
            </div>       -->
            <div class="image">
                <img src="img/escala.jpg" width="1020" height="163" style="margin-left: -20px;" />
                <h1 style="color: #FFF; width: 240px; margin-left: -20px; padding-left: 20px; height: 60px; line-height: 60px; background-color: #12b8ea;
                    margin-top: -107px; position: absolute;"><?php echo utf8_encode("ESCALA MÉDICA"); ?></h1>
            </div>
            
            <div style="text-align: center;">
                <h1 style="margin-top: 40px;">Escala das Unidades</h1>
                
                <?php if (isset($unidadesComEscala_rows) && $unidadesComEscala_rows > 0) { ?>
                    <form method="POST">
                        <table id="table-unidades" border="1" width="800" style="margin: auto; margin-top: 20px; font-size: 12px;">
                            <tr>
                                <th style="width: 250px;">Unidade</th>
                                <th>Setor</th>
                                <th><?php echo utf8_encode(nomeMes(date('m'))); ?></th>
                                <th><?php echo utf8_encode(nomeMes(date('m') + 1)); ?></th>
                            </tr>
                            <?php while ($row = mysql_fetch_assoc($unidadesComEscala)) { ?>
                            <tr>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['setor']; ?></td>
                                
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <td>
                                        <?php 
                                            $sql = mysql_query("SELECT mes FROM escala WHERE id_unidade = " . $row['id_unidade'] . " AND mes = " . (date('m') + $i) . " AND setor = '" . $row['setor'] . "'");
                                            $num_rows = mysql_num_rows($sql);
                                        ?>
                                        <?php if ($num_rows > 0) { ?>
                                            <a href="escala_site.php?id_unidade=<?php echo $row['id_unidade']; ?>&mes=<?php echo (date('m') + $i); ?>&setor=<?php echo $row['setor']; ?>" title="visualizar">
                                                <img src="img/binoculars.png" width="20" />
                                            </a>
                                        <?php } else { ?>
                                            <span> X </span>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </table>
                    </form>
                <?php } else { ?>
                    <h3 style="color: red; margin-top: 20px;"><?php echo utf8_encode("Não existe nenhuma escala registrada."); ?></h3>
                <?php } ?>
                
                <br><br><br><br><br><br>
                                        
                <?php if (isset($registros_rows) && $registros_rows > 0) { ?>
                                        
                    <div class="header-escala">
                        <h2><?php echo strtoupper($registros['nome_unidade']); ?></h2>
                        <span style="font-size: 18px;"><?php echo strtoupper($registros['setor']); ?></span><br>
                        <span style="font-size: 16px;"><?php echo utf8_encode(nomeMes($mes)); ?></span><br>
                        <span style="font-size: 16px;"><?php echo $registros['ano']; ?></span><br>
                    </div>
                        
                    <table border="1" id="table-escala-unidade" style="margin-left: 90px;">
                        <tr>
                            <th>Domingo</th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['domingo']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['domingo'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['domingo'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['domingo'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th>Segunda-Feira</th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['segunda']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['segunda'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['segunda'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['segunda'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th><?php echo utf8_encode("Terça-Feira"); ?></th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['terca']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['terca'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['terca'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['terca'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th>Quarta-Feira</th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['quarta']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['quarta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['quarta'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['quarta'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th>Quinta-Feira</th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['quinta']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['quinta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['quinta'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['quinta'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th>Sexta-Feira</th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['sexta']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['sexta'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['sexta'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['sexta'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table border="1" id="table-escala-unidade">
                        <tr>
                            <th><?php echo utf8_encode("Sábado"); ?></th>
                        </tr>
                        <?php for($i = 1; $i < count($arrayDiaDaSemana['sabado']); $i++) { ?>
                            <tr>
                                <td <?php echo (substr($arrayDiaDaSemana['sabado'][$i], 0, 3) == '12H' || substr($arrayDiaDaSemana['sabado'][$i], 0, 3) == '24H') ? "style='background-color: #ace4f9; font-weight: bold;'" : ''; ?>>
                                    <?php echo $arrayDiaDaSemana['sabado'][$i]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
            </div>
            
            <div id="limpa"></div>
        </div><!--corpo-->                
        
        <!--rodape-->
        <?php        
            include('rodape.php');        
        ?>
        
    </div><!--principal -->
    
    </body>
    
</html>