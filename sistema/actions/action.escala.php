<?php

include("../includes/conecte.php");
session_start();

//print_r($_REQUEST);exit;
if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Escala excluída com sucesso";
        if (!mysql_query("DELETE FROM escala WHERE id_unidade = '{$_REQUEST['id_unidade']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a Escala";
        }
        echo json_encode($return);
        exit;
    }
}
