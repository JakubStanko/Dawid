$(document).ready(function(){

    $('i[data-menu="true"]').on('click',function(){
        const navContainer = $('body').find('.custom-nav');

        if ( $(navContainer).is(":visible") ) {
            $(navContainer).addClass('d-none');
        } else {
            $(navContainer).removeClass('d-none');
        }
    });

});