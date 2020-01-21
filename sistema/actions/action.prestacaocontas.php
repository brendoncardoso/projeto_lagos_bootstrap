<?php

include("../includes/conecte.php");
session_start();

if (isset($_REQUEST['method'])) {
    if($_REQUEST['method'] == 'excluir_pasta'){
        $sql_delete = mysql_query("DELETE FROM pasta WHERE id = '{$_REQUEST['id']}'");
        $_SESSION["message"] = "Pasta excluída com sucesso!";
    } else if ($_REQUEST['method'] == "excluir_arquivo_categoria1"){
        $sql1 = mysql_query("DELETE FROM prestacao_categoria1 WHERE id_pasta = '{$_REQUEST['id_pasta']}';");
        $sql2 = mysql_query("UPDATE pasta SET status = 1 WHERE status = 2 AND id = '{$_REQUEST['id_pasta']}'");
        $_SESSION["message"] = "Arquivo da Categoria 1 foi excluída com sucesso!";
    }else if ($_REQUEST['method'] == "excluir_arquivo_categoria2"){
        $sql = mysql_query("DELETE FROM prestacao_categoria2 WHERE id = '{$_REQUEST['id']}'");
        $_SESSION["message"] = "Arquivo da Categoria 2 foi excluída com sucesso!";
        $sql_num_row = mysql_query("SELECT id_pasta FROM prestacao_categoria2 WHERE id_pasta = '{$_REQUEST['id_pasta']}'");
        $id_num_rows = mysql_num_rows($sql_num_row);
        if(empty($id_num_rows)){
            $sql_update = mysql_query("UPDATE pasta SET STATUS = 1 WHERE STATUS = 3 AND id = '{$_REQUEST['id_pasta']}'");
        }
    } else if($_REQUEST['method'] == "excluir_unidade_categoria3"){
        $sql = mysql_query("DELETE FROM prestacao_categoria3 WHERE id_pasta = '{$_REQUEST['id_pasta']}' AND id_unidade = '{$_REQUEST['id_unidade']}'");
        $_SESSION["message"] = "Unidade excluída com sucesso!";

    } else if($_REQUEST['method'] == "excluir_empresa_categoria3"){
        $sql = mysql_query("DELETE FROM prestacao_categoria3 WHERE id_empresa = '{$_REQUEST['id_empresa']}' AND id_pasta = '{$_REQUEST['id_pasta']}' AND id_unidade = '{$_REQUEST['id_unidade']}'");
        $_SESSION["message"] = "Empresa excluída com sucesso!";

    } else if($_REQUEST['method'] == "excluir_arquivo_categoria3") {
        $sql = mysql_query("DELETE FROM prestacao_categoria3 WHERE id = '{$_REQUEST['id']}'");
        $_SESSION["message"] = "Arquivo excluído com sucesso!";

        $sql_num_row = mysql_query("SELECT id_pasta FROM prestacao_categoria3 WHERE id_pasta = '{$_REQUEST['id_pasta']}'");
        $id_num_rows = mysql_num_rows($sql_num_row);
        
        if(empty($id_num_rows)){
            $sql_update = mysql_query("UPDATE pasta SET STATUS = 1 WHERE STATUS = 4 AND id = '{$_REQUEST['id_pasta']}'");
        }
    }
}




