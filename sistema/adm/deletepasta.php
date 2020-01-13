<?php
    include('../includes/conecte.php');
    include('../includes/restricao.php');

    $id = $_REQUEST['id'];

    $sql_delete = mysql_query("DELETE FROM pasta WHERE id = $id");
    //echo "DELETE FROM pasta WHERE id = $id;";

    header('location: cadastrarpasta.php');
?>