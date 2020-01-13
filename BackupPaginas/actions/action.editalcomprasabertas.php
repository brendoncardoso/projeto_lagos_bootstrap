<?php
include("../includes/conecte.php");
session_start();

$dir_move = "/arquivos/editaispdf/";
$dir = dirname(dirname(__FILE__)) . $dir_move;
$dirSave = "http://www.institutolagosrio.com.br/sistema/arquivos/editaispdf/";

?>

<?php if(isset($_REQUEST['method']) && $_REQUEST['method']=="exclui") {

    $return = array("data"=>true);
    $_SESSION["message"] = "Edital exclu�do com sucesso";
    
    if(!mysql_query("DELETE FROM compras WHERE compra_id = '{$_REQUEST['compra']}' ")){
        $return = array("data"=>false);        $_SESSION["message"] = "Erro ao excluir o edital";    
    }    
    
    echo json_encode($return);
    exit;
    
} else if(isset($_REQUEST['method']) && $_REQUEST['method']=="listaIdUnidade"){

   
        /*$qr = mysql_query("SELECT * FROM editalpessoal AS A INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
        INNER JOIN editalpessoal_cargos AS C ON (C.id_edital = A.id_editalpessoal)
        LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo) 
        WHERE data_fim >= NOW() AND A.status = 1 AND A.id_unidade = {$_REQUEST['id_unidade']}");*/

        $qr = mysql_query("SELECT DISTINCT D.cargo AS nome_cargo, A.prorrogado, B.uf, B.id_unidade, C.id_cargo FROM editalpessoal AS A
        INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
        INNER JOIN editalpessoal_cargos AS C ON(C.id_edital = A.id_editalpessoal)
        LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo)
        WHERE B.id_unidade = '{$_REQUEST['id_unidade']}' AND data_fim >= NOW() AND A.`status` = 1 ORDER BY B.id_unidade");
    $qr_num = mysql_num_rows($qr);    

    if($qr_num > 0){ 
        ?>
            <?php while($row = mysql_fetch_assoc($qr)) { ?>
                <?php
                    $array_cargos[$row['nome_cargo']][] = [
                        "uf" => $row['uf'],
                        "id_unidade" => $row['id_unidade'],
                        "id_cargo" => $row['id_cargo']
                    ];
                ?>

            <?php } ?>

            <?php foreach($array_cargos as $cargos => $nomes) { ?>
                <?php foreach($nomes as $row) { ?>
                    <ul class="getCargo pl-3">
                        <li class="list_nomecargo<?php echo $row['id_unidade']?><?php echo $row['id_cargo']?> sublista" data-cargo=<?php echo $row['id_cargo']?>>
                            <?php echo $cargos; ?>
                        </li>
                    </ul>
                <?php } ?>
            

                <?php
                    /*$qr_start = mysql_query("SELECT * FROM editalpessoal AS A INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                    INNER JOIN editalpessoal_cargos AS C ON (C.id_edital = A.id_editalpessoal)
                    LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo) 
                    WHERE data_fim >= NOW() AND A.status = 1  AND C.id_cargo = '{$row['id_cargo']}'");*/

                    $qr_start = mysql_query("SELECT * FROM editalpessoal AS A INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
                    INNER JOIN editalpessoal_cargos AS C ON (C.id_edital = A.id_editalpessoal)
                    LEFT JOIN cargos AS D ON (D.id_cargo = C.id_cargo) 
                    WHERE A.id_unidade = '{$_REQUEST['id_unidade']}' AND data_fim >= NOW() AND A.status = 1 AND A.id_editalpessoal = A.id_editalpessoal AND C.id_cargo = '{$row['id_cargo']}'");

                    $qr_rows = mysql_num_rows($qr_start);

                    while($rows_quantidades = mysql_fetch_assoc($qr_start)){
                        $array_quantidades[$rows_quantidades['id_cargo']][] = [
                            "id_editalpessoal" => $rows_quantidades['id_editalpessoal'],
                            "id_cargo" => $rows_quantidades['id_cargo'],
                            "nome" => $rows_quantidades['nome'],
                            "id_unidade" => $rows_quantidades['id_unidade'],
                            "num_edital" => $rows_quantidades['num_edital'],
                            "cidade" => $rows_quantidades['cidade'],
                            "uf" => $rows_quantidades['uf'],
                            "observacao" => $rows_quantidades['observacao'],
                            "edital" => $rows_quantidades['edital'],
                            "num_proc_adm" => $rows_quantidades['num_proc_adm'],
                            "prorrogado" => $rows_quantidades['prorrogado']
                        ];
                    }
                ?>

                <?php foreach($array_quantidades as $id_unidades => $key) { ?>
                    <?php foreach($key as $values) { ?>
                        <ul data-id_unidade=<?php echo $values['id_unidade']?>>
                            <?php if($row['id_cargo'] == $values['id_cargo']) { ?>
                                <li class="list_idcargo<?php echo $row['id_unidade']?><?php echo $row['id_cargo'];?> titulo_edital" data-id_editalpessoal=<?php echo $values['id_editalpessoal']?>>
                                    <?php echo $values['num_proc_adm']?> - <?php echo $values['num_edital']?>
                                </li>
                                <div class="cadaUm<?php echo $row['id_unidade']?><?php echo $values['id_cargo']?><?php echo $values['id_editalpessoal']?> sublistaeditalpessoal" data-id_editalpessoal=<?php echo $values['id_editalpessoal']?> data-cargo=<?php echo $values['id_cargo']?> style="padding :20px!important; background: white; padding: 5px; box-shadow: -1px -1px 3px #666, 1px 2px 3px #666; margin: 0 0 20px 0; margin-left: -50px; display: none;">
                                    <h4 class="text-center" style="font-size:1rem;"><strong><?php echo $values['num_edital']; ?> - <?php echo $values['nome']; ?> - <?php echo $values['cidade']; ?> - <?php echo $values['uf']; ?></strong></h4>
                                    <span class="text-white"><?php echo $values['observacao']?></span>
                                    <a href="sistema/candidato.php?edital=<?php echo $values['id_editalpessoal']?>" target="_blank" style="text-decoration: none;">Clique aqui para se Candidatar</a>
                                    <?php if ($values['prorrogado']){ ?>
                                        <span style="color:red">(Prorrogado)</span>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                               
                            <?php } ?>
                        </ul>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

        <?php } else { ?>
            <small class="text-white">Nenhum Edital aberto.</small>
        <?php } exit;?>
    <?php } ?>

<?php
$numero = $_REQUEST['numero'];
$proc_adm = $_REQUEST['proc_adm'];
/*$licitatorio = $_REQUEST['licitatorio'];*/
$unidade = $_REQUEST['unidade'];
$status = $_REQUEST['status'];
$data_ini = $_REQUEST['data_ini'];
$hora_ini = $_REQUEST['hora_ini'];
$data_fim = $_REQUEST['data_fim'];
$hora_fim = $_REQUEST['hora_fim'];
$observacao = $_REQUEST['observacao'];
$hora_fim = ($hora_fim=="00:00")? "23:59":$hora_fim;$d_ini = date("Y-m-d", strtotime(str_replace("/", "-", $data_ini))) . " " . $hora_ini . ":00";$d_fim = date("Y-m-d", strtotime(str_replace("/", "-", $data_fim))) . " " . $hora_fim . ":00";

if(isset($_REQUEST['enviar']) && $_REQUEST['enviar']=="Cadastrar"){
    if(mysql_query("INSERT INTO compras (id_unidade, numero, proc_adm, data_ini, data_fim, observacao) VALUES ({$unidade}, '{$numero}', '{$proc_adm}', '{$d_ini}', '{$d_fim}','{$observacao}');")){
        $id = mysql_insert_id();
    }                //UPLOAD DO EDITAL        if (!empty($_FILES)) {            if (!is_dir($dir)) {                mkdir($dir, 0777);            }            $tmp_name = $_FILES['file']['tmp_name'];            $name = "c" . $id . "-" . str_replace(" ", "_", microtime()) . ".pdf";            if (!move_uploaded_file($tmp_name, $dir . $name)) {                $_SESSION["message"] = "Erro ao mover o arquivo";                header("Location: ../adm/editais.php");            }        }        mysql_query("UPDATE compras SET edital = '{$dirSave}{$name}' WHERE id_compra = {$id}");                $_SESSION["message"] = "Edital cadastrado com sucesso";        header("Location: ../adm/editais.php");    }else{        $_SESSION["message"] = "Erro ao cadastrar";        header("Location: ../adm/editais.php");    }    }else{    $id = $_REQUEST['id'];    if(mysql_query("UPDATE compras SET id_unidade='$unidade', numero='$numero', proc_adm='$proc_adm', licenciatorio='$licitatorio', data_ini='$d_ini', data_fim='$d_fim', status='$status', observacao='{$observacao}' WHERE id_compra = ".$id."")){        $_SESSION["message"] = "Edital alterado com sucesso";        header("Location: ../adm/editais.php");    }else{        $_SESSION["message"] = "Erro ao alterar o edital";        header("Location: ../adm/editais.php");    }    

} 
?>
