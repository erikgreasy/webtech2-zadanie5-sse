import 'bootstrap';
import $ from 'jquery';
import Chart from 'chart.js/auto';

var isRunning = false;

var labels = [];
var dataSin = [];
var dataCos = [];
var dataCosSin = [];

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: labels,
		datasets: [{
			data: dataSin,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		},
		{
			data: dataCos,
			borderColor: 'rgb(75, 55, 32)',
			tension: 0.1
		},
		{
			data: dataCosSin,
			borderColor: 'rgb(22, 55, 32)',
			tension: 0.1
		}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		}
	}
});

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
					var data = JSON.parse(event.data);
					labels.push( data.x );
					dataSin.push( data.sin )
					dataCos.push( data.cos )
					dataCosSin.push( data.cossin )


					myChart.update();
					console.log(JSON.parse(event.data))
				}
				isRunning = true;
			}

		}
	})

})