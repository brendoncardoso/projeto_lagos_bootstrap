<?php
    include('../includes/conecte.php');
    session_start();

//VERIFICA SE É PARAL SALVAR
if (isset($_REQUEST['method']) && $_REQUEST['method'] == "salvar_logo") {
    $sql_select = mysql_query("SELECT max(id) AS last_id from cms_logo WHERE STATUS = 1");
    $sql_verifica_status = mysql_fetch_assoc($sql_select);
    $last_id = $sql_verifica_status['last_id'];

    if(!empty($last_id)){
        $sql_update_status = mysql_query("UPDATE cms_logo SET status = 0 WHERE id = '$last_id'");
    }
    $sql = mysql_query("UPDATE cms_logo SET status = 1 WHERE id = '{$_REQUEST['id_logo']}'");
    header('location: ../adm/cms.php'); 
    $_SESSION["message"] = "Logo atualizado com sucesso!";
    
}else if(isset($_REQUEST['method']) && $_REQUEST['method'] == "excluir_logo") {
    $sql_excluir = mysql_query("DELETE FROM cms_logo WHERE id = '{$_REQUEST['id_logo']}'");
    $_SESSION["message"] = "Logo excluída com Sucesso!";
} ?>

