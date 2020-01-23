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
        <!--CSS-->
        <link rel="stylesheet" href="assets/css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">


        <!--FONT-AWESOME-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <style>
            .pointer{
                cursor: pointer!important;
            }
        </style>

        <script src="assets/js/jquery.3-4-1.js"></script>
    </head>
    
    <body>
        <?php $url = str_replace("/des.projeto_lagos_bootstrap.net/", " ", $_SERVER["REQUEST_URI"]); ?>
        <!-- Cabeçalho -->
        <div class="d-none d-lg-block cabecalho">
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
                        <div class="col-md home">
                            <p class="pointer text-center">
                                <a href="index.php" style="font-size: 12px!important;">Home</a>
                                <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                            </p>
                        </div>

                        <div class="col-md institucional ">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">O Instituto</a>
                                <i class="fa fa-3x fa-hospital-o" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-gestao.png" class="img-fluid" />
                                            <p>Instituto</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row">
                                            <div class="col-lg-6 item"><a href="">- Breve História</a></div>
                                            <div class="col-lg-6 item"><a href="">- Visão, Missão e Valores</a></div>
                                            <div class="col-lg-6 item"><a href="">- Corpo Diretor</a></div>
                                            <div class="col-lg-6 item"><a href="">- Responsabilidade Social</a></div>
                                            <div class="col-lg-6 item"><a href="">- Unidades</a></div>
                                            <div class="col-lg-6 item"><a href="">- Convênios e Parceiros</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md projetos ">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Projetos</a>
                                <i class="fa fa-3x fa-cogs" aria-hidden="true"></i>
                            </p>
                        </div>

                        <div class="col-md noticias ">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Notícias</a>
                                <i class="fa fa-3x fa-newspaper-o" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-escola.png" class="img-fluid" />
                                            <p>Notícias</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-4 item"><a href="">- Notícias Recentes</a></div>
                                            <div class="col-lg-4 item"><a href="">- Eventos/Programas</a></div>
                                            <div class="col-lg-4 item"><a href="">- Blog Lagos</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md trabconosco ">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Trabalhe Conosco</a>
                                <i class="fa fa-3x fa-user-plus"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-trabalheconosco.png" class="img-fluid" />
                                            <p style="font-size: 28px!important;">Trabalhe Conosco</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-6 item"><a href="o-cejam/sobre-nos.html">- Processo Seletivo Abertos</a></div>
                                            <div class="col-lg-6 item"><a href="o-cejam/sobre-nos.html">- Processo Seletivo Encerrados</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md transparencia ">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Transparência</a>
                                <i class="fa fa-3x fa-search" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-transparencia.png" class="img-fluid" />
                                            <p style="font-size: 29px!important">Transparência</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 53px!important;">
                                            <div class="col-lg-4 item"><a href="">- Prestação de Contas</a></div>
                                            <div class="col-lg-4 item"><a href="">- Editais Abertos</a></div>
                                            <div class="col-lg-4 item"><a href="">- Editais Finalizados</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md irs">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Fale Conosco</a>
                                <i class="fa fa-3x fa-phone" aria-hidden="true"></i>
                            </p>
                            <div class="submenu">
                                <div class="row">
                                    <div class="col-lg-3 barra">
                                        <div class="horizontal">
                                            <img src="assets/images/grafismo-barra-irs.png" class="img-fluid" />
                                            <p>Fale <br>Conosco</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 offset-lg-1 itens">
                                        <div class="row" style="margin-top: 70px!important;">
                                            <div class="col-lg-6 item"><a href="">- Avaliação de Atendimento</a></div>
                                            <div class="col-lg-6 item"><a href="">- Ouvidoria</a></div>
                                        </div>
                                    </div>
                                    <!--<div class="col-lg-8 offset-lg-1 itens">
                                        <p class="gambi">&nbsp;</p>
                                        <div class="row">
                                            
                                            <div class="col-lg-4 item">
                                                <ul class="pl-15" style="margin-top: 35px!important; padding-left: 0px!important;">
                                                    <li style="list-style: none">
                                                        <a href="fornecedores.html" style="font-size: 19px;">- Avaliação de Atendimento</a>
                                                    </li>

                                                    <li style="list-style: none">
                                                        <a href="ouvidoria.html" style="font-size: 19px;">- Ouvidoria</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 item contato">
                                                <p class="text-left">
                                                    CEJAM<br/>
                                                    (11) 3469-1818<br/><br/>
                                                    SAU<br/>
                                                    <br/>
                                                    sau@cejam.org.br
                                                </p>
                                            </div>
                                            <div class="col-lg-3 item contato">
                                                <p class="text-left">
                                                    PAISM<br/>
                                                    (11) 3469-1828<br/><br/>
                                                    IMPRENSA<br/>
                                                    (11) 3469-1815<br/>
                                                    comunicacao@cejam.org.br
                                                </p>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md colaborador">
                            <p class="pointer text-center">
                                <a href="#" style="font-size: 12px!important;">Colaboradores</a>
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
            <div class="row topo">
                <div class="col-12 logo">
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
                                <li><a href=""></a>- Notícias Recentes</li>
                                <li><a href=""></a>- Eventos Programas</li>
                                <li><a href=""></a>- Blog Lagos</li>
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
                                <li><a href=""></a>- Processo Seletivo Abertos</li>
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
            
            <!--<div class="row">
                <div class="col-12">
                    <div class="item fale-com-a-gente">
                        <button class="item-collapse" data-toggle="collapse" href="#fale-com-a-gente" role="button" aria-expanded="false" aria-controls="fale-com-a-gente">
                            Fale com a Gente
                        </button>
                        <div class="item-menu collapse" id="fale-com-a-gente">
                            <ul>
                                <li><a href="fornecedores.html">Canal do Fornecedor</a></li>
                                <li><a href="processo-seletivos.html" target="_blank">Faça parte do nosso time</a></li>
                                <li><a href="ouvidoria.html">Ouvidoria</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!--<div class="d-block d-lg-none cabecalho-menu-padding"></div>-->

        <!--BARRA DE NAVEGAÇÃO-->
        <!--<div class="container">
            <div class="bs-example">
                <nav class="navbar navbar-light navbar-static-top navbar-expand-md bg-white p-0">

                    <?php if($num_rows == 1) { ?>
                        <a href="index.php" class="navbar-brand">
                            <img src="sistema/adm/cms_logo_images/<?php echo $cms_logo; ?>" width="150px" alt="">
                        </a>
                    <?php } else { ?>
                        
                    <?php } ?>
                    

                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse" style="margin-bottom: 30px;">
                        <div class="navbar-nav header-menu text-center">
                            <a href="index.php" class="nav-item nav-link <?php echo $url == '/' ? 'active' : "" ; ?> <?php echo $url == '/index.php' ? 'active' : "" ; ?>">
                                <i class="fa fa-home fa-1x text-white icones" aria-hidden="true" ></i>
                                Home
                            </a>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle dropdown1 <?php echo $url == '/instituto.php' || $url == '/breve_historia.php' ? 'active' : ''; ?>" data-toggle="dropdown">
                                    <i class="fa fa-hospital-o text-white icones" aria-hidden="true" ></i>
                                    O Instituto
                                </a>
                                <div class="dropdown-menu">
                                    <a href="projetos.php" class="dropdown-item">
                                        - <i class="fa fa-cogs" aria-hidden="true"></i> 
                                        Projetos
                                    </a>
                                    <a href="noticias.php" class="dropdown-item"> - <i class="fa fa-newspaper-o" aria-hidden="true"></i> Notícias</a>
                                    <a href="capitacao.php" class="dropdown-item"> - <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Capitação</a>
                                    <a href="escala_medica.php" class="dropdown-item"> - <i class="fa fa-user-md" aria-hidden="true"></i> Escala Médica</a>
                                    <a href="corpo_tecnico.php" class="dropdown-item"> - <i class="fa fa-users" aria-hidden="true"></i> Corpo Técnico</a>
                                    <a href="breve_historia.php" class="dropdown-item"> - Breve História </a>
                                    <a href="" class="dropdown-item"> - Visão, Missão e Valores</a>
                                    <a href="" class="dropdown-item"> - Corpo Diretor</a>
                                    <a href="" class="dropdown-item"> - Responsabilidade Social</a>
                                    <a href="" class="dropdown-item"> - Unidades</a>
                                    <a href="" class="dropdown-item"> - Convênios e Parceiros </a>
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle">
                                    <i class="fa fa-cogs text-white icones" aria-hidden="true"></i>
                                    Projetos
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Antigos</a>
                                    <a href="" class="dropdown-item"> - Atuais</a>
                                </div>
                            </div>

                            <a href="projetos.php" class="nav-item nav-link <?php echo $url == '/projetos.php' ? 'active' : ''; ?>">
                                <i class="fa fa-cogs text-white container icones" aria-hidden="true"></i> 
                                Projetos
                            </a>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle dropdown2"  data-toggle="dropdown">
                                    <i class="fa fa-newspaper-o text-white icones" aria-hidden="true"></i>
                                    Notícias
                                </a>

                                <div class="dropdown-menu">
                                    <a href="noticias.php" class="dropdown-item"> - Notícias Recentes</a>
                                    <a href="" class="dropdown-item"> - Eventos/Programas</a>
                                    <a href="" class="dropdown-item"> - Blog Lagos</a>
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user-plus text-white icones"></i>
                                    Trabalhe Conosco
                                </a>

                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Processo Seletivo Abertos</a>
                                    <a href="" class="dropdown-item"> - Processo Seletivo Encerrados</a>
                                </div>
                            </div>

                            
                            <a href="transparencia.php" class="nav-item nav-link <?php echo $url == '/transparencia.php' ? 'active' : ''; ?>">
                                <i class="fa fa-search text-white icones" aria-hidden="true"></i>
                                Transparência
                            </a>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-search text-white container icones" aria-hidden="true"></i>
                                    Transparência
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Prestação de Contas</a>
                                    <a href="" class="dropdown-item"> - Editais Abertos</a>
                                    <a href="" class="dropdown-item"> - Editais Finalizados</a>
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-comments-o text-white container icones" aria-hidden="true"></i>
                                    Fale Conosco
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Avaliação do Atendimento</a>
                                    <a href="ouvidoria.php" class="dropdown-item"> - Ouvidoria</a>
                                </div>
                            </div>

                            <a href="fale_conosco.php" class="nav-item nav-link <?php echo $url == '/fale_conosco.php' ? 'active' : ''; ?>">
                                <i class="fa fa-comments-o text-white container icones" aria-hidden="true"></i>
                                Fale Conosco
                            </a>

                            <a href="http://f71lagos.com/extranet/login" class="nav-item nav-link <?php echo $url == '/http://f71lagos.com/extranet/login' ? 'active' : ''; ?>" target="_blank">
                                <i class="fa fa-address-card text-white icones" aria-hidden="true"></i>
                                Colaboradores
                            </a>

                            

                            <a href="http://f71lagos.com/extranet/login" class="nav-item nav-link <?php echo $url == '/http://f71lagos.com/extranet/login' ? 'active' : ''; ?>" target="_blank">
                                <i class="fa fa-address-card text-white icones" aria-hidden="true"></i>
                                Colaboradores
                            </a>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-hand-paper-o text-white container icones" aria-hidden="true"></i>
                                    Doação de Órgãos
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Saiba Mais</a>
                                    <a href="" class="dropdown-item"> - Jardim do Doador de Órgãos</a>
                                </div>
                            </div>

                            <a href="selecoes.php" class="nav-item nav-link <?php echo $url == '/selecoes.php' ? 'active' : ''; ?>">
                                <i class="fa fa-user-plus text-white icones" aria-hidden="true" ></i>
                                Seleções
                            </a>

                            <a href="ouvidoria.php" class="nav-item nav-link <?php echo $url == '/ouvidoria.php' ? 'active' : ''; ?>">
                                <i class="fa fa-phone text-white icones" aria-hidden="true" ></i>
                                Ouvidoria
                            </a>

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle">
                                    <i class="text-white icones" aria-hidden="true"></i>
                                    Transplantes
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Jardim do Doador</a>
                                    <a href="" class="dropdown-item"> - Ações de Incentivo a Doação</a>
                                </div>
                            </div>

                            <a href="transparencia.php" class="nav-item nav-link <?php echo $url == '/transparencia.php' ? 'active' : ''; ?>">
                                <i class="fa fa-search text-white icones" aria-hidden="true"></i>
                                Transparência
                            </a>

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle <?php echo $url == '/projetos.php' || $url == '/noticias.php' || $url == '/capitacao.php' || $url == '/escala_medica.php' || $url == '/noticia_bd.php?id_noticia='.$id || $url == '/corpo_tecnico.php'? 'active' : ''?>" data-toggle="dropdown">
                                    <i class="fa fa-plus-square text-white container icones" aria-hidden="true"></i>
                                    Informações
                                </a>

                                <div class="dropdown-menu">
                                    <a href="projetos.php" class="dropdown-item">
                                        - <i class="fa fa-cogs" aria-hidden="true"></i> 
                                        Projetos
                                    </a>
                                    <a href="noticias.php" class="dropdown-item"> - <i class="fa fa-newspaper-o" aria-hidden="true"></i> Notícias</a>
                                    <a href="capitacao.php" class="dropdown-item"> - <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Capitação</a>
                                    <a href="escala_medica.php" class="dropdown-item"> - <i class="fa fa-user-md" aria-hidden="true"></i> Escala Médica</a>
                                    <a href="corpo_tecnico.php" class="dropdown-item"> - <i class="fa fa-users" aria-hidden="true"></i> Corpo Técnico</a>
                                </div>
                            </div>

                            <a href="fale_conosco.php" class="nav-item nav-link <?php echo $url == '/fale_conosco.php' ? 'active' : ''; ?>">
                                <i class="fa fa-comments-o text-white container icones" aria-hidden="true"></i>
                                Fale Conosco
                            </a>
                            
                        </div>
                    </div>
                    
                </nav>
            </div>
        </div>-->


