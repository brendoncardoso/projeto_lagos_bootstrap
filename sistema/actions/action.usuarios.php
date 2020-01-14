<?php

include("../includes/conecte.php");
session_start();

if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Usuário excluído com sucesso";
        if (!mysql_query("DELETE FROM usuarios WHERE usu_id = '{$_REQUEST['id_usuario']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a usuário";
        }
        echo json_encode($return);
        exit;
    }
}

//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    $id_unidade = $_POST['unidade'];
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $setor = $_POST['setor'];

    if(mysql_query("INSERT INTO usuarios (id_unidade, login, senha, setor, STATUS) VALUES ('$id_unidade', '$login', '$senha', '$setor', '1')")){
        $_SESSION["message"] = "Usuário cadastrado com sucesso";
        header("Location: ../adm/usuarios.php");
    } else {
        $_SESSION["message"] = "Erro ao cadastrar usuário";
        header("Location: ../adm/usuarios.php");
    }
}else{
    $login = $_POST['login'];
    $id_unidade = $_POST['unidade'];
    $setor = $_POST['setor'];

    if (mysql_query("UPDATE usuarios SET login='{$login}', id_unidade='{$id_unidade}', setor='{$setor}' WHERE usu_id = '{$_REQUEST['id']}'")) {
        $_SESSION["message"] = "Usuário alterado com sucesso";
        header("Location: ../adm/usuarios.php");
    } else {
        $_SESSION["message"] = "Erro ao alterar usuário";
        header("Location: ../adm/usuarios.php");
    }
}
?>
