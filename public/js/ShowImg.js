$(document).ready(function(){
    $('label').on('click','#show-image-button',function(){
        const url = $(location).attr('href'),
        	parts = url.split("/"),
        	lastPart = parts[parts.length-1];

        const fileType = $(this).data('file-type');
        let closeButton = '<button class="main-button" id="hideImg" style="position: fixed; z-index: 100; top: 20px; right: 20px">Close</button>';
        var Image = '',
            imageGroup = '';

        //Set new image
        if (fileType == 'png') {
            imageGroup = 'icon';
            Image = '<div class="icon-container" id="actImg">'+
                        '<i class="'+lastPart+'-'+imageGroup+'"></i>'+
                    '</div>';
        } else if (fileType == 'jpg') {
            imageGroup = 'pic';
            Image = '<i class="'+lastPart+'-'+imageGroup+' pc-pic" id="actImg"></i>';
        }

        $(Image).appendTo('body');
        $(closeButton).appendTo('body');
        $('#actImg').addClass('active');
        $('.dark-background').show();
    });
});