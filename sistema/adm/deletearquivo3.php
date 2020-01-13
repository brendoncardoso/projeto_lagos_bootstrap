<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    $id = $_REQUEST['id'];
    $id_pasta = $_REQUEST['id_pasta'];

    $sql = mysql_query("DELETE FROM prestacao_categoria3 WHERE id = $id;");

    $sql_num_row = mysql_query("SELECT id_pasta FROM prestacao_categoria3 WHERE id_pasta = $id_pasta");
    $id_num_rows = mysql_num_rows($sql_num_row);
    
    if(empty($id_num_rows)){
        $sql_update = mysql_query("UPDATE pasta SET STATUS = 1 WHERE STATUS = 4 AND id = $id_pasta");
    }

    header('location: categoria3.php');
?>