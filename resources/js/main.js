import 'bootstrap';
import $ from 'jquery';

var isRunning = false;

$('#init-sse').on('submit', function(e) {
	e.preventDefault();


	// $(this).hide();

	
	$.ajax( 'handle_post.php', {
		method: 'POST',
		data: {
			a: $('#a').val(),
			sin: $('#sin').is(':checked'),
			cos: $('#cos').is(':checked'),
			cossin: $('#cossin').is(':checked'),

		},
		success: function(data) {
			if( !isRunning ) {
				const evtSource = new EventSource("sse.php");
				evtSource.onmessage = function(event) {
					$('#data').html( event.data )
					console.log(JSON.parse(event.data))
				}
				isRunning = true;
			}

		}
	})

})