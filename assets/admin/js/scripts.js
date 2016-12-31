jQuery(document).ready(function($) {
	
	$("#poll_deadline").datepicker({ minDate: new Date, dateFormat: 'dd-mm-yy' });
	$(function() { $( ".poll_option_container" ).sortable({ handle: ".poll_option_single_sorter" }); });
	
	$(document).on('change', '#wpp_report_form select', function() {
		
		// $('#wpp_report_form')
		
		$(this).closest('form').trigger('submit');
	})
	
	
	$(document).on('click', '.poll_meta_box .poll_option_remove', function() {
		
		__STATUS__ = $(this).attr('status');
		
		if( __STATUS__ == 0 ) {
			
			$(this).attr('status',1);
			$(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
		} else {
			
			$(this).parent().remove();
		}
		
		
		
	})
	
	$(document).on('click', '.poll_meta_box .add_new_option', function() {
		
		__TIME__ = $.now();
		
		__NEW_OPTION__ = 
		'<li class="poll_option_single">'+
			'<span>Option Value</span>'+
			'<input type="text" name="poll_meta_options['+__TIME__+']" value=""/>'+
			'<div class="poll_option_remove" status=0><i class="fa fa-times" aria-hidden="true"></i></div>'+
			'<div class="poll_option_single_sorter"><i class="fa fa-sort" aria-hidden="true"></i></div>'+
		'</li>';
		
		$('.poll_option_container').append( __NEW_OPTION__ );
	})
	
		// var chart_booking = new CanvasJS.Chart("vb_stat_by_booking", {
			
				// theme: "theme2",//theme1
				// zoomEnabled: true,
				// title:{
					// text: stat_title             
				// },
				// animationEnabled: true,   // change to true
				// axisX:{    
					// valueFormatString:  "#,#",
				// },
				// data: [              {
					// type: "bar",
					// dataPoints: arr_data
				// }]
			// });
			// chart_booking.render();
			
			
			

});	







