<?php
    include 'sistema/includes/conecte.php';

    $sql_noticias = mysql_query("SELECT * FROM noticias WHERE status = 1 ORDER BY data DESC");
    $total_noticias = mysql_num_rows($sql_noticias);

    //ULTIMO CADASTRO DA NOTÍCIA
    $sql_ult_not = mysql_query("SELECT * FROM noticias WHERE status = 1 ORDER BY id_noticia DESC LIMIT 1");
    $res_ult_not = mysql_fetch_assoc($sql_ult_not);
    $data = $res_ult_not['data'];

    //LIMITANDO O NÚMERO DE CARACTERES 
    function limita_caracteres($texto, $limite, $quebra = true){
        $tamanho = strlen($texto);
        if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
           $novo_texto = $texto;
        }else{ // Se o tamanho do texto for maior que o limite
           if($quebra == true){ // Verifica a opção de quebrar o texto
              $novo_texto = trim(substr($texto, 0, $limite))."...";
           }else{ // Se não, corta $texto na última palavra antes do limite
              $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limitE
              $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
           }
        }
        return $novo_texto; // Retorna o valor formatado
     }
?>

<?php include_once('header.php'); ?>




    <!--HEADER MENU-->
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

    <?php if($total_noticias != 0) { ?>
        <div class="container mt-5">
            <div class="col-sm-12">
                <div id="noticia">
                    <div class="row">
                        
                        <div class="col-sm-7 p-0">
                            <div class="p-3">
                                <div class="title_wall">
                                    <?php echo $res_ult_not['titulo']; ?>
                                </div>
                                
                                <div class="borda_noticia text-white mt-3 mb-3"><?php echo ucfirst(strftime("%B %d, %Y", strtotime($data))); ?></div>
                                <!--<h5><?php echo $res_ult_not['subtitulo']; ?></h5>-->
                                <?php echo $res_ult_not['texto']; ?>

                                <b>Fonte: </b><?php echo $res_ult_not['fonte'] ?><br>

                                <?php
                                    $link = $res_ult_not['link'];
                                ?>

                                <?php if($link == '') { ?>
                                    
                                <?php } else { ?>
                                    <p><b>Link: </b><?php echo $res_ult_not['link']; ?></p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="borda_noticias"></div>

                        <div class="col-sm-4 p-3">
                            <div class="title_wall">Últimas Notícias</div>
                            
                            <?php while($res_not = mysql_fetch_assoc($sql_noticias)) { 
                                $data_ult = $res_not['data'];
                                $dia = date('d', strtotime($data_ult));
                                $mes_ano = date('m/Y', strtotime($data_ult));
                                $titulo = $res_not['titulo'];
                                $subtitulo = limita_caracteres($res_not['subtitulo'], 105);
                                $id = $res_not['id_noticia'];
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
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <strong>Atenção</strong> Nenhuma notícia foi cadastrada.
        |</div>
    <?php } ?>

            
<?php include_once('footer.php'); ?>

