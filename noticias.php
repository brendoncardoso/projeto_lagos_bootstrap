<?php 
include_once('header.php');
include_once('breadcrumb.php');

$sql_noticias_paginacao = mysql_query("SELECT * FROM noticias");
$count_posts = mysql_num_rows($sql_noticias_paginacao);

$p = 0;
$limit = 5;
$pg = 1;

if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
    $pg = addslashes($_GET['pagina']);
}

$p = ($pg - 1) * $limit;

$sql_noticias = mysql_query("SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data
FROM noticias AS A
LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia)
WHERE A.STATUS = 1
ORDER BY A.data DESC LIMIT $p, $limit");

$sql_noticias_num_rows = mysql_num_rows($sql_noticias);
while($row = mysql_fetch_assoc($sql_noticias)){
    $arrayNoticias[$row['id_noticia']] = [
        "titulo" => $row['titulo'],
        "subtitulo" => $row['subtitulo'],
        "texto" => $row['texto'],
        "data" => $row['data'],
        "fonte" => $row['fonte'],
        "link" => $row['link'],
        "status" => $row['status'],
        "status_img" => $row['status_img'],
        "prioridade" => $row['prioridade'], 
        "img_noticia" => $row['img_noticia']
    ];
}

$paginas = $count_posts/$limit;

if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
    $busca = $_POST['titulo'];
    $sql = mysql_query("SELECT * FROM noticias WHERE titulo LIKE '%$busca%'");
    echo "SELECT * FROM noticias WHERE titulo LIKE '%$busca%'";
    exit;
}else if(isset($_POST['data_ini']) && !empty($_POST['data_ini'])){
    $data_ini = $_POST['data_ini'];
    $sql = mysql_query("SELECT * FROM noticias WHERE data LIKE '%$data_ini%'");
    echo "SELECT * FROM noticias WHERE data LIKE '%$data_ini%'";
    exit;
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
                        <select name="editorial_id" id="editorial_id" class="select2 form-control" style="height: 100% !important;border:none;">
                            <option value="">Escolha um Edital</option>
                                <option value="d5c45c60-768b-11e9-bd85-9106edd042b8"></option>
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
            <?php if(!empty($sql_noticias_num_rows) || $sql_noticias_num_rows > 0) { ?>
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
                                <a href="" class="editorial">Edital</a>
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
                                <a href="https://cejam.org.br/noticias/fala-saude-01--hanseniase">
                                    <?php echo $values['titulo']; ?>
                                </a>
                            </p>
                            <div class="sub-titulo noticia_resumo">
                                <?php echo $values['subtitulo']; ?>
                            </div>
                            <p class="links">
                                <!--<a href="https://cejam.org.br/busca/janeiro-roxo" class="tags">Janeiro Roxo</a>
                                <a href="https://cejam.org.br/busca/hanseniase" class="tags">Hanseníase</a>
                                <a href="https://cejam.org.br/busca/institucional" class="tags">Institucional</a>
                                <a href="https://cejam.org.br/busca/tv-cejam" class="tags">TV CEJAM</a>-->
                                <a href="ver_noticia.php?id_noticia=<?php echo $id_noticia; ?>" class="leia-mais">Leia Mais</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
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
                SINTO MUITO MEU CHAPA
            <?php } ?>
        </div>
    </div>
        
<?php include_once('footer.php'); ?>