<?php



include('../includes/conecte.php');

include('../includes/restricao.php');



if(isset($_REQUEST['method']) && $_REQUEST['method'] != ""){

    $retorno = array("status" => 0);

   

    if($_REQUEST['method'] == "excluir_relatorio"){

        

        $id_rel = $_REQUEST['id'];

        $arquivo = $_REQUEST['file'];

        $diretorio = "rel_anual/".$arquivo;

        $retorno = array("id_rel" => $id_rel, "arquivo" => $arquivo, "dir" => $diretorio);

        

        $del = unlink($diretorio);

        $upd = mysql_query("DELETE

                    FROM relatorio

                    WHERE id_execucao = {$id_rel}") or die(mysql_error());

        

        if($del && $upd){

            $retorno = array("status" => 1);

        }

        

        echo json_encode($retorno);

        exit();

    }

}