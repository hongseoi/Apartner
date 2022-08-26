<?php
$con=mysqli_connect("localhost", "root", "000000", "aptinfo") or die("MySQL 접속 실패");
$wantedcode=getenv("QUERY_STRING");
$sql = " SELECT * from predict_data WHERE apart_code='$wantedcode' ORDER BY YYYYMM";
$ret = mysqli_query($con, $sql);

$arr = array();

while($row = mysqli_fetch_array($ret)){
  array_push($arr,["x"=>(int)$row['YYYYMM'], 'y'=>(double)$row['prices']]);
}

/*
array("x" => 1483381800000 , "y" => 650),
array("x" => 1483468200000 , "y" => 700),
array("x" => 1483554600000 , "y" => 710),
array("x" => 1483641000000 , "y" => 658),
array("x" => 1483727400000 , "y" => 734),
array("x" => 1483813800000 , "y" => 963),
array("x" => 1483900200000 , "y" => 847),
array("x" => 1483986600000 , "y" => 853),
array("x" => 1484073000000 , "y" => 869),
array("x" => 1484159400000 , "y" => 943),
array("x" => 1484245800000 , "y" => 970),
array("x" => 1484332200000 , "y" => 869),
array("x" => 1484418600000 , "y" => 890),
array("x" => 1484505000000 , "y" => 930)

*/
//echo var_dump($arr);
$length = count($arr);
$dataPoints = $arr;
mysqli_close($con);

?>
<html>
  <head>
  <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "아파트 매매가 예측"
	},
/*
	axisX: {
		valueFormatString: "YYYYMM"},
*/
		axisY: {
		title: "매매가 단위(만원)",
		includeZero: false,
		maximum: 100000
	},
	data: [{
		type: "splineArea",
		color: "#6599FF",

		yValueFormatString: "### 만원",
		dataPoints: <?php echo json_encode($dataPoints); ?>
	}]
});
 
chart.render();
 
}
</script>
<title>아파트너: 아파트 매매가 예측</title>
  </head>
    <body>
      <h1><??></h1>
      <!-- 60 이하 가격예측-->
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <!-- 60~85 -->
      <div>

      </div>
      <!--85~135-->
      <div>

      </div>
      <!--over 135-->

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>