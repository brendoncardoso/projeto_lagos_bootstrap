<?php
include("../../includes/conecte.php");
session_start();

$sql_select = mysql_query("SELECT * FROM cms_logo");
$num_rows_sql_select = mysql_num_rows($sql_select);

if($num_rows_sql_select == 0){
    $sql = mysql_query("INSERT INTO cms_logo (id, id_logo) VALUES (1, {$_REQUEST['campanhas_saude']})");
}else if($num_rows_sql_select <= 1){
    $sql = mysql_query("UPDATE cms_logo SET id_logo = {$_REQUEST['campanhas_saude']} WHERE id = 1");
}
exit;
?>
