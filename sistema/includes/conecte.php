<?php

if($_SERVER['HTTP_HOST'] != "localhost" && $_SERVER['HTTP_HOST'] != "localhost:8080"){
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $banco = 'lagosrio_sistema';
	
	// SQL server connection information dataTable
	$sql_details = array(
		'user' => 'root',
		'pass' => '',
		'db'   => 'lagosrio_sistema',
		'host' => 'localhost'
	);
}else{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $banco = 'lagosrio_sistema';
}

mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco);
mysql_query("SET NAMES utf8");

?>