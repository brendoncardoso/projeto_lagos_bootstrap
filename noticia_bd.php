<?php
    include 'sistema/includes/conecte.php';

    //RESGATANDO A VARIÁVEL PELO MÉTODO GET
    $id_noticia = $_GET['id_noticia'];

    //CONSULTANDO QUERY DE TODAS AS NOTÍCIAS ONDE ID_NOTÍCIA É IGUAL AO ID_NOTÍCIA
    $sql_noticiabd = mysql_query("SELECT * FROM noticias WHERE id_noticia = $id_noticia");
    $res_noticiabd = mysql_fetch_assoc($sql_noticiabd);

    $titulo_notbd = $res_noticiabd['titulo'];
    $subtitulo_notbd = $res_noticiabd['subtitulo'];
    $texto_notbd = $res_noticiabd['texto'];
    $fonte_notbd = $res_noticiabd['fonte'];
    $data_noticiabd = $res_noticiabd['data'];

    /////////////////////////////////////////////////////////////////////////////////////////
    $sql_noticias = mysql_query("SELECT * FROM noticias WHERE status = 1 ORDER BY data DESC");
    $total_noticias = mysql_num_rows($sql_noticias);

?>



<?php $url2 = str_replace("/projeto_lagos_bootstrap/noticia_bd.php?", "", $_SERVER["REQUEST_URI"]); ?>
<?php include_once('header.php'); ?>
    
    <div class="borda_menu"></div>
    <div class="page_title">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <h4>NOTÍCIAS</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Notícias</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <img class="" src="assets/images/noticias.jpg" width="100%" class="img-fluid" alt="Responsive image">
    </div>

    <div class="container mt-5">
        <div class="col-sm-12">
            <div id="noticia">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="title_wall"><?php echo $titulo_notbd; ?></div>
                        <div class="borda_noticia text-white mt-3 mb-3"><?php echo ucfirst(strftime("%B %d, %Y" ,strtotime($data_noticiabd)));?></div>
                        <!--<h5><?php echo $subtitulo_notbd; ?></h5>-->
                        <?php echo $texto_notbd; ?>
                        <p><b>Fonte: </b><?php echo $fonte_notbd; ?></p>
                        
                        <?php
                            $link_notbd = $res_noticiabd['link'];
                        ?>
                        <?php if($link_notbd == '') { ?>
                            <p><b></b></p>
                        <?php } else { ?>
                            <p><b>Link: </b>
                                <a href="<?php echo $link_notbd; ?>" target="_blank">
                                    <?php echo $link_notbd; ?>
                                </a>
                            </p>
                        <?php } ?>
                    </div>

                    <div style="border: 1px solid #E4E4E4;"></div>

                    <div class="col-sm-4">
                        <div class="title_wall">Últimas Notícias</div>
                        <?php while($res_not = mysql_fetch_assoc($sql_noticias)) { 
                            $data_ult = $res_not['data'];
                            $dia = date('d', strtotime($data_ult));
                            $mes_ano = date('m/Y', strtotime($data_ult));
                            $titulo = $res_not['titulo'];
                            $id = $res_not['id_noticia'];
                            $subtitulo = $res_not['subtitulo'];
                        ?>
                        <div class="mb-5">
                            <div id="data_news">
                                <strong class="text-white text-center"><?php echo $dia; ?></strong> 
                                <p class="text-white text-center m-0"><?php echo $mes_ano; ?></p>
                            </div>
                            <div class="cont_news">
                                <a href="noticia_bd.php?id_noticia=<?php echo $id; ?>" class="linkAltera" data-page="<?php echo $id; ?>">
                                    <?php echo $titulo; ?>
                                </a>
                                <p class="m-0" style="font-size: 11px;"><?php echo $subtitulo; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
        
            
