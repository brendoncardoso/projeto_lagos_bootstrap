<?php include_once('header.php'); ?>

<?php
    if(isset($_POST['nome']) && !empty($_POST['nome']) && 
    isset($_POST['telefone']) && !empty($_POST['telefone']) && 
    isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['assunto']) && !empty($_POST['assunto'])){ ?>
    
    <?php         
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $assunto = addslashes($_POST['assunto']);
        $mensagem = addslashes($_POST['mensagem']);
        
        $qr_insert = mysql_query("INSERT INTO ouvidoria (nome, telefone, email) values ('$nome', '$telefone', '$email')");
        $qr_menssage = mysql_query("INSERT INTO ouvidoria_mensagem (nome_cliente, assunto, mensagem) values ('$nome', '$assunto', '$mensagem')");
    ?>
<?php } ?>

    <!-- Modal -->
    <div class="modal fade modalfaleconosco" id="" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">
                        ATENÇÃO!
                    </h5>
                    <button type="button" class="close fechar" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="text-center">
                    <div class="modal-body">
                        <img src="assets/images/checked.png" alt="">
                    </div>

                    <div class="modal-body">
                        Mensagem enviada com Sucesso. Obrigado!
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger fechar" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>  

    <!--HEADER MENU-->
    <div class="borda_menu"></div>
    <div class="page_title">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <h4>OUVIDORIA</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Ouvidoria</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-12">
            <div class="row p-5">
                <div class="col-sm-6">
                    <img class="img-thumbnail pr-0" src="assets/images/ouvir-voce.jpg" alt="" style="border: 0px;">
                    <li class="text-dark" style="list-style-type: none;">
                        <i class="fa fa-envelope" aria-hidden="true" style="color: #4DB1E2"></i> 
                        <strong>Email:</strong> <a class="link" style="font-size: 12px;" href="mailto:ouvidoria@institutolagosrio.com.br">ouvidoria@institutolagosrio.com.br</a>
                    </li>
                    <li class="text-dark" style="list-style-type: none;">
                        <i class="fa fa-phone" aria-hidden="true" style="color: #4DB1E2"></i> <strong>Tel.: </strong> (21) 2725-5602
                    </li>
                </div>

                <div class="col-sm-6">
                    <h5 style="font-weight: 200;">Cidadão, precisamos de você!</h5>
                    <div class="borda_line" style="width: 252px;"></div>
                    <div>
                        <p style="text-align: justify;">Ouvidoria é uma ferramenta importante para uma gestão cidadã e moderna, que objetiva a qualidade de vida da população, resultando na melhoria da prestação de diferentes funções, como um instrumento autêntico da democracia participativa.</p>
                        <p style="text-align: justify;">O principal meio para conseguirmos identificar os erros é por você, o usuário de nossas Unidades de Pronto Atendimento, pois é através de suas opiniões que a Ouvidoria tomará as devidas medidas para que haja satisfação em ser bem atendido. É válido lembrar que toda e qualquer opinião seja elogio, crítica e/ou denúncia é tratada de maneira totalmente sigilosa, no qual os dados do denunciante são preservados.</p>
                        <p style="text-align: justify;">Portanto, confie e acredite que você é reconhecido por toda a equipe do Instituto Lagos Rio, sendo esclarecido mediante todos os elogios, denúncias e reclamações.</p>
                        <p style="text-align: justify;">Afinal, quem será sempre importante para nós é você!</p>
                    </div>
                </div>
                <!--<div class="col-sm-6 p-5" style="background-color: #4DB1E2; margin-bottom: 120px;">
                    <h4 class="text-white pb-3" style="margin-top: -23px; font-weight: normal">Dados para Contato</h4>

                    <form id="regiform" method="post">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nome: </label>
                            <input type="text" name="nome" class="form-control" placeholder="" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Telefone: </label>
                            <input type="text" name="telefone" class="form-control phone" placeholder="(__) ____-_____" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email: </label>
                            <input type="email" name="email" class="form-control" placeholder="" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Assunto: </label>
                            <input type="text" name="assunto" class="form-control" placeholder="" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Mensagem: </label>
                            <textarea type="text" class="form-control" name="mensagem" rows="5" data-validation-engine="validate[required]"></textarea>
                        </div>

                        <button class="faleconosco_botao text-white right enviar_mensagem mt-3" type="submit" name="enviar_mensagem" style="width: 100px; height: 40px;">Enviar</button>
                    </form>
                </div>-->
            </div>
        </div>
    </div>

<?php include_once('footer.php'); ?>
