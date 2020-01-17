<?php
    include('conecte.php');
    $sql_user = mysql_query("SELECT * FROM usuarios WHERE usu_id = '{$_SESSION['logado']}'");
    $row_user = mysql_fetch_assoc($sql_user);
    $setor_user = $row_user['setor'];
?>
    <div class="div-menu">
        <?php if($setor_user != 0) { ?>
            <ul>
                <li><a href="inicio.php">INÍCIO</a></li>
                <li><a href="empresas.php">EMPRESAS</a></li>
                <?php if ($adm == "1") { ?>
                    <li><a href="usuarios.php">USUÁRIOS</a></li>
                <?php } ?>
                <li><a href="cms.php">CONTEÚDO</a></li>
                <li><a href="pessoas.php">CURRÍCULOS EDITAIS</a></li>
                <li><a href="curriculos.php">CURRÍCULOS </a></li>
                <li><a href="editais.php">EDITAL DE COMPRAS</a> </li>
                <li><a href="editalpessoal.php">EDITAL DE PESSOAS</a> </li>
                <li><a href="unidades.php">UNIDADES</a> </li>
                <li><a href="cargos.php">CARGOS</a> </li>
                <li><a href="escala.php">ESCALA</a></li>
                <li><a href="noticias.php">NOTÍCIAS</a> </li>
                <li><a href="regulamentos.php">REGULAMENTOS</a> </li>
                <li><a href="relatorios.php">RELATÓRIOS</a></li>
                <li><a href="index.php?sair=true">SAIR</a> </li>
            </ul>
        <?php } else { ?>
            <ul>
                <li><a href="inicio.php">INÍCIO</a></li>
                <li><a href="escala.php">ESCALA</a></li>
                <li><a href="index.php?sair=true">SAIR</a> </li>
            </ul>
        <?php } ?>
    </div>
