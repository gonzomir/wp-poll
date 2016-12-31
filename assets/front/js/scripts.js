jQuery(document).ready(function($) {
	
	

	$(document).on('click', '.single-poll .wpp_result', function() {
		
		__POLL_ID__ 	= $(this).attr( 'poll_id' );
		
		$('.single-poll-'+__POLL_ID__+' .wpp_result_list').fadeIn();
		
	})
	
	
	$(document).on('click', '.single-poll .wpp_submit', function() {
		
		__POLL_ID__ 	= $(this).attr( 'poll_id' );
		__WPP_STATUS__	= $(this).attr( 'wpp_status' );
		__HTML__ 		= $(this).html();
		__CHECKED__		= [];
		
		if( __WPP_STATUS__  == 'disabled' ) return;
		
		$('.submit_poll_option').each(function() {
			if( $(this).is(':checked') ) {
				__CHECKED__.push(this.value);
			}
		});
		
		if( __CHECKED__.length  < 1 ) return;
		
		$(this).html('<i class="fa fa-cog fa-spin"></i>');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:wpp_ajax.wpp_ajaxurl,
		data: {
			"action": "wpp_ajax_submit_poll", 
			"poll_id": __POLL_ID__, 
			"checked": __CHECKED__, 
		},
		success: function(data) {	
			response	= JSON.parse(data)
			_status		= response['status'];			
			_notice		= response['notice'];			
		
			
			if( _status == 0 ) {
				$('.single-poll-'+__POLL_ID__+' .wpp_notice').html( _notice ).addClass('wpp_error').fadeIn();
			}
			
			if( _status == 1 ) {
				$('.single-poll-'+__POLL_ID__+' .wpp_notice').html( _notice ).addClass('wpp_success').fadeIn();
			}
			
			$(this).html( __HTML__ );
		}
			});
	
	})

});	







