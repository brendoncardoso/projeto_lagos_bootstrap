<?php
    include("sistema/includes/conecte.php");

    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
    
    $id_noticia = isset($_REQUEST['id_noticia']) ? $_REQUEST['id_noticia'] : NULL;
    $sql = mysql_query("SELECT * FROM noticias WHERE id_noticia = '$id_noticia'");

    $sql_id = mysql_fetch_assoc($sql);
    $id = $sql_id['id_noticia'];

    $sql = mysql_query("SELECT * FROM cms_logo WHERE status = 1");
    $num_rows = mysql_num_rows($sql);
    $row = mysql_fetch_assoc($sql);
    $cms_logo = $row['id'].".".$row['extensao'];
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Projeto_Lagos_Bootstrap</title>

        <!--VALIDATION ENGINE-->
        <link rel="stylesheet" href="assets/css/validationEngine.jquery.css" type="text/css"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!---------------------------------------------------------------------------------------------------------------->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!--ICON-->
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />

        <!--Bootstrap-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/animate.css">

        <link rel="stylesheet" href="assets/css/cabecalho.css">
        <link rel="stylesheet" href="assets/css/breadcrumbs.css">
        <link rel="stylesheet" href="assets/css/utility.css">
        <link rel="stylesheet" href="assets/css/conteudo.css">
        <!--CSS-->
        <link rel="stylesheet" href="assets/css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">


        <!--FONT-AWESOME-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <style>
            .pointer{
                cursor: pointer!important;
            }

            .small{
                font-size: 27px!important;
            }
        </style>

        <script src="assets/js/jquery.3-4-1.js"></script>
    </head>
    
    <body>
        <?php 
            $local = array("/projeto_lagos_bootstrap/", "/des.projeto_lagos_bootstrap.net/");
            $url = str_replace($local, "", $_SERVER["REQUEST_URI"]); 
        ?>
         
        <!-- Cabeçalho -->
        <div class="d-none d-lg-block cabecalho" 
            style="background: linear-gradient(to right, #242952 25%, 
            <?php echo $url == '' || $url == 'index.php' ? '#4DB1E2' : '' ?> 
            <?php echo $url == 'breve_historia.php' || $url == 'corpo_diretor.php' || $url == 'valores.php' || $url == 'corpo_diretor.php' || $url == 'responsabilidade_social.php' || $url == 'unidades.php' || $url == 'parceiros.php' ? '#00B3B6' : '' ?> 
            <?php echo $url == 'projetos.php' ? 'black' : '' ?> 
            <?php echo $url == 'processo_seletivo.php' ? '#008B8B' : '' ?> 
            <?php echo $url == 'noticias.php' || $url == 'eventos_programas.php' || $url == 'blog_lagos.php' ? '#FFBD00' : ''; ?>
            <?php echo $url == 'transparencia.php' ? '#8B008B' : ''; ?>
            <?php echo $url == 'avaliacao_atendimento.php' || $url == 'ouvidoria.php' ? '#FF7661' : ''; ?>
            );">
            
            <div class="row">
                <div class="col-lg-3 logo">
                    <?php if($num_rows == 1) { ?>
                        <a href="index.php" class="img-fluid">
                            <img src="sistema/adm/cms_logo_images/<?php echo $cms_logo; ?>" height="130" alt="">
                        </a>
                    <?php } else { ?>
                        
                    <?php } ?>
                </div>

                <div class="col-lg-9 menu">
                    <div class="row">
                        <div class="col-md home <?php echo $url == '' ? 'active' : "" ; ?> <?php echo $url == 'index.php' ? 'active' : "" ; ?>">
                            <p class="pointer text-center">
                                <a href="index.php" style="font-size: 12px!important;">Home</a>
                                <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                            </p>
                        </div>

                        <div class="col-md institucional <?php echo $url == 'breve_historia.php' || $url == 'valores.php' || $url == 'corpo_diretor.php' || $url == 'responsabilidade_social.php' || $url == 'unidades.php' || $url == 'parceiros.php'? 'active' : "" ; ?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">O Instituto</a>
                                <i class="fa fa-3x fa-hospital-o" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-gestao.png" class="img-fluid" />
                                            <p class="small">Instituto</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row">
                                            <div class="col-lg-6 item"><a href="breve_historia.php">- Breve História</a></div>
                                            <div class="col-lg-6 item"><a href="valores.php">- Visão, Missão e Valores</a></div>
                                            <div class="col-lg-6 item"><a href="corpo_diretor.php">- Corpo Diretor</a></div>
                                            <div class="col-lg-6 item"><a href="responsabilidade_social.php">- Responsabilidade Social</a></div>
                                            <div class="col-lg-6 item"><a href="unidades.php">- Unidades</a></div>
                                            <div class="col-lg-6 item"><a href="parceiros.php">- Convênios e Parceiros</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md projetos <?php echo $url == 'projetos.php' ? 'active' :'' ?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Projetos</a>
                                <i class="fa fa-3x fa-cogs" aria-hidden="true"></i>
                            </p>
                        </div>

                        <div class="col-md noticias <?php echo $url == 'noticias.php' || $url == 'eventos_programas.php' || $url == 'blog_lagos.php' ? 'active' : '';?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Notícias</a>
                                <i class="fa fa-3x fa-newspaper-o" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-escola.png" class="img-fluid" />
                                            <p class="small">Notícias</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-4 item"><a href="noticias.php">- Notícias Recentes</a></div>
                                            <div class="col-lg-4 item"><a href="eventos_programas.php">- Eventos/Programas</a></div>
                                            <div class="col-lg-4 item"><a href="blog_lagos.php">- Blog Lagos</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md trabconosco <?php echo $url == 'processo_seletivo.php' ? 'active' : '' ?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Trabalhe Conosco</a>
                                <i class="fa fa-3x fa-user-plus"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-trabalheconosco.png" class="img-fluid" />
                                            <p class="small">Trabalhe Conosco</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-6 item"><a href="processo_seletivo.php">- Processo Seletivo Abertos</a></div>
                                            <div class="col-lg-6 item"><a href="processo_seletivo.php">- Processo Seletivo Encerrados</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md transparencia <?php echo $url == 'transparencia.php' ? 'active' : ''?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Transparência</a>
                                <i class="fa fa-3x fa-search" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-transparencia.png" class="img-fluid" />
                                            <p class="small">Transparência</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-4 item"><a href="transparencia.php">- Prestação de Contas</a></div>
                                            <div class="col-lg-4 item"><a href="transparencia.php">- Editais Abertos</a></div>
                                            <div class="col-lg-4 item"><a href="transparencia.php">- Editais Finalizados</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md irs <?php echo $url == 'avaliacao_atendimento.php' || $url == 'ouvidoria.php' ? 'active' : ''?>">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Fale Conosco</a>
                                <i class="fa fa-3x fa-phone" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-irs.png" class="img-fluid" />
                                            <p class="small">Fale <br>Conosco</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 70px!important;">
                                            <div class="col-lg-6 item"><a href="avaliacao_atendimento.php">- Avaliação de Atendimento</a></div>
                                            <div class="col-lg-6 item"><a href="ouvidoria.php">- Ouvidoria</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md colaborador">
                            <p class="pointer text-center">
                                <a href="" style="font-size: 12px!important;" target="_blank">Colaboradores</a>
                                <i class="fa fa-3x fa-address-card" aria-hidden="true"></i>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Cabeçalho Responsivo -->
        <div class="d-block d-lg-none cabecalho responsivo">
            <div class="row">
                <div class="col-12 logo text-center">
                    <a class="icon menu-open">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                   
                    <?php if($num_rows == 1) { ?>
                        <a href="index.php" class="img-fluid">
                            <img src="sistema/adm/cms_logo_images/<?php echo $cms_logo; ?>" height="130" alt="">
                        </a>
                    <?php } else { ?>
                        
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="d-block d-lg-none cabecalho-menu responsivo oculto">
            <div class="row topo" style="">
                <div class="col-12 logo" style="padding-right: 0px!important">
                    <a class="icon menu-open">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </a>
                    <?php if($num_rows == 1) { ?>
                        <a href="index.php" class="img-fluid">
                            <img src="sistema/adm/cms_logo_images/<?php echo $cms_logo; ?>" height="130" alt="">
                        </a>
                    <?php } else { ?>
                        
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item home_cel">
                        <a class="item-collapse" >
                            Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item instituto_cel">
                        <button class="item-collapse" data-toggle="collapse" href="#instituto_cel" role="button" aria-expanded="false" aria-controls="instituto_cel">
                            O Instituto
                        </button>
                        <div class="item-menu collapse" id="instituto_cel">
                            <ul>
                                <li><a href="">- Breve História</a></li>
                                <li><a href="">- Visão, Missão e Valores</a></li>
                                <li><a href="">- Corpo Diretor</a></li>
                                <li><a href="">- Responsabilidade Social</a></li>
                                <li><a href="">- Unidades</a></li>
                                <li><a href="">- Convênios e Parceiros</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item projeto_cel">
                        <a class="item-collapse" >
                            Projetos
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item noticias_cel">
                        <button class="item-collapse" data-toggle="collapse" href="#noticias_cel" role="button" aria-expanded="false" aria-controls="noticias_cel">
                            Notícias
                        </button>
                        <div class="item-menu collapse" id="noticias_cel">
                            <ul>
                                <li><a href="noticias.php"></a>- Notícias Recentes</li>
                                <li><a href="eventos_programas.php"></a>- Eventos Programas</li>
                                <li><a href="blog_lagos.php"></a>- Blog Lagos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item trabalheconosco_cel">
                        <button class="item-collapse" data-toggle="collapse" href="#trabalheconosco_cel" role="button" aria-expanded="false" aria-controls="trabalheconosco_cel">
                            Trabalhe Conosco
                        </button>
                        <div class="item-menu collapse" id="trabalheconosco_cel">
                            <ul>
                                <li><a href="processo_seletivo.php"></a>- Processo Seletivo Abertos</li>
                                <li><a href=""></a>- Processo Seletivo Encerrados</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item transparencia_cel">
                        <button class="item-collapse" data-toggle="collapse" href="#transparencya" role="button" aria-expanded="false" aria-controls="transparencya">
                            Transparência
                        </button>
                        <div class="item-menu collapse" id="transparencya">
                            <ul>
                                <li><a href=""></a>- Prestação de Contas</li>
                                <li><a href=""></a>- Editais Abertos</li>
                                <li><a href=""></a>- Editais Finalizados</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item faleconosco_cel">
                        <button class="item-collapse" data-toggle="collapse" href="#faleconosco" role="button" aria-expanded="false" aria-controls="faleconosco">
                            Fale Conosco
                        </button>
                        <div class="item-menu collapse" id="faleconosco">
                            <ul>
                                <li><a href=""></a>- Avaliação de Atendimento</li>
                                <li><a href=""></a>- Ouvidoria</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="item colaborador_cel">
                        <a class="item-collapse" >
                            Colaboradores
                        </a>
                    </div>
                </div>
            </div>
        </div>


