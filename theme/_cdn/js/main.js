/**
 * DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO TROC
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

    $('#copy-ticket-transfer-area').click(function(){
      var valueOld = document.getElementById('value-real-ticket').innerHTML;
      valueOld.select();
    try {
         var ok = document.execCommand('copy');
            if (ok) { alert('Texto copiado para a área de transferência'); }
        } catch (e) {
        alert(e)
    }
});

});
