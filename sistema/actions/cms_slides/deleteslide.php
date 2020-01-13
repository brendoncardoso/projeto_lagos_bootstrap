<?php
include("../../includes/conecte.php");
session_start();

$sql = mysql_query("DELETE FROM cms_slides WHERE id_img = {$_REQUEST['valor']}");
echo "DELETE FROM cms_slides WHERE id_img = {$_REQUEST['valor']}";
exit;
?>