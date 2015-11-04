/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

jQuery(document).ready(function($)
	{
		$(document).on('click', '.wp_poll_archive_button', function()
		{
			var wp_poll_page 	= $(this).attr('wp_poll_page');
			if ( wp_poll_page )
			{
				$(location).attr('href', wp_poll_page)
			}
			else 
			{
				$(".wp_poll_archive_message").fadeIn();
				setTimeout(function()
				{
					$(".wp_poll_archive_message").fadeOut();
				}, 5000);
			}
		})
		
		
		$(document).on('click', '.wp_poll_button_results', function()
		{
			setTimeout(function()
			{
				$(".wp_poll_total_submit").fadeIn();
				$("span.wp_poll_option_result").fadeIn();
			}, 1000);
		})
		
		$(document).on('click', '.wp_poll_button_submit', function()
		{
			var wp_poll_post_id 	= $(this).attr('wp_poll_post_id');	 
			var wp_poll_option_selected = $('[name=wp_poll_option]:checked').val();
			
			if ( wp_poll_option_selected != undefined && wp_poll_post_id != '' )				
			{
				$(this).html('<i class="fa fa-refresh fa-spin"></i>');
				
				$.ajax(
				{
					type: 'POST',
					context: this,
					url:wp_poll_ajax.wp_poll_ajaxurl,
					data: {
						"action": "wp_poll_ajax_onclick_submit", 
						"wp_poll_post_id":wp_poll_post_id,	
						"wp_poll_option_selected":wp_poll_option_selected,	
					},
					success: function(data) {
						var html = JSON.parse(data)

						var success 		= html['success'];
						var error 			= html['error'];
						
						if ( success )
							$(this ).html(success);
						if ( error )
						{
							$(this ).html(error);
							setTimeout(function()
							{
								location.reload();
							}, 1000);
						}	
					}
				});
			}
		})
	});