<?php
include('../includes/conecte.php');
include('../includes/restricao.php');
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <title>Administração de Candidatos</title>
        <link href="../estrutura.css" rel="stylesheet" type="text/css"/>
        <script src="../resources/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../maskedinput.js" type="text/javascript"></script>
        <script src="../cadastro.js" type="text/javascript" ></script>
        <script src="../validationEngine/jquery.validationEngine-pt.js" type="text/javascript" ></script>
        <script src="../validationEngine/validationEngine.js" type="text/javascript" ></script>
        <link href="../validationEngine/validationEngine.jquery.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(function(){

                $('#telefone').mask('(99)9999-9999');
                $('#nivel').change(function(){
                    var nivel_id = $(this).val();
                    $.ajax({
                        url: '../action.cargo.php?nivel='+nivel_id,
                        success: function(resposta){
                            $('#cargo').html(resposta);
                        }
                    })
                });

                $('.linha_upload').click(function(){
                    $('.upload2').trigger('click');
                });
            });
        </script>

    </head>
    <body>
        <div id="corpo">
            <div id="conteudo">
                <div id="estado" align="">

                    <h1 class="titulo">&nbsp;</h1>
                    <h1 class="titulo">&nbsp;</h1>
                    <h1 class="titulo">Consulta:</h1>
                    <div class="seta_branca_grande"></div>
                    <h1 class="titulo">Selecione o Estado que deseja Colsultar:</h1>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <table align="center" width="400px">
                        <tr>
                            <td bgcolor="#004A95" valign="middle" align="center" width="120px" style="height:40px">
                                <a href="inicio.php?uf=rj"><font color="#FFFFFF"><b>RIO DE JANEIRO</b></font></a>
                            </td>
                        <tr>
                            <td bgcolor="#004A95" valign="middle" align="center" width="120px" style="height:40px">
                                <a href="inicio.php?uf=rs"><font color="#FFFFFF"><b>RIO GRANDE DO SUL</b></font></a></td>
                        </tr>
                    </table>


                    <div class="clear_left"></div>            
                    <div id="rodape"></div>	
                </div>
            </div>
        </div>

    </form>
</body>
</html>
