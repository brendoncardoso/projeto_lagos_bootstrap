<?php
session_start();

//senha rh lagos2012rh
//echo md5("lagos2012rh");

if(!isset($_SESSION['logado'])){	
    header('Location: index.php');
}

$setor = $_SESSION['setor'];

?>