$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
    // Tek tıklama yapıldıktan sonra butonu disable eder.
    jQuery('form').submit(function(){ 
        $(this).find(':submit').attr( 'disabled','disagbled' ).html("<i class='fa fa-spinner'></i> Kaydediliyor");
    });
})