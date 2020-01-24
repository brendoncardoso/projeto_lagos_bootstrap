<?php
include 'sistema/includes/conecte.php';

// RELATÓRIO DE EXECUÇÃO

/*function removeCarateres($texto) {
    return ereg_replace("[^a-zA-Z0-9_]", "", strtr($texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
}*/

/////////////////////////////////////////////// RELATÓRIO DE 2012 //////////////////////////////////////////////////
$sql_12 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2012' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_12 = array();



while ($row = mysql_fetch_assoc($sql_12)){
    $uni_2[$row['id_unidade']]["unidade"] = $row['nome_unidade'];
    $uni_2[$row['id_unidade']]["dados"][$row['mes']] = $row['id_unidade'] ."_". $row['mes'] ."_". $row['ano'] . ".pdf";
}

/////////////////////////////////////////////// RELATÓRIO DE 2013 //////////////////////////////////////////////////
$sql_13 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2013' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni = array();



while ($row = mysql_fetch_assoc($sql_13)){
    $uni[$row['id_unidade']]["unidade"] = $row['nome_unidade'];
    $uni[$row['id_unidade']]["dados"][$row['mes']] = $row['id_unidade'] ."_". $row['mes'] ."_". $row['ano'] . ".pdf";
}

/////////////////////////////////////////////// RELATÓRIO DE 2014 ///////////////////////////////////////////////////

$sql_14 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2014' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_b = array();



while ($row_b = mysql_fetch_assoc($sql_14)){
    $uni_b[$row_b['id_unidade']]["unidade"] = $row_b['nome_unidade'];
    $uni_b[$row_b['id_unidade']]["dados"][$row_b['mes']] = $row_b['id_unidade'] ."_". $row_b['mes'] ."_". $row_b['ano'] . ".pdf";
}



////////////////////////////////////////////// RELATÓRIO DE 2015 /////////////////////////////////////////////////////

$sql_15 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2015' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_15 = array();



while ($row_15 = mysql_fetch_assoc($sql_15)){
    $uni_15[$row_15['id_unidade']]["unidade"] = $row_15['nome_unidade'];
    $uni_15[$row_15['id_unidade']]["dados"][$row_15['mes']] = $row_15['id_unidade'] ."_". $row_15['mes'] ."_". $row_15['ano'] . ".pdf";
}

///////////////////////////////////////////// RELATÓRIO DE 2016 //////////////////////////////////////////////////////

$sql_16 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2016' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_16 = array();



while ($row_16 = mysql_fetch_assoc($sql_16)){
    $uni_16[$row_16['id_unidade']]["unidade"] = $row_16['nome_unidade'];
    $uni_16[$row_16['id_unidade']]["dados"][$row_16['mes']] = $row_16['id_unidade'] ."_". $row_16['mes'] ."_". $row_16['ano'] . ".pdf";
}



///////////////////////////////////////////// RELATÓRIO DE 2017 ///////////////////////////////////////////////////////

