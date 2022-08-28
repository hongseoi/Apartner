<?php
$con=mysqli_connect("localhost", "root", "000000", "aptinfo") or die("MySQL 접속 실패");
$wantedcode=getenv("QUERY_STRING");
$sql = "SELECT distinct prices FROM aptinfo.predict_data WHERE apart_code= '$wantedcode' and 60<=area_m3<85 order by yyyymm desc limit 5;";
$ret = mysqli_query($con, $sql);

$arr = array();

while($row = mysqli_fetch_array($ret)){
  array_push($arr, (int)$row['prices']);
}

mysqli_close($con);

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>

var arr = <?php echo json_encode($arr) ?>;
if (arr.length==0){window.alert("정보 없음");}

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "아파트 매매가 예측"
	},
	axisX:{
		valueFormatString: "YY DD"
	},
	axisY: {
		title: "가격(단위:만원)",
		scaleBreaks: {
			autoCalculate: true
		}
	},
	data: [{
		type: "line",
		xValueFormatString: "DD MMM",
		color: "#F08080",
		dataPoints: [
			{ x: new Date(2022, 0, 8), y: arr[5] },
			{ x: new Date(2022, 0, 9), y: arr[4] },
			{ x: new Date(2022, 0, 10), y: arr[3] },
			{ x: new Date(2022, 0, 11), y: arr[2] },
			{ x: new Date(2022, 0, 12), y: arr[1] }

		]
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>