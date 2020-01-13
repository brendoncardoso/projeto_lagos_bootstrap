<?php

//CONEXAO COM O BANCO
include("../includes/conecte.php");

function trataTxt($var) {
    $var = strtolower($var);
    
    $var = str_replace(array("á","à","â","ã","ª","Á","À","Â","Ã"), "a", $var);
    $var = str_replace(array("é","è","ê","É","È","Ê"), "e", $var);
    $var = str_replace(array("í","ì","î","Í","Ì","Î"), "i", $var);
    $var = str_replace(array("ó","ò","ô","õ","º","Ó","Ò","Ô","Õ"), "o", $var);
    $var = str_replace(array("ú","ù","û","Ú","Ù","Û"), "u", $var);
    $var = str_replace(array("ç","Ç"), "c", $var);
    $var = str_replace(array("'","\"","-","*","$","%","#","@","!",".",","), "", $var);
    
    return $var;
}

//FUNÇÃO DE UPLOAD
function upload($arquivo, $nomeArquivo) {
    
    $upload = false;
    $error = array();
    if(!empty($arquivo)){
        //FAZENDO A VERIFICAÇÃO DA EXTENÇÃO DO ARQUIVO
        $extensao = explode('.', $arquivo["name"]);
        $extensaoValida = array("doc", "docx", "rtf", "odf", "odt", "pdf", "txt");
        
        if (!in_array($extensao[1], $extensaoValida)) {
            $error[0] = "Por favor, envie arquivos com as seguintes extensões: doc, docx, rtf, odt, pdf, txt";
            
        } else {
            //VERIFICA SE NÃO EXISTIU ERRO
            if (count($error) == 0) {
                //FAZ O UPLOAD DA IMAGEM PARA O SEU RESPECTIVO CAMINHO
                if (!move_uploaded_file($arquivo["tmp_name"], '../resources/curriculos/' . $nomeArquivo)){
                    $error[1] = "erro ao mover o arquivo";
                }else{
                    $upload = true;
                }
            }
        }
    }
    return $upload;
}

//VARIÁVEIS RECUPERADAS
$arquivo = $_FILES['curriculo'];
$nomeArq = $arquivo['name'];
$nome = $_REQUEST['nome'];
$cargo = $_REQUEST['cargo'];
$email = $_REQUEST['email'];
$telefone = $_REQUEST['telefone'];
$telefone = str_replace(array("(",")","-"," "),"",$_REQUEST['telefone']);

//VERIFICA SE EXISTE POST
if ($_REQUEST['enviar'] == "Enviar") {

    //SETA UMA VARIÁVEL PARA UMA FLAG
    $upload = false;
    //VERIFICA SE O INSERT FOI REALIZADO COM SUCESSO
    if (mysql_query("INSERT INTO curriculos (nome,telefone,email,cargo) VALUES ('{$nome}','{$telefone}','{$email}','{$cargo}')")) {
        $upload = true;
    }
    //VERIFICA SE É PARA REALIZAR O UPLOAD
    if ($upload == true) {
        
        //RECUPERA O ULTIDO ID CADASTRADO   
        $ultimoId = mysql_insert_id();
        
        //RECUPERA A EXTESÃO DO ARQUIVO
        $ext = explode('.', $arquivo["name"]);
        
        $nome = str_replace(" ", "_", $nome);
        $nomeArquivo =  trataTxt($nome) ."_". $ultimoId . "." . $ext[1];
       
        //VERIFICA SE ARRAY DE ERROS ESTA VAZIO
        if(upload($arquivo, $nomeArquivo)){
            //UPDATE NA TABELA COM O LINK PARA O CURRICULO
            $sql_arquivo = mysql_query("UPDATE curriculos SET arquivo_curriculo = '{$nomeArquivo}' WHERE id_curriculo = '{$ultimoId}'");
        }  
    }
    
    
    header("Location: ../cadCurriculo.php");
}
?>
