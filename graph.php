<?php

$wantedcode=getenv("QUERY_STRING");

$con=mysqli_connect("localhost", "root", "000000", "aptinfo") or die("MySQL 접속 실패");
$sql1 = " SELECT * from nearinfo WHERE aptcode='$wantedcode'";
$sql2 = " SELECT * from aptinfo WHERE aptcode='$wantedcode'";

$ret1 = mysqli_query($con, $sql1);
$ret2 = mysqli_query($con, $sql2);

$aptname = array();
$marketname = array();
$marketdistance = array();
$busname = array();
$busdistance = array();
$subwayname = array();
$subwaydistance = array();
$kindergartenname = array();
$kindergartendistance = array();
$hospitalname = array();
$hospitaldistance = array();
$school1name = array();
$schoo1distance = array();
$school2name  = array();
$school2distance = array();
$school3name = array();
$school3distance = array();
$address = array();
$dong = array();
$phonenum = array();
$selltype = array();
$mngtype = array();
$halltype = array();
$heattype = array();
$numofbuildings = array();
$generation = array();
$builder = array();
$contributer = array();
$under60 = array();
$bt60to85 = array();
$bt85to135 = array();
$over135 = array();
$parking = array();
$aprovaldate = array();


 while($row = mysqli_fetch_array($ret1)){
  array_push($aptname, $row['aptname']);
  array_push($marketname, $row['marketname']);
  array_push($marketdistance, (double)$row['marketdistance']*1000);
  array_push($busname, $row['busname']);
  array_push($busdistance, (double)$row['busdistance']*1000);
  array_push($subwayname, $row['subwayname']);
  array_push($subwaydistance, (double)$row['subwaydistance']*1000);
  array_push($kindergartenname, $row['kindergartenname']);
  array_push($kindergartendistance, (double)$row['kindergartendistance']*1000);
  array_push($hospitalname, $row['hospitalname']);
  array_push($hospitaldistance, (double)$row['hospitaldistance']*1000);
  array_push($school1name, $row['school1name']);
  array_push($schoo1distance, (double)$row['schoo1distance']*1000);
  array_push($school2name, $row['school2name']);
  array_push($school2distance, (double)$row['school2distance']*1000);
  array_push($school3name , $row['school3name']);
  array_push($school3distance, (double)$row['school3distance']*100);
  array_push($dong, $row['dong']);
  array_push($phonenum, $row['phonenum']);
  array_push($selltype, $row['selltype']);
  array_push($mngtype, $row['mngtype']);
  array_push($halltype, $row['halltype']);
  array_push($heattype, $row['heattype']);
  array_push($numofbuildings, $row['numofbuildings']);
  array_push($generation, $generation);

 }
 mysqli_close($con);
?>

<html>
  <head>

  <style>
        table.type09 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
  }
  table.type09 thead th {
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    color: #369;
    border-bottom: 3px solid #036;
  }
  table.type09 tbody th {
    width: 150px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border-bottom: 1px solid #ccc;
    background: #F3F6F7;
  }
  table.type09 td {
    width: 350px;
    padding: 10px;
    vertical-align: top;
    border-bottom: 1px solid #ccc;
  }
    </style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
       google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawStuff);
       google.charts.setOnLoadCallback(drawChart);
    var aptname = <?php echo json_encode($aptname)  ?>;
     var busdistance = <?php echo json_encode($busdistance)  ?>;
     var hospitaldistance = <?php echo json_encode($hospitaldistance)  ?>;
     var kindergartendistance = <?php echo json_encode($kindergartendistance)  ?>;
     var marketdistance = <?php echo json_encode($marketdistance)  ?>;
    var subwaydistance = <?php echo json_encode($subwaydistance)  ?>;
    var schoo1distance = <?php echo json_encode($schoo1distance)  ?>;
    var school2distance = <?php echo json_encode($school2distance)  ?>;
    var school3distance = <?php echo json_encode($school3distance)  ?>;
    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['O', '거리(m)'],
          ["버스정류장", busdistance[0]] ,
          ["병원",  hospitaldistance[0] ],
          ["대규모점포(대형마트,백화점,쇼핑몰 등)",marketdistance[0]],
          ['지하철역', subwaydistance[0]],
          ["유치원", kindergartendistance[0]],
          ['초등학교',schoo1distance[0]],
          ['중학교', school2distance[0]],
          ['고등학교', school3distance[0]]
        ]);
        var options = {
          title: '아파트와의 최단거리',
          width: 900,
          legend: { position: 'none' },
          chart: { title: '아파트 주변 인프라',
                   subtitle: '내가 원하는 집과 최단거리에 있는 시설들!!' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: '거리(단위:m)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_div'));
        chart.draw(data, options);
      }
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'cost'],
          ['2012',  500],
          ['2013',  1000],
          ['2014',  1170],
          ['2015',  660],
          ['2016',  1030],
          ['2017',  1035],
          ['2018',  1034],
          ['2019',  1032],
          ['2020',  1030],
          ['2021',  1040],
          ['2022',  2000]
        ]);
        var options = {
          title: '아파트 가격 예측',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };
        var chart = new google.visualization.AreaChart(document.getElementById('linechart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      </script>
  </head>
  <body>

  <?php

  while($row = mysqli_fetch_array($ret2)){
    echo '<table class="type09">'.'<thead>'.'<tr>'.'<th colspan="2" scope="cols">'.'<h1>'.$row['aptname'].'</h1>'.'</th>'.'</tr>'.'</thead>'.'<tbody>';

  }


  ?>

  <div class="row">
  <div class="col-md-12" style="padding-left:3px; padding-right:3px">
    <div id="barchart_div" style="width: 100%; height: 420px;"></div>
  </div>
</div>
<div class="row">
  <div class="col-md-4" style="margin-left:10px; padding-left:3px; padding-right:3px">
    <div id="linechart_div" style="width: 900px; height: 500px;"></div>
  </div>
</div>
  </body>
</html>