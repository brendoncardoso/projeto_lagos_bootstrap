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
    
} else if(isset($_REQUEST['method']) && $_REQUEST['method']=="listaUf"){

   
        $qr = mysql_query("SELECT A.id_compra, A.id_unidade, A.data_fim, A.numero, A.proc_adm, A.observacao, B.nome, A.edital, B.uf, B.cidade
            FROM compras AS A
            INNER JOIN unidades AS B ON (B.id_unidade=A.id_unidade)
            WHERE B.uf = '{$_REQUEST['uf']}' AND A.status = 1
            ORDER BY id_compra ASC;
        ");
    

    $qr_num = mysql_num_rows($qr);    

    if($qr_num > 0){ 
        ?>
                <?php while($row = mysql_fetch_assoc($qr)) { ?>
                    <?php
                        $array_compras[$row['nome']][$row['id_compra']][][$row['id_unidade']] = [
                            "numero" => $row['numero'],
                            "nome" => $row['nome'],
                            "observacao" => $row['observacao'],
                            "cidade" => $row['cidade'],
                            "edital" => $row['edital'],
                            "uf" => $row['uf'],
                            "proc_adm" => $row['proc_adm']
                        ];
                    ?>

                    
                    
                <?php } ?>
           
                    <!--id = ANO-->
                    <!--id_unidade = Número da Unidade-->
                    <!--id_compra = Número da Compra-->

                <?php foreach($array_compras as $nomeUnidade => $row1) { ?> 
                    <li class="sublista"><?php echo $nomeUnidade; ?></li>
                    <?php foreach($row1 as $id_unidade => $row2) { ?>
                        <ul class="getUf pl-3"><li class="lista_nome<?php echo $_REQUEST['uf']?><?php echo $id_unidade?> sublista" data-id_unidade="<?php echo $id_unidade; ?>" hidden></li></ul> 
                            <?php foreach($row2 as $row3 => $row4) { ?>
                                <ul class="id_unidade" data-id_unidade=<?php echo $id_unidade; ?>>
                                    <?php foreach($row4 as $id_compra => $values) { ?>
                                        <li class="lista_id<?php echo $_REQUEST['uf']?><?php echo $id_unidade; ?> titulo_edital" data-id_compra =<?php echo $id_compra?>>
                                            <?php echo $values['numero']; ?> - <?php echo $values['proc_adm']; ?>
                                        </li>
                                        <div class="cadaUm<?php echo $_REQUEST['uf']?><?php echo $id_unidade; ?><?php echo $id_compra; ?>" style="padding :20px!important; background: white; padding: 5px; box-shadow: -1px -1px 3px #666, 1px 2px 3px #666; margin: 0 0 20px 0; margin-left: -50px; display: none;">
                                            <h4 class="text-center" style="font-size:1rem;"><strong><?php echo $values['numero']; ?> - <?php echo $nomeUnidade; ?> - <?php echo $values['cidade']; ?> - <?php echo $values['uf']; ?></strong></h4>
                                            <span class="text-white"><?php echo $values['observacao']?></span>
                                            <a href="sistema/edital.php?id_compra=<?php echo $id_compra; ?>" data-key="<?php echo $id_compra?>" target="_blank">Clique aqui para Abrir o Edital</a>
                                        </div>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
        <?php } else { ?>
            <small class="text-white">Nenhum Edital aberto. </small>
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
