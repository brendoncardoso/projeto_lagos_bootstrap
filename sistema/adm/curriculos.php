<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');


if(isset($_REQUEST['cargos']) && $_REQUEST['cargos'] != "") {
	$cargo = $_REQUEST['cargos'];
	$addsql = " WHERE A.cargo = '{$cargo}'";
	$limit = "";
} else {
	$addsql = "";
}


if(isset($_REQUEST['procurar']) && $_REQUEST['procurar'] != "") {
	if($addsql != ""){
		$addsql .= " AND A.nome like '%{$_REQUEST['procurar']}%'";
	}else{
		$addsql .= " WHERE A.nome like '%{$_REQUEST['procurar']}%'";
	}
	$procurar = $_REQUEST['procurar'];

} else {
	$procurar = "";
}

$limite = 20;
$pagina = (isset($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina-1) * $limite : 0;
$sql = "SELECT * FROM curriculos AS A INNER JOIN cargos AS B ON (A.cargo = B.id_cargo) {$addsql} ORDER BY A.id_curriculo DESC";
$qr_pessoa = mysql_query($sql . " LIMIT $inicio,$limite");
$total = mysql_num_rows($qr_pessoa);

/* PAGINAÇÃO */
$html_pagina = geraPaginacao($pagina, $limite, $sql, "");
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="-1" />
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <title>Administração de Candidatos</title>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"/>
        <!--<link href="../resources/css/bootstrap.css" type="text/css" rel="stylesheet"/>-->
        <link href="../resources/css/font-awesome.css" type="text/css" rel="stylesheet"/>
		<!--<link href="../resources/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
		<link href="../resources/css/jquery.dataTables.css" type="text/css" rel="stylesheet"/>-->
        <script src="../resources/js/jquery3.2.1.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/global.js" type="text/javascript"></script>
		<script src="../resources/js/bootstrap.js" type="text/javascript"></script>
		<!--<script src="../resources/js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../resources/js/dataTables.bootstrap.min.js" type="text/javascript"></script>-->

		<style>
            nav ul li a {
                text-decoration: none;
                color: #000;
                display: block;
                padding: 10px;
                width: unset;
                text-decoration: none!important;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <div id="header">
                <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>

            <div>
				<nav>
					<?php include('../includes/menu_adm.php'); ?>
				</nav>
			</div>

            <div id="conteudo">
                <div class="blocos">
                    <h2>Currículos recentes</h2>
                        <form class="form-horizontal" method="POST" action="" id="form" name="form">
                            <div class="form-group">
                                <fieldset>
                                    <legend>Buscar</legend>
                                    <p>
                                        <label class="first">Cargos:</label> 
                                        <select id="" name="cargos" class="" onchange="submit();" style="width: 400px">
                                            <option value="">« Selecione o Cargo »</option>
                                            <?php 
                                                $qr_cargos = mysql_query("SELECT * FROM cargos AS A where status = 1 order by cargo");
                                                while ($row_cargos = mysql_fetch_assoc($qr_cargos)){
                                                    if($cargo == $row_cargos['id_cargo']){
                                                        $selected = "SELECTED";

                                                    }else{
                                                        $selected = "";
                                                    }												
                                                    echo "<option value=\"{$row_cargos['id_cargo']}\" {$selected}>{$row_cargos['cargo']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </p>
                                    <p>
                                        <label class="first" for="">Procurar:</label>
                                        <input id="procurar" type="search" name="procurar" placeholder="Procurar pelo nome" value="<?php echo $procurar;?>" class="validate[required]" style="width: 400px;">
                                        <!--<div class="">
                                            <input id="procurar" name="procurar" type="search" placeholder="Procurar pelo nome" class="form-control input-md" value="<?php echo $procurar;?>">
                                        </div>-->
                                    </p>
                                    <p class="controls"><input id="btn_procurar" name="btn_procurar" type="submit" value="BUSCAR" class="button"></p>

                                </fieldset>

                                <!--<label class="col-md-2 control-label" for="cargos">Cargos:</label>
                                <div class="col-md-4">
                                    <select id="cargos" name="cargos" class="form-control" onchange="submit();">
                                        <option value="">SELECIONE O CARGO</option>
                                        <?php 
                                            $qr_cargos = mysql_query("SELECT * FROM cargos AS A where status = 1 order by cargo");
                                            while ($row_cargos = mysql_fetch_assoc($qr_cargos)){
                                                if($cargo == $row_cargos['id_cargo']){
                                                    $selected = "SELECTED";

                                                }else{
                                                    $selected = "";
                                                }												
                                                echo "<option value=\"{$row_cargos['id_cargo']}\" {$selected}>{$row_cargos['cargo']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>-->

                                <!--<label class="col-md-1 control-label" for="cargos">Procurar:</label>
                                <div class="col-md-3">
                                    <input id="procurar" name="procurar" type="search" placeholder="Procurar pelo nome" class="form-control input-md" value="<?php echo $procurar;?>">
                                </div>-->

                                <!--<div class="col-md-2">
                                    <button id="btn_procurar" name="btn_procurar" class="btn btn-primary">Procurar</button>
                                </div>-->
                            </div>

                            <br>

                            <input type="hidden" name="pagina" id="pagina">
                        </form>

                        <?php
                            if ($total == 0) {
                                echo '<h4>Nenhum currículo cadastado.</h4>';
                            } else {

                        ?>

                        <div class="table-responsive">
                            <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>CARGO</th>
                                        <th>TELEFONE</th>
                                        <th>E-MAIL</th>
                                        <th>DATA</th>
                                        <th>VISUALIZAR</th>
                                        <th>CURRÍCULO</th>
                                        <th>ULTIMA VISUALIZAÇÃO</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $i = 0;
                                        while ($row_pessoa = mysql_fetch_assoc($qr_pessoa)):
                                            $class = ($i++ % 2 ) ? 'even' : 'odd';

                                            if($row_pessoa['data_reg'] != "") {
                                                $data_temp = explode("-",$row_pessoa['data_reg']);
                                                $data = $data_temp[2]."/".$data_temp[1]."/".$data_temp[0];
                                            } else{
                                                $data = " - ";
                                            }

                                            if($row_pessoa['data_alterada'] != "") {
                                                $data_temp = explode("-",$row_pessoa['data_alterada']);
                                                $data_alterada = $data_temp[2]."/".$data_temp[1]."/".$data_temp[0];
                                                $class = "class=\"center success\"";
                                            }else{
                                                $data_alterada = " - ";
                                                $class = "class=\"center\"";
                                            }
                                    ?>	

                                    <tr <?php echo $class; ?>>
                                        <td><?php echo $row_pessoa['id_curriculo'] ?></td>
                                        <td><?php echo $row_pessoa['nome'] ?></td>
                                        <td class="center"><?php echo $row_pessoa['cargo']; ?></td>
                                        <td><?php echo $row_pessoa['telefone'] ?></td>
                                        <td class="center"><?php echo $row_pessoa['email'] ?></td>
                                        <td><?php echo $data ?></td>

                                        <td class="center">
                                            <a href="../../novo/curriculos/<?php echo $row_pessoa['arquivo_curriculo'] ?>" target="_blank"><i class="fa fa-eye fa-2x arquivo" aria-hidden="true" id="<?php echo $row_pessoa['id_curriculo'] ?>"></i></a>
                                        </td>

                                        <td class="center">
                                            <a href="../../novo/curriculos/<?php echo $row_pessoa['arquivo_curriculo'] ?>" class="icon icon-baixar arquivo" title="Baixar" id="<?php echo $row_pessoa['id_curriculo'] ?>">&nbsp;</a>
                                        </td>
                                        <td class="center"><?php echo $data_alterada;?></td>
                                    </tr>

                                    <?php
                                        endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <?php echo $html_pagina;?>
                </div>
            </div>
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>

	<script>
            $(function () {
               $(".arquivo").click(function(){
                   var id = this.id;
                   var dados = "id="+id;
                   $.post("action_ajax.php",dados, function(resposta){
                        window.location.reload();
                    });
               }); 
            });
        </script>
    </body>
</html>

