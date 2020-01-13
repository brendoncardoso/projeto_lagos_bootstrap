<?php

include("../includes/conecte.php");
session_start();

//print_r($_REQUEST);exit;
if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Cargo excluído com sucesso";
        if (!mysql_query("DELETE FROM cargos WHERE id_cargo = '{$_REQUEST['cargo']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a unidade";
        }
        echo json_encode($return);
        exit;
    } elseif ($_REQUEST['method'] == "delAssoc") {
        $return = array("data" => true);
        $_SESSION["message"] = "Associação excluída com sucesso";
        if (!mysql_query("DELETE FROM unidades_cargos WHERE id_cargo = '{$_REQUEST['cargo']}' AND id_unidade = '{$_REQUEST['unidade']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a associação de cargo a unidade";
        }
        echo json_encode($return);
        exit;
    } elseif ($_REQUEST['method'] == "listar") {
        
        $qr_cargos = mysql_query("SELECT A.id_cargo,A.id_nivel,A.cargo,C.nome AS nivel FROM cargos AS A
                                    INNER JOIN unidades_cargos AS B ON (B.id_cargo=A.id_cargo)
                                    INNER JOIN niveis AS C ON (C.id_nivel=A.id_nivel)
                                    WHERE B.id_unidade = '{$_REQUEST['unidade']}'");
        $html = "<h4>Nenhum cargo encontrado na unidade selecionada, <a href=\"javascript:cargoUnidade({$_REQUEST['unidade']});\">clique aqui para relacionar</a></h4>";
        if (mysql_num_rows($qr_cargos) > 0) {
            $html = "<h4><a href=\"javascript:cargoUnidade({$_REQUEST['unidade']});\">clique aqui para adicionar ou remover cargos na unidade selecionada</a></h4>";
            $html .= "<table width=\"100%\" class=\"grid\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                            <thead>
                                <tr>
                                    <th>Nível</th>
                                    <th>Cargo</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>";
            $i=0;
            while ($row = mysql_fetch_assoc($qr_cargos)) {
                $class = (($i++ % 2) == 0) ? "even" : "odd";
                $html .= "<tr class=\"{$class}\">";
                $html .= "<td>{$row['nivel']}</td>";
                $html .= "<td>{$row['cargo']}</td>";
                $html .= "<td class=\"center\"><a href=\"javascript:;\" class=\"icon icon-excluir\" title=\"Excluir\" data-key=\"{$row['id_cargo']}\" >&nbsp;</a></td>";
                $html .= "</tr>";
            }
            $html .= "</tbody></table>";
        }
        echo $html;
        exit;
    } elseif ($_REQUEST['method'] == "pessoa") {
        $nivel_id = $_GET['nivel'];
        $edital = $_GET['edital'];
        
        $return = "<option value=\"-1\">« Selecione »</option>";
        
        $qr_cargo = mysql_query("SELECT A.id_cargo,A.cargo FROM cargos AS A
                                    LEFT JOIN editalpessoal_cargos AS B ON (B.id_cargo=A.id_cargo)
                                    WHERE A.id_nivel = {$nivel_id} AND B.id_edital = {$edital}");
        while ($row_cargo = mysql_fetch_assoc($qr_cargo)){
            $return .= "<option value=\"{$row_cargo['id_cargo']}\">{$row_cargo['cargo']}</option>";
        }
        echo $return;exit;
    }
}

//RELACIONANDO CARGOS A UNIDADES
if (isset($_REQUEST['relacionar']) && !empty($_REQUEST['relacionar'])) {
    $cargos = $_REQUEST['cargos'];
    $qr_cargos = "INSERT INTO unidades_cargos (id_unidade, id_cargo) VALUES  ";
    $qnt_cargos = count($cargos);
    foreach ($cargos as $key => $value) {
        $qr_cargos .= "({$_REQUEST['id']},{$value})";
        if ($key + 1 < $qnt_cargos) {
            $qr_cargos .= ",";
        }
    }
    mysql_query("DELETE FROM unidades_cargos WHERE id_unidade={$_REQUEST['id']}");
    if(mysql_query($qr_cargos)){
        $_SESSION["message"] = "Cargos relacionados com sucesso";
        header("Location: ../adm/cargos.php");
    } else {
        $_SESSION["message"] = "Erro ao relacionar os cargos";
        header("Location: ../adm/cargos.php");
    }
    exit;
}

//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
$cargo = $_REQUEST['cargo'];
$nivel = $_REQUEST['nivel'];

//VERIFICA SE É CADASTRO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    if (mysql_query("INSERT INTO cargos (id_nivel, cargo) VALUES ({$nivel}, '{$cargo}')")) {
        $_SESSION["message"] = "Cargo cadastrado com sucesso";
        header("Location: ../adm/cargos.php");
    } else {
        $_SESSION["message"] = "Erro ao cadastrar o cargo";
        header("Location: ../adm/cargos.php");
    }
} else {
    $id = $_REQUEST['id'];

    if (mysql_query("UPDATE cargos SET id_nivel='{$nivel}', cargo='{$cargo}' WHERE id_cargo = '{$id}'")) {
        $_SESSION["message"] = "Cargo alterado com sucesso";
        header("Location: ../adm/cargos.php");
    } else {
        $_SESSION["message"] = "Erro ao alterar o cargo";
        header("Location: ../adm/cargos.php");
    }
}

?>