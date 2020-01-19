<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
include('../includes/paginacao.php');
include('../includes/global.php');

if (isset($_SESSION['message'])) {
    $mensagem = $_SESSION['message'];
    unset($_SESSION['message']);
}

$sql_logo = mysql_query("SELECT * FROM cms_logo");

while($row = mysql_fetch_assoc($sql_logo)){
    $arrayLogo[$row['id']] = [
        "nome_logo" => $row['nome_logo'],
        "extensao" => $row['extensao']
    ];
}

$sql_logo_rows = mysql_num_rows($sql_logo);


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
        <link href="../resources/css/jquery.qtip.css" type="text/css" rel="stylesheet"/>
        <link href="../resources/css/jquery.validationEngine.css" type="text/css" rel="stylesheet"/>
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr 1fr 1fr;
                grid-template-areas: ". . ." ". . ." ". . .";
                margin-left: 70px;
            }
            .logo{
                margin-bottom: 20px;
                text-align: center;
            }

            .text-center{
                text-align: center;
            }

            .button_center{
                float: none!important;
                display: inline-block!important;
            }

            .button_a{
                color: black; 
                font-size: 13px;
                padding: 1px 10px;
            }

            .button_center{
                float: none!important;
                display: inline-block!important;
            }
        </style>

        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.validationEngine-pt.js" type="text/javascript"></script>
        <script src="../resources/js/maskedinput.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.qtip-2.min.js" type="text/javascript"></script>
        <script src="../resources/js/global.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.FCKEditor.js" type="text/javascript" ></script>
        <script src="ckeditor/ckeditor.js" type="text/javascript" ></script>
        <script type="text/javascript">
       

            $(document).ready(function(){
                $(".message").delay(2000).fadeOut("slow");

                $('.excluir_logo').click(function(){
                    var id_logo = $(this).data('id');

                    if(confirm("Atenção, deseja realmente excluir essa Logo?")){
                        $.post('../actions/action.cms.php',
                        {id_logo:id_logo, method: "excluir_logo"},
                        function(data){
                            window.location = "logolista.php"
                        }, "json");
                    }
                });
            });
            
        </script>
    </head>

    <body>
        <div class="main">
            <div id="header">
                <h1>ADMINISTRAÇÃO DE CANDIDATOS</h1>
            </div>
            <nav>
                <?php include('../includes/menu_adm.php'); ?>
            </nav>

            <section>
                <div id="conteudo">
                    <div class="blocos">
                        <h2>Lista de Logos</h2>

                        <hr class="clear"/>
                        
                        <?php if (isset($mensagem))  { ?>
                            <div class="message">
                                <?= $mensagem; ?>
                            </div>
                        <?php }?>

                        <?php if(!empty($sql_logo_rows)) { ?>
                            <form action="" method="post">
                                <table width="100%" class="grid" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nome da Logo</th>
                                            <th colspan="2">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            $class = (($i++ % 2) == 0) ? "even" : "odd";
                                        ?>
                                        <?php foreach($arrayLogo as $id_logo => $values) { ?>
                                            <tr class="<?php echo $class ?>">
                                                <td class="center"><?= $id_logo; ?></td>
                                                <td class="center"><?= $values['nome_logo']; ?></td>
                                                <td class="center">
                                                    <a class="button_a button text-center button_center" href="cms_logo_images/<?php echo $id_logo; ?>.<?php echo $values['extensao']; ?>" target="_blank">
                                                        VISUALIZAR
                                                    </a> 
                                                </td>
                                                <td class="center">
                                                    <input type="submit" name="excluir_logo" class="button excluir_logo text-center button_center" value="EXCLUIR" data-id="<?php echo $id_logo; ?>"/>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        <?php } else { ?>
                            <div id="retorno">
                                <h4>Nenhum logo cadastrado, <a href="logoform.php">clique aqui para cadastrar</a></h4>
                            </div>
                        <?php } ?>
                    </div> 
                </div>
            </section>
          
            <section id="footer">
                <p>Todos os direitos reservados</p>
            </section>
        </div>
    </body>
</html>