<?php include_once('header.php'); ?>
<?php include_once('breadcrumb.php'); ?>
<?php
    
    if(isset($_REQUEST['busca']) && !empty($_REQUEST['busca'])){
        $tag_request = $_REQUEST['busca'];

        $sql_noticia = "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
        LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND A.tags LIKE '%$tag_request%' ORDER BY A.data DESC";

        $sql_noticias = mysql_query($sql_noticia);
        $sql_noticias_count_isset = mysql_num_rows($sql_noticias);
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
                "img_noticia" => $row['img_noticia'],
                "tags" => explode(",", $row['tags'])
            ];
        }

        $sql_evento = "SELECT * FROM eventos WHERE nome_local LIKE '%$tag_request%' ORDER BY DATA ASC"; 

        $sql_eventos = mysql_query($sql_evento);
        $sql_eventos_rows = mysql_num_rows($sql_eventos);

        while($row = mysql_fetch_assoc($sql_eventos)){
            $arrayEventos[$row['id']] = [
                "nome_evento" => $row['nome_evento'],
                "subtitulo" => $row['subtitulo'],
                "data" => $row['data'],
                "dia_da_semana" => date('w', strtotime($row['data'])),
                "nome_local" => $row['nome_local'],
                "descricao" => $row['descricao'],
                "programacao" => $row['programacao'],
                "participantes" => $row['participantes'],
                "inscricao" => $row['inscricao'],
                "regulamento" => $row['regulamento']
            ];
        }
    }else{
        $sql = "SELECT * FROM eventos ORDER BY DATA ASC";
        $sql_eventos = mysql_query($sql);
        $sql_eventos_rows = mysql_num_rows($sql_eventos);

        while($row = mysql_fetch_assoc($sql_eventos)){
            $arrayEventos[$row['id']] = [
                "nome_evento" => $row['nome_evento'],
                "subtitulo" => $row['subtitulo'],
                "data" => $row['data'],
                "dia_da_semana" => date('w', strtotime($row['data'])),
                "nome_local" => $row['nome_local'],
                "descricao" => $row['descricao'],
                "programacao" => $row['programacao'],
                "participantes" => $row['participantes'],
                "inscricao" => $row['inscricao'],
                "regulamento" => $row['regulamento']
            ];
        }
    }

    if(isset($_POST['buscar_tag']) && !empty($_POST['buscar_tag'])){
        unset($_REQUEST['busca']);
    }

    if(isset($_POST['tags']) && !empty($_POST['tags'])) {
        $teste = $_POST['tags'];
        $tag_post_remove_vazios = explode(",", $_POST['tags']);
        $tag_post = array_filter($tag_post_remove_vazios);
        $quantidade_palavras = count($tag_post);

        $gambiarra_tag = "";
        for($x = 0; $x < $quantidade_palavras; $x++){
            $gambiarra_tag .= " || A.tags LIKE '%".trim($tag_post[$x])."%'";
        };
        
    
        $tags_post_isset = substr($gambiarra_tag, 3);
    
            if($quantidade_palavras <= 1){
                $sql = "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
                LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND A.tags LIKE '%".$tag_post[0]."%' ORDER BY A.data DESC";

                echo "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
                LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND A.tags LIKE '%".$tag_post[0]."%' ORDER BY A.data DESC";
            
            $sql_noticias = mysql_query($sql);
            $sql_noticias_count = mysql_num_rows($sql_noticias);

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
                    "img_noticia" => $row['img_noticia'],
                    "tags" => explode(",", $row['tags'])
                ];
            }
        }else{
                $sql = "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
                LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND $tags_post_isset ORDER BY A.data DESC";

                echo "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
                LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND $tags_post_isset ORDER BY A.data DESC";
            
            $sql_noticias = mysql_query($sql);
            $sql_noticias_count = mysql_num_rows($sql_noticias);

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
                    "img_noticia" => $row['img_noticia'],
                    "tags" => explode(",", $row['tags'])
                ];
            }
        }
    }


    /*$sql_noticias = mysql_query("SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND A.tags LIKE '%$tag_post%' ORDER BY A.data DESC");

    echo "<pre>";
    echo "SELECT A.id_noticia, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) WHERE A.status = 1 AND A.tags LIKE '%$tag_request%'  $tag_post ORDER BY A.data DESC";
    echo "</pre>";*/
