jQuery(document).ready(function($)
	{
		$('#wp_poll_for_date').datepicker({
            dateFormat : 'yy-mm-dd'
        });
		
		$(document).on('click', '#wp_poll_reset_settings', function()
		{
			$(this).html('Resetting ... ');
			$.ajax(
				{
					type: 'POST',
					context: this,
					url:wp_poll_ajax.wp_poll_ajaxurl,
					data: {
						"action": "wp_poll_ajax_reset_settings", 
					},
					success: function(data) {
						alert(data);
						
						if ( data == '1' ) {
							$(this ).html("Reset OK");
							setTimeout(function()
							{
								location.reload();
							}, 1000);
						}
						else $(this ).html("Reset Error! Try Again");
							
							
					}
				});
		})
		
		$('#wp_poll_select_poll').on('change', function () {
			var wp_poll_id_selected = $(this).val();
			if (wp_poll_id_selected) { 
				window.location = $(location).attr('href')+'&wp_poll='+wp_poll_id_selected;
			}
			return false;
		});
		
		/*$(document).on('click', '.wp_poll_linked', function()
		{
			var pre_option = $(this).html();
			$(this).html('no');
		})
		*/
		
		
	});