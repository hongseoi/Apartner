
<?php
$wantedcode=getenv("QUERY_STRING");
$con=mysqli_connect("localhost", "root", "000000", "aptinfo") or die("MySQL 접속 실패");
$sql = " SELECT * FROM full_data where aptcode='$wantedcode'";


$ret = mysqli_query($con, $sql);


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

 while($row = mysqli_fetch_array($ret)){
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
  array_push($school3distance, (double)$row['school3distance']*1000);



 }

 mysqli_close($con);
?>

<html>
  <head>
    <style>
      table.type09 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.0;
  
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
    background: #f3f6f7;
  }
  table.type09 td {
    width: 350px;
    padding: 10px;
    vertical-align: top;
    border-bottom: 1px solid #ccc;
  }
      nav {float: right;}
      section {float: left;}

      .f {
        text-align : center;
      }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawStuff);
      google.charts.setOnLoadCallback(drawChart);

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
            ['', '거리(m)'],
          ["버스정류장", busdistance[0]] ,
          ["병원",  hospitaldistance[0] ],
          ["대규모점포",marketdistance[0]],
          ['지하철역', subwaydistance[0]],
          ["유치원", kindergartendistance[0]],
          ['초등학교',schoo1distance[0]],
          ['중학교', school2distance[0]],
          ['고등학교', school3distance[0]]
        ]);

        var options = {
          
          width: 700,
          legend: { position: 'none' },
          
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              y: { side: 'top', label: '거리(단위:m)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_div'));
        chart.draw(data, options);
      }

//https://helperbyte.com/questions/372640/how-to-pass-array-of-data-to-build-a-graph-on-google-charts
  

      function drawChart(data) {
        var arr = <?php echo $arr ?>;
        var data = google.visualization.arrayToDataTable([
          ['Year', 'cost'], arr
        ]);

        var options = {
          
          title: '아파트 가격 현황',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('linechart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      
    
      </script>
  </head>

  <body>
    <nav>
  <div class="row">
  <strong><p class="f">아파트 주변 인프라</p></strong>
  <div class="col-md-12" style="margin-left:16%; padding-left:8px; padding-right:3px">
    <div id="barchart_div" style="width: 900px; height: 350px;"></div>
  </div>
</div>    
    </body>
    </html>