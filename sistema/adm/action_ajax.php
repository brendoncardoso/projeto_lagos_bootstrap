<?php
include('../includes/conecte.php');
$id = $_REQUEST['id'];
$data = date("Y-m-d");
$sql = "UPDATE curriculos SET data_alterada = '{$data}' WHERE id_curriculo = '{$id}'";
$qr_pessoa = mysql_query($sql);
echo $qr_pessoa;
?>


