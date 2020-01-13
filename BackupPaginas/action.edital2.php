<?php
include("../includes/conecte.php");
session_start();

$dir_move = "/arquivos/editaispdf/";
$dir = dirname(dirname(__FILE__)) . $dir_move;
$dirSave = "http://www.institutolagosrio.com.br/sistema/arquivos/editaispdf/";

?>

<?php if(isset($_REQUEST['method']) && $_REQUEST['method'] == "exclui") {

    $return = array("data"=>true);
    $_SESSION["message"] = "Edital excluído com sucesso";
    
    if(!mysql_query("DELETE FROM compras WHERE id_compra = '{$_REQUEST['compra']}' ")){
        $return = array("data"=>false);        
        $_SESSION["message"] = "Erro ao excluir o edital";    
    }    
    
    echo json_encode($return);

    
} else if(isset($_REQUEST['method']) && $_REQUEST['method']== "listaAno"){

    if (strlen($_REQUEST['id']) == 4) {
        $qr = mysql_query("SELECT A.id_unidade, A.id_compra, DATE_FORMAT(data_fim, '%Y') AS ano, B.nome, A.data_fim, A.numero, A.proc_adm, A.observacao,  A.edital, B.uf, B.cidade
        FROM compras AS A
        INNER JOIN unidades AS B ON B.id_unidade=A.id_unidade
        WHERE YEAR(A.data_fim) = '{$_REQUEST['id']}'
        ORDER BY id_compra ASC");
    }

    $qr_num = mysql_num_rows($qr);    

    if($qr_num > 0){ 
        ?>
            <?php while($row = mysql_fetch_assoc($qr)) { ?>
                <?php
                    $array_compras[$row['ano']][$row['nome']][$row['id_compra']][][$row['id_unidade']] = [
                        "numero" => $row['numero'],
                        "proc_adm" => $row['proc_adm'],
                        "edital" => $row['edital'],
                        "cidade" => $row['cidade'],
                        "uf" => $row['uf'],
                        "observacao" => $row['observacao']
                    ];
                ?>


            <?php } ?>

                <!--id = ANO-->
                <!--id_unidade = Número da Unidade-->
                <!--id_compra = Número da Compra-->

                
            <!--<?php foreach($array_compras as $ano => $row1) { ?>
                <ul class="pl-4">
                    <?php foreach($row1 as $nome_unidade => $row3) { ?>
                        <li class="sublista"><?php echo $nome_unidade; ?></li>
                        <?php foreach($row3 as $id_compra => $row4) { ?>
                            <?php foreach($row4 as $row5 => $row6) { ?>
                                <?php foreach($row6 as $id_unidade => $values) { ?>
                                    <li class="lista_nome<?php echo $_REQUEST['id']?><?php echo $id_compra?> sublista" data-id_compra="<?php echo $id_compra; ?>" data-id_unidade ="<?php echo $id_unidade?>" hidden></li>
                                    <ul class="lista_id<?php echo $_REQUEST['id']?><?php echo $id_compra?> titulo_edital" data-id_compra="<?php echo $id_compra; ?>" data-id_unidade = "<?php echo $id_unidade?>">
                                        <li class="titulo_edital"><?php echo $values['numero'] ;?> - <?php echo $values['proc_adm']; ?></li>
                                    </ul>
                                    <div class="cadaUm<?php echo $_REQUEST['id']?><?php echo $id_compra?><?php echo $id_unidade; ?>" style="padding :20px!important; background: white; padding: 5px; box-shadow: -1px -1px 3px #666, 1px 2px 3px #666; margin: 0 0 20px 0; margin-left: -50px; display: none;">
                                        <h4 class="text-center" style="font-size:1rem;"><strong><?php echo $values['numero']; ?> - <?php echo $nome_unidade ?> - <?php echo $values['cidade']; ?> - <?php echo $values['uf']; ?></strong></h4>
                                        <span class="text-white"><?php echo $values['observacao']?></span>
                                        <a href="<?php echo $values['edital']?>" target="_blank" style="text-decoration: none;">Clique aqui para Baixar o Edital</a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
            <?php } ?> -->
    <?php } else { ?>
        <small class="text-white">Nenhum Edital Encerrado.</small>
    <?php } ?>
<?php } exit; ?>

<?php
$numero = isset($_REQUEST['numero']);
$proc_adm = isset($_REQUEST['proc_adm']);
/*$licitatorio = $_REQUEST['licitatorio'];*/
$unidade = isset($_REQUEST['unidade']);
$status = isset($_REQUEST['status']);
$data_ini = isset($_REQUEST['data_ini']);
$hora_ini = isset($_REQUEST['hora_ini']);
$data_fim = isset($_REQUEST['data_fim']);
$hora_fim = isset($_REQUEST['hora_fim']);
$observacao = isset($_REQUEST['observacao']);
$hora_fim = ($hora_fim=="00:00")? "23:59":$hora_fim;$d_ini = date("Y-m-d", strtotime(str_replace("/", "-", $data_ini))) . " " . $hora_ini . ":00";$d_fim = date("Y-m-d", strtotime(str_replace("/", "-", $data_fim))) . " " . $hora_fim . ":00";

if(isset($_REQUEST['enviar']) && $_REQUEST['enviar'] == "Cadastrar"){
    /*if(mysql_query("INSERT INTO compras (id_unidade, numero, proc_adm, data_ini, data_fim, observacao) VALUES ({$unidade}, '{$numero}', '{$proc_adm}', '{$d_ini}', '{$d_fim}','{$observacao}');")){
        $id = mysql_insert_id();
        header('location: ../adm/editais.php');
    }*/                //UPLOAD DO EDITAL        if (!empty($_FILES)) {            if (!is_dir($dir)) {                mkdir($dir, 0777);            }            $tmp_name = $_FILES['file']['tmp_name'];            $name = "c" . $id . "-" . str_replace(" ", "_", microtime()) . ".pdf";            if (!move_uploaded_file($tmp_name, $dir . $name)) {                $_SESSION["message"] = "Erro ao mover o arquivo";                header("Location: ../adm/editais.php");            }        }        mysql_query("UPDATE compras SET edital = '{$dirSave}{$name}' WHERE id_compra = {$id}");                $_SESSION["message"] = "Edital cadastrado com sucesso";        header("Location: ../adm/editais.php");    }else{        $_SESSION["message"] = "Erro ao cadastrar";        header("Location: ../adm/editais.php");    }    }else{    $id = $_REQUEST['id'];    if(mysql_query("UPDATE compras SET id_unidade='$unidade', numero='$numero', proc_adm='$proc_adm', licenciatorio='$licitatorio', data_ini='$d_ini', data_fim='$d_fim', status='$status', observacao='{$observacao}' WHERE id_compra = ".$id."")){        $_SESSION["message"] = "Edital alterado com sucesso";        header("Location: ../adm/editais.php");    }else{        $_SESSION["message"] = "Erro ao alterar o edital";        header("Location: ../adm/editais.php");    }    
 
    echo "OK"; exit;
} 
?>