$sql_17 = mysql_query("SELECT A.*, B.nome AS nome_unidade
        FROM relatorio AS A
        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
        WHERE A.ano = '2017' AND A.status = 1 AND A.tipo = 1
        ORDER BY B.nome") or die(mysql_error());
$uni_17 = array();



while ($row_17 = mysql_fetch_assoc($sql_17)){
    $uni_17[$row_17['id_unidade']]["unidade"] = $row_17['nome_unidade'];
    $uni_17[$row_17['id_unidade']]["dados"][$row_17['mes']] = $row_17['id_unidade'] ."_". $row_17['mes'] ."_". $row_17['ano'] . ".pdf";
}


///////////////////////////////////////////// RELATÓRIO DE 2018 ////////////////////////////////////////////////////////

$sql_18 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2018' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_18 = array();



while ($row_18 = mysql_fetch_assoc($sql_18)){
    $uni_18[$row_18['id_unidade']]["unidade"] = $row_18['nome_unidade'];
    $uni_18[$row_18['id_unidade']]["dados"][$row_18['mes']] = $row_18['id_unidade'] ."_". $row_18['mes'] ."_". $row_18['ano'] . ".pdf";
}

///////////////////////////////////////////// RELATÓRIO DE 2019 /////////////////////////////////////////////////////////

$sql_19 = mysql_query("SELECT A.*, B.nome AS nome_unidade
                        FROM relatorio AS A
                        LEFT JOIN unidades AS B ON (B.id_unidade = A.id_unidade)
                        WHERE A.ano = '2019' AND A.status = 1 AND A.tipo = 1
                        ORDER BY B.nome") or die(mysql_error());
$uni_19 = array();



while ($row_19 = mysql_fetch_assoc($sql_19)){
    $uni_19[$row_19['id_unidade']]["unidade"] = $row_19['nome_unidade'];
    $uni_19[$row_19['id_unidade']]["dados"][$row_19['mes']] = $row_19['id_unidade'] ."_". $row_19['mes'] ."_". $row_19['ano'] . ".pdf";
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


////////////////////////////////////////////////////////////////////

$sql_categoria1 = mysql_query("SELECT A.id, A.id_pasta, B.nome, A.arquivo, A.status FROM prestacao_categoria1 AS A INNER JOIN pasta AS B ON (A.id_pasta = B.id)");
$sql_num_rows_categoria1 = mysql_num_rows($sql_categoria1);
while($cat1 = mysql_fetch_assoc($sql_categoria1)){
    $arrayCat1[$cat1['id_pasta']][$cat1['nome']] = [
        "id" => $cat1['id'],
        "arquivo" => $cat1['arquivo']
    ];
}

/*echo "<pre>";
print_r($arrayCat1);
echo "</pre>";
exit;*/

$sql_categoria2 = mysql_query("SELECT A.id, A.id_pasta, B.nome, A.nome_arquivo, A.arquivo, A.status FROM prestacao_categoria2 AS A INNER JOIN pasta AS B ON (A.id_pasta = B.id)");
$sql_num_rows_categoria2 = mysql_num_rows($sql_categoria2);
while($cat2 = mysql_fetch_assoc($sql_categoria2)){
    $arrayCat2[$cat2['id_pasta']][$cat2['nome']][$cat2['id']] = [
        "nome_arquivo" => $cat2['nome_arquivo'],
        "arquivo" => $cat2['arquivo']
    ];
}

/*echo "<pre>";
print_r($arrayCat2);
echo "</pre>";*/


$sql_categoria3 = mysql_query("SELECT A.id, A.id_pasta, B.nome, A.id_unidade, C.nome AS nome_unidade, A.id_empresa, D.nome_empresa, A.nome_arquivo
FROM prestacao_categoria3 AS A
INNER JOIN pasta AS B ON (A.id_pasta = B.id)
INNER JOIN unidades AS C ON (A.id_unidade = C.id_unidade)
INNER JOIN empresas_prestador AS D ON (A.id_empresa = D.id)");

$sql_num_rows_categoria3 = mysql_num_rows($sql_categoria3);
while($cat3 = mysql_fetch_assoc($sql_categoria3)){
    /*$arrayCat3[$cat3['id_pasta']][$cat3['nome']][$cat3['id_unidade']][][$cat3['nome_unidade']][$cat3['id_empresa']][$cat3['nome_empresa']][] = [
        "nome_arquivo" => $cat3['nome_arquivo']
    ];*/

    $arrayCat3[$cat3['id_pasta']][$cat3['nome']][$cat3['id_unidade']][$cat3['nome_unidade']][$cat3['id_empresa']][$cat3['nome_empresa']][] = [
        "nome_arquivo" => $cat3['nome_arquivo']
    ];
}

/*echo "<pre>";
print_r($arrayCat3);
echo "</pre>";*/

function listFolderFiles($dir){
    $ffs = scandir($dir);
    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

// prevent empty ordered elements

if (count($ffs) < 1) 
return;

echo '<ul  id="hide_compras" style="list-style-type: circle;">';
    foreach($ffs as $ff){
        $li = strpos($ff,".pdf") > 0 ? "<p class='p_preto'><a href='".$dir.'/'.$ff."'>".str_replace('.pdf','',$ff)."</a></p>" : $ff;
        echo '<li>'.$li;
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
        echo '</li>';
    }
echo '</ul>';
}

?>

<?php include_once('header.php'); ?>

<style>
    th{
        text-align: center;
    }

     li{
        color: black;
    }
</style>

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
                    <img class="img-thumbnail" src="assets/images/transparencia.jpeg" alt="" style="max-width: 102%;">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <h4>Prestação de Contas</h4>
                    <div class="borda_line" style="width: 210px!important"></div>
                    <ul class="p-0" style="list-style-type: unset; color: #48AFE1!important">
                        <!--<li><p class="p_preto"><a href="sistema/arquivos/pdfs/novo/Estatuto abertura do Complexo.pdf" target="_blank">Estatuto Consolidado da OSS</a></p></li>-->
                        <!-- <li><p class="p_preto"><a href="pdfs/balancopatrimonial.pdf" target="_blank">Balanço Patrimonial do ano de 2012</a></p></li> -->
                        <li class="lista_css">
                            Ouvidoria  - <a class="" href="ouvidoria.php">acesse aqui
                        </li>
                        <?php foreach($arrayCat1 as $id_pasta => $rows1) { ?>
                            <?php foreach($rows1 as $nome_categoria1 => $values) { ?>
                                <li class="lista_css">
                                    <a class="lista_css" href="sistema/adm/atas_documentos/<?php echo $values['id']; ?>.pdf" target="_blank"><?php echo $nome_categoria1; ?></a>
                                </li>
                            <?php } ?>
                        <?php }?>

                        
                        <?php foreach($arrayCat2 as $id_pasta => $rows1) { ?>
                            <?php foreach($rows1 as $nome_categoria2 => $rows2) { ?>
                                <li class="lista_css botaoCategoria2" data-id_pasta=<?php echo $id_pasta; ?>>
                                    <?php echo $nome_categoria2; ?>
                                </li>
                                <?php foreach($rows2 as $id => $values) { ?>
                                    <li class="categoria2<?php echo $id_pasta?> lista_css" style="display: none; margin-left: 40px;">
                                        <a class="lista_css" href="sistema/adm/atas_documentos/<?php echo $id; ?>_<?php echo $id_pasta; ?>.pdf" target="_blank"><?php echo $values['nome_arquivo']?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        <?php }?>

                        <?php foreach($arrayCat3 as $id_pasta => $row) { ?>
                            <input class="getPasta" type="hidden" name="" data-id_pasta=<?php echo $id_pasta; ?>>

                            <?php foreach($row as $nome_pasta => $rows1) { ?>
                                <li class="lista_css botaoCategoria" data-id_pasta=<?php echo $id_pasta?>><?php echo $nome_pasta; ?></li>
                                <div class="pasta<?php echo $id_pasta?>" style="display: none;">
                                    <?php foreach($rows1 as $id_unidade => $rows2) { ?>
                                        <input class="getUnidade" type="hidden" name="" data-id_unidade=<?php echo $id_unidade; ?>>
                                        <?php foreach($rows2 as $nome_unidade => $rows3) { ?>
                                            <li class="lista_css showUnidade<?php echo $id_pasta?><?php echo $id_unidade; ?> teste" style="margin-left: 20px;" data-id_unidade=<?php echo $id_unidade?> data-id_pasta=<?php echo $id_pasta?>><?php echo $nome_unidade; ?></li>
                                        <?php } ?>
                                        <div class="actionCategoria3<?php echo $id_pasta; ?><?php echo $id_unidade; ?> " ></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        


                        <?php 
                                $sql = mysql_query("SELECT * FROM pasta"); 
                                $num = mysql_num_rows($sql);   
                                
                                while($row = mysql_fetch_assoc($sql)){
                                    $arrayPastas[] = [
                                        "nome" => $row['nome']
                                    ];
                                }
                            
                                /*echo '<pre>';
                                print_r($arrayPastas);
                                echo '</pre>';*/
                        ?>

                        <!--<?php foreach($arrayPastas as $pastas) { ?> 
                            <li>
                                <p class="p_preto">
                                    <a href=""><?php echo $pastas['nome']; ?></a>
                                </p>
                            </li>
                        <?php } ?>-->
                    </ul>
                </div>
                <div class="col-sm-7 p-0">
                    <div>
                        <select class="form-control right" name="" id="select_ano" data-validation-engine="validate[required]" style="width: 100px;'                                                                                                                                                                            
                        ">
                            <?php
                                $sql_B = "SELECT DISTINCT ano FROM relatorio WHERE tipo = 1" or die(mysql_error());
                                $sql_A = "SELECT DISTINCT ano FROM relatorio WHERE tipo = 2" or die(mysql_error());
                                
                                $sql_anoB = mysql_query($sql_B);
                                $sql_anoA = mysql_query($sql_A);                                    
                            ?>

                            <option value="" placeholder="Ano"></option>
                            <option class="todos" style="">Todos</option>
                            <?php $ano = date('Y'); ?>
                            <?php for($i = 2012; $i<=$ano; $i++){ ?>
                                <option class=<?php echo $i; ?> value="<?php echo $i; ?>" <?= $i == $ano ? 'selected': ''?>><?php echo $i?></option>
                            <?php } ?>
                            <?php while($row_anoA = mysql_fetch_assoc($sql_anoA)){ ?>
                                <option class="anosA" value="<?php echo $row_anoA['ano']?>" name="anosA" style="display: none;">
                                    <?php echo $row_anoA['ano']?>    
                                </option>
                            <?php } ?>   
                            <?php while($row_anoB = mysql_fetch_assoc($sql_anoB)){ ?>
                                <option class="anosB" value="<?php echo $row_anoB['ano']?>" name="anosB" style="display: none;">
                                    <?php echo $row_anoB['ano']?>    
                                </option>
                            <?php } ?>
                        </select>
                        <small class="right pr-2 mt-3">Selecione o Ano:</small>
                    </div>

                    <h4 class="pl-2">Relatórios</h4>
                    <div class="borda_line mb-2" style="width: 105px!important; margin-left: 5px;"></div>

                    <form action="">
                        <div class="col-sm-12 mt-4 p-0">
                            <h6 class="titulo_relatorio" style="display: none;">Relatórios Anuais</h6>
                            <div class="anual p-0 container"> 
                                <!--------------------------- ANUAL 2012 ------------------------------>
                                <h5 id="h2_rel12a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2012</h5>

                                <table class="table table-sm table-bordered table-striped" id="tabela12a" style="display: none;">
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
                                </table>     
                                
                                <!--------------------------- ANUAL 2013 ------------------------------>
                                <h5 id="h2_rel13a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2013</h5>
                                
                                <table class="table table-sm table-bordered table-striped" id="tabela13a" style="display: none;">
                                    <?php if(!empty($uni_a)) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/rel_anual/<?php echo $uni_a[$k]['dados'][$i]; ?>" class="doc_efeito" target="_blank">
                                                                    <img src="assets/images/pdf3.png" alt="">
                                                                </a> 
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert13a" role="alert13a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>   

                                <!--------------------------- ANUAL 2014 ------------------------------>
                                <h5 id="h2_rel14a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2014</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela14a" style="display: none;">
                                    <?php if(!empty($anual_14[$k])) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_14[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert14a" role="alert14a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>   

                                <!--------------------------- ANUAL 2015 ------------------------------>
                                <h5 id="h2_rel15a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2015</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela15a" style="display: none;">
                                    <?php if(!empty($anual_15[$k])) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_15[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert15a" role="alert15a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table> 

                                <!--------------------------- ANUAL 2016 ------------------------------>
                                <h5 id="h2_rel16a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2016</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela16a" style="display: none;">
                                    <?php if(!empty($anual_16)) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_16[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert16a" role="alert16a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table> 

                                <!--------------------------- ANUAL 2017 ------------------------------>
                                <h5 id="h2_rel17a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2017</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela17a" style="display: none;">
                                    <?php if(!empty($anual_17[$k])) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_17[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert17a" role="alert17a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table> 

                                <!--------------------------- ANUAL 2018 ------------------------------>
                                <h5 id="h2_rel18a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2018</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela18a" style="display: none;">
                                    <?php if(!empty($anual_18[$k])) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_18[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert18a" role="alert18a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table> 

                                <!--------------------------- ANUAL 2019 ------------------------------>
                                <h5 id="h2_rel19a"><img src="assets/images/relatorio-anual.png"> Relatório Anual 2019</h5>
                                <table class="table table-sm table-bordered table-striped" id="tabela19a" style="display: none;">
                                    <?php if(!empty($anual_19[$k])) { ?>
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
                                                            <?php if (!empty($uni_a[$k]['dados'][$i])) { ?>
                                                                <a href="../sistema/adm/real_anual/<?php echo $anual_19[$k]['dados'][$i]?>"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>   
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert19a" role="alert19a" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório Anual <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table> 
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4 p-0">
                            <h4 class="titulo_relatorio" style="display: none;">Relatórios de Execução</h4>

                            <div class="execucao p-0 container">
                                <!--------------------------- 2012 ---------------------->
                                <h5 id="h2_rel12"><img src="assets/images/executionicon.png">Relatório de Execução 2012</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela12" style="display: none;">
                                    <?php if (!empty($uni_12[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_12 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_12[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if (!empty($uni_12[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_12[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert12" role="alert" style="display: none;" >
                                            <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!--------------------------- 2013 ---------------------->
                                <h5 id="h2_rel13"><img src="assets/images/executionicon.png">Relatório de Execução 2013</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela13" style="display: none;">
                                    <?php if (!empty($uni[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if (!empty($uni[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert13" role="alert13" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!----------------------------- 2014 ---------------------------->
                                <h5 id="h2_rel14"><img src="assets/images/executionicon.png">Relatório de Execução 2014</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela14">
                                    <?php if (!empty($uni_b[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_b as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_b[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if(!empty($uni_b[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_b[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert14" role="alert14" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!----------------------------- 2015 ---------------------------->
                                <h5 id="h2_rel15"><img src="assets/images/executionicon.png">Relatório de Execução 2015</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela15">
                                    <?php if (!empty($uni_15[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_15 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_15[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if(!empty($uni_15[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_15[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert15" role="alert15" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!----------------------------- 2016 ---------------------------->
                                <h5 id="h2_rel16"><img src="assets/images/executionicon.png">Relatório de Execução 2016</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela16">
                                    <?php if (!empty($uni_16[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_16 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_16[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if(!empty($uni_16[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_16[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert16" role="alert16" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!----------------------------- 2017 ---------------------------->
                                <h5 id="h2_rel17"><img src="assets/images/executionicon.png">Relatório de Execução 2017</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela17">
                                    <?php if (!empty($uni_17[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_17 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_17[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if(!empty($uni_17[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_17[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert17" role="alert17" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>

                                <!----------------------------- 2018 ---------------------------->
                                <h5 id="h2_rel18"><img src="assets/images/executionicon.png">Relatório de Execução 2018</h5>
                                <?php $count = 0; ?>
                                <table class="table table-sm table-bordered table-striped" id="tabela18">
                                    <?php if (!empty($uni_18[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_18 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_18[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <?php if(!empty($uni_18[$k]['dados'][$i])) { ?>
                                                                <a href="sistema/adm/rel_execucao/<?php echo $uni_18[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert18" role="alert18" style="display: none;">
                                        <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>


                                <!----------------------------- 2019 ---------------------------->
                                <h5 id="h2_rel19"><img src="assets/images/executionicon.png">Relatório de Execução 2019</h5>
                                <?php $count = 0; ?>

                                <table class="table table-sm table-bordered table-striped" id="tabela19">
                                    <?php if(!empty($uni_19[$k])) { ?>
                                        <thead class="text-center">
                                            <tr>
                                                <th>Unidade</th>
                                                <th>Jan</th>
                                                <th>Fev</th>
                                                <th>Mar</th>
                                                <th>Abr</th>
                                                <th>Mai</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Ago</th>
                                                <th>Set</th>
                                                <th>Out</th>
                                                <th>Nov</th>
                                                <th>Dez</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($uni_19 as $k => $link) { ?>
                                                <tr>
                                                    <td><?php echo $uni_19[$k]['unidade']?></td>
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <td>
                                                            <a href="sistema/adm/rel_execucao/<?php echo $uni_19[$k]['dados'][$i]; ?>" target="_blank"><img src="assets/images/pdf3.png" alt=""></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert19" role="alert19" style="display: none;">
                                            <strong>Atenção! </strong> Esse Relatório de Execução <strong>NÃO</strong> foi cadastrado no ano selecionado.
                                        </div>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
    </div>
    
    
<?php include_once('footer.php'); ?>

