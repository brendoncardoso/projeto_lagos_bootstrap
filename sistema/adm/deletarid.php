<?php

include('../includes/conecte.php');
include('../includes/restricao.php');

    $id_pasta = $_REQUEST['id_pasta'];
    $id_unidade = $_REQUEST['id_unidade'];
    $sql = mysql_query("DELETE FROM prestacao_categoria3 WHERE id_pasta = $id_pasta AND id_unidade = $id_unidade");
    header('location: categoria3.php');
?>