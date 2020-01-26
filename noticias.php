<?php include_once('header.php'); ?>
    <?php include_once('breadcrumb.php'); ?>
    <div class="pagina-noticias pagina-conteudo noticias">
        <div class="col-sm-10 offset-sm-1">
            <h1>Notícias</h1>
            <form id="form-crud" class="busca d-none d-lg-block" method="post" action="">
                <input type="hidden" name="_token" value="">                    
                <div class="row">
                    <div class="coluna col-12 col-sm-12 col-md-5 col-lg-5">
                        <input type="text" name="titulo" placeholder="Digite sua Busca" class="form-control">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <select name="editorial_id" id="editorial_id" class="select2 form-control" style="height: 100% !important;border:none;">
                            <option value="">Escolha um Edital</option>
                                <option value="d5c45c60-768b-11e9-bd85-9106edd042b8"></option>
                            </select>                         
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <input type="text" name="data_ini" id="data_ini" placeholder="A partir" class="form-control" data-mask="99/99/9999" autocomplete="off" maxlength="10">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-2 col-lg-2">
                        <input type="text" name="data_fim" id="data_fim" placeholder="Até" class="form-control" data-mask="99/99/9999" autocomplete="off" maxlength="10">
                        <p class="border-effect"></p>
                    </div>
                    <div class="coluna col-12 col-sm-12 col-md-1 col-lg-1">
                        <input type="submit" value="Buscar">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once('footer.php'); ?>