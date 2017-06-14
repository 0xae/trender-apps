function LoadBarchart(id, title, keys, values, measure, label){
	$(id).highcharts({
		chart: {type: 'column'},
		title: {text: title},
		xAxis: {categories: keys},
		yAxis: {min: 0, title: {text: ''}},
        legend:false,
		plotOptions: {column: {pointPadding: 0.1,borderWidth: 0}},
        credits: {
            enabled: false
        },

		series: [{
		    color: '#528DCC',
		    data: values
		}]
	});
}


function LoadCircular(id, title, data){
    $(id).highcharts({
        chart: {plotBackgroundColor: null,plotBorderWidth: 1,plotShadow: false},
        title: {text: title},
        tooltip: {pointFormat: '{series.name}: <b>{point.y}</b>'},
        plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}',
        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}}}},
        series: [{
            type: 'pie',
            name: title,
            data: data,
        }]
    });
}
