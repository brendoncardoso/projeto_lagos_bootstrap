<?php
include("../../includes/conecte.php");
session_start();

$sql1 = mysql_query("UPDATE noticias SET status_img = 0 WHERE id_noticia = {$_REQUEST['id_noticia']}");
$sql1 = mysql_query("DELETE FROM cms_img_noticia WHERE id_noticia = {$_REQUEST['id_noticia']}");


?>