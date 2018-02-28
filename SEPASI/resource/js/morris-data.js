$(document).ready(function(){
	$.ajax({
		url:'get_chart',
		data:{},
		success:function(dataCharts){
			Morris.Bar({
				element: 'morris-bar-chart',
				data: dataCharts,
				xkey: 'y',
				ykeys: ['a'],
				labels: ['Series A'],
				hideHover: 'auto',
				resize: true
			});
		}
	})
});