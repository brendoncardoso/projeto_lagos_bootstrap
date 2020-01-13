<?php
    $id = $_REQUEST['id'];
    $sql = mysql_query("UPDATE pasta SET STATUS = 0 WHERE STATUS = 1 AND id = $id");
    echo "UPDATE pasta SET STATUS = 0 WHERE STATUS = 1 AND id = $id";
?>