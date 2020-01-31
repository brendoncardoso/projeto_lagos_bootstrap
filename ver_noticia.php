<?php include_once('header.php'); ?>
<?php include_once('breadcrumb.php'); ?>
<?php 
    $id = isset($_GET['id_noticia']) ? $_GET['id_noticia'] : ''; 
    $sql = mysql_query("SELECT * FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) WHERE A.id_noticia =". $id);
    
    while($row = mysql_fetch_assoc($sql)) {
        $verifica_tag = $row['tags'];

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

    if(!empty($verifica_tag)){
        $act = 1;
    }else{
        $act = 0;
    }

    $sql_leia_tambem = mysql_query("SELECT A.id_noticia, C.nome_edital, A.titulo, A.subtitulo, A.texto, A.tags, A.fonte, A.link, A.prioridade, B.img_noticia, A.status, A.status_img, A.data FROM noticias AS A
    LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia) LEFT JOIN editalnoticias AS C ON (A.id_editalnoticia = C.id_editalnoticia) ORDER BY A.id_noticia DESC LIMIT 5");
    while($row_leia_tambem = mysql_fetch_assoc($sql_leia_tambem)){
        $arrayLeiaTambem[$row_leia_tambem['id_noticia']] = [
            "nome_edital" => $row['nome_edital'],
            "titulo" => $row_leia_tambem['titulo'],
            "subtitulo" => $row_leia_tambem['subtitulo'],
            "texto" => $row_leia_tambem['texto'],
            "data" => $row_leia_tambem['data'],
            "fonte" => $row_leia_tambem['fonte'],
            "link" => $row_leia_tambem['link'],
            "status" => $row_leia_tambem['status'],
            "status_img" => $row_leia_tambem['status_img'],
            "prioridade" => $row_leia_tambem['prioridade'], 
            "img_noticia" => $row_leia_tambem['img_noticia'],
        ];
    }
?>



<div class="conteudo">
    <div class="pagina-noticias pagina-conteudo noticias">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <div class="row">
                    <div class="col-sm-8 noticia-interna">
                       
                        <?php foreach($arrayNoticias AS $id_noticia => $values) { ?>
                            <?php if(!empty($values['nome_edital'])) { ?>
                                <p class="editorial d-none d-lg-block">
                                    <a href="" class="editorial"><?= $values['nome_edital']; ?></a>
                                </p>
                                
                                <a href="" class="editorial-mobile d-block d-lg-none"><?= $values['nome_edital']; ?></a>
                            <?php } ?>
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
                                    
                            <p class="data"><?php echo "$dia de $nome_mes de $ano"; ?></p>

                            <h1><?php echo $values['titulo'];?></h1>

                            <p class="subtitulo"><?php echo $values['subtitulo']; ?></p> 

                            <div class="texto">
                                <?php echo $values['texto']?>
                                <b>Fonte: </b> <?php echo $values['fonte']; ?>
                            </div>

                            <p class="tags text-left">
                                <?php if($act == 1) { ?>
                                    <i class="fa fa-tags fa-2x" aria-hidden="true"></i>
                                <?php } ?>
                                
                                <?php foreach($values['tags'] AS $tags) { ?>
                                    <?php if(!empty($tags) || $tags != NULL) { ?>
                                        <a href="eventos_programas.php?busca=<?php echo urlencode(trim($tags)); ?>"><?php echo $tags; ?></a>
                                    <?php } ?>
                                <?php } ?>
                            </p>
                            
                                                    
                            <!--<div class="texto">
                                <p><span style="font-weight: 400;">O Natal costuma ser uma época na qual a paz, o amor e a confraternização se evidenciam em ações de solidariedade e união. É um momento de respeito, alegria e harmonia. E esse misto de sentimentos positivos foi desfrutado no último sábado (07) por mais de 250 pessoas, na Igreja Missão Paz, Baixada do Glicério, onde ocorreu a </span><strong>14ª Edição da Campanha Natal com Saúde</strong><span style="font-weight: 400;">.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">Com decoração natalina num dia de céu aberto, o salão da igreja foi preparado por voluntários do </span><strong>Programa Dr. Conforto</strong><span style="font-weight: 400;">, que transformaram o local em ambiente acolhedor para as 160 crianças que chegariam em seguida, pulando de alegria e ansiosas pelas surpresas que as aguardavam.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">Trampolim, piscina de bolinhas, escorregador, além de outros brinquedos infláveis, ficaram à disposição dos pequenos, que se revezavam em filas para brincar. Quem optasse por brincadeiras tradicionais podia se divertir pulando corda com o auxílio de recreadores.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">Atividades culturais também não ficaram de fora da festa. Teve origami, desenho, pintura, maquiagem artística, spray de cabelo e até tatuagem removível, de modo que os pequenos encheram o espaço com as mais variadas cores.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">Na hora do lanche, foram distribuídos saquinhos de pipoca, algodão doce, cachorro-quente, salgadinhos, sorvete e outras guloseimas para a criançada e suas famílias, que acompanharam a comemoração. Além disso, 149 crianças beneficiadas pelo Programa Viva Leite receberam sacolinhas de natal, contendo roupas e brinquedos.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">Outro destaque na festa foi a visita do Papai Noel, marcada por abraços e fotografias que ficarão na lembrança dos pequenos como um momento único. A Pepa Pig, personagem de desenho infantil, também esteve presente, junto de um robô com mais de dois metros de altura que deixou os pequenos impressionados, convidando-os para brincar em volta de sua estrutura.&nbsp;</span></p>
                                <p><span style="font-weight: 400;">“O Natal com Saúde representa a concretização do nosso trabalho, por meio de pequenos gestos de solidariedade que, juntos, se tornam grandes momentos de alegria, amor, união, gratidão e companheirismo, transformando a realidade dessas pessoas, seja por meio dos presentes, do Papai Noel, da família ou até mesmo da doação do nosso tempo em prol de uma causa maior, fortalecendo o vínculo com as famílias acolhidas pelo Instituto de Responsabilidade Social CEJAM”, destaca Tatiane Gomes, coordenadora do IRS.</span></p>
                                <p><span style="font-weight: 400;">A 14ª Edição do Natal com Saúde, realizada pelo <strong>CEJAM</strong> por meio de seu Instituto de Responsabilidade Social, contou com parceria de 26 voluntários do Programa Dr. Conforto, e das empresas Nelmar, Clover Printers, Linemed, Alsa Fort, DotCom, Sodexo e Controle Geral.&nbsp;</span></p>
                                <p><b>Fonte: </b>Imprensa, Comunicação &amp; Marketing</p>
                            </div>-->
                            <!--<p class="tags text-left">
                                <i class="fa fa-tags fa-2x" aria-hidden="true"></i>
                                <a href="https://cejam.org.br/busca/instituto-de-responsabilidade-social">INSTITUTO DE RESPONSABILIDADE SOCIAL</a>
                                <a href="https://cejam.org.br/busca/responsabilidade-social">Responsabilidade Social</a>
                                <a href="https://cejam.org.br/busca/sao-paulo">São Paulo</a>
                            </p>-->
                        </div>
                    <?php } ?>
                    <div class="col-sm-4 noticia-lateral">
                        <!--<div class="compartilhe">
                            <h1>Compartilhe essa notícia</h1>
                            <div class="row">
                                <div class="icon-share">
                                    <a id="facebook-share-btt" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas&amp;amp;src=sdkpreparse" target="_blank"><img src="https://cejam.org.br/img/layout/fb-noticias.png" class="img-fluid fb-share-button"></a>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {            
                                        //altera a URL do botão
                                        document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas&amp;src=sdkpreparse";
                                    }, false);
                                </script>
                                <div class="icon-share">
                                    <a href="https://api.whatsapp.com/send?text=14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas" id="whatsapp-share-btt" rel="nofollow" target="_blank"><img src="https://cejam.org.br/img/layout/whatsapp-noticias.png" class="img-fluid"></a>
                                </div>
                                <script>
                                    //Constrói a URL depois que o DOM estiver pronto
                                    document.addEventListener("DOMContentLoaded", function() {
                                        //conteúdo que será compartilhado: Título da página + URL
                                        var conteudo = encodeURIComponent(document.title + " " + window.location.href);
                                        //altera a URL do botão
                                        document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas";
                                    }, false);
                                </script>
                                <div class="icon-share">
                                    <a href="https://twitter.com/intent/tweet?url=https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas&amp;text=14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças" id="twitter-share-btt" rel="nofollow" target="_blank"><img src="https://cejam.org.br/img/layout/twitter-noticias.png" class="img-fluid"></a>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url=https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas&text=14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças";
                                    }, false);                                    
                                </script>
                                <div class="icon-share">
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://cejam.org.br/noticias/14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas&amp;title=14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças&amp;summary=%26lt%3Bp%26gt%3B%26lt%3Bspan%20style%3D%26quot%3Bfont-weight%3A%20400%3B%26quot%3B%26gt%3BO%20Natal%20costuma%20ser%20uma%20%C3%A9poca%20na%20qual%20a%20paz%2C%20o%20amor%20e%20a%20confraterniza%C3%A7%C3%A3o%20se%20evidenciam%20em%20a%C3%A7%C3%B5es%20de%20solidariedade%20e%20uni%C3%A3o.%20%C3%89%20um%20momento%20de%20respeito%2C%20alegria%20e%20harmoni..." id="linkedin-share-btt" rel="nofollow" target="_blank"><img src="https://cejam.org.br/img/layout/linkedin-noticias.png" class="img-fluid"></a>
                                </div>
                                <script>
                                    //Constrói a URL depois que o DOM estiver pronto
                                    document.addEventListener("DOMContentLoaded", function() {

                                        
                                        //tenta obter o conteúdo da meta tag description
                                        var slug = "14-edicao-da-campanha-natal-com-saude-reune-mais-de-250-pessoas-em-festa-para-criancas";
                                        // console.log('slug ' +slug);
                                        var titulo = "14ª Edição da Campanha Natal com Saúde reúne mais de 250 pessoas em festa para crianças";
                                        // console.log('titulo ' +titulo);
                                        var summary = "&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;O Natal costuma ser uma época na qual a paz, o amor e a confraternização se evidenciam em ações de solidariedade e união. É um momento de respeito, alegria e harmoni..."
                                        // console.log('summary '+summary);
                                        var linkedinLink = "https://www.linkedin.com/shareArticle?mini=true&url=https://cejam.org.br/noticias/"+slug+"&title="+titulo+"&summary="+encodeURIComponent(summary);
                                        // console.log(linkedinLink);

                                        document.getElementById("linkedin-share-btt").href = linkedinLink;
                                    }, false);                                    
                                </script>
                            </div>
                        </div>-->
                        <div class="mais-lidas">
                            <!--<h1>Mais Lidas</h1>
                            <div class="row noticia">
                                <hr>
                                <div class="col-lg-3 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <span>1</span>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <a href="https://cejam.org.br/noticias/cursos-auxiliar-e-tecnico-de-enfermagem-da-escola-de-saude-cejam-matriculas-abertas">
                                        Cursos Auxiliar e Técnico de Enfermagem da Escola de Saúde CEJAM. Matrículas abertas 
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <hr>
                                <div class="col-lg-3 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <span>2</span>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <a href="https://cejam.org.br/noticias/prefeitura-de-sao-paulo-anuncia-ampliacao-do-mae-paulistana-cejam-atuara-em-37-maternidades-com-o-programa">
                                        Prefeitura de São Paulo anuncia ampliação do Mãe Paulistana; CEJAM atuará em 37 maternidades com o programa
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <hr>
                                <div class="col-lg-3 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <span>3</span>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <a href="https://cejam.org.br/noticias/missa-em-homenagem-ao-fundador-e-superintendente-do-cejam-dr-fernando-proenca-de-gouvea">
                                        Missa em homenagem ao fundador e superintendente do CEJAM, Dr. Fernando Proença de Gouvêa
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <hr>
                                <div class="col-lg-3 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <span>4</span>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <a href="https://cejam.org.br/noticias/cejam-assume-administracao-do-hospital-municipal-de-cajamar">
                                        CEJAM assume administração do Hospital Municipal de Cajamar
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <hr>
                                <div class="col-lg-3 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <span>5</span>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <a href="https://cejam.org.br/noticias/cejam-estreia-novo-programa-de-integracao-com-a-comunidade">
                                        CEJAM estreia novo programa de integração com a comunidade
                                    </a>
                                </div>
                            </div>-->
                        </div>
                        <div class="leia-tambem">
                            <h1>Leia Também</h1>
                            <?php foreach($arrayLeiaTambem as $id_noticia => $values) { ?>
                                <div class="row noticia">
                                    <div class="col-lg-1 grafismo d-none d-lg-block">
                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-12 col-lg-11 titulo">
                                        <a href="ver_noticia.php?id_noticia=<?php echo $id_noticia; ?>">
                                            <?php echo $values['titulo']; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--<div class="row noticia">
                                <div class="col-lg-1 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-12 col-lg-11 titulo">
                                    <a href="https://cejam.org.br/noticias/prefeitura-de-sao-paulo-promove-semana-de-mobilizacao-contra-a-dengue">
                                        Prefeitura de São Paulo promove semana de mobilização contra a Dengue
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <div class="col-lg-1 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-12 col-lg-11 titulo">
                                    <a href="https://cejam.org.br/noticias/fala-saude-01--hanseniase">
                                        Fala Saúde #01 | Hanseníase
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <div class="col-lg-1 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-12 col-lg-11 titulo">
                                    <a href="https://cejam.org.br/noticias/hospital-evandro-freire-recebe-novo-tomografo-e-batiza-auditorio-em-homenagem-a-dr-fernando-proenca-de-gouvea">
                                        Hospital Evandro Freire recebe novo tomógrafo e batiza auditório em homenagem a Dr. Fernando Proença de Gouvêa
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <div class="col-lg-1 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-12 col-lg-11 titulo">
                                    <a href="https://cejam.org.br/noticias/prefeitura-de-sao-paulo-lanca-o-corujao-do-cancer">
                                        Prefeitura de São Paulo lança o Corujão do Câncer
                                    </a>
                                </div>
                            </div>
                            <div class="row noticia">
                                <div class="col-lg-1 grafismo d-none d-lg-block">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-12 col-lg-11 titulo">
                                    <a href="https://cejam.org.br/noticias/confira-o-funcionamento-das-unidades-de-saude-no-feriado-de-aniversario-da-cidade-de-sao-paulo">
                                        Confira o funcionamento das unidades de saúde no feriado de aniversário da cidade de São Paulo
                                    </a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>