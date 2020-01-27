<?php include_once('header.php'); ?>
<?php
    $sql1 = "SELECT * FROM cms_slides WHERE id_img = 1";
    $sql_query1 = mysql_query($sql1);
    $num_rows1 = mysql_num_rows($sql_query1);

    while($row = mysql_fetch_assoc($sql_query1)){
        $arraySlides1[$row['id_img']] = [
            "id_img" => $row['id_img'],
            "extensao" => $row['extensao']
        ];
    }

    $sql2 = "SELECT * FROM cms_slides WHERE id_img = 2";
    $sql_query2 = mysql_query($sql2);
    $num_rows2 = mysql_num_rows($sql_query2);

    while($row = mysql_fetch_assoc($sql_query2)){
        $arraySlides2[$row['id_img']] = [
            "id_img" => $row['id_img'],
            "extensao" => $row['extensao']
        ];
    }

    $sql3 = "SELECT * FROM cms_slides WHERE id_img = 3";
    $sql_query3 = mysql_query($sql3);
    $num_rows3 = mysql_num_rows($sql_query3);

    while($row = mysql_fetch_assoc($sql_query3)){
        $arraySlides3[$row['id_img']] = [
            "id_img" => $row['id_img'],
            "extensao" => $row['extensao']
        ];
    }
?>

