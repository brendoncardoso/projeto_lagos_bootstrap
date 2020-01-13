<div class="div-menu">
    <?php if($setor == "1"){ ?>
    <ul>
        <li><a href="inicio.php">INÍCIO</a></li>
        <li><a href="empresas.php">EMPRESAS</a></li>
        <li><a href="cms.php">MENU</a></li>
        <li><a href="pessoas.php">CURRÍCULOS EDITAIS</a></li>
        <li><a href="curriculos.php">CURRÍCULOS </a></li>
        <li><a href="editais.php">EDITAL COMPRAS</a> </li>
        <li><a href="editalpessoal.php">EDITAL PESSOAL</a> </li>
        <li><a href="unidades.php">UNIDADES</a> </li>
        <li><a href="cargos.php">CARGOS</a> </li>
        <li><a href="escala.php">ESCALA</a></li>
        <li><a href="noticias.php">NOTICIAS</a> </li>
        <li><a href="regulamentos.php">REGULAMENTOS</a> </li>
        <li><a href="../adm/relatorios.php">RELATÓRIOS</a> <!--relatorios.php--></li>
        <li><a href="index.php?sair=true">SAIR</a> </li>
    </ul>
    <?php }else{ ?>
    <ul>
        <li><a href="inicio.php">INÍCIO</a></li>
        <!--<li><a href="pessoas.php">CURRÍCULOS</a> </li>-->
        <li><a href="cms.php">MENU</a></li>
        <li><a href="escala.php">ESCALA</a></li>
        <li><a href="index.php?sair=true">SAIR</a> </li>
    </ul>
    <?php } ?>
</div>