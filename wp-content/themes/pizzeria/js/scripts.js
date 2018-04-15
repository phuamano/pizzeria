
var map;
function initMap() {
  var latlng={
    lat: -12.0382903,
    lng: -77.0654176
  };

  map = new google.maps.Map(document.getElementById('mapa'), {
    center: latlng,
    zoom: 16
  });

  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: 'La Pizzeria'
  });
}

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

    //ajustar mapa
    var mapa = $('#mapa');
    if(mapa.length > 0){
      if($(document).width() >= breakpoint){
        ajustarMapa(0);
      }else {
        ajustarMapa(300);
      }
    }

    $(window).resize(function(){
      if($(document.width() >= breakpoint)){
          ajustarMapa(0);
        }else {
          ajustarMapa(300);
        }
    });


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

function ajustarMapa(altura){
  if(altura == 0){
    var ubicacionSection = $('.ubicacion-reservacion');
    var ubicacionAltura = ubicacionSection.height();
    $('#mapa').css({'height': ubicacionAltura});
  }else {
      $('#mapa').css({'height': altura});
  }

}
