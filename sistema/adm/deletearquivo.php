<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    $id = $_REQUEST['id'];
    
    $sql = mysql_query("DELETE FROM prestacao_categoria1 WHERE id_pasta = $id;");
    $sql = mysql_query("UPDATE pasta SET status = 1 WHERE status = 2 AND id = $id;");

    header('location: categoria1.php');
?>