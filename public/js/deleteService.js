$(document).ready(function(){
    const deletePath = Routing.generate('yaml_delete_service_route');

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

    $('.services-container').on('click','.service-position > .service-options-container > .service-option-row > #delete-service-button',function(){
		const serviceId = $(this).data('service-id');
		let confirmationButton =  $('.confirm-container').find('#confirm-button');
		confirmationButton.attr('data-service-id',serviceId);
		confirmationButton.data('service-id',serviceId);
		$('.confirm-container').addClass('active');
		$('.dark-background').show();
	});

	$('.confirm-container').on('click','#reject-button',function(){
		$('.confirm-container').removeClass('active');
		$('.dark-background').hide();
	});

    $('.confirm-container').on('click','#confirm-button',function(){
        const serviceId = $(this).data('service-id');
        const Button = $(this);
		const deletingButton = $('.services-container')
							.find('.service-position')
							.find('.service-options-container')
							.find('.service-option-row')
							.find('span[id="delete-service-button"][data-service-id="'+serviceId+'"]');
		const deletingRow = deletingButton.closest('.service-position');
		console.log(serviceId);
        $.ajax({
            method: "POST",
            url: deletePath,
            data: {
                id: serviceId
            },
            dataType: "text",
            success: function(){
				deletingRow.fadeOut();
                alert_correct_adv('Service position deleted successfully.','delete-msg');
				$('.confirm-container').removeClass('active');
				$('.dark-background').hide();
				setTimeout(
					function() {
						deletingRow.remove();
					},
				0);
            },
            error: function(e1,e2,e3){
                alert_incorrect_adv('Service position deleted unsuccessfully.','delete-msg');
				$('.confirm-container').removeClass('active');
				$('.dark-background').hide();

				console.log(e1);
				console.log(e2);
				console.log(e3);
            }
        });
    });
});