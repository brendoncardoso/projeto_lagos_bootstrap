<?php

include("../includes/conecte.php");
session_start();

//print_r($_REQUEST);exit;
if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Unidade excluída com sucesso";
        if (!mysql_query("DELETE FROM unidades WHERE id_unidade = '{$_REQUEST['unidade']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a unidade";
        }
        echo json_encode($return);
        exit;
    }
}

//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
$nome = $_REQUEST['nome'];
$endereco = $_REQUEST['endereco'];
$bairro = $_REQUEST['bairro'];
$cidade = $_REQUEST['cidade'];
$cep = $_REQUEST['cep'];
$uf = strtoupper($_REQUEST['uf']);

//VERIFICA SE É CADASTRO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    if (mysql_query("INSERT INTO unidades (nome, endereco, bairro, cidade, uf, cep, status) VALUES ('$nome', '$endereco', '$bairro', '$cidade', '$uf', '$cep', '1')")) {
        $_SESSION["message"] = "Unidade cadastrada com sucesso";
        header("Location: ../adm/unidades.php");
    } else {
        $_SESSION["message"] = "Erro ao cadastrar a unidade";
        header("Location: ../adm/unidades.php");
    }
} else {
    $id = $_REQUEST['id'];
    
    if (mysql_query("UPDATE unidades SET nome='{$nome}', endereco='{$endereco}', bairro='{$bairro}', cidade='{$cidade}', uf='{$uf}', cep='{$cep}' WHERE id_unidade = '{$id}'")) {
        $_SESSION["message"] = "Unidade alterada com sucesso";
        header("Location: ../adm/unidades.php");
    } else {
        $_SESSION["message"] = "Erro ao alterar a unidade";
        header("Location: ../adm/unidades.php");
    }
}
?>
