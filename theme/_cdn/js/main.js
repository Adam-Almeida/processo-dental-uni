/**
 * DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 **/

$(function(){
    $('.main_header_content_menu_mobile_obj').on('click', function(){
        $('.main_header_content_menu_mobile_sub').toggleClass('ds_none');
    });

    $('.nav a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('href'),
        targetOffset = $(id).offset().top;
          
        $('html, body').animate({ 
          scrollTop: targetOffset - 100
        }, 500);
      });

});