?>
    <style>
    .pane_tab{
        margin-left: 8.333333%;
    }
    .removeListStyle{
        list-style: none;
    }
    
    </style>

    <div class="container ajusteContainer" style="margin-top: 80px;">
        <div class="pagina-conteudo pagina-noticias pagina-busca noticias">
            <div class="col-sm-12 "> 
                <!--<p class="text-center">Preencha a sua busca abaixo.</p>
                <form id="form-crud" class="busca" method="post" action="">
                    <div class="row">
                        <div class="coluna col-12 col-sm-12 col-md-12 col-lg-7">
                            <input type="text" name="tags" placeholder="Digite sua Busca. Ex: Tag1, Tag2, Tag 3 ..." class="form-control" value="<?php echo isset($teste) ? $teste : ''; ?>">
                            <p class="border-effect"></p>
                        </div>
                        <div class="coluna col-12 col-sm-12 col-md-12 col-lg-2 d-none d-lg-block">
                            <input type="text" name="inicio" id="data_ini" placeholder="A partir" class="form-control" data-mask="99/99/9999" value="" autocomplete="off" maxlength="10">
                            <p class="border-effect"></p>
                        </div>
                        <div class="coluna col-12 col-sm-12 col-md-12 col-lg-2 d-none d-lg-block">
                            <input type="text" name="fim" id="data_fim" placeholder="Até" class="form-control" data-mask="99/99/9999" value="" autocomplete="off" maxlength="10">
                            <p class="border-effect"></p>
                        </div>
                        <div class="coluna col-12 col-sm-12 col-md-12 col-lg-1">
                            <input type="submit" name="buscar_tag" value="Buscar">
                        </div>
                    </div>
                </form>          -->     
                <div class="row abas">
                    <ul class="nav nav-tabs nav-fill" id="buscaTab" role="tablist">
                        <li class="nav-item removeListStyle">
                            <a class="nav-link <?= !isset($_REQUEST['busca']) ? 'active show' : ''; ?>" id="eventos-tab" data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">Eventos
                                <?php if($sql_eventos_rows > 0) { ?>
                                    <span class="badge badge-warning">
                                        <?php echo $sql_eventos_rows; ?>
                                    </span>
                                <?php } ?>
                            </a>
                        </li>
                        <?php if(isset($_REQUEST['busca']) && !empty($_REQUEST['busca'])) { ?>
                            <li class="nav-item removeListStyle ">
                                <a class="nav-link <?= isset($_REQUEST['busca']) ? 'active' : ''; ?>" id="noticias-tab" data-toggle="tab" href="#noticias" role="tab" aria-controls="noticias" aria-selected="false">Notícias 
                                    <?php if(!isset($_REQUEST['busca'])) { ?>
                                        <?php if($sql_noticias_count == 0) { ?>
                                            
                                        <?php } else { ?>
                                            <span class="badge badge-warning">
                                                <?php echo $sql_noticias_count; ?>
                                            </span>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if($sql_noticias_count_isset == 0) { ?>
                                            
                                            <?php } else { ?>
                                                <span class="badge badge-warning">
                                                    <?php echo $sql_noticias_count_isset; ?>
                                                </span>
                                            <?php } ?>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <!--EVENTOS-->
                <div class="tab-content" id="myTabContent" style="width: 100%">
                    <div class="tab-pane fade getEventos" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">
                        <div class="pagina-conteudo eventos">
                            <div class="row">
                                <?php if($sql_eventos_rows > 0) { ?>
                                    <?php foreach($arrayEventos as $id => $values) { ?>
                                        <div class="col-sm-4 pl-0">
                                            <div class="card">
                                                <div class="img-clip card-img-top" style="background-image: url(&quot;sistema/adm/cms_logo_images/3.png&quot;);"></div>
                                                <div class="card-body">
                                                    <span class="card-tag purple"><?= $values['nome_evento']; ?></span>
                                                    <h5 class="card-title"><?= $values['subtitulo']; ?></h5>
                                                    <?php
                                                        switch($values['dia_da_semana']){
                                                            case 0: $dia_da_semana = "Domingo"; break;
                                                            case 1: $dia_da_semana = "Segunda - Feira"; break;
                                                            case 2: $dia_da_semana = "Terça - Feira"; break;
                                                            case 3: $dia_da_semana = "Quarta - Feira"; break;
                                                            case 4: $dia_da_semana = "Quinta - Feira"; break;
                                                            case 5: $dia_da_semana = "Sexta - Feira"; break;
                                                            case 6: $dia_da_semana = "Sábado"; break;
                                                            default;
                                                        }
                                                    ?>
                                                    <p class="card-text"><?php echo $dia_da_semana." ". date('d/m/Y', strtotime($values['data']))?></p>
                                                </div>
                                                <a href="ver_evento.php?id_evento=<?php echo $id; ?>" target="_blank" class="btn">Saiba Mais</a>
                                            </div>
                                        </div>   
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="alert alert-warning m-0" role="alert" style="width: 100% !important;">
                                        <strong>Atenção!</strong> Nenhum Evento Encontrado.
                                    </div>
                                <?php } ?>
                                  
                            </div>                                                                                                      
                        </div>
                    </div>
                    

                    <!--NOTÍCIAS-->
                    <div class="tab-pane fade getNoticias" id="noticias" role="tabpanel" aria-labelledby="noticias-tab">
                        <div class="pagina-conteudo noticias">
                            <?php if(isset($sql_noticias_count) && !empty($sql_noticias_count) > 0 || isset($sql_noticias_count_isset) && !empty($sql_noticias_count_isset) > 0) { ?>
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
                                        <div class="col-sm-9">
                                            <p class="editorial">
                                                <a href="https://cejam.org.br/noticias/editoria/saude" target="_blank" class="editorial">Saúde</a>
                                            </p>
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
                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Atenção!</strong> Não foi possível encontrar Tags de acordo com campo preenchido.
                                    <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>-->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once('footer.php'); ?>
<script>
    $(document).ready(function(){
        var noticias_tab = $('#noticias-tab').attr('class');
        var eventos_tab = $('#eventos-tab').attr('class');

        if(noticias_tab == 'nav-link active'){
            $('.getNoticias').addClass('active show');
        }

        if(eventos_tab == 'nav-link active show'){
            $('.getEventos').addClass('active show');
        }

        $('#noticias-tab').click(function(){
            $('.getNoticias').addClass('active show');
            $('.getEventos').removeClass('active show');
        })

        $('#eventos-tab').click(function(){
            $('.getNoticias').removeClass('active show');
            $('.getEventos').addClass('active show');
        })

    
    });
</script>