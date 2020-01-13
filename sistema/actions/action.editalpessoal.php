<?php

include("../includes/conecte.php");
session_start();

$dir_move = "/arquivos/editaispdf/";
$dir = dirname(dirname(__FILE__)) . $dir_move;
$dirSave = "sistema/arquivos/editaispdf/";

if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Edital excluído com sucesso";
        if (!mysql_query("DELETE FROM editalpessoal WHERE id_editalpessoal = '{$_REQUEST['edital']}'")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir o edital";
        }
        echo json_encode($return);
        exit;
    } elseif ($_REQUEST['method'] == "loadcargos") {
        $ar_edicao = array();
        if (isset($_REQUEST['edit'])) {
            $qr_edicao = mysql_query("SELECT id_cargo FROM editalpessoal_cargos WHERE id_edital = {$_REQUEST['edit']}");
            while ($rows_ed = mysql_fetch_assoc($qr_edicao)) {
                array_push($ar_edicao, $rows_ed['id_cargo']);
            }
        }

        $qr_cargos = mysql_query("SELECT B.id_cargo,B.cargo,C.nome FROM unidades_cargos AS A
                                    INNER JOIN cargos AS B ON(A.id_cargo=B.id_cargo)
                                    INNER JOIN niveis AS C ON(C.id_nivel=B.id_nivel)
                                    WHERE A.id_unidade = {$_REQUEST['unidade']} 
                                    ORDER BY C.nome,B.cargo");
        $total = mysql_num_rows($qr_cargos);
        $return = "";
        if ($total > 0) {
            $return .= "<table id=\"tableShowCargos\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
            $i = 1;
            while ($row = mysql_fetch_assoc($qr_cargos)) {
                $checked = (in_array($row['id_cargo'], $ar_edicao)) ? " checked=\"checked\"" : "";
                $return .= "<td><label><input type=\"checkbox\" name=\"cargos[]\" value=\"{$row['id_cargo']}\"{$checked} > {$row['nome']} - {$row['cargo']} </label></td>";
                if ($i++ == 2) {
                    $i = 1;
                    $return .= "</tr><tr>";
                }
            }
            $return .= "</tr><table>";
        } else {
            $return .= "<div>Nenhum cargo encontrado na unidade selecionada</div>";
        }
        echo $return;
        exit;
    } else if (isset($_REQUEST['method']) && $_REQUEST['method'] == "listaAno") {
        $qr_ano = mysql_query("SELECT A.num_edital,A.observacao,B.nome,B.uf,B.cidade FROM editalpessoal AS A
                                INNER JOIN unidades AS B ON B.id_unidade=A.id_unidade
                                WHERE YEAR(A.data_ini) = '{$_REQUEST['ano']}' AND (A.data_fim <= NOW() OR A.status = 2)");
        $to_ano = mysql_num_rows($qr_ano);
        $html = "<p>Nenhum edital encontrado para esta data</p>";
        if ($to_ano > 0) {
            $html = "";
            while ($row = mysql_fetch_assoc($qr_ano)) {
                $html .= "<div class='cadaUm'>";
                $html .= "<h4>{$row['num_edital']} - {$row['nome']} - {$row['cidade']}, {$row['uf']}</h4>";
                $html .= "<p>{$row['observacao']}</p>";
                $html .= "</div>";
            }
        }
        echo $html;
        exit;
    }
}
//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
$num_edital = $_REQUEST['num_edital'];
$num_proc_adm = $_REQUEST['num_proc_adm'];
$unidade = $_REQUEST['unidade'];
$cargos = $_REQUEST['cargos'];
$data_ini = $_REQUEST['data_ini'];
$hora_ini = $_REQUEST['hora_ini'];
$data_fim = $_REQUEST['data_fim'];
$hora_fim = $_REQUEST['hora_fim'];
$observacao = $_REQUEST['observacao'];
$status = $_REQUEST['status'];
$anexos = $_REQUEST['num_anexos'];

$hora_fim = ($hora_fim == "00:00") ? "23:59" : $hora_fim;

$d_ini = date("Y-m-d", strtotime(str_replace("/", "-", $data_ini))) . " " . $hora_ini . ":00";
$d_fim = date("Y-m-d", strtotime(str_replace("/", "-", $data_fim))) . " " . $hora_fim . ":00";

//PREPARA A INSERÇÃO DOS CARGOS DO EDITAL (INSERT E EDIT)
$qr_cargos = "INSERT INTO editalpessoal_cargos (id_edital,id_cargo) VALUES ";
$qnt_cargos = count($cargos);
foreach ($cargos as $key => $value) {
    $qr_cargos .= "(|,{$value})";
    if ($key + 1 < $qnt_cargos) {
        $qr_cargos .= ",";
    }
}

//VERIFICA SE É CADASTRO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    if (mysql_query("INSERT INTO editalpessoal (id_unidade, num_edital, num_proc_adm, data_ini, data_fim, observacao, status) VALUES ('$unidade', '$num_edital', '$num_proc_adm', '$d_ini','$d_fim','$observacao','$status')")) {
        $id = mysql_insert_id();
        //UPLOAD DO EDITAL
        if (!empty($_FILES)) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }

            $tmp_name = $_FILES['file']['tmp_name'];
            $name = $id . "-" . str_replace(" ", "_", microtime()) . ".pdf";

            if (!move_uploaded_file($tmp_name, $dir . $name)) {
                $_SESSION["message"] = "Erro ao mover o arquivo";
                header("Location: ../adm/editalpessoal.php");
            }
        }

        mysql_query("UPDATE editalpessoal SET edital = '{$dirSave}{$name}' WHERE id_editalpessoal = {$id}");

        $qr_cargos = str_replace("|", $id, $qr_cargos);

        if (mysql_query($qr_cargos)) {
            $_SESSION["message"] = "Edital cadastrado com sucesso";
            header("Location: ../adm/editalpessoal.php");
        } else {
            $_SESSION["message"] = "Erro ao relacionar os cargos";
            header("Location: ../adm/editalpessoal.php");
        }
    } else {
        $_SESSION["message"] = "Erro ao cadastrar";
        header("Location: ../adm/editalpessoal.php");
    }
} else {
    $id = $_REQUEST['id'];
    $alterEtial = "";
    //UPLOAD DE ANEXOS E EDITAL
    if (!empty($_FILES)) {
        
        //EDITAL
        if(!empty($_FILES['file'])){
            $tmp_name = $_FILES['file']['tmp_name'];
            $name = $id . "-" . str_replace(" ", "_", microtime()) . ".pdf";

            if (!move_uploaded_file($tmp_name, $dir . $name)) {
                $_SESSION["message"] = "Erro ao mover o arquivo";
                header("Location: ../adm/editalpessoal.php");
            }
            $alterEtial = ",edital='".$dirSave.$name."'";
            unset($tmp_name);
            unset($name);
        }
        
        //VERIFICANDO SE FOI ENVIADO ARQUIVO EM ANEXO
        if (count($_FILES['anexos']['name']) > 1) {
            $uploadAnexos = count($_FILES['anexos']['name']);
        } else {
            $uploadAnexos = ($_FILES['anexos']['name'][0] != "") ? 1 : 0;
        }

        if ($uploadAnexos > 0) {
            $anexo = ($anexos > 0) ? $anexos + 1 : 1;
            foreach ($_FILES['anexos']['tmp_name'] as $tmp_name) {
                $name = $id . "-Anexo-" . $anexo . ".pdf";
                if (!move_uploaded_file($tmp_name, $dir . $name)) {
                    $_SESSION["message"] = "Erro ao mover o arquivo em anexo";
                    header("Location: ../adm/editalpessoal.php");
                }
                $anexo++;
            }
        }
    } else {
        $uploadAnexos = 0;
    }
    $totalAnexos = $anexos + $uploadAnexos;
    $prorrogacao = 0;
    //PRORROGAÇÃO
    if (isset($_REQUEST['prorrogacao_data']) && !empty($_REQUEST['prorrogacao_data'])) {
        $qr_prorrogado = mysql_query("SELECT prorrogado FROM editalpessoal WHERE id_editalpessoal = " . $id . "");
        $to_prorro = mysql_num_rows($qr_prorrogado);
        $dt_fim_ant = null;
        //VERIFICA SE É A PRIMEIRA PRORRGAÇÃO, SE FOR GUARDO A DATA ORIGINAL DE ENCERRAMENTO
        if ($to_prorro == 0) {
            $dt_fim_ant = $d_fim;
        }

        $dt_prorrogado = date("Y-m-d", strtotime(str_replace("/", "-", $_REQUEST['prorrogacao_data']))) . " " . $_REQUEST['prorrogacao_hora'] . ":00";
        mysql_query("INSERT INTO edital_prorrogacoes (id_pessoal, data_fim_ant, data_fim) VALUES ({$id},'{$dt_fim_ant}', '{$dt_prorrogado}');");
        $prorrogacao = 1;
        $d_fim = $dt_prorrogado;
    }
    
    $qrNameFile = mysql_query("SELECT edital FROM editalpessoal WHERE  id_editalpessoal = {$id}");
    $rowNameFile = mysql_fetch_assoc($qrNameFile);
   
    if(isset($_REQUEST['remove_ed']) && $_REQUEST['remove_ed'] == 1){
        $nameF = end(explode("/",$rowNameFile['edital']));
        //unlink($dir . $nameF) or die("Erro fatal ao excluir o arquivo");
        $alterEtial = ",edital=''";
    }
    
    if (mysql_query("UPDATE editalpessoal SET id_unidade={$unidade}, num_edital='{$num_edital}', num_proc_adm='{$num_proc_adm}', data_ini='{$d_ini}', data_fim='{$d_fim}', observacao='{$observacao}', status={$status}, anexos={$totalAnexos}, prorrogado={$prorrogacao} {$alterEtial} WHERE  id_editalpessoal = " . $id . "")) {

        mysql_query("DELETE FROM editalpessoal_cargos WHERE id_edital={$id} ");

        $qr_cargos = str_replace("|", $id, $qr_cargos);
        if (mysql_query($qr_cargos)) {
            $_SESSION["message"] = "Edital alterado com sucesso";
            header("Location: ../adm/editalpessoal.php");
        } else {
            $_SESSION["message"] = "Erro ao relacionar os cargos";
            header("Location: ../adm/editalpessoal.php");
        }
    } else {
        $_SESSION["message"] = "Erro ao alterar o edital";
        header("Location: ../adm/editalpessoal.php");
    }
}
?>
