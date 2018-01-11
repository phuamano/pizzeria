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
});


