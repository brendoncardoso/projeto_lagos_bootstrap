<?php
include('../includes/conecte.php');
include('../includes/restricao.php');

if(isset($_REQUEST['method']) && $_REQUEST['method'] != ""){
    $retorno = array("status" => 0);
        
    if($_REQUEST['method'] == "altera_arquivo"){
        
        $arquivo_antigo = $_REQUEST['id'];
        $dir = "rel_execucao/{$arquivo_antigo}";
        
        $arquivo_novo = $_FILES['file'];
        $nome_an = $arquivo_novo['name'];
        
        if(file_exists($dir)){
//            unlink($dir);
            $retorno = array("arquivo antigo" => $arquivo_antigo, "arquivo novo" => $arquivo_novo);
        }
        
//        if(getFuncionarioId($id_fun)){
//            $retorno = array("status" => 1, "nome" => $row['nome'], "cpf" => $row['cpf'], "banco" => $row['banco'], "agencia" => $row['agencia'], "conta" => $row['conta']);
//        }                
        
        echo json_encode($retorno);
        exit();
    }
}
?>