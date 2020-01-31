<?php 
include_once('header.php');
include_once('breadcrumb.php');

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
$mes = date('m'); // Mês desejado, pode ser por ser obtido por POST, GET, etc.
$proximo_mes = date('m', strtotime("+1 week")); 
$ano = date("Y"); // Ano atual
$ultimo_dia = date("Y-m-t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
$primeiro_dia_util = date("Y-m-01", mktime(0,0,0,$proximo_mes,'01',$ano)); // Mágica, plim!


$paginas = 0;
$p = 0;
$limit = 5;
$pg = 1;

if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
    $pg = addslashes($_GET['pagina']);
}

$p = ($pg - 1) * $limit;

$busca = isset($_POST['titulo']) ? $_POST['titulo'] : '';

if(isset($_POST['titulo']) && !empty($_POST['titulo']) 
    && isset($_POST['data_ini']) && !empty($_POST['data_ini'])
        && isset($_POST['data_fim']) && !empty($_POST['data_fim']) 
            && isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia'])){

            $id_editalnoticia = intval($_POST['id_editalnoticia']);
            $data_ini_converter = str_replace("/", "-", $_POST['data_ini']);
            $explode_data_ini = explode('-', $data_ini_converter);
            $data_ini = $explode_data_ini[2]."-".$explode_data_ini[1]."-".$explode_data_ini[0];

            $data_fim_converter = str_replace("/", "-", $_POST['data_fim']);
            $explode_data_fim = explode('-', $data_fim_converter);
            $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
                
            
            if($data_fim == $ano."-".$mes."-".(date('d') + 1)){
                $data_fim = $primeiro_dia_util;
            }else{
                $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
            }
           
            $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");
            $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

            $sql_noticias = mysql_query("SELECT A.id_noticia,  C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");

            echo "SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC";


while($row = mysql_fetch_assoc($sql_noticias)){
    $arrayNoticias[$row['id_noticia']] = [
        "nome_edital" => $row['nome_edital'],
        "titulo" => $row['titulo'],
        "subtitulo" => $row['subtitulo'],
        "texto" => $row['texto'],
        "data" => $row['data'],
        "fonte" => $row['fonte'],
        "link" => $row['link'],
        "status" => $row['status'],
        "status_img" => $row['status_img'],
        "prioridade" => $row['prioridade'], 
        "img_noticia" => $row['img_noticia'],
        "tags" => explode(",", $row['tags'])
    ];
}
}else if(isset($_POST['titulo']) && !empty($_POST['titulo']) 
    && isset($_POST['data_ini']) && !empty($_POST['data_ini'])
        && isset($_POST['data_fim']) && !empty($_POST['data_fim']) ){
            $data_ini_converter = str_replace("/", "-", $_POST['data_ini']);
            $explode_data_ini = explode('-', $data_ini_converter);
            $data_ini = $explode_data_ini[2]."-".$explode_data_ini[1]."-".$explode_data_ini[0];
            $data_fim_converter = str_replace("/", "-", $_POST['data_fim']);
            $explode_data_fim = explode('-', $data_fim_converter);
            $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);

            if($data_fim == $ano."-".$mes."-".(date('d') + 1)){
                $data_fim = $primeiro_dia_util;
            }else{
                $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
            }

            $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");
            $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

            
            $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");


            echo "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
            LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.titulo LIKE '%$busca%' AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC";

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia']) 
&& isset($_POST['data_ini']) && !empty($_POST['data_ini'])
    && isset($_POST['data_fim']) && !empty($_POST['data_fim'])){
        $id_editalnoticia = intval($_POST['id_editalnoticia']);
        $data_ini_converter = str_replace("/", "-", $_POST['data_ini']);
        $explode_data_ini = explode('-', $data_ini_converter);
        $data_ini = $explode_data_ini[2]."-".$explode_data_ini[1]."-".$explode_data_ini[0];

        $data_fim_converter = str_replace("/", "-", $_POST['data_fim']);
        $explode_data_fim = explode('-', $data_fim_converter);
        $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);

        if($data_fim == $ano."-".$mes."-".(date('d') + 1)){
            $data_fim = $primeiro_dia_util;
        }else{
            $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
        }
       
        $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
        LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");
        $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

        $sql_noticias = mysql_query("SELECT A.id_noticia,  C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
        LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");

        echo "SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
        LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  C.id_editalnoticia = $id_editalnoticia AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC";

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}

