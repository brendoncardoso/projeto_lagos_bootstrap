<?php include_once('header.php'); ?>

<?php
    if(isset($_POST['nome']) && !empty($_POST['nome']) && 
    isset($_POST['telefone']) && !empty($_POST['telefone']) && 
    isset($_POST['email']) && !empty($_POST['email'])) { ?>
        
        <?php 
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $mensagem = addslashes($_POST['mensagem']);
            
            $qr_insert = mysql_query("INSERT INTO fale_conosco (nome, telefone, email) values ('$nome', '$telefone', '$email')");
            $qr_menssage = mysql_query("INSERT INTO fale_conosco_mensagens (nome_cliente, mensagem) values ('$nome', '$mensagem')");
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
                        <h4>FALE CONOSCO</h4>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="right">
                            <a href="index.php" class="text-white">Home</a>
                            <span>» Fale Conosco</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-12">
            <div class="row p-5">
                <div class="col-sm-6 container">
                    <div class="title_wall">Escritório Administrativo</div>
                    <p class="container">Rua do Carmo, 9 – 10º andar – Centro – Rio de Janeiro – RJ</p>
                    <p class="container">CEP: 20011-020</p>
                    <p class="container">Telefones (21) 2725-5602 / 2725-3428</p>
                    <iframe class="container" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d29401.996966922117!2d-43.175735!3d-22.904162!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5f9d6b9751%3A0x598353b01f9ff371!2sR.+do+Carmo%2C+9+-+Centro%2C+Rio+de+Janeiro+-+RJ%2C+20011-020%2C+Brasil!5e0!3m2!1spt-BR!2sus!4v1561821342272!5m2!1spt-BR!2sus" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-6 p-5" style="background-color: #4DB1E2">
                    <h4 class="text-white pb-3" style="margin-top: -23px; font-weight: normal">FALE CONOSCO</h4>
                    <form id="regiform2" method="post">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nome: </label>
                            <input type="text" class="form-control" name="nome" id="formGroupExampleInput" placeholder="" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Telefone: </label>
                            <input type="text" class="form-control phone" name="telefone" id="formGroupExampleInput2" placeholder="(__) ____-_____" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email: </label>
                            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="" data-validation-engine="validate[required]">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Mensagem: </label>
                            <textarea class="form-control" name="mensagem" id="exampleFormControlTextarea1" rows="5" data-validation-engine="validate[required]"></textarea>
                        </div>

                        <button class="faleconosco_botao text-white right enviar_mensagem mt-3" type="submit" name="enviar_mensagem" style="width: 100px; height: 40px;">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('footer.php'); ?>