<?php if(isset($_POST['nome']) && !empty($_POST['nome']) && 
    isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento']) && 
    isset($_POST['telefone']) && !empty($_POST['telefone']) && 
    isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['mensagem']) && !empty($_POST['mensagem'])) { ?>
        
        <?php 
            $nome = addslashes($_POST['nome']);
            $data_nascimento = addslashes($_POST['data_nascimento']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $mensagem = addslashes($_POST['mensagem']);
            
            $qr_insert = mysql_query("INSERT INTO fale_conosco (nome, data_nascimento, telefone, email) values ('$nome', '$data_nascimento', '$telefone', '$email')");
            $qr_menssage = mysql_query("INSERT INTO fale_conosco_mensagens (nome_cliente, mensagem) values ('$nome', '$mensagem')");
        ?>
<?php } else { ?>
    
<?php } ?>

    <!-- Modal -->
    <div class="modal fade modalfaleconosco pr-0" id="" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">
                        ATENÇÃO!
                    </h5>
                    <button type="button" class="close fechar" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="text-center">
                    <div class="modal-body">
                        <img src="assets/images/checked.png" alt="">
                    </div>

                    <div class="modal-body">
                        Mensagem enviada com Sucesso. Obrigado!
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger fechar" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>    

    <!--CAROUSEL-->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
                <?php if($num_rows1 > 0) { ?>
                    <?php foreach($arraySlides1 as $id_img => $values) { ?>
                        <img class="d-block w-100" src="sistema/adm/cms_slides/<?php echo $id_img?>.<?php echo $values['extensao']?>" alt="Primeiro Slide" style="height: 583px">
                    <?php } ?>
                <?php } else { ?>
                    <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=Primeiro slide" alt="First slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16f675a3305%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16f675a3305%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.9140625%22%20y%3D%22217.7%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <?php } ?>
            </div>

            <div class="carousel-item">
                <?php if($num_rows2 > 0) { ?>
                    <?php foreach($arraySlides2 as $id_img => $values) { ?>
                        <img class="d-block w-100" src="sistema/adm/cms_slides/<?php echo $id_img?>.<?php echo $values['extensao']?>" alt="Segundo Slide" style="height: 583px">
                    <?php } ?>
                <?php } else { ?>
                    <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=666&amp;fg=444&amp;text=Segundo slide" alt="Second slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16f675ccfc0%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16f675ccfc0%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.3125%22%20y%3D%22217.7%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">                
                <?php } ?>

                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>

            <div class="carousel-item">
                <?php if($num_rows3 > 0) { ?>
                    <?php foreach($arraySlides3 as $id_img => $values) { ?>
                        <img class="d-block w-100" src="sistema/adm/cms_slides/<?php echo $id_img?>.<?php echo $values['extensao']?>" alt="Terceiro Slide">
                    <?php } ?>
                <?php } else { ?>
                    <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=555&amp;fg=333&amp;text=Terceiro slide" alt="Third slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16f675ccfc2%20text%20%7B%20fill%3A%23333%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16f675ccfc2%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23555%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22276.9921875%22%20y%3D%22217.7%22%3EThird%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">                
                <?php } ?>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>                
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="col-sm-12 text-center">
            <strong><p class="title-home text-center">Acesso Rápido</p></strong>
            <div class="acesso-rapido">
                <div class="row">
                    <div class="acesso_rapido transp col-sm-3">
                        <a href="transparencia.php">
                            <img src="https://cejam.org.br/img/layout/acesso-rapido-transparencia.png" class="hide-o animated img-fluid ">
                        </a>
                    </div>

                    <div class="acesso_rapido  colaboradores col-sm-3">
                        <a href="http://f71lagos.com/extranet/login" target="_blank">
                            <img src="https://cejam.org.br/img/layout/acesso-rapido-colaborador.png" class="hide-o animated img-fluid">
                        </a>
                    </div>

                    <div class="acesso_rapido  processos_seletivos col-sm-3">
                        <a href="processo_seletivo.php">
                            <img src="https://cejam.org.br/img/layout/acesso-rapido-processo-seletivo.png" class="hide-o animated img-fluid">
                        </a>
                    </div>

                    <div class="acesso_rapido  fornecedores col-sm-3">
                        <a href="">
                            <img src="https://cejam.org.br/img/layout/acesso-rapido-fornecedores.png" class="hide-o animated img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="col-sm-12">
            <strong><p class="title-home text-center ">Notícias Recentes</p></strong>
            <?php
                $sql = "SELECT A.id_noticia, A.titulo, A.subtitulo, B.img_noticia, A.status, A.status_img, A.data
                FROM noticias AS A
                LEFT JOIN cms_img_noticia AS B ON (A.id_noticia = B.id_noticia)
                WHERE A.STATUS = 1
                ORDER BY A.data DESC;";
                $sql_noticias = mysql_query($sql);
                $data = isset($data['data'])?$data['data']: '';
                $sql_noticias_num_rows = mysql_num_rows($sql_noticias);
            
                while($sql_fetch = mysql_fetch_assoc($sql_noticias)){
                    $array_noticias[$sql_fetch['id_noticia']] = [
                        "id_noticia" => $sql_fetch['id_noticia'], 
                        "titulo" => $sql_fetch['titulo'],
                        "subtitulo" => $sql_fetch['subtitulo'],
                        "data" => $sql_fetch['data'],
                        "status_img" => $sql_fetch['status_img'],
                        "img_noticia" => $sql_fetch['img_noticia']
                    ];
                }
                
            ?>
            <?php if ($sql_noticias_num_rows) { ?>
                <div class="row">
                    <?php $contador = 1; ?>
                    <?php foreach($array_noticias as $noticias) { ?>
                        <?php if ($contador <= 4) { ?>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 animated noticia hide-o">
                                <?php if($noticias['status_img'] == 1) { ?>
                                    <a href="noticia_bd.php?id_noticia=<?php echo $noticias['id_noticia']; ?>">
                                        <img src="sistema/adm/cms_img_noticias/<?php echo $noticias['img_noticia']; ?>" alt="..." href="" class="img-thumbnail mx-auto d-block img1" style="height: 160px">
                                    </a>
                                <?php } else { ?>
                                    <a href="noticia_bd.php?id_noticia=<?php echo $noticias['id_noticia']; ?>">
                                        <img src="assets/images/0.png" alt="..." href="" class="img-thumbnail mx-auto d-block img1" style="height: 160px">
                                    </a>
                                <?php } ?>

                                <!--<a class="text-white" href="" style="text-decoration: none;">
                                    <div class="borda-noticias text-center">
                                        Saúde
                                    </div>
                                </a>-->

                                <a href="noticia_bd.php?id_noticia=<?php echo $noticias['id_noticia']; ?>" style="color: #4DB1E2">
                                    <div class="sub-title mt-3" style="color: #4DB1E2">
                                        <?= $noticias['subtitulo']; ?>
                                    </div>
                                </a>

                                <?php
                                    $dia = date('d', strtotime($noticias['data']));
                                    $mes = date('m', strtotime($noticias['data']));
                                
                                    
                                    $ano = date('Y', strtotime($noticias['data']));
                                    $horas = date('H:i', strtotime($noticias['data']));
                                    if($mes == 01){
                                        $nome_mes = "Janeiro";
                                    }else if($mes == 02){
                                        $nome_mes = "Fevereiro";
                                    }else if($mes == 03){
                                        $nome_mes = "Março";
                                    }else if($mes == 04){
                                        $nome_mes = "Abril";
                                    }else if($mes == 05){
                                        $nome_mes = "Maio";
                                    }else if($mes == 06){
                                        $nome_mes = "Junho";
                                    }else if($mes == 07){
                                        $nome_mes = "Julho";
                                    }else if($mes == 08){
                                        $nome_mes = "Agosto";
                                    }else if($mes == 09){
                                        $nome_mes = "Setembro";
                                    }else if($mes == 10){
                                        $nome_mes = "Outubro";
                                    }else if($mes == 11){
                                        $nome_mes = "Novembro";
                                    }else if($mes == 11){
                                        $nome_mes = "Dezembro";
                                    }
                                    
                                ?>

                                <hr style="margin-bottom: 1px;">
                                <span class="data_noticias_home p-0" style="font-size: 12px;"><?= $dia." de ".$nome_mes." às ".$horas; ?></span>
                            </div>
                        <?php } ?>
                        <?php $contador++; ?>
                    <?php } ?>
                </div>

                <br>
                <br>

                <div class="container">
                    <div class="col-sm-12 text-center">
                        <a href="noticias.php">
                            <button type="button" class="btn btn-blue btn-lg">Ver Mais Notícias</button>
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Atenção!</strong> Não há registro de Notícias.
                </div>
            <?php } ?>
        </div>
    </div>
    
<?php include_once('footer.php'); ?>
                         