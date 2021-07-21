$(window).on('load', function () {
	setTimeout(function(){
		$('.preloader-container').fadeOut();
	},500);
});

$(document).ready(function(){

    $('i[data-menu="true"]').on('click',function(){
        const navContainer = $('body').find('.custom-nav');

        if ( $(navContainer).is(":visible") ) {
            $(navContainer).addClass('d-none');
        } else {
            $(navContainer).removeClass('d-none');
        }
    });

    const upButton = $('.toTheTop');

    $(window).scroll(function(event){

        const lastScrollTop = 450;
        const scrollTop = $(this).scrollTop();
        const upButton = $('.toTheTop');
        const navBar = $('.head-container');
        const cutonMenu = $('.custom-nav');

        if (scrollTop > lastScrollTop) {
            // downscroll code
            upButton.stop(true, true).show();
            navBar.css({position: 'fixed', top: '0px'});
            cutonMenu.css({position: 'fixed', top: '60px'});
        } else {
            // upscroll code
            upButton.stop(true, true).hide();
            navBar.css({position: 'static', top: '0px'});
            cutonMenu.css({position: 'static', top: '0px'});
        }
    });

    $(upButton).on('click',function(){
        $("html, body").animate({scrollTop: 0}, 2000);
    });

});
