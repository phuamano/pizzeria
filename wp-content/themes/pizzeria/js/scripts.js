$ = jQuery.noConflict();

$(document).ready(function(){
    
    //ocultar y mostrar menu
    $('.mobile-menu a').on('click' , function(){
        $('nav.menu-sitio').toggle('slow');
    });
    
    //reaccionar a reseize en la pantalla
    var breakpoint = 768;
    $(window).resize(function(){
        if($(document).width() >= breakpoint){
            $('nav.menu-sitio').show();
        }else{
            $('nav.menu-sitio').hide();
        }
            
    });
    
    //ajustar cajas segun tamañao de imagen
    ajustarCajas();
    
    //fluidbox
    jQuery('.gallery a').each(function(){
        jQuery(this).attr({'data-fluidbox' : ''});
    });
    
    if(jQuery('[data-fluidbox]').length > 0){
        jQuery('[data-fluidbox]').fluidbox();
    }
});

function ajustarCajas(){
    var imagenes = $('.imagen-caja');
    if(imagenes.length > 0){
        var altura = imagenes[0].height;
        var cajas = $('div.contenido-caja');
        $(cajas).each(function(i, elemento){
           $(elemento).css({'height' : altura +'px'}); 
        });
    }
    
}


