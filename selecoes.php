<?php
    require_once '/sistema/includes/conecte.php';

    $qr_estadosA = mysql_query("SELECT A.id_editalpessoal, A.id_unidade, B.uf, D.id_cargo, B.nome, A.num_edital, A.num_proc_adm, A.data_ini, A.data_fim, D.cargo, A.observacao, A.edital, A.status, A.prorrogado
    FROM editalpessoal AS A
    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
    INNER JOIN editalpessoal_cargos AS C ON (C.id_edital = A.id_editalpessoal)
    LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo)
    WHERE data_fim >= NOW() AND A.status = 1
    ORDER BY B.nome");

    $to_estadosA = mysql_num_rows($qr_estadosA);
    while($row = mysql_fetch_assoc($qr_estadosA)){
        $arrEstadosA[$row['id_unidade']][$row['nome']][$row['uf']][$row['cargo']][$row['id_editalpessoal']] = [
            "num_edital" => $row['num_edital'],
            "num_proc_adm"=> $row['num_proc_adm'],
            "edital"=> $row['edital'],
            "prorrogado" => $row['prorrogado']
        ];
    }


    $qr_estadosB = mysql_query("SELECT nome as nome_unidade, edital as url_edital, YEAR(data_ini) AS ano FROM editalpessoal AS A
                                INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                                WHERE data_fim <= NOW() OR A.status = 2
                                ORDER BY YEAR(data_ini) DESC");
    $to_estadosB = mysql_num_rows($qr_estadosB);
    while($estados = mysql_fetch_array($qr_estadosB)) {
        $array[$estados['nome_unidade']][$estados['ano']][] = $estados['url_edital'];
    } 

    
    /////////////////////////////////////////////////////////// EDITAIS DE COMPRAS ///////////////////////////////////////////////////
    /*$qr_estadosC = mysql_query("SELECT B.uf FROM compras AS A
                    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                    WHERE data_fim >= NOW() AND A.status = 1
                    GROUP BY B.uf ORDER BY B.uf");*/

    $qr_estadosC = mysql_query("SELECT DISTINCT B.uf as uf FROM compras A 
    INNER JOIN UNIDADES AS B ON (B.id_unidade=A.id_unidade)
    WHERE data_fim >=NOW() AND A.status = 1 
    ORDER BY B.nome DESC; ");
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
                            <div class="text-white">
                                <h5><i class="fa fa-users fa-1x" aria-hidden="true"></i> Trabalhe Conosco</h5>
                            </div>

                            <!-- VAGAS ABERTAS -->
                            <div class="mt-3">
                                <strong>Vagas Abertas: </strong>
                                <?php if ($to_estadosA > 0) { ?>
                                    <?php foreach($arrEstadosA as $id => $row1) { ?>
                                        <?php foreach($row1 as $nome_unidade => $row2) { ?>
                                            <?php foreach($row2 as $uf => $row4) { ?>
                                                <li class="sublista">
                                                    <?php echo $nome_unidade; ?> - <?php echo $uf; ?>
                                                </li>
                                                <?php foreach($row4 as $cargo => $row5) { ?>
                                                    <?php foreach($row5 as $id_editalpessoal => $values) { ?>
                                                            <li class="pl-3 titulo_edital">
                                                                <a href="sistema/candidato.php?edital=<?php echo $id_editalpessoal?>" class="bt_edital" data-key="<?php echo $id_editalpessoal?>" target="_blank"> <?php echo $cargo ?></a>
                                                                <?php if ($values['prorrogado']){ ?>
                                                                    <span style="color:red">(Prorrogado)</span>
                                                                <?php } ?>
                                                            </li>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class= "mt-3">
                                        <small class="text-white">Nenhum Processo Seletivo em aberto.</small>
                                    </div>
                                <?php } ?> 
                            </div>

                            <!--PROCESSOS SELETIVOS ENCERRADOS-->
                            <div class="mt-3">
                                <strong>Processo Seletivos Encerrrados: </strong>
                                <?php if($to_estadosB > 0){ ?>
                                    <ul class="p-0">
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
                                    <div class="mt-3">
                                        <small class='text-white'>Nenhum Processo Seletivo encerrado.</small>;
                                    </div>
                                <?php }?>
                            </div>
                            

                            <!--PROCESSOS SELETIVOS ENCERRADOS
                            <strong class="mt-3">Processo Seletivos Encerrados: </strong>
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
                                                                <li class="text-white">
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
                                <?php }?>-->


                            <div>
                                <strong>Regulamento do Regime de Compras:</strong>
                            </div>

                            <div>
                                <a class="btn btn-success text-white btn-sm br-0 botao_regulamento" href="sistema/arquivos/regulamentos/regime_contratacao.pdf" target="_blank">
                                    <small class="text-white">Baixar Regulamento <img src="assets/images/pdficon.png" alt="" class="mb-1"></small>
                                </a>
                            </div>

                            <div class="mt-3">      
                                <small class="text-white">&copy; Todos os direitos Reservados</small>
                            </div>
                        </div>
                    </form>
                </div>

                <!--Editais-->
                <div class="col-sm-6 p-5 hide_editais">
                    <form method="post" action="" name="form2" id="form2">    
                        <div class="editais">
                            <h5 class="text-white"><i class="fa fa-clipboard" aria-hidden="true"></i> Editais de Compras / Serviços</h5>
                            
                            <div class="mt-3">
                                <strong>Editais Abertos: </strong>
                                <?php if($to_estadosC > 0) { ?>
                                    <ul class="pl-3 mb-0">
                                        <?php while($estados = mysql_fetch_array($qr_estadosC)) { ?>
                                            <li class="botao_editais_abertos text-white" data-key=<?php echo $estados['uf']?>>
                                                <?php echo $estados['uf']?>
                                            </li>
                                            <div class="pesquisa<?php echo $estados['uf']?>" style="display: none;"></div>
                                        <?php } ?>
                                    </ul>
                                    <div style="borda-selecoes"></div>
                                <?php } else { ?>
                                    <div>
                                        <small class="text-white">Nenhum Edital aberto.</small>
                                    </div>
                                <?php } ?>
                            </div>
                           

                            <div class="mt-3">
                                <strong>Editais encerrados: </strong>
                                <?php if($to_estadosD > 0) { ?>
                                    <ul class="ml-3 p-0">
                                        <?php while($estados = mysql_fetch_assoc($qr_estadosD)) { ?>
                                            <li class="botao_editais_encerrados" data-key="<?php echo $estados['ano']; ?>">
                                                <?php echo $estados['ano']?>
                                            </li>
                                            <div class="pesquisa<?php echo $estados['ano']?>" style="display: none"><br></div>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <div>
                                        <small class="text-white">Nenhum Edital encerrado.</small>
                                    </div>
                                <?php } ?>
                            </div>


                            <div>
                                <strong>Regulamento do Regime de Compras:</strong>
                            </div>

                            <div>
                                <a class="btn btn-success text-white btn-sm br-0 regime-compras" href="sistema/arquivos/regulamentos/regime_compras.pdf" target="_blank">
                                    <small class="text-white">Baixar Regulamento <img src="assets/images/pdficon.png" alt="" class="mb-1"></small>
                                </a>
                            </div>


                            <div class="mt-3">                                
                                <small class="text-white">&copy; Todos os direitos Reservados</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

<?php include_once('footer.php'); ?>
