$(document).ready(function(){

    var phpSaveUrl = Routing.generate('yaml_save_image_route');

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

    $(document).on('change','#PictureJpgFile,#PicturePngFile',function(){
		$('.dark-background').show();
		//Catch last part from url
        var url = $(location).attr('href'),
        	parts = url.split("/"),
        	last_part = parts[parts.length-1];

		var property = $(this).prop('files')[0],
		    file_name = property.name,
		    file_extension = file_name.split('.').pop().toLowerCase(),
		    file_size = property.size,
		    file_id = last_part,
			file_type = $(this).data('file-type'),
			file_folder = '';

		if ( (file_type != 'jpg') && (file_type != 'png')) {
			console.log();
			alert_incorrect_adv('wrong button data.','wrongData');
			$('body').find('.dark-background').hide();

		} else if (jQuery.inArray(file_extension,[file_type]) == -1) {
			alert_incorrect_adv('wrong format. '+file_type+' only!','wrongData');
			$('body').find('.dark-background').hide();

		} else if (file_size > 10000000) {
			alert_incorrect_adv('Image size is to big. Max 10 mb.','wrongData');
			$('body').find('.dark-background').hide();

		} else {

			//Set folder path and picture part name
			if (file_type == 'jpg') {
				file_folder = 'pictures';
				file_type = 'pic';
			} else if (file_type == 'png') {
				file_folder = 'icons';
				file_type = 'ico';
			}

			//Set form data
			var form_data = new FormData();
				form_data.append('file', property);
				form_data.append('extension', file_extension);
				form_data.append('name', file_id);
				form_data.append('folder', file_folder);
				form_data.append('type', file_type);

			$.ajax({
				url: phpSaveUrl,
				method:"POST",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function(start){
					alert_correct_adv('Uploading image....','loadingImg');
				},
				success:function(success){
					alert_correct_adv('Uploading completed!','loadingImg');
					$('body').find('.dark-background').hide();
				},
				error:function(){
                    console.log('Something completly wrong!');
					$('body').find('.dark-background').hide();
				}
			});
		}
	});
});