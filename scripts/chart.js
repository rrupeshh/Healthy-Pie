/*var myData = new Array([10, 18.9], [15, 18.4]);
var lowerData = new Array([10,18.6], [15, 18.6]);
var upperData = new Array([10,24.5], [15, 24.5]);

var myChart = new JSChart('chartcontainer', 'line');

myChart.setDataArray(myData, 'first line');
myChart.setDataArray(lowerData);
myChart.setDataArray(upperData);

myChart.setBackgroundColor('#f1f1f1');
myChart.setAxisNameX('Time');
myChart.setAxisNameY('BMI');
myChart.setLineColor('#f00', 'first line')
myChart.setSize(1150, 400);
myChart.setTitle('MY BMI CHART');
myChart.setTitleColor('#16C');
myChart.setTitleFontSize(10);
myChart.draw();*/

function doSomething(item_val) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET','chart.php?reg_id='+item_val,true);

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			var data = this.responseText;
			var json = JSON.parse(data);

			if(json.msg == 'false') {
				document.getElementById("chartcontainer").innerHTML = "No Data To Plot! Please Add!";
			} else {
				var point1 = Number(json[4]);
				var point2 = Number(json[3]);
				var point3 = Number(json[2]);
				var point4 = Number(json[1]);
				var point5 = Number(json[0]);

				
				var myData = new Array([10, point1], [15, point2], [20, point3], [25, point4], [30, point5]);
				var lowerData = new Array([10, 18.6], [15, 18.6], [20, 18.6], [25, 18.6], [30, 18.6]);
				var upperData = new Array([10, 24.5], [15, 24.5], [20, 24.5], [25, 24.5], [30, 24.5]);

				var myChart = new JSChart('chartcontainer', 'line');

				myChart.setDataArray(myData, 'first line');
				myChart.setDataArray(lowerData);
				myChart.setDataArray(upperData);

				myChart.setBackgroundColor('#f1f1f1');
				myChart.setAxisNameX('Time');
				myChart.setAxisNameY('BMI');
				myChart.setLineColor('#f00', 'first line')
				myChart.setSize(1150, 400);
				myChart.setTitle('MY BMI CHART');
				myChart.setTitleColor('#16C');
				myChart.setTitleFontSize(10);
				myChart.draw();
			}
		}
	}

	xhr.send(null);
}