$(document).ready(function(){
    $('.responsivo .menu-open').click(function(){
        $('.cabecalho-menu').toggleClass('oculto');
    });

    $('.nav-toggle').change( function(){
        var slug = $(this).val();
        $('#'+slug+'-tab').trigger('click');
    } );
});