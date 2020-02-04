<?php include_once('header.php'); ?>
<?php include_once('breadcrumb.php'); ?>
<?php 
    $sql = "SELECT * FROM eventos WHERE id =". $_REQUEST['id_evento'];
    $sql_eventos = mysql_query($sql);
    $sql_eventos_rows = mysql_num_rows($sql_eventos);

    while($row = mysql_fetch_assoc($sql_eventos)){
        $arrayEventos[$row['id']] = [
            "nome_evento" => $row['nome_evento'],
            "subtitulo" => $row['subtitulo'],
            "data" => $row['data'],
            "hora_ini" => date('H:i', strtotime($row['hora_ini'])), 
            "hora_fim" => date('H:i', strtotime($row['hora_fim'])),
            "dia_da_semana" => date('w', strtotime($row['data'])),
            "nome_local" => $row['nome_local'],
            "dados" => array(
                "descricao" => $row['descricao'],
                "programacao" => $row['programacao'],
                "participantes" => $row['participantes'],
                "inscricao" => $row['inscricao'],
                "regulamento" => $row['regulamento']
            )
        ];
    }

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
<div class="pagina-conteudo pagina-eventos noticias">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <?php foreach($arrayEventos AS $id => $values) { ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <h1><?php echo $values['subtitulo']; ?></h1>
                            <p class="info">
                                <b>Data</b><br>
                                <?php
                                    $dia = date('d', strtotime($values['data']));
                                    $mes = date('m', strtotime($values['data']));
                                    $ano = date('Y', strtotime($values['data']));

                                    switch($mes){
                                        case 1: $nome_mes = "Janeiro"; break;
                                        case 2: $nome_mes = "Fevereiro"; break;
                                        case 3: $nome_mes = "Março"; break;
                                        case 4: $nome_mes = "Abril"; break;
                                        case 5: $nome_mes = "Maio"; break;
                                        case 6: $nome_mes = "Junho"; break;
                                        case 7: $nome_mes = "Julho"; break;
                                        case 8: $nome_mes = "Agosto"; break;
                                        case 9: $nome_mes = "Setembro"; break;
                                        case 10: $nome_mes = "Outubro"; break;
                                        case 11: $nome_mes = "Novembro"; break;
                                        case 12: $nome_mes = "Dezembro"; break;
                                        default;
                                }
                                ?>
                                <?php echo $dia." de ".$nome_mes." de ".$ano;  ?>
                                </p><p class="info">
                                <b>Horário</b><br>
                                <?php echo $values['hora_ini']." às ". $values['hora_fim'];?> 
                            </p>
                            <p class="info">
                                <b>Local</b><br>
                                <?php echo $values['nome_local']; ?>

                            </p>
                        </div>
                        <!--<div class="col-sm-9">
                            <img class="card-img-top banner-evento" src="https://cejam.org.br/adm-portal/storage/imagens_eventos/a7fca530-799f-11e9-92ef-ed808fceb0a3.jpeg" alt="Evento">
                        </div>-->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 menu-lateral">
                            <div class="d-none d-lg-block">
                                <ul class="nav" id="myTab" role="tablist">
                                    <?php foreach(array_filter($values['dados']) AS $conteudo => $keys) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo $conteudo == 'descricao' ? 'active' : ''; ?>" id="<?php echo $conteudo."-tab"?>" data-toggle="tab" href="#<?= $conteudo; ?>" role="tab" aria-controls="<?= $conteudo; ?>" aria-selected="<?php echo $conteudo == 'descricao' ? 'true' : ''; ?>">
                                                <?php
                                                    switch($conteudo){
                                                        case "descricao": $nome_conteudo = "Descrição"; break;
                                                        case "programacao": $nome_conteudo = "Programação"; break;
                                                        case "participantes": $nome_conteudo = "Participantes"; break;
                                                        case "inscricao": $nome_conteudo = "Inscrição"; break;
                                                        case "regulamento": $nome_conteudo = "Regulamento"; break;
                                                        default;
                                                    }
                                                ?>
                                                <?php echo $nome_conteudo; ?>
                                                <div class="grafismo">
                                                    <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="d-block d-lg-none">
                                <select class="nav-toggle">
                                    <?php foreach(array_filter($values['dados']) AS $conteudo => $keys) { ?>
                                        <?php
                                            switch($conteudo){
                                                case "descricao": $nome_conteudo = "Descrição"; break;
                                                case "programacao": $nome_conteudo = "Programação"; break;
                                                case "participantes": $nome_conteudo = "Participantes"; break;
                                                case "inscricao": $nome_conteudo = "Inscrição"; break;
                                                case "regulamento": $nome_conteudo = "Regulamento"; break;
                                                default;
                                            }
                                        ?>
                                        <option value="<?= $conteudo; ?>"><?= $nome_conteudo; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9 conteudo">
                            <div class="tab-content" id="myTabContent">
                                <?php foreach(array_filter($values['dados']) AS $conteudo => $keys) { ?>
                                    <div class="tab-pane fade <?php echo $conteudo == 'descricao' ? 'active show' : ''; ?>" id="<?= $conteudo; ?>" role="tabpanel" aria-labelledby="<?= $conteudo; ?>-tab">
                                        <?php echo $keys; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>