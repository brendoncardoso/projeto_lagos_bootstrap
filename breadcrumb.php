
<div class="conteudo">
    <div class="breadcrumbs 
        <?php echo $url == 'breve_historia.php' || $url == 'corpo_diretor.php' || $url == 'unidades.php' || $url == 'valores.php' || $url == 'responsabilidade_social.php' || $url == 'parceiros.php' ? 'instituto_breadcrumb' : ''; ?>
        <?php echo $url == 'projetos.php' ? 'projeto_breadcrumb' : ''; ?>
        <?php echo $url == 'noticias.php' || $url == 'eventos_programas.php' || $url == 'blog_lagos.php' || $url == "ver_noticia.php?id_noticia=".$id_noticia ? 'noticias_breadcrumb' : ''; ?>
        <?php for($x = 0; $x <= $paginas; $x++) { 
                echo $url == "noticias.php?pagina=$x" ? 'noticias_breadcrumb' : '';
        } ?>
        <?php echo $url == 'processo_seletivo.php' ? 'trabconosco_breadcrumb' : ''; ?>
        <?php echo $url == 'transparencia.php' ? 'transparencia_breadcrumb' : ''; ?>
        <?php echo $url == 'avaliacao_atendimento.php' || $url == 'ouvidoria.php' ? 'faleconosco_breadcrumb' : ''; ?>
        ">
        <div class="row">
            <div class="col-sm-12">
                <div class=" pagina">
                    <div class="col-sm-12">
                        <ul class="red">
                            <li>
                                <a href="index.php">Home</a> 
                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                             </li>
                            <li>
                                <span>
                                    <?php echo $url == 'breve_historia.php' || $url == 'corpo_diretor.php' || $url == 'unidades.php' || $url == 'valores.php' || $url == 'responsabilidade_social.php' || $url == 'parceiros.php' ? 'O Instituto' : ''; ?>
                                    <?php echo $url == 'projetos.php' ? 'Projetos' : ''; ?>
                                    <?php echo $url == 'noticias.php' || $url == 'eventos_programas.php' || $url == 'blog_lagos.php' || $url == 'ver_noticia.php?id_noticia='.$id_noticia ? 'Notícias' : ''; ?>
                                    <?php for($x = 0; $x <= $paginas; $x++) { 
                                        echo $url == "noticias.php?pagina=$x" ? 'Notícias' : '';
                                    } ?>
                                    <?php echo $url == 'processo_seletivo.php' ? 'Trabalhe Conosco' : ''; ?>
                                    <?php echo $url == 'transparencia.php' ? 'Transparência' : ''; ?>
                                    <?php echo $url == 'avaliacao_atendimento.php' || $url == 'ouvidoria.php' ? 'Fale Conosco' : ''; ?>
                                </span>
                                <?php if($url == 'ver_noticia.php?id_noticia='.$id_noticia){ ?>
                                    <?php 
                                        $sql = mysql_query("SELECT titulo FROM noticias WHERE id_noticia =". $id_noticia); 
                                        $row = mysql_fetch_assoc($sql);
                                        $titulo = $row['titulo'];   
                                    ?>
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    <li>
                                        <span>
                                            <?php echo $titulo;?>
                                        </span>
                                    </li>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                    <div class="grafismo">
                        <i class="fa fa-caret-down big" aria-hidden="true"></i>
                        <i class="fa fa-caret-down small" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

