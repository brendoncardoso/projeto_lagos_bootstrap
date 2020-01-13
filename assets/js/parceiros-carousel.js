$(document).ready(function(){

    // força troca de slide a cada x segundos
    setInterval(function(){
        var total = parseInt( $('.parceiros .cursor a').length );
        var atual = parseInt( $('.parceiros .cursor a.active').attr('item') );
        var proximo = ( (atual + 1) > total ) ? 1 : (atual + 1);
        $('.parceiros .cursor a.item-'+proximo).trigger('click');
    }, 6000);

    $('.parceiros .cursor a').click(function(){

        var link = $(this);

        if( !link.hasClass('active') ){

            // fade out active
            var active = $('.parceiros .itens .active');
            setTimeout(transitionOutRow.bind(null, active), 1 );

            // fade in selecionado
            var selected = $('.parceiros .itens .item-'+$(this).attr('item'));
            selected.attr('item', $(this).attr('item'));
            setTimeout(transitionInRow.bind(null, selected), 1200 );

        }

    });

});

function transitionOutRow( row ){
    row.find('.animated').each(function( index ){
        var element = $(this);
        setTimeout(transitionOut.bind(null, element), ( (index + 1) * 100 ) );
    });
    setTimeout(transitionOutFinish, 1000 );
}

function transitionOut( element ){
    element.addClass('fadeOutLeft');
    setTimeout(transitionOutRemove.bind(null, element), 1000 );
}

function transitionOutRemove( element ){
    element.removeClass('fadeOutLeft');
    element.addClass('hide-o');
}

function transitionOutFinish( ){
    $('.parceiros .itens .active').removeClass('active');
    $('.parceiros .cursor .active').removeClass('active');
}

function transitionInRow( row ){
    $('.parceiros .itens .item-'+row.attr('item')).addClass('active');
    $('.parceiros .cursor .item-'+row.attr('item')).addClass('active');
    row.find('.animated').each(function( index ){
        var element = $(this);
        setTimeout(transitionIn.bind(null, element), ( (index + 1) * 100 ) );
    });
}

function transitionIn( element ){
    element.removeClass('hide-o');
    element.addClass('fadeInRight');
    setTimeout(transitionInRemove.bind(null, element), 1000 );
}

function transitionInRemove( element ){
    element.removeClass('fadeInRight');
}