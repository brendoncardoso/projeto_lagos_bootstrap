<?php

include("../includes/conecte.php");
session_start();

if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Estado excluído com sucesso";
        if (!mysql_query("DELETE FROM estados WHERE id = '{$_REQUEST['id']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir o Estado";
        }
        echo json_encode($return);
        exit;
    }
}

//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    $estado = $_POST['estado'];
    $sigla = $_POST['sigla'];
    /*$id_unidade = $_POST['unidade'];
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $setor = $_POST['setor'];*/

    if(mysql_query("INSERT INTO estados (estado, sigla) VALUES ('$estado', '$sigla')")){
        $_SESSION["message"] = "Estado cadastrado com sucesso";
        header("Location: ../adm/estados.php");
    } else {
        $_SESSION["message"] = "Erro ao cadastrar Estado";
        header("Location: ../adm/estados.php");
    }
}else{
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
    $estado = $_POST['estado'];
    $sigla = $_POST['sigla'];

    if (mysql_query("UPDATE estados SET estado='{$estado}', sigla='{$sigla}' WHERE id = '{$_REQUEST['id']}'")) {
        $_SESSION["message"] = "Estado alterado com sucesso";
        header("Location: ../adm/estados.php");
    } else {
        $_SESSION["message"] = "Erro ao alterar usuário";
        header("Location: ../adm/estados.php");
    }
}
?>