else if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia'])) {
    $id_editalnoticia = intval($_POST['id_editalnoticia']);

    $sql_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' ORDER BY A.data DESC");

    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    echo "ASELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND C.id_editalnoticia = $id_editalnoticia AND A.titulo LIKE '%$busca%' ORDER BY A.data DESC";

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia']) && empty($_POST['titulo']) && empty($_POST['data_ini']) && empty($_POST['data_fim'])){
    $id_editalnoticia = intval($_POST['id_editalnoticia']);
    

    $sql_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE C.id_editalnoticia = $id_editalnoticia ORDER BY A.data DESC");
    
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE C.id_editalnoticia = $id_editalnoticia ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    echo "SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE C.id_editalnoticia = $id_editalnoticia ORDER BY A.data DESC";

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia']) && isset($_POST['data_ini']) && !empty($_POST['data_ini']) && empty($_POST['titulo'])  && empty($_POST['data_fim'])){
    $sql_num_rows_noticias  = 0;
}else if(isset($_POST['id_editalnoticia']) && !empty($_POST['id_editalnoticia']) && isset($_POST['data_fim']) && !empty($_POST['data_fim']) && empty($_POST['titulo'])  && empty($_POST['data_ini'])){
    $sql_num_rows_noticias  = 0;
}  else if(isset($_POST['data_ini']) && !empty($_POST['data_ini']) && isset($_POST['data_fim']) && !empty($_POST['data_fim']) && empty($_POST['titulo']) && empty($_POST['id_editalnoticia'])) {

    $data_ini_converter = str_replace("/", "-", $_POST['data_ini']);
    $explode_data_ini = explode('-', $data_ini_converter);
    $data_ini = $explode_data_ini[2]."-".$explode_data_ini[1]."-".$explode_data_ini[0];

    $data_fim_converter = str_replace("/", "-", $_POST['data_fim']);
    $explode_data_fim = explode('-', $data_fim_converter);
    $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
    if($data_fim == $ano."-".$mes."-".(date('d') + 1)){
        $data_fim = $primeiro_dia_util;
    }else{
        $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
    }

    $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");
    
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    echo "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.data BETWEEN '$data_ini' AND '$data_fim' ORDER BY A.data DESC";

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}

