<?php
    include 'sistema/includes/conecte.php';

    $sql = "SELECT id_noticia, titulo, subtitulo, data FROM noticias WHERE status = 1 ORDER BY data DESC;";
    $sql_noticias = mysql_query($sql);
    $data = isset($data['data'])?$data['data']: '';

    while($sql_fetch = mysql_fetch_assoc($sql_noticias)){
        $array_noticias[$sql_fetch['id_noticia']] = [
            "id_noticia" => $sql_fetch['id_noticia'], 
            "titulo" => $sql_fetch['titulo'],
            "subtitulo" => $sql_fetch['subtitulo'],
            "data" => $sql_fetch['data']
        ];
    }
    
    /*echo '<pre>';
    print_r($array_noticias);
    echo '</pre>';*/

?>    
    <!--FOOTER-->
    <div class="footer">
        <div class="container p-0">
            <div id="scrollup">
                <i class="fa fa-angle-double-up"></i>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 footer_lagos">
                        <div class="widget_icon">
                            <img src="assets/images/planeta.png" alt="">
                        </div>
                        
                        <h5 class="text-white text-center mt-4 mb-5">SOBRE A LAGOS</h5>

                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <li class="">
                                    <iframe width="450" height="282" frameborder="5" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+do+Carmo,+9,+Centro,+Rio+de+Janeiro&amp;aq=1&amp;oq=rua+do+carmo,+9&amp;sll=-22.914131,-43.445982&amp;sspn=0.369991,0.676346&amp;ie=UTF8&amp;hq=&amp;hnear=Rua+do+Carmo,+9+-+Centro,+Rio+de+Janeiro,+20011-020&amp;t=m&amp;z=14&amp;ll=-22.903163,-43.176239&amp;output=embed"></iframe>
                                </li>
                            </div>

                            <div class="col-sm-1"></div>
                           
                            <div class="col-sm-3">
                                <li class="">
                                    <i class="fa fa-home" aria-hidden="true"></i> R. do Carmo, 9 - Centro, Rio de Janeiro
                                </li>

                                <li class="">
                                    <i class="fa fa-envelope" aria-hidden="true"></i> 
                                    <strong>Email:</strong> <a class="link" style="font-size: 12px;" href="mailto:ouvidoria@institutolagosrio.com.br">ouvidoria@institutolagosrio.com.br</a>
                                </li>

                                <!--<li>
                                    <i class="fa fa-envelope" aria-hidden="true"></i> 
                                    <strong>Email:</strong> <a class="link" style="font-size: 12px;" href="mailto:projeto@institutolagosrio.com.br">projeto@institutolagosrio.com.br</a>
                                </li>-->

                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i> <strong>Tel.: </strong>(21) 2725-5602 
                                </li>
                            </div>
                        </div>
                    </div>
        
                    

                    <!--<div class="col-sm-4">
                        <ul class="footer_lagos">
                            <div class="widget_icon">
                                <img src="assets/images/sobre.png" alt="">
                                <h5 class="text-white mt-4 mb-3">SOBRE A LAGOS</h5>
                            </div>

                            
                            <li>
                                <i class="fa fa-home" aria-hidden="true"></i> R. do Carmo, 9 - Centro, Rio de Janeiro
                            </li>

                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i> 
                                <strong>Email:</strong> <a class="link" style="font-size: 12px;" href="mailto:ouvidoria@institutolagosrio.com.br">ouvidoria@institutolagosrio.com.br</a>
                            </li>

                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i> 
                                <strong>Email:</strong> <a class="link" style="font-size: 12px;" href="mailto:projeto@institutolagosrio.com.br">projeto@institutolagosrio.com.br</a>
                            </li>

                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i> <strong>Tel.: </strong>(21) 2725-5602 
                            </li>

                            <hr class="borda_footer">
                        </ul>
                    </div>-->

                    <!--<div class="col-sm-4 footer_lagos">
                        <div class="widget_icon">
                            <img src="assets/images/posts.png" alt="">
                            <h5 class="text-white text-center mt-4 mb-5">POSTS RECENTES</h5>
                        </div>

                        <div class="col-sm-12">
                            <?php $contador = 1; ?>
                            <?php foreach($array_noticias as $noticias) { ?>
                                <?php if ($contador <= 3) { ?>

                                    <div class=" mt-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                                <div class="col-sm-12 p-0">
                                                <img src="assets/images/noticias_img.png" alt="" class="border-lightblue" height="68">
                                                    <div class="noticias_column">
                                                        <a class="link" href="noticia_bd.php?id_noticia=<?php echo $noticias['id_noticia']; ?>" >
                                                            <h6 class="noticias_titulo">
                                                                <?php echo $noticias['titulo']?>
                                                            </h6>
                                                        </a>

                                                        <p class="noticias_subtitulo">

                                                            <?php echo ucfirst(mb_strtolower($noticias['subtitulo'])); ?>

                                                            <a class="link pl-1" href="noticia_bd.php?id_noticia=<?php echo $noticias['id_noticia']; ?>" target="_blank">
                                                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                            </a>

                                                        </p>

                                                        <div class="noticias_data">
                                                            <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo ucfirst(strftime("%B %d, %Y", strtotime($noticias['data']))); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <hr class="borda_footer pl-5 pr-5">
                                <?php } ?>
                                <?php $contador++; ?>
                            <?php } ?>
                        </div>
                    </div>-->

                    <!--<h6 class="text-white text-center">OUVIDORIA</h6>

                    <div class="borda_ouvidoria text-white">
                        <small>Sugestões, elogios ou reclamações: (21) 2532-0144</small>
                        <hr class="ouvidoria">
                        <p style="color: white">E-mail: </p><small class="text-white">ouvidoria@institutolagosrio.com.br</small>
                        <hr class="ouvidoria">
                        <p style="color: white">E-mail para o recebimento de editais e esclarecimentos de prefeitura:</p> <small class="text-white">projeto@institutolagosrio.com.br</small>
                        <p class="text-center pt-5">
                            <a href="fale_conosco.php" class="faleconosco_botao text-white">ENTRAR EM CONTATO</a>
                        </p>
                    </div>-->

                    <!--<div class="col-sm-4 footer_lagos">
                        <div class="container containerbg">
                            <div class="widget_icon_solo">
                                <img class="img_relogio" src="assets/images/relogio.png" alt="">
                            </div>

                            <ul class="footer_lagos p-4">
                                <li class="text-white pt-0">Seg: 09:00 am - 17:00 pm</li>
                                <hr class="borda_footer">
                                <li class="text-white pt-0">Ter: 09:00 am - 17:00 pm</li>
                                <hr class="borda_footer">
                                <li class="text-white pt-0">Qua: 09:00 am - 17:00 pm</li>
                                <hr class="borda_footer">
                                <li class="text-white pt-0">Qui: 09:00 am - 17:00 pm</li>
                                <hr class="borda_footer">
                                <li class="text-white pt-0">Sex: 09:00 am - 17:00 pm</li>
                                <hr class="borda_footer">
                                <li class="text-white pt-0">Sáb e Dom: Dia Livre</li>
                                <hr class="borda_footer">
                            </ul>

                            <p class="text-center p-0">
                                <a href="fale_conosco.php" class="faleconosco_botao text-white" style="font-size: 11px; line-height: 16px; padding: 7px;">ENTRAR EM CONTATO</a>
                            </p>

                        </div>      
                    </div>-->

                </div>
            </div>
        </div>

        <div class="copyright">
            <div class="container">
                <p class="text-white"><i class="fa fa-copyright" aria-hidden="true"></i> Copyrights: Instituto dos Lagos Rio - Desenvolvido por <a href="https://www.f71.com.br/" style="text-decoration: none;" target="_blank"><img src="assets/images/f71_copyright.png" alt="" width="30"></a></p>
            </div>
        </div>

    </div>

    
    
    <!--JavaScript--><!--JQUERY-->        
    <script src="assets/js/jquery.3-4-1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/js/jquery.validationEngine-pt_BR.js"></script>
    <script src="assets/js/jquery.validationEngine.min.js"></script>
    <script src="assets/js/jquery.maskedinput.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!--POPPER-->
    <!--<script src="assets/js/popper.min.js"></script>-->
    <script src="assets/js/responsive.js"></script>
    <script src="assets/js/script.js"></script>   
    <script src="assets/js/document_jquery.js"></script>
    <script src="assets/js/noticia.js"></script>
    <script src="assets/js/acesso-rapido.js"></script>
    <script src="assets/js/parceiros-carousel.js"></script>
    <script src="assets/js/jquery.progresstimer.js"></script>

</body>
</html>  