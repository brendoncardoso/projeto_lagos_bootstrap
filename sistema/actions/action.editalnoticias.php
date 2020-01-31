<?php

include("../includes/conecte.php");
session_start();



//print_r($_REQUEST);exit;
if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Edital de Notícias excluída com sucesso!";
        if (!mysql_query("DELETE FROM editalnoticias WHERE id_editalnoticia = '{$_REQUEST['id_editalnoticia']}'")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a Edital de Notícias!";
        }
        echo json_encode($return);
        exit;
    }
}

if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    if(mysql_query("INSERT INTO editalnoticias (nome_edital) VALUES ('{$_REQUEST['nome_edital']}');")){
        $_SESSION["message"] = "Edital de Notícias Cadastrado com sucesso!";
        header('location: ../adm/noticiasform.php');
    }
}else if(isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Salvar"){
    if(mysql_query("UPDATE editalnoticias SET nome_edital = '{$_REQUEST['nome_edital']}'  WHERE id_editalnoticia = '{$_REQUEST['id']}'")){
        $_SESSION["message"] = "Edital de Notícias alterado com sucesso!";
        header('location: ../adm/editalnoticiaform.php');
    }
}

?>