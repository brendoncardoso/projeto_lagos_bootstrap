<?php include_once('header.php'); ?>
<?php include_once('breadcrumb.php'); ?>
<?php
    $qr_estadosA = mysql_query("SELECT A.id_editalpessoal, A.id_unidade, B.nome AS nome_unidade, B.uf, A.num_edital, A.num_proc_adm, D.cargo
    FROM editalpessoal AS A
    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
    INNER JOIN editalpessoal_cargos AS C ON (A.id_editalpessoal = C.id_edital)
    INNER JOIN cargos AS D ON (C.id_cargo = D.id_cargo)
    WHERE data_fim >= NOW() AND A.status = 1");

    while($rowA = mysql_fetch_assoc($qr_estadosA)){
        $arrayA[$rowA['nome_unidade']][$rowA['id_editalpessoal']] = [
            "id_unidade" => $rowA['id_unidade'],
            "uf" => $rowA['uf'],
            "num_edital" => $rowA['num_edital'], 
            "num_proc_adm" => $rowA['num_proc_adm'],
            "cargo" => $rowA['cargo']
        ];
    }
    
    $to_estadosA = mysql_num_rows($qr_estadosA);

    $qr_estadosB = mysql_query("SELECT A.id_editalpessoal, DATE_FORMAT(A.data_ini, '%Y') AS ano, A.id_unidade, B.nome AS nome_unidade, B.uf, A.num_edital, A.num_proc_adm, D.cargo, A.edital
    FROM editalpessoal AS A
    INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
    INNER JOIN editalpessoal_cargos AS C ON (A.id_editalpessoal = C.id_edital)
    INNER JOIN cargos AS D ON (C.id_cargo = D.id_cargo)
    WHERE data_fim <= NOW() AND A.status = 2
    ORDER BY B.nome, ano DESC");

    while($rowB = mysql_fetch_assoc($qr_estadosB)){
        $arrayB[$rowB['nome_unidade']][$rowB['uf']][$rowB['ano']][$rowB['id_editalpessoal']] = [
            "id_unidade" => $rowB['id_unidade'],
            "num_edital" => $rowB['num_edital'], 
            "num_proc_adm" => $rowB['num_proc_adm'],
            "cargo" => $rowB['cargo'], 
            "edital" => $rowB['edital']
        ];
    }

    $to_estadosB = mysql_num_rows($qr_estadosB);
?>

<style>
    .nav-link {
        display: block;
        padding: 0.8rem 1rem!important;
    }

    .pagina-conteudo .menu-lateral ul li a .grafismo{
        display: none;
        position: absolute;
        right: 0;
        top: 8px!important;
    }
</style>

<div class="conteudo">
    <div class="pagina-conteudo trabconosco mt-5">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <div class="row">
                    <div class="col-sm-3 menu-lateral">
                        <h1 class="pl-3">Processo Seletivo</h1>
                        <div class="d-none d-lg-block">
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item">
                                <a class="nav-link <?php echo !isset($_REQUEST['pagina']) ? 'active show' : ''; ?>" id="faca-seu-cadastro-tab" data-toggle="tab" href="#faca-seu-cadastro" role="tab" aria-controls="faca-seu-cadastro" aria-selected="true">
                                        Cadastre-se
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" id="tutorial-tab" title="Clique Aqui para Acessar o Tutorial de Canditatura" href="">
                                        Tutorial
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>-->
                                <li class="nav-item">
                                    <a href="https://www.institutolagosrio.com.br/novo/arquivos/regulamentos/regime_contratacao.pdf" class="nav-link" id="tutorial-tab" title="Clique Aqui para Acessar o Tutorial de Canditatura" target="_blank">
                                        Regulamento
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo isset($_REQUEST['pagina']) && $_REQUEST['pagina'] == 'aberto' ? 'active' : ''; ?>" id="editais-a-vencer-tab" data-toggle="tab" href="#editais-a-vencer" role="tab" aria-controls="editais-a-vencer" aria-selected="true">
                                        Em Aberto
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link active show" id="editais-em-andamento-tab" data-toggle="tab" href="#editais-em-andamento" role="tab" aria-controls="editais-em-andamento" aria-selected="true">
                                        Em Andamento
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>-->
                                <li class="nav-item">
                                    <a class="nav-link <?php echo isset($_REQUEST['pagina']) && $_REQUEST['pagina'] == 'encerrado' ? 'active' : ''; ?>" id="editais-finalizados-tab" data-toggle="tab" href="#editais-finalizados" role="tab" aria-controls="editais-finalizados" aria-selected="false">
                                        Encerrados
                                        <div class="grafismo">
                                            <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-block d-lg-none">
                            <select class="nav-toggle">
                                <option value="faca-seu-cadastro">Cadastre-se</option>
                                <option value="editais-a-vencer">Em Aberto</option>
                                <option value="editais-em-andamento">Em Andamento</option>
                                <option value="editais-finalizados">Finalizados</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-9 conteudo">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade <?php echo !isset($_REQUEST['pagina']) ? 'active show' : ''; ?>" id="faca-seu-cadastro" role="tabpanel" aria-labelledby="faca-seu-cadastro-tab">
                                <h1>Cadastre-se</h1>
                                (TEXTO)
                            </div>
                            <div class="tab-pane fade <?php echo $_REQUEST['pagina'] == 'aberto' ? 'active show' : ''; ?>" id="editais-a-vencer" role="tabpanel" aria-labelledby="editais-a-vencer-tab">
                                <div class="row">
                                    <?php foreach($arrayA AS $nome_unidade => $val1) { ?>
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="flip-card">
                                                <div class="flip-card-inner">
                                                    <div class="flip-card-front">
                                                        <img src="https://cejam.org.br/img/layout/fornecedores-3.png" alt="Avatar" class="img-fluid">
                                                        <?php foreach($val1 as $id_editalpessoal => $values) { ?>
                                                            <p><?= $nome_unidade; ?> - (<?= $values['uf']; ?>)</p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="flip-card-back">
                                                        <div class="conteudo">
                                                            <?php foreach($val1 as $id_editalpessoal => $values) { ?>
                                                                <h1 class="d-block d-lg-none"><?= $nome_unidade; ?></h1>
                                                                <a class="vaga-titulo" href="" title="Visualizar Detalhes da Vaga">
                                                                    - <?= $values['cargo'];?>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="tab-pane fade <?php echo $_REQUEST['pagina'] == 'encerrado' ? 'active show' : ''; ?>" id="editais-finalizados" role="tabpanel" aria-labelledby="editais-finalizados-tab">
                                <div class="row">
                                    <?php if($to_estadosB > 0) { ?>
                                        <?php foreach($arrayB as $nome_unidade => $val1) { ?>
                                            <?php foreach($val1 AS $uf => $val2) { ?>
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="flip-card">
                                                        <div class="flip-card-inner">
                                                            <div class="flip-card-front">
                                                                <img src="https://cejam.org.br/img/layout/fornecedores-1.png" alt="Avatar" class="img-fluid">
                                                                <p><?= $nome_unidade; ?> - (<?= $uf; ?>)</p>
                                                            </div>
                                                            <div class="flip-card-back">
                                                                <div class="conteudo">
                                                                    <h1 class="d-block d-lg-none"><?= $nome_unidade; ?></h1>
                                                                    <p class="text-center">Anexos</p>
                                                                    <ul>
                                                                        <?php foreach($val2 AS $ano => $val3) { ?>
                                                                            <li><?= $ano; ?>
                                                                                <ul style="padding-left: 15px!important">
                                                                                    <li>                                                                           
                                                                                        <?php foreach($val3 AS $id_editalpessoal => $values) { ?>
                                                                                            <a class="vaga-titulo" href="<?= $values['edital']; ?>" title="Visualizar Detalhes da Vaga" style="padding: 0px!important; font-size: 9px!important" target="_blank">
                                                                                                N° <?= $values['num_edital']; ?> - <?= $values['cargo'];?>
                                                                                            </a>
                                                                                        <?php } ?>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="alert alert-warning" role="alert" style="width: 100%!important; margin-top: 20px;">
                                            <strong>Atenção!</strong> Não há processo seletivo encerrado.
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--<div class="container p-0">
        <div class="conteudo">
            <div class="pagina-conteudo">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 menu-lateral">
                            <h1>Processo Seletivo</h1>
                            <div class="d-none d-lg-block">
                                <ul class="nav" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="faca-seu-cadastro-tab" data-toggle="tab" href="#faca-seu-cadastro" role="tab" aria-controls="faca-seu-cadastro" aria-selected="true">
                                            Cadastre-se
                                            <div class="grafismo">
                                                <i class="fa fa-caret-right big" aria-hidden="true"></i>
                                                <i class="fa fa-caret-right small" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tutorial-tab" title="Clique Aqui para Acessar o Tutorial de Canditatura" href="pdf/Tutorial%20Catho.pdf" target="blank" >
                                            Tutorial
                                            <div class="grafismo">
                                                <i class="fa fa-caret-right big" aria-hidden="true"></i>
                                                <i class="fa fa-caret-right small" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="editais-a-vencer-tab" data-toggle="tab" href="#editais-a-vencer" role="tab" aria-controls="editais-a-vencer" aria-selected="true">
                                            Em Aberto
                                            <div class="grafismo">
                                                <i class="fa fa-caret-right big" aria-hidden="true"></i>
                                                <i class="fa fa-caret-right small" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </li>
                                                                                                    <li class="nav-item">
                                        <a class="nav-link" id="editais-em-andamento-tab" data-toggle="tab" href="#editais-em-andamento" role="tab" aria-controls="editais-em-andamento" aria-selected="true">
                                            Em Andamento
                                            <div class="grafismo">
                                                <i class="fa fa-caret-right big" aria-hidden="true"></i>
                                                <i class="fa fa-caret-right small" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="editais-finalizados-tab" data-toggle="tab" href="#editais-finalizados" role="tab" aria-controls="editais-finalizados" aria-selected="true">
                                            Finalizados
                                            <div class="grafismo">
                                                <i class="fa fa-caret-right big" aria-hidden="true"></i>
                                                <i class="fa fa-caret-right small" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
<?php include_once('footer.php'); ?>