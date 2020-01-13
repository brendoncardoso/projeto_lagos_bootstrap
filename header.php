<?php
    include("sistema/includes/conecte.php");

    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
    
    $id_noticia = isset($_REQUEST['id_noticia']) ? $_REQUEST['id_noticia'] : NULL;
    $sql = mysql_query("SELECT * FROM noticias WHERE id_noticia = '$id_noticia'");

    $sql_id = mysql_fetch_assoc($sql);
    $id = $sql_id['id_noticia'];

    $sql = mysql_query("SELECT * FROM cms_logo");
    $num_rows = mysql_num_rows($sql);
    $row = mysql_fetch_assoc($sql);
    $cms_logo = $row['id_logo'];
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

        <!--CSS-->
        <link rel="stylesheet" href="assets/css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">


        <!--FONT-AWESOME-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
    <body>
        <?php $url = str_replace("/des.projeto_lagos_bootstrap.net/", " ", $_SERVER["REQUEST_URI"]); ?>

        <!--BARRA DE NAVEGAÇÃO-->
        <div class="container">
            <div class="bs-example">
                <nav class="navbar navbar-light navbar-static-top navbar-expand-md bg-white p-0">

                    <?php if($num_rows == 1) { ?>
                        <a href="index.php" class="navbar-brand">
                            <img src="assets/images/<?php echo $cms_logo; ?>.png" width="150px" alt="">
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
                                    <!--<a href="projetos.php" class="dropdown-item">
                                        - <i class="fa fa-cogs" aria-hidden="true"></i> 
                                        Projetos
                                    </a>
                                    <a href="noticias.php" class="dropdown-item"> - <i class="fa fa-newspaper-o" aria-hidden="true"></i> Notícias</a>
                                    <a href="capitacao.php" class="dropdown-item"> - <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Capitação</a>
                                    <a href="escala_medica.php" class="dropdown-item"> - <i class="fa fa-user-md" aria-hidden="true"></i> Escala Médica</a>
                                    <a href="corpo_tecnico.php" class="dropdown-item"> - <i class="fa fa-users" aria-hidden="true"></i> Corpo Técnico</a>-->
                                    <a href="breve_historia.php" class="dropdown-item"> - Breve História </a>
                                    <a href="" class="dropdown-item"> - Visão, Missão e Valores</a>
                                    <a href="" class="dropdown-item"> - Corpo Diretor</a>
                                    <a href="" class="dropdown-item"> - Responsabilidade Social</a>
                                    <a href="" class="dropdown-item"> - Unidades</a>
                                    <a href="" class="dropdown-item"> - Convênios e Parceiros </a>
                                </div>
                            </div>

                            <!--<div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle">
                                    <i class="fa fa-cogs text-white icones" aria-hidden="true"></i>
                                    Projetos
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Antigos</a>
                                    <a href="" class="dropdown-item"> - Atuais</a>
                                </div>
                            </div>-->

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

                            
                            <!--<a href="transparencia.php" class="nav-item nav-link <?php echo $url == '/transparencia.php' ? 'active' : ''; ?>">
                                <i class="fa fa-search text-white icones" aria-hidden="true"></i>
                                Transparência
                            </a>-->

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

                            <!--<a href="fale_conosco.php" class="nav-item nav-link <?php echo $url == '/fale_conosco.php' ? 'active' : ''; ?>">
                                <i class="fa fa-comments-o text-white container icones" aria-hidden="true"></i>
                                Fale Conosco
                            </a>-->

                            <!--<a href="http://f71lagos.com/extranet/login" class="nav-item nav-link <?php echo $url == '/http://f71lagos.com/extranet/login' ? 'active' : ''; ?>" target="_blank">
                                <i class="fa fa-address-card text-white icones" aria-hidden="true"></i>
                                Colaboradores
                            </a>-->

                            

                            <a href="http://f71lagos.com/extranet/login" class="nav-item nav-link <?php echo $url == '/http://f71lagos.com/extranet/login' ? 'active' : ''; ?>" target="_blank">
                                <i class="fa fa-address-card text-white icones" aria-hidden="true"></i>
                                Colaboradores
                            </a>

                            <!--<div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-hand-paper-o text-white container icones" aria-hidden="true"></i>
                                    Doação de Órgãos
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Saiba Mais</a>
                                    <a href="" class="dropdown-item"> - Jardim do Doador de Órgãos</a>
                                </div>
                            </div>-->

                            <!--<a href="selecoes.php" class="nav-item nav-link <?php echo $url == '/selecoes.php' ? 'active' : ''; ?>">
                                <i class="fa fa-user-plus text-white icones" aria-hidden="true" ></i>
                                Seleções
                            </a>-->

                            <!--<a href="ouvidoria.php" class="nav-item nav-link <?php echo $url == '/ouvidoria.php' ? 'active' : ''; ?>">
                                <i class="fa fa-phone text-white icones" aria-hidden="true" ></i>
                                Ouvidoria
                            </a>-->

                            <!--<div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle">
                                    <i class="text-white icones" aria-hidden="true"></i>
                                    Transplantes
                                </a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item"> - Jardim do Doador</a>
                                    <a href="" class="dropdown-item"> - Ações de Incentivo a Doação</a>
                                </div>
                            </div>-->

                            <!--<a href="transparencia.php" class="nav-item nav-link <?php echo $url == '/transparencia.php' ? 'active' : ''; ?>">
                                <i class="fa fa-search text-white icones" aria-hidden="true"></i>
                                Transparência
                            </a>-->

                            <!--<div class="nav-item dropdown">
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
                            </div>-->

                            <!--<a href="fale_conosco.php" class="nav-item nav-link <?php echo $url == '/fale_conosco.php' ? 'active' : ''; ?>">
                                <i class="fa fa-comments-o text-white container icones" aria-hidden="true"></i>
                                Fale Conosco
                            </a>-->
                            
                        </div>
                    </div>
                    
                </nav>
            </div>
        </div>


