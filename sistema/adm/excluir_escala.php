<?php

include('../includes/conecte.php');
include('../includes/restricao.php');

if (isset($_GET['id_escala']) && !empty($_GET['id_escala']) && 
    isset($_GET['ano']) && !empty($_GET['ano']) && 
    isset($_GET['id_unidade']) && !empty($_GET['id_unidade'])) {
    
    $mes = addslashes($_GET['id_escala']);
    $ano = addslashes($_GET['ano']);
    $id_unidade = addslashes($_GET['id_unidade']);
    $setor = $_GET['setor'];
    
    $sql = mysql_query("DELETE FROM escala WHERE mes = " . $mes . " AND setor = '" . $setor . "' AND ano = " . $ano . " AND id_unidade = " . $id_unidade);
    header("Location: escala.php");
    exit;
}

