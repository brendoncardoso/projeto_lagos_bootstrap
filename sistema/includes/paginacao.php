<?php

function geraPaginacao($pagina,$limite,$query,$javascript){

    $qr_pessoa_total = mysql_query($query);
    $total = mysql_num_rows($qr_pessoa_total);
    $paginacao = "";
    if ($total > $limite) {
        $paginacao = "<tfoot><tr><td colspan=\"100%\"><p class='center'>";
        $paginas = ceil($total / $limite);
        $maxPagShow = 15;
        $pagMestre = 12;

        $ini_paginacao = 1;
        $fim_paginacao = $paginas;

        if ($paginas > $maxPagShow) {
            if ($pagina < $pagMestre) {
                $fim_paginacao = $maxPagShow;
            } else {
                $fim_paginacao = $pagina + ($maxPagShow - $pagMestre);
                if ($fim_paginacao >= $paginas)
                    $fim_paginacao = $paginas;
                $ini_paginacao = $fim_paginacao - ($maxPagShow - 1);
            }
        }

        if ($ini_paginacao > 1) {
            $paginacao .= "<a href=\"javascript:paginacao('first','{$javascript}');\">Primeira</a> - ";
        }
        if ($pagina > 1) {
            $paginacao .= "<a href=\"javascript:paginacao('prev','{$javascript}');\">voltar</a> - ";
        }

        $paginacao .= "<span class='paginacao'>";
        for ($i = $ini_paginacao; $i <= $fim_paginacao; $i++) {
            if ($i == $pagina) {
                $paginacao .= " <span class='paginaSel'>{$i}</span> ";
            } else {
                $paginacao .= " <a href=\"javascript:paginacao({$i},'{$javascript}');\">{$i}</a> ";
            }
        }
        $paginacao .= "</span>";

        if ($pagina < $paginas) {
            $paginacao .= " - <a href=\"javascript:paginacao('next','{$javascript}');\">proxima</a>";
        }

        if ($fim_paginacao < $paginas) {
            $paginacao .= " - <a href=\"javascript:paginacao('last','{$javascript}');\">Última</a>";
        }

        $paginacao .= " - ({$total} registros, <span id='lastpage'>{$paginas}</span> paginas) ";

        $paginacao .= "</p><p class='center'>Ir direto <input type=\"text\" name=\"go\" id=\"go\" value=\"\"> <input type=\"button\" id=\"btGo\" value=\"Ver página\" calss=\"button\" onClick=\"javascript:paginacaoGo('{$javascript}');\"> </p></td></tr></tfoot>";
    }
    return $paginacao;
}
?>
