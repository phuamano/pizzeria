/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$ = jQuery.noConflict();

$(document).ready(function(){
    //Obtener la URL de admin-ajax.php

    $('.borrar_registro').on('click', function(e){
        e.preventDefault();

        var id = $(this).attr('data-reservaciones');

        $.ajax({
            type: 'post',
            data:{
                'action': 'pizzeria_eliminar',
                'id': id,
                'tipo' : 'eliminar'
            },
            url : url_eliminar.ajaxurl,
            success: function(data){
                var resultado = JSON.parse(data);
                if(resultado.respuesta == 1){
                    jQuery("[data-reservaciones = '"+resultado.id+"']").parent().parent().remove();
                    alert("Se Elimino");
                }
            }
        });
    });
});
