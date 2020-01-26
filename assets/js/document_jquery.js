$(document).ready(function(){
    var style = document.querySelector('.cabecalho').style.background;

    $('.home').click(function(){
        window.location.href="index.php"
    });

    $('.projetos').click(function(){
        window.location.href="projetos.php"
    });

    $('.colaborador').click(function(){
        window.open("http://f71lagos.com/extranet/login");
    });

    $('.home').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #4DB1E2"
        });
    });

    $('.home').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.institucional').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #00B3B6",
        });
    });

    $('.institucional').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.projetos').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, black"
        });
    });

    $('.projetos').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.noticias').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #FFBD00"
        });
    });

    $('.noticias').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.trabconosco').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #008B8B"
        
        });
    });

    $('.trabconosco').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.transparencia').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #8B008B"
        
        });
    });

    $('.transparencia').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.irs').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #FF7661"
        });
    });

    $('.irs').mouseout(function(){
        $('.cabecalho').css({
            background: (style)
        });
    });

    $('.colaboradores').mouseover(function(){
        $('.cabecalho').css({
            background: "linear-gradient(to right, #242952 25%, #008DAF"
        });
    });

    $('.img1').mouseover(function(){
        $(this).css({'transform':'scale(1.1)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.img1').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.img2').mouseover(function(){
        $(this).css({'transform':'scale(1.1)','transition':'1s', 'cursor':'pointer'});
    });

    $('.img2').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.transp').mouseover(function(){
        $(this).css({'transform':'scale(1.1)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.transp').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.colaboradores').mouseover(function(){
        $(this).css({'transform':'scale(1.1)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.colaboradores').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.processos_seletivos').mouseover(function(){
        $(this).css({'transform':'scale(1.1)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.processos_seletivos').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.fornecedores').mouseover(function(){
        $(this).css({'transform':'scale(1.1)', 'transition':'1s', 'cursor':'pointer'});
    });

    $('.fornecedores').mouseleave(function(){
        $(this).css({'transform':'scaleY(1.0)', 'transition':'1s', 'cursor':'pointer'});
    });

    var id_pasta = $('.getPasta').attr('data-id_pasta');
    var id_empresa = $('.getEmpresa').attr('data-id_empresa');
    var id_unidade = $('.getUnidade').attr('data-id_unidade');
    

    $('.botaoCategoria2').click(function(){
        var id_pasta = $(this).attr('data-id_pasta');
        $('.categoria2'+id_pasta).toggle();
    })

    $('.botaoCategoria').click(function(){
        var id_pasta = $(this).attr('data-id_pasta');
        $('.pasta'+id_pasta).toggle();
        
    });

    $('.teste').click(function(){
        var id_pasta = $(this).attr('data-id_pasta');
        var id_unidade = $(this).attr('data-id_unidade');

        $.ajax({
            url: "sistema/actions/actionCategoria3.php",
            datType: "html",
            data: {id_unidade: id_unidade, id_pasta:id_pasta},
            success: function(data){
                $('.actionCategoria3'+id_pasta+id_unidade).html(data);
              
                $('.empresa_prestador'+id_pasta+id_unidade).click(function(){
                    var id_empresa = $(this).attr('data-id_empresa');
                    
                    $.ajax({
                        url: "sistema/actions/actionCategoria33.php",
                        dataType: "html",
                        data: {id_unidade:id_unidade, id_pasta:id_pasta, id_empresa:id_empresa},
                        success: function(data){
                            $('.actionCategoria33'+id_unidade+id_empresa).html(data);
                        },
                        error: function(){
                            alert("Deu error");
                        }  
                    });
                });
            },
            error: function(){
                alert("ERROR");
            }
        });

       
    });

   


    $('.abrirUnidade').click(function(){
        var id_unidade = $(this).attr('data_id_unidade');
        var id_pasta = $(this).attr('data_pasta');

        $.ajax({    
            url: "respostaCategoria.php",
            method: "POST",
            dataType: "html",
            data: {id_unidade: id_unidade, id_pasta:id_pasta},

            success: function(data){
                $('#respostaCategoria').hide();
                $('#respostaUnidade').html(data);
                $('.abrirEmpresa').click(function(){
                    var id_empresa = $(this).attr('data-id_empresa');
                    $.ajax({
                        url: "respostaEmpresa.php",
                        method: "POST",
                        dataType: "html",
                        data: {id_unidade: id_unidade, id_pasta:id_pasta, id_empresa:id_empresa},
                        success: function(data){
                            $("#respostaUnidade").hide();
                            $('#respostaEmpresa').html(data);
                        },
                        error: function(){
                            alert("Error");
                        }
                    });
                })
            },
            error: function(){
                alert("Error!");
            }
        });
    })

    //$('#modalintro').modal('show');
    

    $('.enviar_mensagem').click(function(e){
        var vazios = $("input[type=text]").filter(function(){
            return !this.value;
        }).get();

        var vazios = $("input[type=date]").filter(function(){
            return !this.value;
        }).get();

        var vazios = $("input[type=email]").filter(function(){
            return !this.value;
        }).get();

        var vazios = $("textarea[type=text]").filter(function(){
            return !this.value;
        }).get();


        if (vazios.length) {
        } else {
            $('.modalfaleconosco').modal('show');
            e.preventDefault();
            $('.fechar').click(function(){
                $('#regiform').submit();
                $('#regiform2').submit();
                $('#regiform3').submit();
            })
        }
    });

    $(document).ready(function(){
        function esconderPesquisas(){
            $('.pesquisa2019').hide();
            $('.pesquisa2016').hide();
            $('.pesquisa2015').hide();
            $('.pesquisa2014').hide();
            $('.pesquisa2013').hide();
            $('.pesquisa2012').hide();
        }

        function esconderPesquisasAbertas(){
            $('.pesquisaRJ').hide();
            $('.pesquisaSP').hide();
            $('.pesquisaRS').hide();
        }
        
            getObj = document.querySelectorAll('.botao_cargo');
            
            getObj.forEach((obj) => {
                var id_unidade = obj.getAttribute("data-id_unidade");
                if(id_unidade == 1){
                    $('.pesquisa1').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa1').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            $('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
    
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 2){
                    $('.pesquisa2').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
    
                    function(resposta2){
                        $('.pesquisa2').html(resposta2);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            $('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 3){
                    $('.pesquisa3').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa3').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            $('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 4){
                    $('.pesquisa4').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa4').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            $('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 5){
                    $('.pesquisa5').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa5').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 6){
                    $('.pesquisa6').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa6').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 7){
                    $('.pesquisa7').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa7').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 8){
                    $('.pesquisa8').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa8').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 9){
                    $('.pesquisa9').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa9').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 10){
                    $('.pesquisa10').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa10').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 11){
                    $('.pesquisa11').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa11').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 12){
                    $('.pesquisa12').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa12').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 13){
                    $('.pesquisa13').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa13').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 14){
                    $('.pesquisa14').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa14').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 15){
                    $('.pesquisa15').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa15').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 16){
                    $('.pesquisa16').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa16').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 17){
                    $('.pesquisa17').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa17').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 18){
                    $('.pesquisa18').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa18').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 19){
                    $('.pesquisa19').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa19').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 20){
                    $('.pesquisa20').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa20').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 21){
                    $('.pesquisa21').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa21').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 22){
                    $('.pesquisa22').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa22').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 23){
                    $('.pesquisa23').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa23').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 24){
                    $('.pesquisa24').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa24').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 25){
                    $('.pesquisa25').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa25').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 26){
                    $('.pesquisa26').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa26').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 27){
                    $('.pesquisa27').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa27').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 28){
                    $('.pesquisa28').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa28').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 29){
                    $('.pesquisa29').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa29').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 30){
                    $('.pesquisa30').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa30').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 31){
                    $('.pesquisa31').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa31').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 32){
                    $('.pesquisa32').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa32').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }else if(id_unidade == 33){
                    $('.pesquisa33').show();
                    $.post("sistema/actions/action.comprasvagasabertas.php",
                    {id_unidade:id_unidade, method:"listaIdUnidade"}, 
                    function(resposta){
                        $('.pesquisa33').html(resposta);
                        getCargo = document.querySelectorAll('.sublista');
                        getIdEditalPessoal = document.querySelectorAll('.sublistaeditalpessoal');
                        
                        getCargo.forEach((item) => {
                            var id_cargo = item.getAttribute("data-cargo");                    
                            //$('.list_idcargo'+id_unidade+id_cargo).hide();
    
                            getIdEditalPessoal.forEach((item2) => { 
                                var id_editalpessoal = item2.getAttribute('data-id_editalpessoal');
    
                                $('.list_nomecargo'+id_unidade+id_cargo).click(function(){
                                    $('.list_idcargo'+id_unidade+id_cargo).show();
                                    $('.cadaUm'+id_unidade+id_cargo+id_editalpessoal).hide();
                                });
    
                                $('.list_idcargo'+id_unidade+id_cargo).click(function(){
                                    var editalpessoal = $(this).data("id_editalpessoal");
                                    $('.cadaUm'+id_unidade+id_cargo+editalpessoal).show();
                                })
                            });
                        });
                        $("#loading").hide();
                    }, "html");            
                }
            });

            
        

        $('.botao_editais_abertos').click(function(){
            var uf = $(this).data("key");
           
            if(uf == 'RJ'){
                $('.pesquisaRJ').toggle();
                $('.pesquisaSP').hide();
                $('.pesquisaRS').hide();

                $.post("sistema/actions/action.editalcompras.php", 
                {uf:uf, method:"listaUf"},
                    function(resposta){
                        $('.pesquisaRJ').html(resposta);

                        var getUf = document.querySelectorAll('.sublista');
                    
                        getUf.forEach((item) => {
                            var id_unidade = item.getAttribute('data-id_unidade');
    
                            $('.lista_nome'+uf+id_unidade).click(function(){
                                var id_unidade = $(this).data("id_unidade");
                            });
                        
                            $('.lista_id'+uf+id_unidade).click(function(){
                                var id_compra = $(this).data("id_compra");
                                $('.cadaUm'+uf+id_unidade+id_compra).toggle();
                            });
                        });
                        
                        $("#loading").hide();
                    },"html");

                
            }else if(uf == 'SP'){
                $('.pesquisaRJ').hide();
                $('.pesquisaSP').toggle();
                $('.pesquisaRS').hide();

                $.post("sistema/actions/action.editalcompras.php", 
                {uf:uf, method:"listaUf"},
                    function(resposta){
                        $('.pesquisaSP').html(resposta);

                        var getUf = document.querySelectorAll('.sublista');
                    
                        getUf.forEach((item) => {
                            var id_unidade = item.getAttribute('data-id_unidade');
    
                            $('.lista_nome'+uf+id_unidade).click(function(){
                                var id_unidade = $(this).data("id_unidade");
                            });
                        
                            $('.lista_id'+uf+id_unidade).click(function(){
                                var id_compra = $(this).data("id_compra");
                                $('.cadaUm'+uf+id_unidade+id_compra).toggle();
                            });
                        });
                        
                        $("#loading").hide();
                    },"html");
            }else if(uf == 'RS'){
                $('.pesquisaRJ').hide();
                $('.pesquisaSP').hide();
                $('.pesquisaRS').toggle();

                $.post("sistema/actions/action.editalcompras.php", 
                {uf:uf, method:"listaUf"},
                    function(resposta){
                        $('.pesquisaRS').html(resposta);

                        var getUf = document.querySelectorAll('.sublista');
                    
                        getUf.forEach((item) => {
                            var id_unidade = item.getAttribute('data-id_unidade');
    
                            $('.lista_nome'+uf+id_unidade).click(function(){
                                var id_unidade = $(this).data("id_unidade");
                            });
                        
                            $('.lista_id'+uf+id_unidade).click(function(){
                                var id_compra = $(this).data("id_compra");
                                $('.cadaUm'+uf+id_unidade+id_compra).toggle();
                            });
                        });
                        
                        $("#loading").hide();
                    },"html");
            }else{
                $('.pesquisaRJ').hide();
                $('.pesquisaSP').hide();
                $('.pesquisaRS').hide();
            }
        })
        
        $('.botao_editais_encerrados').click(function(){
            var id = $(this).data("key");
            /*console.log(id);*/
            
            if(id == 2019){

                $('.pesquisa2019').toggle();
                $('.pesquisa2015').hide();
                $('.pesquisa2016').hide();
                $('.pesquisa2014').hide();
                $('.pesquisa2013').hide();
                $('.pesquisa2012').hide();
                esconderPesquisasAbertas();
                
                $.post("sistema/actions/action.edital.php",
                
                {id:id, method:"listaAno"},
                function(resposta){
                    $('.pesquisa2019').html(resposta);

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                    var getId = document.querySelectorAll('.sublista');
                    getId.forEach((item) => {
                        
                        var id_compra = item.getAttribute('data-id_compra');

                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                           

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });


                    

                    $("#loading").hide();
                },"html");
            }else if(id == 2016){
                $('.pesquisa2016').toggle();
                $('.pesquisa2019').hide();
                $('.pesquisa2015').hide();
                $('.pesquisa2014').hide();
                $('.pesquisa2013').hide();
                $('.pesquisa2012').hide();
                esconderPesquisasAbertas();

                $.post("sistema/actions/action.edital.php",
                {id:id, method:"listaAno"},
                
                function(resposta){
                    $('.pesquisa2016').html(resposta);
                    /*var getId = document.querySelectorAll('ul li.lista_nome'+id);
                
                    getId.forEach((item) => {
                        var id_unidade = item.getAttribute('data-id_unidade');
                        $('.lista_nome'+id).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.lista_id'+id_unidade).show();
                        });
                    
                        $('.lista_id'+id_unidade).click(function(){
                            var id_compra = $(this).data("id_compra");
                           $('.cadaUm'+id_unidade+id_compra).toggle();
                        });

                    });*/

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                    var getId = document.querySelectorAll('.sublista');
                    
                    getId.forEach((item) => {
                        var id_compra = item.getAttribute('data-id_compra');
                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                           

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });
                    
                    $("#loading").hide();
                },"html");

            }else if(id == 2015){

                $('.pesquisa2015').toggle();
                $('.pesquisa2019').hide();
                $('.pesquisa2016').hide();
                $('.pesquisa2014').hide();
                $('.pesquisa2013').hide();
                $('.pesquisa2012').hide();
                esconderPesquisasAbertas();
                
                $.post("sistema/actions/action.edital.php",
                
                {id:id, method:"listaAno"},
                function(resposta){
                    $('.pesquisa2015').html(resposta);

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                    var getId = document.querySelectorAll('.sublista');
                                        
                    getId.forEach((item) => {
                        var id_compra = item.getAttribute('data-id_compra');
                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                           

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });

                    $("#loading").hide();
                },"html");
            }else if(id == 2014){
                $('.pesquisa2014').toggle();
                $('.pesquisa2019').hide();
                $('.pesquisa2016').hide();
                $('.pesquisa2015').hide();
                $('.pesquisa2013').hide();
                $('.pesquisa2012').hide();
                esconderPesquisasAbertas();


                $.post("sistema/actions/action.edital.php",
                {id:id, method:"listaAno"},
                function(resposta){
                    $('.pesquisa2014').html(resposta);

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                    var getId = document.querySelectorAll('.sublista');
                    
                    getId.forEach((item) => {
                        var id_compra = item.getAttribute('data-id_compra');
                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                           

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });

                    $("#loading").hide();
                },"html");
            }else if(id == 2013){

                $('.pesquisa2013').toggle();
                $('.pesquisa2019').hide();
                $('.pesquisa2016').hide();
                $('.pesquisa2015').hide();
                $('.pesquisa2014').hide();
                $('.pesquisa2012').hide();
                esconderPesquisasAbertas();

                $.post("sistema/actions/action.edital.php",
                {id:id, method:"listaAno"},
                function(resposta){
                    $('.pesquisa2013').html(resposta);

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                   var getId = document.querySelectorAll('.sublista');
                    
                    getId.forEach((item) => {
                        var id_compra = item.getAttribute('data-id_compra');
                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                        

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });
                    
                    $("#loading").hide();
                },"html");
            }else if(id == 2012){

                $('.pesquisa2012').toggle();
                $('.pesquisa2019').hide();
                $('.pesquisa2016').hide();
                $('.pesquisa2015').hide();
                $('.pesquisa2014').hide();
                $('.pesquisa2013').hide();
                esconderPesquisasAbertas();

                $.post("sistema/actions/action.edital.php",
                {id:id, method:"listaAno"},
                function(resposta){
                    $('.pesquisa2012').html(resposta);

                    getUf = document.querySelectorAll('ul.getUF');
                    getUf.forEach((item) => {
                        var uf = item.getAttribute('data-uf');
                        $('.lista'+uf+id).click(function(){
                            $('.listaUf'+uf+id).toggle();
                        });
                    });

                    var getId = document.querySelectorAll('.sublista');
                    getId.forEach((item) => {
                        var id_compra = item.getAttribute('data-id_compra');
                        $('.lista_nome'+id+id_compra).click(function(){
                            var id_compra = $(this).data("id_compra");
                        });
                           

                        $('.lista_id'+id+id_compra).click(function(){
                            var id_unidade = $(this).data("id_unidade");
                            $('.cadaUm'+id+id_compra+id_unidade).toggle();
                        });
                    });
                    $("#loading").hide();
                },"html");
            }else{
               
            }
        });
    })

    $(document).ready(function(){

        /*$('.dropdown').mouseover(function(){
            var show = $('.dropdown').attr("class");

            if(show == 'nav-item dropdown'){
                $('.dropdown').addClass('show');
                $('.dropdown-menu').slideDown();

                $("#panel").fadeOut();
                $("#panel2").fadeOut();
                $("#panel3").fadeOut();

            }
        });*/

        /*$('.dropdown').mouseover('show.bs.dropdown', function(){
            $(".dropdown-toggle").dropdown();
        });*/

       
     

        /*if(hide == hide){
            $('.dropdown').removeClass('show');
            $('.dropdown-menu').hide();
        }*/
    });

    /*$('.borda_extranet').mouseover(function(){
        $(this).css('background-color', '#0481C0')
        $(this).addClass('borda_extranet_after');
    });

    $('.borda_extranet').mouseleave(function(){
        $(this).css('background-color', '#4DB1E2');
        $(this).removeClass('borda_extranet_after');
    });*/

    
    ///////////////////// SLIDES COM ICONS /////////////////////////////////////////////
    $('.slide1').hide();
    $('.slide2').hide();
    $('.slide3').hide();
    $('.fa-plus').css('cursor', 'pointer');
    $('i.fa-plus').css('color', '#CBCBCB');

    $('.plus1').mouseover(function(){
        $('.span_body_mission').css('color', '#008FD5');
    });

    $('.plus1').mouseleave(function(){
        $('.span_body_mission').css('color', 'black');
    });

    $('.plus2').mouseover(function(){
        $('.span_body_vision').css('color', '#008FD5');
    });

    $('.plus2').mouseleave(function(){
        $('.span_body_vision').css('color', 'black');
    });

    function slide1(classe) { 
        $(classe).on('click', function() {
        $('.slide1').slideToggle(100);

        $('.span_body').removeClass('text-dark');
            let st = $(this).data('st');

            if (st == 1) {
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                $(this).data('st', 2);
            } else {
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                $(this).data('st', 1);
            }
        });
    }
    slide1('.plus1');
    
    function slide2(classe) { 
        $(classe).on('click', function() {
        $('.slide2').slideToggle(100);
            let st = $(this).data('st');
            if (st == 1) {
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                $(this).data('st', 2);
            } else {
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                $(this).data('st', 1);
            }
        });
    }
    
    slide2('.plus2');

    function slide3(classe) { 
        $(classe).on('click', function() {
        $('.slide3').slideToggle(100);
            let st = $(this).data('st');
            if (st == 1) {
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                $(this).data('st', 2);
            } else {
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                $(this).data('st', 1);
            }
        });
    }
    
    slide3('.plus3');
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    $('#panel').show();
    $('#panel2').hide();
    $('#panel3').hide();        
    
    $('.modal').click(function(){
        $("#panel").delay(250).slideDown("slow");
    });


    $('.carousel-control-prev').click(function(){
        $('#panel').delay(250).slideToggle("slow");
        $('#panel3').hide();

        $('#panel2').delay(250).slideToggle("slow");
        $('#panel').hide();

        $('#panel3').delay(250).slideToggle("slow");
        $('#panel2').hide();

        /*$('.dropdown-menu').hide();*/

    });

    $('.carousel-control-next').click(function(){
        $('#panel').delay(250).slideUp("slow");
        $('#panel3').hide();

        $('#panel2').delay(250).slideToggle("slow");
        $('#panel').hide();

        $('#panel3').delay(250).slideToggle("slow");
        $('#panel2').hide();

        /*$('.dropdown-menu').hide();*/
    });

  

    $('i.fa').click(function() {
        $('#modalintro').modal('hide');
    });

    $('.modal-body').click(function(){
        $('#modalintro').modal('hide');
    });

    $('.borda_extranet').click(function(){
        window.open('http://f71lagos.com/extranet/login', '_blank');
    });

    /**SCROLL UP */
    $("#scrollup").click(function() {
        $('html, body').animate({scrollTop: 0}, 900);
    });

    /* MODAL INDEX*/
    //$('#modalintro').modal('show');

    /* SELEÇÕES */
    $('.parte_do_grupo').fadeIn("slow");
    $('.hide_parte_do_grupo').show();

    $("#trabalhe_conosco").click(function(){
        $('.trabalhe_conosco_button').removeClass('btn-outline-blue');
        $(this).addClass('btn-blue');
        
        $('.editais_button').removeClass('btn-blue');
        $('.editais_button').addClass('btn-outline-blue');

        $('.hide_trabalhe_conosco').css('display', 'block');
        $('.hide_editais').css('display', 'none');

        $('.trabalhe_conosco').fadeIn("slow");
        $('.editais').fadeOut("slow");

        $('.hide_parte_do_grupo').hide();
        $('.parte_do_grupo').fadeOut();
    });

    $("#editais").click(function(){
        $('.editais_button').removeClass('btn-outline-blue');
        $(this).addClass('btn-blue');
        $('.trabalhe_conosco_button').removeClass('btn-blue');
        $('.trabalhe_conosco_button').addClass('btn-outline-blue');

        $('.hide_trabalhe_conosco').css('display', 'none');
        $('.hide_editais').css('display', 'block');
        
        $('.editais').fadeIn("slow");
        $('.trabalhe_conosco').fadeOut("slow");
        $('.hide_parte_do_grupo').hide();
    });

    /** TABLE_INSTITUTO */
    $('#quem_somos').removeAttr('href');            
    $("#quem_somos").click(function() {
        $('.table_instituto').fadeToggle();
    });

    /** MASCARA TELEFONE */
    $('.phone').mask("(99) 9999-99999");
    $('.date').mask("99/99/9999");

    // VALIDATION ENGINE
    $("#regiform").validationEngine();
    $("#regiform2").validationEngine();
    $("#regiform3").validationEngine();


    $('.btn-old').click(function(){
        var bt = $(this);
        var id = bt.data('key');
        var st = bt.attr("data-st");


        if(st=="0"){
            $("#loading").show();
            $.post("sistema/actions/action.edital.php",
                    {id:id, method:"listaAno"},
                    function(resposta){
                        console.log(st);
                        $('#pesquisa').html(resposta);
                        $("#loading").hide();
                    },"html");
            bt.attr('data-st', 0);

        }else if(st=="1"){
            $("#pesquisa").hide();
            bt.attr('data-st', 2);

        }else if(st=="2"){
            $("#pesquisa").show();
            bt.attr('data-st', 1);
        }
    });

    $('.linkAltera').click(function() {
        var id = $(this).data("page");
        console.log("noticia_bd.php?id_noticia=" + id);
    }); 


    ///////////////////////////////////////////////////////////
    $(document).ready(function(){
        $('#show_cad_crf').click(function(){
            var display = $("#hide_cad_crf").css("display");
            if(display == 'none'){
                $('i.certificado').removeClass('fa-angle-down').addClass('fa-angle-up');
            }else if(display == 'block'){
                $('i.certificado').removeClass('fa-angle-up').addClass('fa-angle-down');
            }
        });

        $("#show_cad_nacional").click(function(){
            var display = $("#hide_cad_nacional").css("display");
            if(display == 'none'){
                $('i.cadastro').removeClass('fa-angle-down').addClass('fa-angle-up');

            }else if(display == 'block'){
                $('i.cadastro').removeClass('fa-angle-up').addClass('fa-angle-down');
            }
        });

        $('#show_cont_adtv').click(function(){
            var display = $(".hide_cont_adtv").css("display");
            if(display == 'none'){
                $('i.contrato').removeClass('fa-angle-down').addClass('fa-angle-up');
            }else if(display == 'block'){
                $('i.contrato').removeClass('fa-angle-up').addClass('fa-angle-down');
            }
        });

        $('#show_reg_compras').click(function(){
            
            var display = $("#hide_compras").css("display");
            if(display == 'none'){
                $('i.regulamento').removeClass('fa-angle-down').addClass('fa-angle-up');
            }else if(display == 'block'){
                $('i.regulamento').removeClass('fa-angle-up').addClass('fa-angle-down');
            }
        });
    });

    ///////////////////////////////////////////////////////////////

    $(document).ready(function(){
        $('#hide_cad_crf').hide();
        $('#show_cad_crf').click(function(){
            $('#hide_cad_crf').toggle("slow");
        });
    
        $('#hide_cad_nacional').hide();
        $('#show_cad_nacional').click(function(){
            $('#hide_cad_nacional').toggle("slow");
        });
    
        $('#hide_cad_gestao').hide();
        $('#show_cad_gestao').click(function(){
            $('#hide_cad_gestao').toggle("slow");
        });
    
        
        $('.hide_cont_adtv').hide();
        $('#show_cont_adtv').click(function(){
            $('.hide_cont_adtv').toggle("slow");
        });

        $('#hide_compras').hide();
        $('#show_reg_compras').click(function(){
            $('#hide_compras').toggle("slow");
        })
        
        $("#tabela12").hide();
        $("#tabela13").hide();
        $("#tabela14").hide();
        $("#tabela15").hide();
        $("#tabela16").hide();
        $("#tabela17").hide();
        $("#tabela18").hide();
        $("#tabela19").hide();
        $("#tabela12a").hide();
        $("#tabela13a").hide();
        $("#tabela14a").hide();
        $("#tabela15a").hide();
        $("#tabela16a").hide();
        $("#tabela17a").hide();
        $("#tabela18a").hide();
        $("#tabela19a").hide();
    
        $("#h2_rel12a").click(function() {
            $('.alert12a').toggle();
            $("#tabela12a").toggle();
        });

        $("#h2_rel12").click(function() {
            $('.alert12').toggle();
            $("#tabela12").toggle();
        });

        $("#h2_rel13").click(function() {
            $('.alert13').toggle();
            $("#tabela13").toggle();
        });
    
        $("#h2_rel13a").click(function() {
            $('.alert13a').toggle();
            $("#tabela13a").toggle();
        });
    
        $("#h2_rel14").click(function() {
            $('.alert14').toggle();
            $("#tabela14").toggle();
        });
    
        $("#h2_rel14a").click(function() {
            $('.alert14a').toggle();
            $("#tabela14a").toggle();
        });
    
        $("#h2_rel15").click(function() {
            $('.alert15').toggle();
            $("#tabela15").toggle();
        });
    
        $("#h2_rel15a").click(function() {
            $('.alert15a').toggle();
            $("#tabela15a").toggle();
        });
    
        $("#h2_rel16").click(function() {
            $('.alert16').toggle();
            $("#tabela16").toggle();
        });
    
        $("#h2_rel16a").click(function() {
            $('.alert16a').toggle();
            $("#tabela16a").toggle();
        });
    
        $("#h2_rel17").click(function() {
            $('.alert17').toggle();
            $("#tabela17").toggle();
        });
    
        $("#h2_rel17a").click(function() {
            $('.alert17a').toggle();
            $("#tabela17a").toggle();
        });
    
        $("#h2_rel18").click(function() {
            $('.alert18').toggle();
            $("#tabela18").toggle();
        });
    
        $("#h2_rel18a").click(function() {
            $('.alert18a').toggle();
            $("#tabela18a").toggle();
        });
    
        $("#h2_rel19").click(function() {
            $('.alert19').toggle();
            $("#tabela19").toggle();
        });
    
        $("#h2_rel19a").click(function() {
            $('.alert19a').toggle();
            $("#tabela19a").toggle();
        });

        $('#h2_rel12').css('cursor', 'pointer');
        $('#h2_rel13').css('cursor', 'pointer');
        $('#h2_rel14').css('cursor', 'pointer');
        $('#h2_rel15').css('cursor', 'pointer');
        $('#h2_rel16').css('cursor', 'pointer');
        $('#h2_rel17').css('cursor', 'pointer');
        $('#h2_rel18').css('cursor', 'pointer');
        $('#h2_rel19').css('cursor', 'pointer');
        $('#h2_rel12a').css('cursor', 'pointer');
        $('#h2_rel13a').css('cursor', 'pointer');
        $('#h2_rel14a').css('cursor', 'pointer');
        $('#h2_rel15a').css('cursor', 'pointer');
        $('#h2_rel16a').css('cursor', 'pointer');
        $('#h2_rel17a').css('cursor', 'pointer');
        $('#h2_rel18a').css('cursor', 'pointer');
        $('#h2_rel19a').css('cursor', 'pointer');

        
    });

    $('#show_cont_bangu').hide();
    $('#show_cont_bebedouro').hide();
    $('#show_cont_campos_goytacazes').hide();
    $('#show_cont_marechal_hermes').hide();
    $('#show_cont_niteroi').hide();
    $('#show_cont_realengo').hide();
    $('#show_cont_ricardo_albuquerque').hide();
    $('#show_cont_sao_goncalo_um').hide();
    $('#show_cont_sao_goncalo_dois').hide();
    $('#show_cont_carlos_chagas').hide();
    $('#show_cont_viamao').hide();
    $('#show_complexo_estadual').hide();
    $('#show_cont_bangu').hide();


    $('#hide_cont_bangu').click(function(){
        $('#show_cont_bangu').slideToggle();
    });

    $('#hide_cont_bebedouro').click(function(){
        $('#show_cont_bebedouro').slideToggle();
    });

    $('#hide_cont_campos_goytacazes').click(function(){
        $('#show_cont_campos_goytacazes').slideToggle();
    });

    $('#hide_cont_marechal_hermes').click(function(){
        $('#show_cont_marechal_hermes').slideToggle();
    });

    $('#hide_cont_niteroi').click(function(){
        $('#show_cont_niteroi').slideToggle();
    });

    $('#hide_cont_realengo').click(function(){
        $('#show_cont_realengo').slideToggle();
    });

    $('#hide_cont_ricardo_albuquerque').click(function(){
        $('#show_cont_ricardo_albuquerque').slideToggle();
    });
    
    $('#hide_cont_sao_goncalo_um').click(function(){
        $('#show_cont_sao_goncalo_um').slideToggle();
    });

    $('#hide_cont_sao_goncalo_dois').click(function(){
        $('#show_cont_sao_goncalo_dois').slideToggle();
    });

    $('#hide_cont_carlos_chagas').click(function(){
        $('#show_cont_carlos_chagas').slideToggle();
    });

    $('#hide_cont_viamao').click(function(){
        $('#show_cont_viamao').slideToggle();
    });

    $('#hide_cont_complexo_estadual').click(function(){
        $('#show_cont_complexo_estadual').slideToggle();
    });

    $(document).ready(function(){

        function esconderTituloRelatorio(){
            $('.titulo_relatorio').hide();
        }

        function esconderAlertsExecucao(){
            $('.alert12').hide();
            $('.alert13').hide();
            $('.alert14').hide();
            $('.alert15').hide();
            $('.alert16').hide();
            $('.alert17').hide();
            $('.alert18').hide();
            $('.alert19').hide();
        }

        function esconderAlertsAnual(){
            $('.alert12a').hide();
            $('.alert13a').hide();
            $('.alert14a').hide();
            $('.alert15a').hide();
            $('.alert16a').hide();
            $('.alert17a').hide();
            $('.alert18a').hide();
            $('.alert19a').hide();
        }

        function aparecerTodasTabelasEh5(){
            $('#h2_rel12a').show();
            $('#h2_rel13a').show();
            $('#h2_rel14a').show();
            $('#h2_rel15a').show();
            $('#h2_rel16a').show();
            $('#h2_rel17a').show();
            $('#h2_rel18a').show();
            $('#h2_rel19a').show();
            $('#h2_rel12').show();
            $('#h2_rel13').show();
            $('#h2_rel14').show();
            $('#h2_rel15').show();
            $('#h2_rel16').show();
            $('#h2_rel17').show();
            $('#h2_rel18').show();
            $('#h2_rel19').show();
            $('#tabela12').hide();
            $('#tabela12a').hide();
            $('#tabela13').hide();
            $('#tabela13a').hide();
            $('#tabela14').hide();
            $('#tabela14a').hide();
            $('#tabela15').hide();
            $('#tabela15a').hide();
            $('#tabela16').hide();
            $('#tabela16a').hide();
            $('#tabela17').hide();
            $('#tabela17a').hide();
            $('#tabela18').hide();
            $('#tabela18a').hide();
            $('#tabela19').hide();
            $('#tabela19a').hide();
        }

        function esconderTodasTabelasEh5(){
            $('#h2_rel12a').hide();
            $('#h2_rel13a').hide();
            $('#h2_rel14a').hide();
            $('#h2_rel15a').hide();
            $('#h2_rel16a').hide();
            $('#h2_rel17a').hide();
            $('#h2_rel18a').hide();
            $('#h2_rel19a').hide();
            $('#h2_rel12').hide();
            $('#h2_rel13').hide();
            $('#h2_rel14').hide();
            $('#h2_rel15').hide();
            $('#h2_rel16').hide();
            $('#h2_rel17').hide();
            $('#h2_rel18').hide();
            $('#h2_rel19').hide();
            $('#tabela12').hide();
            $('#tabela12a').hide();
            $('#tabela13').hide();
            $('#tabela13a').hide();
            $('#tabela14').hide();
            $('#tabela14a').hide();
            $('#tabela15').hide();
            $('#tabela15a').hide();
            $('#tabela16').hide();
            $('#tabela16a').hide();
            $('#tabela17').hide();
            $('#tabela17a').hide();
            $('#tabela18').hide();
            $('#tabela18a').hide();
            $('#tabela19').hide();
            $('#tabela19a').hide();
        }

        $("select option:selected").each(function(){
            var selected = $(this).text();

            if(selected == 2012){
                esconderTituloRelatorio();
                $('#h2_rel12a').show();
                $('#tabela12a').show();

                $('#h2_rel12').show();
                $('#tabela12').show();

                $('.alert12').show();
                $('.alert12a').show();
                
            }else if(selected == 2013){
                esconderTituloRelatorio();
                $('#h2_rel13a').show();
                $('#tabela13a').show();

                $('#h2_rel13').show();
                $('#tabela13').show();

                $('.alert13').show();
                $('.alert13a').show();

            }else if(selected == 2014){
                esconderTituloRelatorio();
                $('#h2_rel14a').show();
                $('#tabela14a').show();

                $('#h2_rel14').show();
                $('#tabela14').show();

                $('.alert14').show();
                $('.alert14a').show();

            }else if(selected == 2015){
                esconderTituloRelatorio();
                $('#h2_rel15a').show();
                $('#tabela15a').show();

                $('#h2_rel15').show();
                $('#tabela15').show();

                $('.alert15').show();
                $('.alert15a').show();

            }else if(selected == 2016){
                esconderTituloRelatorio();
                $('#h2_rel16a').show();
                $('#tabela16a').show();

                $('#h2_rel16').show();
                $('#tabela16').show();

                $('.alert16').show();
                $('.alert16a').show();

            }else if(selected == 2017){
                esconderTituloRelatorio();
                $('#h2_rel17a').show();
                $('#tabela17a').show();

                $('#h2_rel17').show();
                $('#tabela17').show();

                $('.alert17').show();
                $('.alert17a').show();

            }else if(selected == 2018){
                esconderTituloRelatorio();
                $('#h2_rel18a').show();
                $('#tabela18a').show();

                $('#h2_rel18').show();
                $('#tabela18').show();

                $('.alert18').show();
                $('.alert18a').show();

            }else if(selected == 2019){
                esconderTituloRelatorio();
                $('#h2_rel19a').show();
                $('#tabela19a').show();

                $('#h2_rel19').show();
                $('#tabela19').show();

                $('.alert19').show();
                $('.alert19a').show();

            }else{
                esconderTituloRelatorio();
                $('#h2_rel17a').hide();
                $('#tabela17a').hide();

                $('#h2_rel17').hide();
                $('#tabela17').hide();
            }
        });
        

        $('#select_ano').on('change', function(){
            var ano = $(this).val();
            
            if(ano == 0){
                esconderAlertsAnual();
                esconderAlertsExecucao();
                esconderTodasTabelasEh5();
                esconderTituloRelatorio();
            }else if(ano == 'Todos'){
                aparecerTodasTabelasEh5()
                esconderAlertsAnual();
                esconderAlertsExecucao();
            }else if(ano == 2012){
                esconderAlertsAnual();
                esconderAlertsExecucao();
                esconderTodasTabelasEh5();
                esconderTituloRelatorio();

                $('#h2_rel12a').show();
                $('#tabela12a').show();
                $('#h2_rel12').show();
                $('#tabela12').show();
                $('.alert12').show();
                $('.alert12a').show();

            }else if(ano == 2013){
                esconderAlertsAnual();
                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel13a').show();
                $('#tabela13a').show();
                $('#h2_rel13').show();
                $('#tabela13').show();
                $('.alert13').show();
                $('.alert13a').show();



            }else if(ano == 2014){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel14a').show();
                $('#tabela14a').show();
                $('#h2_rel14').show();
                $('#tabela14').show();
                $('.alert14').show();
                $('.alert14a').show();



            }else if(ano == 2015){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel15a').show();
                $('#tabela15a').show();
                $('#h2_rel15').show();
                $('#tabela15').show();
                $('.alert15').show();
                $('.alert15a').show();



            }else if(ano == 2016){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel16a').show();
                $('#tabela16a').show();
                $('#h2_rel16').show();
                $('#tabela16').show();
                $('.alert16').show();
                $('.alert16a').show();



            }else if(ano == 2017){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel17a').show();
                $('#tabela17a').show();
                $('#h2_rel17').show();
                $('#tabela17').show();
                $('.alert17').show();
                $('.alert17a').show();



            }else if(ano == 2018){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();

                $('#h2_rel18a').show();
                $('#tabela18a').show();
                $('#h2_rel18').show();
                $('#tabela18').show();
                $('.alert18').show();
                $('.alert18a').show();



            }else if(ano == 2019){
                esconderAlertsAnual();

                esconderAlertsExecucao();
                esconderTituloRelatorio();
                esconderTodasTabelasEh5();
                $('#h2_rel19a').show();
                $('#tabela19a').show();
                $('#h2_rel19').show();
                $('#tabela19').show();
                $('.alert19').show();
                $('.alert19a').show();


            }else{
                esconderAlertsAnual();
                esconderAlertsExecucao();

                $('#tabela17').show();
                $('#tabela17a').show();

                $('#tabela18').show();
                $('#tabela18a').show();

                $('#tabela19').show();
                $('#tabela19a').show();
            }
        });

        $('#opcao_pastas').change(function(){
            var value = $(this).val();
            console.log(value);

            alert("SELECIONOU");
        });
    });
});



