<?php
    include '../sistema/includes/conecte.php';

// RELATÓRIO DE EXECUÇÃO
$rel_execucao = mysql_query("SELECT A.*, B.nome AS nome_unidade
FROM relatorio AS A
LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
WHERE A.status = 1 AND A.tipo = 1
ORDER BY A.Ano, A.mes ASC
    ");

while($row = mysql_fetch_assoc($rel_execucao)){
    $rel_exec[$row['ano']][$row['mes']] = $row['mes']."_".$row['ano'].".pdf";
}

// RELATÓRIO ANUAL

///////////////////////////////////////// RELATÓRIO ANUAL DE 2013 ////////////////////////////////////////////////////////
$sql_a = mysql_query("SELECT A.*, B.nome AS nome_unidade
                    FROM relatorio AS A
                    LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                    WHERE A.ano = '2013' AND A.status = 1 AND A.tipo = 2
                    ORDER BY B.nome") or die(mysql_error());
$uni_a = array();

while ($row_a = mysql_fetch_assoc($sql_a)){
    $uni_a[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $uni_a[$row_a['id_unidade']]["dados"] [$row_a['subtipo']]= $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

/////////////////////////////////////////// RELATÓRIO ANUAL DE 2014 //////////////////////////////////////////////////////
$sql_a14 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2014' AND A.status = 1 AND A.tipo = 2
                        ORDER BY B.nome") or die(mysql_error());
$anual_14 = array();

while ($row_a = mysql_fetch_assoc($sql_a14)){
    $anual_14[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $anual_14[$row_a['id_unidade']]["dados"] [$row_a['subtipo']]= $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

/////////////////////////////////////////// RELATÓRIO ANUAL DE 2015 ////////////////////////////////////////////////////////
$sql_a15 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2015' AND A.status = 1 AND A.tipo = 2
                        ORDER BY B.nome") or die(mysql_error());
$anual_15 = array();

while ($row_a = mysql_fetch_assoc($sql_a15)){
    $anual_15[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $anual_15[$row_a['id_unidade']]["dados"] [$row_a['subtipo']]= $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

/////////////////////////////////////////// RELATÓRIO ANUAL DE 2016 ////////////////////////////////////////////////////////
$sql_a16 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                            FROM relatorio AS A
                            LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                            WHERE A.ano = '2016' AND A.status = 1 AND A.tipo = 2
                            ORDER BY B.nome") or die(mysql_error());
$anual_16 = array();

while ($row_a = mysql_fetch_assoc($sql_a16)){
    $anual_16[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $anual_16[$row_a['id_unidade']]["dados"] [$row_a['subtipo']]= $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

//////////////////////////////////////////// RELATÓRIO ANUAL DE 2017 ///////////////////////////////////////////////////////
$sql_a17 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2017' AND A.status = 1 AND A.tipo = 2
                        ORDER BY B.nome") or die(mysql_error());
$anual_17 = array();

while ($row_a = mysql_fetch_assoc($sql_a17)){
    $anual_17[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $anual_17[$row_a['id_unidade']]["dados"] [$row_a['subtipo']]= $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

////////////////////////////////////////// RELATÓRIO ANUAL DE 2018 //////////////////////////////////////////////////////////

$sql_a18 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2018' AND A.status = 1 AND A.tipo = 2
                        ORDER BY B.nome") or die(mysql_error());
$anual_18 = array();

while ($row_a = mysql_fetch_assoc($sql_a18)){
    $anual_18[$row_a['id_unidade']]["unidade"] = $row_a['nome_unidade'];
    $anual_18[$row_a['id_unidade']]["dados"] [$row_a['subtipo']] = $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
}

////////////////////////////////////////// RELATÓRIO ANUAL DE 2019 ///////////////////////////////////////////////////////
$sql_a19 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2018' AND A.status = 1 AND A.tipo = 2
                        ORDER BY B.nome") or die(mysql_error());
$anual_19 = array();

while ($row_a = mysql_fetch_assoc($sql_a19)){
    $anual_19[$row_a['id_unidade']]['unidade'] = $row_a['nome_unidade'];
    $anual_19[$row_a['id_unidade']]['dados'] [$row_a['subtipo']] = $row_a['id_unidade']. "_" .$row_a['tipo']. "_" .$row_a['subtipo']. "_" .$row_a['ano']. ".pdf";
} 

function listFolderFiles($dir){
    $ffs = scandir($dir);
    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

// prevent empty ordered elements

if (count($ffs) < 1) 
return;

echo '<ul style="display:none; list-style-type: circle;" class="show_compras">';
    foreach($ffs as $ff){
        $li = strpos($ff,".pdf") > 0 ? "<p class='p_preto'><a href='".$dir.'/'.$ff."'>".str_replace('.pdf','',$ff)."</a></p>" : $ff;
        echo '<li>'.$li;
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
        echo '</li>';
    }
echo '</ul>';
}


?>

<?php include_once('../header.php'); ?>

    <!--HEADER MENU-->
    <div class="borda_menu"></div>
    <div class="page_title">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <h4>TRANSPARÊNCIA</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Transparência</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-5">
        <img class="" src="assets/images/relatorio.jpg" width="100%" class="img-fluid" alt="Responsive image">
    </div>
    
    <div class="container">
        <div class="col-sm-12">
            <h5 class="title_wall">Apresentação</h5>
            <div class="row">
                <div class="col-sm-5">
                    <div class="lei mb-5">
                        <p>Lei de Acesso à informação</p>
                        <p>Em respeito à normativa legal que garante o acesso à informação pública e estabelece a obrigatoriedade dos órgãos públicos e entidade sem fins lucrativos garantirem e divulgarem independente de solicitação, informações e interesse geral ou coletivo, garantindo a confidencialidade prevista no texto legal. A Lei determina que estejam acessíveis na internet dados relacionados à gastos, estrutura, entre outros, o que é denominado Transparência Ativa.</p>
                        <p>Com o objetivo de mantermos a seriedade e a transparência de nossa Instituição, o Instituto dos Lagos Rio, tornou acessível às informações de seus projetos, sempre visando a boa administração e respeitando os interesses da população.</p>
                        <p>Fonte: <a href="http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm" target="_blank">Lei nº 12.527/11 – Lei de Acesso à informação</a></p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <img class="img-thumbnail" src="assets/images/transparencia.jpeg" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <h4>Prestação de Contas</h4>
                    <div class="borda_line" style="width: 210px!important"></div>
                </div>
                <div class="col-sm-7">
                    <h4>Relatórios</h4>
                    <div class="borda_line" style="width: 105px!important"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <ul style="list-style-type: unset;">
                        <li><p class="p_preto"><a href="pdfs/novo/Estatuto abertura do Complexo.pdf" target="_blank">Estatuto Consolidado da OSS</a></p></li>
                        <!-- <li><p class="p_preto"><a href="pdfs/balancopatrimonial.pdf" target="_blank">Balanço Patrimonial do ano de 2012</a></p></li> -->
                        <li><p class="p_preto">Ouvidoria  - <a href="ouvidoria.php">acesse aqui</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Balanco e Demonstracoes Financeiras 2013.pdf" target="_blank">Balanço e Demonstrações Financeiras 2013</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Balanco e Demonstracoes Financeiras 2014.pdf" target="_blank">Balanço e Demonstrações Financeiras 2014</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Balanco e Demonstracoes Financeiras 2015.pdf" target="_blank">Balanço e Demonstrações Financeiras 2015</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Balanco e Demonstracoes Financeiras 2016.pdf" target="_blank">Balanço e Demonstrações Financeiras 2016</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Balanco e demonstracoes financeiras 2017.pdf" target="_blank">Balanço e Demonstrações Financeiras 2017</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/novo/CND2018.pdf" target="_blank">Certidão Negativa de Débitos</a></p></li>

                        
                        <div class="card-header" role="tab" id="headingOne1">
                            <li><p class="p_preto"><a id="show_cad_crf" data-toggle="collapse" data-parent="#accordionEx" href="collapseOne1" aria-expanded="true" aria-controls="collapseOne1">CRF - Certificado de Regularidade do FGTS <i class="fa fa-angle-down rotate-icon text-center"></i></a></p>
                                <ul id="hide_cad_crf">
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF - SGI.pdf" target="_blank">UPA 24h São Gonçalo I</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF - SGII.pdf" target="_blank">UPA 24h São Gonçalo II</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF BANGU.pdf" target="_blank">UPA 24h Bancu</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF MARECHAL.pdf" target="_blank">UPA 24h Marechal</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF REALENGO.pdf" target="_blank">UPA 24h Realengo</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF RICARDO.pdf" target="_blank">UPA 24h Ricardo de Albuquerque</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF_CAMPOS.pdf" target="_blank">UPA 24h Campos dos Goytacazes</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF Niteroi.pdf" target="_blank">UPA 24h Niterói</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF VIAMAO.pdf" target="_blank">UPA 24h Viamão</a></p></li>
                                    <li><p class="p_preto"><a href="pdfs/novo/CRF Sao Pedro da Aldeia.pdf" target="_blank">UPA 24h São Pedro da Aldeia</a></p></li>
                                </ul>
                            </li>
                        </div>

                        <!--li><p class="p_preto"><a href="pdfs/Certificado de Regularidade FGTS 2013.pdf" target="_blank">Certificado de Regularidade FGTS 2013</a></p></li> -->
                        <!--<li><p class="p_preto"><a href="pdfs/Parecer de Auditoria 2013.pdf" target="_blank">Parecer de Auditoria 2013</a></p></li>
                        <li><p class="p_preto"><a href="pdfs/Pronunciamento do Conselho de Administracao 2013.pdf" target="_blank">Pronunciamento do Conselho de Administração 2013</a></p></li>-->
                        <li><p class="p_preto"><a href="pdfs/Relatorio Execucao Orcamentaria Analitico.xls" target="_blank">Relatório Execução Orçamentária Analítico</a></p></li>                    
                        <!-- <li><p class="p_preto"><a href="pdfs/denominacao_social_entidade.pdf" target="_blank">Denominação Social da Entidade</a></p></li> -->                   
                        <li><p class="p_preto"><a href="javascript::void(0)" target="_blank">Certificado de Registro Cadastral - CRC</a></p></li>                    
                        <li><p class="p_preto"><a href="javascript::void(0)" class="toggle" id="show_cad_gestao">Relatório de Gestão</a></p>
                            <ul id="hide_cad_gestao" style="display : none">
                                <li><p class="p_preto"><a href="javascript::void(0)" class="toogle">2017</a></p>
                                    <ul>
                                        <li><p class="p_preto"><a href="arquivos/Prestação de Contas_Set_7_CES-RJ.pdf" target="_blank">Setembro - Complexo Estadual de Saúde</a></p></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><p class="p_preto"><a id="show_cad_nacional" data-toggle="collapse" data-parent="#accordionEx" href="collapseOne2" aria-expanded="true" aria-controls="collapseOne2">Cadastro Nacional de Pessoa Jurídica - CNPJ <i class="fa fa-angle-down rotate-icon text-center"></i></a></p>
                            <ul id="hide_cad_nacional">
                                <li><p class="p_preto"><a href="pdfs/novo/CNPJ HEAT.pdf" target="_blank">CNPJ - Instituto dos Lagos - Rio</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_bebedouro.pdf" target="_blank">CNPJ - Bebedouro</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_bangu.pdf" target="_blank">CNPJ - UPA 24h BANGU</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_campos_goytacazes.pdf" target="_blank">CNPJ - UPA 24h Campos dos Goytacazes</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_marechal_hermes.pdf" target="_blank">CNPJ - UPA 24h Marechal Hermes</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_niteroi.pdf" target="_blank">CNPJ - UPA 24h Niterói</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_realengo.pdf" target="_blank">CNPJ - UPA 24h Realengo</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_ricardo_albuquerque.pdf" target="_blank">CNPJ - UPA 24h Ricardo de Albuquerque</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_sao_goncalo_1.pdf" target="_blank">CNPJ - UPA 24h São Gonçalo I</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_sao_goncalo_2.pdf" target="_blank">CNPJ - UPA 24h São Gonçalo II</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/cnpj_alberto_torres.pdf" target="_blank">CNPJ - Hospital Estadual Albarto Torres</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/CNPJ Caffaro.pdf" target="_blank">CNPJ - Cáffaro</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/CNPJ Sao Pedro da Aldeia.pdf" target="_blank">CNPJ - São Pedro da Aldeia</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/CNPJ Viamao.pdf" target="_blank">CNPJ - Viamão</a></p></li>
                                <li><p class="p_preto"><a href="pdfs/CNPJ Carlos Chagas.pdf" target="_blank">CNPJ - Carlos Chagas</a></p></li>
                            </ul>
                        </li>  

                        <li>
                            <p class="p_preto"><a href="pdfs/qualificacao_completa_dos_integrantes_administração_conselho_fiscal.pdf" target="_blank">Qualificação Completa dos Integrantes da Administração e do Conselho Fiscal</a></p>
                        </li> 

                        <li>
                            <p class="p_preto"><a id="show_cont_adtv" data-toggle="collapse" data-parent="#accordionEx" href="collapseOne3" aria-expanded="true" aria-controls="collapseOne3">Contrato de Gestão e Termos Aditivos <i class="fa fa-angle-down rotate-icon text-center"></i></a></p>
                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_bangu">
                                    <p class="p_preto"><a>BANGU</a></p>
                                    <ul id="show_cont_bangu">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_bangu_UPA.pdf" target="_blank">1º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_bangu_UPA.pdf" target="_blank">2º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_020_2012-UPA_Bangu.pdf" target="_blank">3º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 020 2012 Bangu.pdf" target="_blank">4º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 020 2012 - Bangu.pdf" target="_blank">5º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 020.2012 Bangu.pdf" target="_blank">6º Termo Aditivo BANGU</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_020_bangu_UPA.PDF" target="_blank">Contrato de Gestão 020 Bangu</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTÃO 020 2012 - UPA Bangu.PDF" target="_blank">Contrato de Gestão 020 2012 Bangu</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_bebedouro"><p class="p_preto"><a>BEBEDOURO</a></p>
                                    <ul id="show_cont_bebedouro">
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_bebedouro.pdf" target="_blank">Contrato de Gestão Bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/1 Termo Aditivo n 111.2013 Bebedouro.pdf" target="_blank">1 Termo Aditivo n 111.2013 Bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2 Termo Aditivo n. 84.2016 Bebedouro.pdf" target="_blank">2 Termo Aditivo n. 84.2016 Bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2 Termo aditivo n. 163.2013 Bebedouro.pdf" target="_blank">2 Termo aditivo n. 163.2013 Bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/Contrato de Gestão n 016-2014 - bebedouro.pdf" target="_blank">Contrato de Gestão n 016-2014 - bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/Contrato de Gestão n 88.2015 - bebedouro.pdf" target="_blank">Contrato de Gestão n 88.2015 - bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/Contrato n 134.2013 Bebedouro.pdf" target="_blank">Contrato n 134.2013 Bebedouro</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/Oficio Aditivo Bebedouro.pdf" target="_blank">Oficio Aditivo Bebedouro</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_campos_goytacazes"><p class="p_preto"><a>CAMPOS DE GOYTACAZES</a></p>
                                    <ul id="show_cont_campos_goytacazes">
                                        <li><p class="p_preto"><a href="pdfs/1 Termo Aditivo CONTRATO 001 2014 Campos.pdf" target="_blank">1º Termo Aditivo UPA Campos de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2 Termo Aditivo CONTRATO 001 2014 Campos.pdf" target="_blank">2º Termo Aditivo UPA Campo de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3 Termo Aditivo CONTRATO 001 2014 Campos.pdf" target="_blank">3º Termo Aditivo UPA Campo de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 001 2014 Campos.pdf" target="_blank">4º Termo Aditivo UPA Campo de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5º Termo Aditivo CONTRATO 001.2014 Campos.pdf" target="_blank">5º Termo Aditivo UPA Campo de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6º Termo Aditivo CONTRATO 001.2014 Campos.pdf" target="_blank">6º Termo Aditivo UPA Campo de Goytacazes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTÃO Nº 001 014 - UPA CAMPOS.pdf" target="_blank">Contrato de Gestão 001.14 UPA</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_marechal_hermes">
                                    <p class="p_preto"><a>MARECHAL HERMES</a></p>
                                    <ul id="show_cont_marechal_hermes">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_marechal_hermes_UPA.pdf" target="_blank">1º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_marechal_hermes_UPA.pdf" target="_blank">2º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_021_2012-UPA_Marechal_Hermes.pdf" target="_blank">3º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 021 2012 Marechal.pdf" target="_blank">4º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 021 2012 - Marechal.pdf" target="_blank">5º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 021.2012 Marechal.pdf" target="_blank">6º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/7 Termo Aditivo CONTRATO 021.2012 - Marechal.pdf" target="_blank">7º Termo Aditivo UPA Marechal Hermes</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_021_2012_marechal_hermes_UPA.pdf" target="_blank">5Contrato de Gestão 021 2012 UPA</a></p></li>
                                        <!--<li><p class="p_preto"><a href="pdfs/contrato_de_gestao_021_marechal_hermes_UPA.pdf" target="_blank">Contrato de Gestão 021 UPA</a></p></li>-->
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_niteroi"><p class="p_preto"><a>NITERÓI</a></p>
                                    <ul id="show_cont_niteroi">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_niteroi_UPA.pdf" target="_blank">1º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_niteroi_UPA.pdf" target="_blank">2º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_024_2012-UPA_Fonseca.pdf" target="_blank">3º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 024 2012 UPA Niteroi.pdf" target="_blank">4º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 024 2012 UPA Niteroi.pdf" target="_blank">5º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 024.2012 UPA NITEROI.pdf" target="_blank">6º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/7 Termo Aditivo CONTRATO  024.2012 - UPA NITERO�?.pdf" target="_blank">7º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/8 Termo Aditivo CONTRATO 024.2012 - UPA NITERÓI.pdf" target="_blank">8º Termo Aditivo UPA Niterói</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_024_0162017_niterói_UPA.pdf" target="_blank"></a>CONTRATO DE GESTÃO N° 016.2017 - UPA NITERÓI</p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_024_2012_niteroi_UPA.pdf" target="_blank">Contrato de Gestão 024 2012 UPA</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_realengo"><p class="p_preto"><a>REALENGO</a></p>
                                    <ul id="show_cont_realengo">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_realengo_UPA.pdf" target="_blank">1º Termo Aditivo UPA Realengo</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_realengo_UPA.pdf" target="_blank">2º Termo Aditivo UPA Realengo</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_022_2012-UPA_Realengo.pdf" target="_blank">3º Termo Aditivo UPA Realengo</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 022 2012 - Realengo.pdf" target="_blank">4º Termo Aditivo UPA Realengo</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 022 2012 Realengo.pdf" target="_blank">5º Termo Aditivo UPA Realengo</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 022.2012 Realengo.pdf" target="_blank">6º Termo Aditivo UPA Realengo</a></p></li>
                                        <!--<li><p class="p_preto"><a href="pdfs/contrato_de_gestao_realengo_022_2012_UPA.pdf" target="_blank">Contrato de Gestão 022 2012 UPA</a></p></li>-->
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTÃO 022 2012 - UPA Realengo.pdf" target="_blank">Contrato de Gestão 022 2012 UPA</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_realengo_022_UPA.pdf" target="_blank">Contrato de Gestão 022 UPA</a></p></li>
                                    </ul>
                                </li>
                            </ul>


                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_ricardo_albuquerque"><p class="p_preto"><a>RICARDO DE ALBUQUERQUE</a></p>
                                    <ul id="show_cont_ricardo_albuquerque">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_ricardo_albuquerque_UPA.pdf" target="_blank">1º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_ricardo_albuquerque_UPA.pdf" target="_blank">2º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_023_2012-UPA_Ricardo_de_Albuquerque.pdf" target="_blank">3º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 023 2012 Ricardo.pdf" target="_blank">4º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 023 2012 Ricardo de Al.pdf" target="_blank">5º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 023.2012 - Ricardo de A.pdf" target="_blank">6º Termo Aditivo UPA Ricardo de Albuquerque</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_ricardo_albuquerque_023_2012_UPA.pdf" target="_blank">Contrato de Gestão 023 2012 UPA</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_ricardo_albuquerque_023_UPA.pdf" target="_blank">Contrato de Gestão 023 UPA</a></p></li>
                                    </ul>
                                </li>
                            </ul>


                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_sao_goncalo_um">
                                    <p class="p_preto"><a>SÃO GONÇALO 1</a></p>
                                    <ul id="show_cont_sao_goncalo_um">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_sg_um_UPA.pdf" target="_blank">1º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_sg_um_UPA.pdf" target="_blank">2º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_024_2012-UPA_Fonseca.pdf" target="_blank">3º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 014 2012 Sao Goncalo I.pdf" target="_blank">4º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 014 2012 Sao Goncalo I.pdf" target="_blank">5º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 014 2012 Sao Goncalo I.pdf" target="_blank">6º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/7 Termo Aditivo CONTRATO 014 2012 Sao Goncalo I.pdf" target="_blank">7º Termo Aditivo UPA São Gonçalo 1</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_sg_um_014_2012_UPA.pdf" target="_blank">Contrato de Gestão 014 2012 UPA</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/contrato_de_gestao_sg_um_014_UPA.pdf" target="_blank">Contrato de Gestão 014 UPA</a></p></li>
                                    </ul>
                                </li>
                            </ul>


                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_sao_goncalo_dois"><p class="p_preto"><a>SÃO GONÇALO 2</a></p>
                                    <ul id="show_cont_sao_goncalo_dois">
                                        <li><p class="p_preto"><a href="pdfs/1_termo_aditivo_sg_dois_UPA.pdf" target="_blank">1º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2_termo_aditivo_sg_dois_UPA.pdf" target="_blank">2º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/3_TA_CONTRATO_015_2012-UPA_Santa_Luzia.pdf" target="_blank">3º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/4 Termo Aditivo CONTRATO 015 2012 - Sao Goncalo II.pdf" target="_blank">4º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/5 Termo Aditivo CONTRATO 015 2012 Sao Goncalo II.pdf" target="_blank">5º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/6 Termo Aditivo CONTRATO 015.2012 Sao Goncalo II.pdf" target="_blank">6º Termo Aditivo UPA São Gonçalo 2</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTAO 015 2012 - UPA Sao Goncalo II.pdf" target="_blank">Contrato de Gestão 015 2012 UPA</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTAO N° 017.2017 - UPA SAO GONCALO II.pdf" target="_blank">Contrato de Gestão Nº 017.2017 UPA</a></p></li>
                                        <!--<li><p class="p_preto"><a href="pdfs/contrato_de_gestao_sg_dois_015_2012_UPA.pdf" target="_blank">Contrato de Gestão 015 2012 UPA</a></p></li>-->
                                        <!--<li><p class="p_preto"><a href="pdfs/contrato_de_gestao_sg_dois_015_UPA.pdf" target="_blank">Contrato de Gestão 015 UPA</a></p></li>-->
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_carlos_chagas"><p class="p_preto"><a>CARLOS CHAGAS</a></p>
                                    <ul id="show_cont_carlos_chagas">
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTAO N 019.2017 - UTI HECC.pdf" target="_blank">CONTRATO DE GESTÃO N° 019.2017 - UTI HECC</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_viamao"><p class="p_preto"><a>VIAMÃO</a></p>
                                    <ul id="show_cont_viamao">
                                        <li><p class="p_preto"><a href="pdfs/1 Termo Aditivo - Viamao.pdf" target="_blank">1 Termo Aditivo - Viamão</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/2 Termo Aditivo - Viamao.pdf" target="_blank">2 Termo Aditivo - Viamao</a></p></li>
                                        <li><p class="p_preto"><a href="pdfs/Contrato de Gestao Viamao.pdf" target="_blank">Contrato de Gestão Viamão</a></p></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="hide_cont_adtv">
                                <li id="hide_cont_complexo_estadual"><p class="p_preto"><a>Complexo Estadual de Saude - HEAT, HEJBC, UPA 24H SG II</a></p>
                                    <ul id="show_complexo_estadual">
                                        <li><p class="p_preto"><a href="pdfs/CONTRATO DE GESTAO Nº 004.2017 - Complexo Estadual de Saude - HEAT, HEJBC, UPA 24H SG II.pdf" target="_blank">CONTRATO DE GESTAO Nº 004.2017 - Complexo Estadual de Saude - HEAT, HEJBC, UPA 24H SG II</a></p></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <p class="p_preto"><a class="toggle" href="pdfs/Ata para qualificacao completa.pdf" target="_blank">Ata para qualificação completa</a></p>
                        </li>

                        <li>
                            <p class="p_preto"><a id="show_reg_compras" data-toggle="collapse" data-parent="#accordionEx" href="collapseOne4" aria-expanded="true" aria-controls="collapseOne4">Regulamento de Compras <i class="fa fa-angle-down rotate-icon text-center"></i></a></p>
							    <?php listFolderFiles('sistema/arquivos/rc'); ?>
                        </li>                    

                        <li>
                            <p class="p_preto">
                                <a href="sistema/arquivos/pdfs/regulamento_contratacao.pdf" target="_blank">Regulamento de Contratação de Pessoal</a>
                            </p>
                        </li>                    
                    </ul>
                </div>
                
                <div class="col-sm-3 p-0 text-center">
                    <!--------------------------- ANUAL 2012 
                    <h5 id="h2_rel12a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2012</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela12a">
                        <thead class="text-center">
                            <tr>
                                <th>Upa Itaboraí</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td>Balanço Patrimonial <a href="../sistema/adm/pdf/Balanco Patrimonial.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Demonstração do Fluxo de Caixa <a href="../sistema/adm/pdf/Demonstracao do Fluxo de Caixa.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Demonstração Patrimônio <a href="../sistema/adm/pdf/Demonstracao Patrimonio Liquido.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Notas Explicativas <a href="../sistema/adm/pdf/Notas explicativas as demonstracoes contabeis.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Parecer de Auditoria <a href="../sistema/adm/pdf/Parecer de Auditoria.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Ata de Assembléia geral <a href="../sistema/adm/pdf/Ata da Assembleia geral.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Inventário Itaboraí <a href="../sistema/adm/pdf/Inventario Itaborai 2012.pdf" target="_blank" ><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>

                            <tr>
                                <td>Relatório de Execução Orçamentária <a href="../sistema/adm/pdf/Relatorio de Execucao Orcamentaria em Nivel Anailitico.pdf" target="_blank" class="right"><img src="assets/images/pdf3.png" alt=""></a></td>
                            </tr>

                            <tr>
                                <td>Relatório de Gestão Anual <a href="../sistema/adm/pdf/Relatorio de Gestao Anual.pdf" target="_blank"><img src="assets/images/pdf3.png" alt="" class="right"></a></td>
                            </tr>
                        </tbody>
                    </table>     ------------------------------>

                    <!--------------------------- ANUAL 2013 
                    <h5 id="h2_rel13a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2013</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela13a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($uni_a as $k => $link) { ?>
                                <tr>
                                    <td><?php echo $uni_a[$k]['unidade']; ?></td>
                                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/rel_anual/<?php echo $uni_a[$k]['dados'][$i]; ?>" class="doc_efeito" target="_blank"><img src="assets/images/pdf3.png" alt=""></a> 
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>   ------------------------------>

                    <!--------------------------- ANUAL 2014 
                    <h5 id="h2_rel14a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2014</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela14a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_14 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_14[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_14[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>   ------------------------------>

                    <!--------------------------- ANUAL 2015 
                    <h5 id="h2_rel15a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2015</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela15a" style="display: none;">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_15 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_15[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_15[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table> ------------------------------>

                    <!--------------------------- ANUAL 2016
                    <h5 id="h2_rel16a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2016</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela16a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_16 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_16[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_16[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>  ------------------------------>

                    <!--------------------------- ANUAL 2017 
                    <h5 id="h2_rel17a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2017</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela17a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_17 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_17[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_17[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>------------------------------>

                    <!--------------------------- ANUAL 2018 
                    <h5 id="h2_rel18a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2018</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela18a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_18 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_18[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_18[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>------------------------------>

                    <!--------------------------- ANUAL 2019 
                    <h5 id="h2_rel19a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2019</h5>
                    <table class="table table-sm table-bordered table-striped" id="tabela19a">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Relatório</th>
                                <th>Balancete</th>
                                <th>Inventário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($anual_19 as $k => $link){ ?>
                                <tr>
                                    <td><?php echo $anual_19[$k]['unidade']; ?></td>
                                    <?php for($i = 1; $i <= 3; $i++) { ?>
                                        <td class="text-center">
                                            <a href="../sistema/adm/real_anual/<?php echo $anual_19[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                        </td>   
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>      ------------------------------>          
                </div>
                
                <?php for($x = 2013; $x <= date('Y'); $x++) { ?>
                    <?php $last_years = substr($x, -2); ?>
                    <h5 id="h2_rel<?= $last_years; ?>"><img src="assets/images/file2.png">Relatório de Execução <?= $x; ?></h5>
                    <?php $count = 0; ?>
                    <table class="table table-sm table-bordered table-striped" id="tabela<?= $last_years?>">
                        <?php foreach($rel_exec as $ano => $val) { ?>
                            <?php if($ano == $x) { ?>
                                <thead class="text-center">
                                    <?php for ($l = 1; $l <= 12; $l++) { ?>
                                        <?php foreach($val as $mes => $link) { ?>
                                            <?php if($mes == $l) { ?>
                                                <?php
                                                    switch($mes) {
                                                        case 1: $nome_mes = "Jan"; break;
                                                        case 2: $nome_mes = "Fev"; break;
                                                        case 3: $nome_mes = "Mar"; break;
                                                        case 4: $nome_mes = "Abr"; break;
                                                        case 5: $nome_mes = "Mai"; break;
                                                        case 6: $nome_mes = "Jun"; break;
                                                        case 7: $nome_mes = "Jul"; break;
                                                        case 8: $nome_mes = "Ago"; break;
                                                        case 9: $nome_mes = "Set"; break;
                                                        case 10: $nome_mes = "Out"; break;
                                                        case 11: $nome_mes = "Nov"; break;
                                                        case 12: $nome_mes = "Dez"; break;
                                                    }    
                                                ?>
                                                <th>
                                                    <?php echo $nome_mes ;?>
                                                </th>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php for ($l = 1; $l <= 12; $l++) { ?>
                                            <?php foreach($val as $mes => $link) { ?>
                                                <?php if($mes == $l) { ?>
                                                    <td>
                                                        <?php if ($link != "") { ?>
                                                            <a href="../sistema/adm/rel_execucao/<?php echo $link; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            <?php } ?>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>    
                        <?php } ?>                                    
                    </table>
                <?php }?>
                </div>
            </div>
        </div>
    </div>

    
<?php include_once('../footer.php'); ?>
    
