<?php
include("../includes/conecte.php");
session_start();

if(isset($_REQUEST['method']) && !empty($_REQUEST['method']) == "excluir_slide") {
    $sql = mysql_query("DELETE FROM cms_slides WHERE id_img = {$_REQUEST['id_slide']}");
    echo "DELETE FROM cms_slides WHERE id_img = {$_REQUEST['id_slide']}";
    header('location: ../adm/cms.php'); 
    $_SESSION["message"] = "Slide excluído com sucesso!";
}

?>