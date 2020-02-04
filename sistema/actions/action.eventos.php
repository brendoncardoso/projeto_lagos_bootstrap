<?php

include("../includes/conecte.php");
session_start();

if(isset($_REQUEST['method']) && $_REQUEST['method']=="exclui") { 
    $return = array("data"=>true);
    $_SESSION["message"] = "Evento excluído com sucesso!";
    if(!mysql_query("DELETE FROM eventos WHERE id = '{$_REQUEST['id']}' ")){
        $return = array("data"=>false);
        $_SESSION["message"] = "Erro ao excluir o Evento!";
    }
    echo json_encode($return);exit;
}

print_r($_REQUEST);

$nome_evento = isset($_REQUEST['nome_evento']) ? $_REQUEST['nome_evento'] : NULL;
$subtitulo = isset($_REQUEST['subtitulo']) ? $_REQUEST['subtitulo'] : NULL;
$data_ini = isset($_REQUEST['data_ini']) ? $_REQUEST['data_ini'] : NULL;
$hora_ini = isset($_REQUEST['hora_ini']) ? $_REQUEST['hora_ini'] : NULL;
$hora_fim = isset($_REQUEST['hora_fim']) ? $_REQUEST['hora_fim'] : NULL;
$nome_local = isset($_REQUEST['nome_local']) ? $_REQUEST['nome_local'] : NULL;
$descricao = isset($_REQUEST['descricao']) && !empty($_REQUEST['descricao']) ? $_REQUEST['descricao'] : NULL;
$programacao = isset($_REQUEST['programacao']) && !empty($_POST['programacao']) ? $_REQUEST['programacao'] : NULL;
$participantes = isset($_REQUEST['participantes']) && !empty($_POST['participantes']) ? $_REQUEST['participantes'] : NULL;
$inscricao = isset($_REQUEST['inscricao']) && !empty($_POST['inscricao'])? $_REQUEST['inscricao'] : NULL;
$regulamento = isset($_REQUEST['regulamento']) && !empty($_POST['regulamento']) ? $_REQUEST['regulamento'] : NULL;
$descricao_radio = $_REQUEST['descricao_radio'];
$programacao_radio = $_REQUEST['programacao_radio'];
$participantes_radio = $_REQUEST['participantes_radio'];
$inscricao_radio = $_REQUEST['inscricao_radio'];
$regulamento_radio = $_REQUEST['regulamento_radio'];
$d_ini = date("Y-m-d", strtotime(str_replace("/", "-", $data_ini)));

if(isset($_REQUEST['enviar']) && $_REQUEST['enviar']=="Cadastrar"){
    if(mysql_query("INSERT INTO eventos (nome_evento, subtitulo, data, hora_ini, hora_fim, nome_local, descricao, programacao, participantes, inscricao, regulamento) VALUES ('$nome_evento', '$subtitulo', '$d_ini', '$hora_ini', '$hora_fim', '$nome_local', '$descricao', '$programacao', '$participantes', '$inscricao', '$regulamento')")){
        $_SESSION["message"] = "Evento cadastrado com sucesso!";
        header("Location: ../adm/eventos.php");
    }else{
        $_SESSION["message"] = "Erro ao cadastrar evento!";
        header("Location: ../adm/eventos.php");
    }
}else{
    $id = $_REQUEST['id'];
    


    if(mysql_query("UPDATE eventos SET nome_evento='$nome_evento', subtitulo='$subtitulo', data='$d_ini', hora_ini='$hora_ini', hora_fim='$hora_fim', nome_local='$nome_local', descricao='$descricao', programacao='$programacao', participantes='$participantes', inscricao='$inscricao', regulamento='{$regulamento}' WHERE id = ".$id."")){
        if($descricao_radio == 2){
            mysql_query("UPDATE eventos SET descricao = NULL WHERE id = ".$id."");
        }

        if($programacao_radio == 2){
            mysql_query("UPDATE eventos SET programacao = NULL WHERE id = ".$id."");
        }

        if($participantes_radio == 2){
            mysql_query("UPDATE eventos SET participantes = NULL WHERE id = ".$id."");
        }

        if($inscricao_radio == 2){
            mysql_query("UPDATE eventos SET inscricao = NULL WHERE id = ".$id."");
        }

        if($regulamento_radio == 2){
            mysql_query("UPDATE eventos SET regulamento = NULL WHERE id = ".$id."");
        }
    
        $_SESSION["message"] = "Evento alterado com sucesso";
        header("Location: ../adm/eventos.php");

    }else{
        $_SESSION["message"] = "Erro ao alterar o Evento";
        header("Location: ../adm/eventos.php");
    }
}

?>