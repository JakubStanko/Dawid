$(document).ready(function(){
    $('body').on('click','#hideImg',function(){
        $('#actImg').removeClass('active');
        $('#actImg').remove();
        $(this).remove();
        $('body').find('.dark-background').hide();
    });
});