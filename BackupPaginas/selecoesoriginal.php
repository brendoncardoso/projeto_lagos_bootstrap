<?php
    require_once '/sistema/includes/conecte.php';

    //////////////////////////////////////////////////// TRABALHE CONOSCO //////////////////////////////////////////////////////////////
    $qr_estadosA = mysql_query("SELECT B.nome, B.uf FROM editalpessoal AS A
                                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                WHERE data_fim >= NOW() AND A.status = 1
                                GROUP BY B.nome ORDER BY B.nome");
    $to_estadosA = mysql_num_rows($qr_estadosA);



    $qr_estadosB = mysql_query("SELECT nome as nome_unidade, edital as url_edital, YEAR(data_ini) AS ano FROM editalpessoal AS A
                                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                WHERE data_fim <= NOW() OR A.status = 2
                                ORDER BY YEAR(data_ini) DESC");
    $to_estadosB = mysql_num_rows($qr_estadosB);

    /////////////////////////////////////////////////////////// EDITAIS DE COMPRAS ///////////////////////////////////////////////////
    $qr_estadosC = mysql_query("SELECT B.uf FROM compras AS A
                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                    WHERE data_fim >= NOW() AND A.status = 1
                    GROUP BY B.uf ORDER BY B.uf");

    $to_estadosC = mysql_num_rows($qr_estadosC);

    $qr_estadosD = mysql_query("SELECT YEAR(data_ini) AS ano FROM compras AS A
                                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                    WHERE data_fim <= NOW() OR A.status = 2
                                    GROUP BY YEAR(data_ini)
                                    ORDER BY YEAR(data_ini) DESC");

    $to_estadosD = mysql_num_rows($qr_estadosD);
?>

<?php include_once('header.php'); ?>

    <!--HEADER MENU-->
    <div class="borda_menu"></div>
    <div class="page_title">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <h4>SELEÇÕES</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Seleções</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="col-sm-12 p-5">
            <div class="row">
                
                <div class="col-sm-6 mb-5">
                    <h5>Procedimentos para aquisição e contratações de serviços</h5>
                    <p class="mb-5">O Instituto dos Lagos Rio disponibiliza em seu site o Regulamento de compras, com todos os processos de aquisições e contratações de serviços, relacionando os fornecedores que firmaram contrato conosco. Basta acessar os links abaixo:</p>
                    
                    <button id="trabalhe_conosco" type="button" class="container btn btn-outline-blue btn-lg mb-3 trabalhe_conosco_button">
                        <i class="fa fa-users" aria-hidden="true"></i> Trabalhe Conosco
                    </button>
                                    
                    <button id="editais" type="button" class="container btn btn-outline-blue btn-lg editais_button">
                        <i class="fa fa-clipboard" aria-hidden="true"></i> Editais de Compras/Serviços
                    </button>
                </div>

                <!--Parte do Grupo -->
                <div class="col-sm-6 p-5 hide_parte_do_grupo">
                    <div class="parte_do_grupo">
                        <div class="mt-2">
                            <h5 class="text-white">Faça parte do grupo instituto Lagos Rio</h5>
                            <p class="text-white">Trabalhar aqui é viver em um ambiente muito alegre e agradável, onde todos buscam contribuir não só para um bom serviço, como também para o cumprimento de nossa missão.</p>
                        </div>
                    </div>
                </div>


                <!--Trabalhe Conosco-->
                <div class="col-sm-6 p-5 hide_trabalhe_conosco">
                    <form method="post" action="" name="form1" id="form1">
                        <div class="trabalhe_conosco">
                            <div class="text-white mb-4">
                                <h5><i class="fa fa-users fa-1x" aria-hidden="true"></i> Trabalhe Conosco</h5>
                            </div>

                            <!-- VAGAS ABERTAS -->
                            <strong>Vagas Abertas: </strong>

                            <?php if ($to_estadosA > 0) { ?>
                                <ul class="mt-3 p-0">
                                    <?php while($estados = mysql_fetch_array($qr_estadosA)) { ?>
                                        <li class="text-white">
                                            <?php echo $estados['nome']; ?> - <?php echo $estados['uf']; ?>

                                            <ul>
                                                <?php 
                                                    $qr_vagasAb = mysql_query("SELECT * FROM editalpessoal AS A INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                                    INNER JOIN editalpessoal_cargos AS C ON (C.id_edital = A.id_editalpessoal)
                                                    LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo) 
                                                    WHERE data_fim >= NOW() AND A.status = 1 AND B.nome = '{$estados['nome']}'
                                                    ORDER BY B.nome");
                                                ?>

                                                <?php while($vagasAb = mysql_fetch_array($qr_vagasAb)) { ?>
                                                    <li class="ml-4">
                                                        <a href="sistema/candidato.php" class="bt_edital" data-key="<?php echo $vagasAb['id_editalpessoal']?>" target="_blank"> <?php echo $vagasAb['cargo']?></a>
                                                        <?php if ($vagasAb['prorrogado']){ ?>
                                                            <span style="color:red">(Prorrogado)</span>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <div class="borda-selecoes"></div>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <small class="text-white mt-3"><br/>Nenhum Processo Seletivo em aberto.</small><br/><br/>
                            <?php } ?>
                            

                            <!--PROCESSOS SELETIVOS ENCERRADOS-->
                            <strong class="mt-3">Processo Seletivos Encerrrados: </strong>
                                <?php while($estados = mysql_fetch_array($qr_estadosB)) {
                                                $array[$estados['nome_unidade']][$estados['ano']][] = $estados['url_edital'];
                                            }   
                                            //echo '<pre>';
                                            //print_r($estados);
                                            //echo '</pre>'; 

                                if($to_estadosB > 0){

                                ?>

                                <ul class="mt-3 p-0">
                                    <?php foreach ($array as $nome_unidade => $value) { ?>
                                        <li class="text-white mb-3">
                                            <?php echo $nome_unidade; ?>             
                                            <ul class="text-white">
                                                <?php foreach($value as $ano => $links_edital) { ?>
                                                    <li class="ml-4 text-white mb-3">
                                                        <?php echo $ano; ?>
                                                        <ul>
                                                            <?php foreach ($links_edital as $link) { ?>
                                                                <li>
                                                                    <a href="<?php echo $link; ?>" target="a_blank">
                                                                        <img src="assets/images/pdf-icon.png" width="30" height="30"/>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <div class="borda-selecoes"></div>
                                        </li>
                                    <?php } ?>
                                </ul>    

                                <?php } else { ?>
                                    <small class='text-white mt-3'>Nenhum Processo Seletivo encerrado.</small><br/><br/>;
                                <?php }?>
                            <br>

                            <strong>Regulamento do Regime de Compras:</strong><br/>

                            <a class="btn btn-success text-white btn-sm br-0 botao_regulamento" href="sistema/arquivos/regulamentos/regime_contratacao.pdf" target="_blank">
                                <small class="text-white">Baixar Regulamento <img src="assets/images/pdficon.png" alt="" class="mb-1"></small>
                            </a>

                            <br/><br/>

                            <small class="text-white">&copy; Todos os direitos Reservados</small>
                        </div>
                    </form>
                </div>

                <!--Editais-->
                <div class="col-sm-6 p-5 hide_editais">
                    <form method="post" action="" name="form2" id="form2">    
                        <div class="editais">
                            <h5 class="text-white"><i class="fa fa-clipboard" aria-hidden="true"></i> Editais de Compras / Serviços</h5>
                            <br/>
                            <strong>Editais Abertos: </strong>

                            <?php if($to_estadosC > 0) { ?>
                                <ul class="mt-3 p-0">
                                    <?php while($estados = mysql_fetch_array($qr_estadosC)) { ?>
                                        <li class="text-white mt-3">
                                            <?php echo $estados['uf']?>
                                            <ul class="p-0">
                                                <?php
                                                    $qr_vagasCd = mysql_query("SELECT * FROM compras AS A
                                                        INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                                        WHERE data_fim >= NOW() AND A.status = 1 AND B.uf = '{$estados['uf']}'
                                                        ORDER BY B.nome");
                                                ?>

                                                <?php while($vagasCd = mysql_fetch_array($qr_vagasCd)) { ?>
                                                    <li class="ml-5">
                                                        <a href="sistema/editais.php" data-key="<?php echo $vagasCd['id_compra']?>" data-st="0" target="_blank"><?php echo $vagasCd['nome']?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <div style="borda-selecoes"></div>
                                </ul>

                            <?php } else { ?>
                                <small class="text-white"><br/>Nenhum Edital aberto.</small><br/><br/>
                            <?php } ?>

                            <strong>Editais encerrados: </strong>

                            <?php if($to_estadosD > 0) { ?>
                                <ul class="ml-3 p-0">
                                    <?php while($estados = mysql_fetch_array($qr_estadosD)) { ?>
                                        <li class="a" data-key="<?php echo $estados['ano']?>" data-st="0">
                                            <?php echo $estados['ano']?>

                                        </li>
                                    <?php } ?>
                                    <div id="pesquisa"></div>
                                </ul>
                            <?php } else { ?>
                                <small class="text-white">Nenhum Edital encerrado.</small><br/><br/>
                            <?php } ?>

                            

                            <strong>Regulamento do Regime de Compras:</strong><br/>
                            <a class="btn btn-success text-white btn-sm br-0 regime-compras" href="sistema/arquivos/regulamentos/regime_compras.pdf" target="_blank">
                                <small class="text-white">Baixar Regulamento <img src="assets/images/pdficon.png" alt="" class="mb-1"></small>
                            </a>

                            <br/><br/>

                            <small class="text-white">&copy; Todos os direitos Reservados</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

<?php include_once('footer.php'); ?>
