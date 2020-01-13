<?php
/*if($_COOKIE['debug']){
    phpinfo();
}*/

session_start();
setcookie("autorizado", "true", 0, "/");

include('../includes/conecte.php');

//echo md5("datario123");

if(isset($_REQUEST['sair'])){
    //session_destroy();
}

if (isset($_POST['enviar']) && !empty($_POST['login']) && !empty($_POST['senha'])) {        
    $login = trim(mysql_real_escape_string($_POST['login']));
    $senha = md5(trim($_POST['senha']));

    $qr_usu = mysql_query("SELECT * FROM usuarios WHERE login= '$login' AND senha = '$senha' AND status = 1");

    $verifica_usuario = mysql_num_rows($qr_usu);

    if ($verifica_usuario != 0) {
        $row_usu = mysql_fetch_assoc($qr_usu);

        $_SESSION['logado'] = $row_usu['usu_id'];
        $_SESSION['setor'] = $row_usu['setor'];
        $_SESSION['id_unidade'] = $row_usu['id_unidade'];
        header('Location: inicio.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link href="../resources/css/new-adm.css" type="text/css" rel="stylesheet"/>
        
        <title>Administração de Candidatos</title>
    </head>

    <body>
        <div id="corpo-login">
            <section id="login">

                <h2>ADMINISTRAÇÃO DE CANDIDATOS</h2>

                <div class="div-float" id="logo">
                    <img src="../resources/images/logomaster6.gif"/>
                </div>

                <div id="form">
                    <form name="form" method="post" action="">
                        <div class="div-float">
                            <p><label>Login:</label> <input type="text" name="login" class="text"></p>
                            <p><label>Senha:</label> <input type="password" name="senha" class="text"/></p>
                        </div>
                        <div class="div-float botao">
                            <p class="controls"><input type="submit" name="enviar" value="ENTRAR" class="button"/></p>
                        </div>
                    </form>
                </div>
            </section>
            <span class="clear">&nbsp;</span>
        </div>
    </form>
</body>
</html>
