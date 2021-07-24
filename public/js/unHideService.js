$(document).ready(function(){
    const unHidePath = Routing.generate('yaml_unhide_service_route');

	function alert_correct_adv(message,class_id) {
		var allert = '<div class="alert-con result-correct '+class_id+' alert-success container-shadow">'+
		'<div class="alert-header">'+
			'<i class="alert-icons confirm-ico"></i>'+
		'</div>'+
		'<div class="alert-body">'+
			'<div class="alert-title">'+
				'Informations:'+
			'</div>'+
			'<div class="alert-message">'+
				''+message+''+
			'</div>'+
		'</div>'+
	  '</div>';

		$(allert).appendTo('body');
		$('body').find('.'+class_id).show();
		setTimeout(
			function() {
				$('body').find('.'+class_id).fadeOut();
				setTimeout(
					function() {
						$('body').find('.'+class_id).remove();
					},
				1500);
			},
		5000);
	}

	function alert_incorrect_adv(message,class_id) {
		var allert = '<div class="alert-con result-wrong alert-notsuccess '+class_id+' container-shadow">'+
		'<div class="alert-header">'+
			'<i class="alert-icons reject-ico"></i>'+
		'</div>'+
		'<div class="alert-body">'+
			'<div class="alert-title">'+
				'Informations:'+
			'</div>'+
			'<div class="alert-message">'+
				''+message+''+
			'</div>'+
		'</div>'+
	  '</div>';

		$(allert).appendTo('body');
		$('body').find('.'+class_id).show();
		setTimeout(
			function() {
				$('body').find('.'+class_id).fadeOut();
				setTimeout(
					function() {
						$('body').find('.'+class_id).remove();
					},
				1500);
			},
		5000);
	}

    $('.services-container').on('click','.service-position > .service-options-container > .service-option-row > #unhide-service-button',function(){
        const serviceId = $(this).data('service-id');
        const Button = $(this);

		$('.dark-background').show();

        $.ajax({
            method: "POST",
            url: unHidePath,
            data: {
                id: serviceId
            },
            dataType: "text",
            success: function(success){
                alert_correct_adv('Service position unhided successfully.','unhide-msg');
                Button.attr({
                    id: 'hide-service-button',
                    style: 'background-color: #3299CC;'
                });
                Button.next().html('Hide service').attr('id','option-hide');
				$('.dark-background').hide();
            },
            error: function(){
                alert_incorrect_adv('Service position unhided unsuccessfully.','unhide-msg');
				$('.dark-background').hide();
            }
        });
    });
});