else if(isset($_POST['data_ini']) && !empty($_POST['data_ini']) && empty($_POST['data_fim']) && empty($_POST['titulo']) && empty($_POST['id_editalnoticia'])) {

              
    $data_ini_converter = str_replace("/", "-", $_POST['data_ini']);
    $explode_data_ini = explode('-', $data_ini_converter);
    $data_ini = $explode_data_ini[2]."-".$explode_data_ini[1]."-".$explode_data_ini[0];
   

    $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE  A.status = 1 AND A.data LIKE '$data_ini' ORDER BY A.data DESC");
    
    ECHO "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE  A.status = 1 AND A.data LIKE '$data_ini' ORDER BY A.data DESC";
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto,  A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE  A.status = 1 AND A.data LIKE '$data_ini' ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(isset($_POST['data_fim']) && !empty($_POST['data_fim']) && empty($_POST['data_ini']) && empty($_POST['titulo']) && empty($_POST['id_editalnoticia'])){
        
    $data_fim_converter = str_replace("/", "-", $_POST['data_fim']);
    $explode_data_fim = explode('-', $data_fim_converter);
    $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
    $sql_ultima_data = mysql_query("SELECT DATE_FORMAT(data, '%d/%m/%Y') AS data_ultimo FROM noticias ORDER BY DATA ASC LIMIT 1");
    $row_data = mysql_fetch_assoc($sql_ultima_data);
    $ultima_data = $row_data['data_ultimo'];
    if($data_fim == $ano."-".$mes."-".(date('d') + 1)){
        $data_fim = $primeiro_dia_util;
    }else{
        $data_fim = $explode_data_fim[2]."-".$explode_data_fim[1]."-".($explode_data_fim[0] + 1);
    }

    $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto,  A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.data BETWEEN '$ultima_data' AND '$data_fim' ORDER BY A.data DESC");
    

    echo "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto,  A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND A.data BETWEEN '$ultima_data' AND '$data_fim' ORDER BY A.data DESC";
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia)  WHERE A.status = 1 AND A.data BETWEEN '$ultima_data' AND '$data_fim' ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(empty($_REQUEST['pagina']) && empty($_POST['titulo']) && empty($_POST['id_editalnoticia']) && empty($_POST['data_ini']) && empty($_POST['data_fim'])){
    
    $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC LIMIT $p, $limit");
    echo "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC LIMIT $p, $limit";
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    $paginas = $sql_num_rows_noticias/$limit;
    $sql_noticias_num_rows = mysql_num_rows($sql_noticias);
        
    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}else if(!empty($_REQUEST['pagina']) && empty($_POST['titulo']) && empty($_POST['id_editalnoticia']) && empty($_POST['data_ini']) && empty($_POST['data_fim'])){
   
    $sql_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC LIMIT $p, $limit");
    echo "SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC LIMIT $p, $limit";
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    $paginas = $sql_num_rows_noticias/$limit;
    $sql_noticias_num_rows = mysql_num_rows($sql_noticias);
    
    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
    
}else if(isset($_POST['titulo']) && !empty($_POST['titulo']) && empty($_POST['id_editalnoticia']) && empty($_POST['data_ini]']) && empty($_POST['data_fim'])){
    unset($_REQUEST['pagina']);
    
   
    $sql_rows_noticias = mysql_query("SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  A.titulo LIKE '%$busca%' ORDER BY A.data DESC");
    $sql_num_rows_noticias = mysql_num_rows($sql_rows_noticias);

    $sql_noticias = mysql_query("SELECT A.id_noticia,  C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  A.titulo LIKE '%$busca%' ORDER BY A.data DESC");

    echo "SELECT A.id_noticia, C.id_editalnoticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags,  A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.status = 1 AND  AND A.titulo LIKE '%$busca%' ORDER BY A.data DESC";

    $paginas = $sql_num_rows_noticias/$limit;
    $sql_noticias_num_rows = mysql_num_rows($sql_noticias);
    
    while($row = mysql_fetch_assoc($sql_noticias)){
        $arrayNoticias[$row['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row['titulo'],
            "subtitulo" => $row['subtitulo'],
            "texto" => $row['texto'],
            "data" => $row['data'],
            "fonte" => $row['fonte'],
            "link" => $row['link'],
            "status" => $row['status'],
            "status_img" => $row['status_img'],
            "prioridade" => $row['prioridade'], 
            "img_noticia" => $row['img_noticia'],
            "tags" => explode(",", $row['tags'])
        ];
    }
}



?>
    <div class="pagina-noticias pagina-conteudo noticias">
        <div class="col-sm-10 offset-sm-1">
            <h1>Notícias</h1>
            <form id="form-crud" class="busca d-none d-lg-block" method="post" action="">
                <input type="hidden" name="_token" value="">                    
                <div class="row">
                    <div class="coluna col-12 col-sm-12 col-md-5 col-lg-5">
                        <input type="text" name="titulo" placeholder="Digite sua Busca" class="form-control">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <?php
                            $sql_edital_noticias = mysql_query("SELECT * FROM editalnoticias WHERE status = 1");
                            $sql_edital_num_rows = mysql_num_rows($sql_edital_noticias);
                            while($row = mysql_fetch_assoc($sql_edital_noticias)){
                                $arrayEditalNoticia[$row['id_editalnoticia']] = [
                                    "nome_edital" => $row['nome_edital']
                                ];    
                            }
                        ?>
                        <select name="id_editalnoticia" id="id_editalnoticia" class="select2 form-control" style="height: 100% !important;border:none;" <?= $sql_edital_num_rows == 0 ? 'disabled' : ''; ?>>
                            <?php if($sql_edital_num_rows == 0) { ?>
                                <option value="">Escolha um Edital</option>
                            <?php } else { ?>
                                <option value="">Escolha um Edital</option>
                                <?php foreach($arrayEditalNoticia AS $id_editalnoticia => $values) { ?>
                                    <option value="<?php echo $id_editalnoticia?>" ><?php echo $values['nome_edital']?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>                         
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <input type="text" name="data_ini" id="data_ini" placeholder="A partir" class="form-control" data-mask="99/99/9999" autocomplete="off" maxlength="10">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <input type="text" name="data_fim" id="data_fim" placeholder="Até" class="form-control" data-mask="99/99/9999" autocomplete="off" maxlength="10">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-1 col-lg-1">
                        <input type="submit" value="Buscar">
                    </div>
                </div>
            </form>
            <?php if(isset($sql_noticias_num_rows) && !empty ($sql_noticias_num_rows) || isset($sql_noticias_num_rows) && !empty($sql_noticias_num_rows) || !empty($sql_num_rows_noticias) || $sql_num_rows_noticias > 0) { ?>
                <?php foreach($arrayNoticias AS $id_noticia => $values) { ?>
                    <div class="d-none d-lg-block">
                        <div class="breadcrumbs noticias separador">
                            <div class="row pagina">
                                <div class="grafismo">
                                    <i class="fa fa-caret-down big" aria-hidden="true"></i>
                                    <i class="fa fa-caret-down small" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row noticia">
                        <div class="col-sm-3">
                            <a href="ver_noticia.php?id_noticia=<?php echo $id_noticia; ?>">
                                <?php if($values['status_img'] == 1) { ?>
                                    <img src="sistema/adm/cms_img_noticias/<?php echo $values['img_noticia']; ?>" alt="..." href="" class="img-fluid">
                                <?php } else  { ?>
                                    <img src="assets/images/0.png" alt="..." href="" class="img-fluid">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="col-sm-9 pos">
                            <p class="editorial d-none d-lg-block">
                                <?php if(!empty($values['nome_edital'])) { ?>
                                    <a href="" class="editorial">
                                        <?= $values['nome_edital']; ?>
                                    </a>
                                <?php } ?>
                            </p>
                            <a href="https://cejam.org.br/noticias/editoria/bem-viver" class="editorial-mobile d-block d-lg-none">Edital</a>
                            <p class="data">
                                <!-- <a href="https://cejam.org.br/noticias/fala-saude-01--hanseniase"> -->
                                    <?php
                                       $dia = date('d', strtotime($values['data'])); 
                                       $mes = date('m', strtotime($values['data'])); 
                                       $ano = date('Y', strtotime($values['data'])); 

                                       switch($mes){
                                            case 1: $nome_mes = "Janeiro"; break;
                                            case 2: $nome_mes = "Fevereiro"; break;
                                            case 3: $nome_mes = "Março"; break;
                                            case 4: $nome_mes = "Abril"; break;
                                            case 5: $nome_mes = "Maio"; break;
                                            case 6: $nome_mes = "Junho"; break;
                                            case 7: $nome_mes = "Julho"; break;
                                            case 8: $nome_mes = "Agosto"; break;
                                            case 9: $nome_mes = "Setembro"; break;
                                            case 10: $nome_mes = "Outubro"; break;
                                            case 11: $nome_mes = "Novembro"; break;
                                            case 12: $nome_mes = "Dezembro"; break;
                                            default;
                                       }
                                    ?>
                                    <?php echo "$dia de $nome_mes de $ano"; ?>                                    
                                <!-- </a> -->
                            </p>
                            <p class="titulo">
                                <a href="ver_noticia.php?id_noticia=<?php echo $id_noticia; ?>">
                                    <?php echo $values['titulo']; ?>
                                </a>
                            </p>

                            <div class="sub-titulo noticia_resumo">
                                <p>
                                    <?php echo $values['subtitulo']; ?>
                                </p>
                            </div>

                            <p class="links">
                                <?php foreach($values['tags'] AS $tags) { ?>
                                    <?php if(!empty($tags) || $tags != NULL) { ?>
                                        <a href="eventos_programas.php?busca=<?php echo urlencode(trim($tags)); ?>" class="tags"><?php echo $tags; ?></a>
                                    <?php } ?>
                                <?php } ?>
                                <a href="ver_noticia.php?id_noticia=<?php echo $id_noticia; ?>" class="leia-mais">Leia Mais</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($paginas) && !empty($paginas)) { ?>
                    <div class="paginador">
                        <ul class="pagination" role="navigation">
                            <li class="page-item <?php echo $pg == "" || $pg == 1 ? 'disabled' : 'active'?>">
                                <a class="page-link" href="?pagina=<?= ($pg - 1); ?>" rel="next" aria-label="« Previous">‹</a>
                            </li>
                            <?php for($x = 0; $x < $paginas; $x++) { ?>
                                <li class="page-item <?= $pg == ($x + 1) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?pagina=<?=($x + 1);?>"><?= ($x + 1);?> </a>
                                </li>
                            <?php } ?>

                            <li class="page-item <?php echo $pg >= $paginas ? 'disabled' : 'active'; ?>">
                                <a class="page-link" href="?pagina=<?= ($pg + 1); ?>" rel="next" aria-label="Next »">›</a>
                            </li>
                        </ul>
                    </div>
                <?php } else { ?>

                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <b>Atenção!</b> Não foi possível encontrar notícias de acordo com os campos preenchidos.
                </div>
            <?php } ?>
        </div>
    </div>
        
<?php include_once('footer.php'); ?>