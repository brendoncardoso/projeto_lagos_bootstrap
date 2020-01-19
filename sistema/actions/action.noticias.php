<?php

include("../includes/conecte.php");
session_start();

//print_r($_REQUEST);exit;
if (isset($_REQUEST['method'])) {
    if ($_REQUEST['method'] == "exclui") {
        $return = array("data" => true);
        $_SESSION["message"] = "Notícia excluída com sucesso";
        if (!mysql_query("DELETE FROM noticias WHERE id_noticia = '{$_REQUEST['noticia']}' ")) {
            $return = array("data" => false);
            $_SESSION["message"] = "Erro ao excluir a notícia";
        }
        echo json_encode($return);
        exit;
    }
}

if (isset($_REQUEST['method']) && !empty($_REQUEST['method']) == "excluir_thumb") {
    $sql_update_view = mysql_query("UPDATE noticias SET status_img = 0 WHERE id_noticia = {$_REQUEST['id_noticia']}");
    $sql_delete_thumb = mysql_query("DELETE FROM cms_img_noticia WHERE id_noticia = {$_REQUEST['id_noticia']}");
    $_SESSION["message"] = "Thumbnail atualizado com sucesso!";    
}


//POPULA AS VARIAVEIS PARA A INSERÇÃO OU EDIÇÃO
$titulo = $_REQUEST['titulo'];
$subtitulo = $_REQUEST['subtitulo'];
$texto = $_REQUEST['fckExemplo'];
$fonte = $_REQUEST['fonte'];
$link = $_REQUEST['link'];
$data = date("Y-m-d H:i:s");
$prioridade = $_REQUEST['prioridade'];
$imagem_noticia = $_REQUEST['imagem_noticia'];
$id_noticia = $_REQUEST['id_noticia'];


//VERIFICA SE É CADASTRO
if (isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar") {
    if(isset($_FILES['imagem_noticia']['name']) && !empty($_FILES['imagem_noticia']['name'])){
        $extensoes = array('jpg', 'png', 'jpeg');
        $nome_img = $_FILES['imagem_noticia']['name'];
        $extensao = strtolower(end(explode('.', $nome_img)));

        if (array_search($extensao, $extensoes) === false) {
            $_SESSION["message"] = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou jpeg";
            header("Location: ../adm/noticias.php");
        }else{
            $pasta = "../adm/cms_img_noticias";

            if(!is_dir($pasta)){
                mkdir($pasta);
            }

            $sql = mysql_query ("INSERT INTO noticias (titulo, subtitulo, texto, data, fonte, link, prioridade, status_img) VALUES ('$titulo', '$subtitulo', '$texto', '$data', '$fonte', '$link', '$prioridade', 1)") &&
            $get_id_noticia = mysql_query("SELECT LAST_INSERT_ID()");
            $last_id = mysql_fetch_assoc($get_id_noticia);
            $last_id_noticia = $last_id['LAST_INSERT_ID()'];
            
            if ($sql &&
                mysql_query("INSERT INTO cms_img_noticia (id_noticia, img_noticia) VALUES ($last_id_noticia, '$nome_img')") && move_uploaded_file($_FILES['imagem_noticia']['tmp_name'], $pasta."/".$nome_img)) {
                $_SESSION["message"] = "Notícia cadastrada com sucesso";
                header("Location: ../adm/noticias.php");
            } else {
                $_SESSION["message"] = "Erro ao cadastrar a notícia";
                header("Location: ../adm/noticias.php");
            }
        }
    }else{
        if (mysql_query("INSERT INTO noticias (titulo, subtitulo, texto, data, fonte, link, prioridade) VALUES ('$titulo', '$subtitulo', '$texto', '$data', '$fonte', '$link', '$prioridade')")) {
            $_SESSION["message"] = "Notícia cadastrada com sucesso";
            header("Location: ../adm/noticias.php");
        } else {
            $_SESSION["message"] = "Erro ao cadastrar a notícia";
            header("Location: ../adm/noticias.php");
        }
    }
} else {
    $id = $_REQUEST['id'];

    if(isset($_FILES['imagem_noticia']['name']) && !empty($_FILES['imagem_noticia']['name'])){
        $extensoes = array('jpg', 'png', 'jpeg');
        $nome_img = $_FILES['imagem_noticia']['name'];
        $extensao = strtolower(end(explode('.', $nome_img)));

        if (array_search($extensao, $extensoes) === false) {
            $_SESSION["message"] = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou jpeg";
            header("Location: ../adm/noticias.php");
        }else{
            $pasta = "../adm/cms_img_noticias";

            if(!is_dir($pasta)){
                mkdir($pasta);
            }

            if (mysql_query("UPDATE noticias SET titulo='{$titulo}', subtitulo='{$subtitulo}', texto='{$texto}', fonte='{$fonte}', link='{$link}', status_img = 1 WHERE id_noticia = '{$id}'") &&
                mysql_query("INSERT INTO cms_img_noticia (id_noticia, img_noticia) VALUES ($id, '$nome_img')") &&  move_uploaded_file($_FILES['imagem_noticia']['tmp_name'], $pasta."/".$nome_img)) {
                $_SESSION["message"] = "Notícia alterada com sucesso";
                header("Location: ../adm/noticias.php");
            } else {
                $_SESSION["message"] = "Erro ao alterar a notícia";
                header("Location: ../adm/noticias.php");
            } 
        }
    }else{
        if (mysql_query("UPDATE noticias SET titulo='{$titulo}', subtitulo='{$subtitulo}', texto='{$texto}', fonte='{$fonte}', link='{$link}' WHERE id_noticia = '{$id}'")) {
            $_SESSION["message"] = "Notícia alterada com sucesso";
            header("Location: ../adm/noticias.php");
        } else {
            $_SESSION["message"] = "Erro ao alterar a notícia";
            header("Location: ../adm/noticias.php");
        } 
    }
} 


?>
