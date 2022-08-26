<!DOCTYPE html>
<html>
    <head>
    <style>


#container {
  display: flex;
}
#box-left {
  flex: 1;
}
#box-center {
  flex: 1;
  text-align: center;
}
#box-right {
  flex: 1;
  text-align: right;
}

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
  .btnstyle {
    display: block;
    width: 150px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    line-height: 25px;
}

</style>
<?php
  $wantedcode=getenv("QUERY_STRING");
  $con=mysqli_connect("localhost", "root", "000000", "aptinfo") or die("MySQL 접속 실패");
  $sql = " SELECT * FROM full_data where aptcode='$wantedcode'";

  $ret = mysqli_query($con, $sql);
  if($ret){
    $count = mysqli_num_rows($ret);
  }
  else{
    echo "aptinfo데이터 검색 실패!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
    exit();
  }
$aptname = array();
$aptloc = array();
$aptdong = array();
$aptnum= array();
$selltype = array();
$mngtype = array();
$halltype = array();
$heattype = array();
$numoftown = array();
$numofgen = array();
$constructer = array();
$dooer = array();
$area1  = array();
$area2= array();
$area85to135= array();
$areaover135= array();
$approvaltime= array();
$applytime= array();


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

  while($row=mysqli_fetch_array($ret)){
    array_push($aptname, $row['aptname']);
  array_push($aptloc, $row['aptloc']);
  array_push($aptdong, $row['aptdong']);
  array_push($aptnum, $row['aptnum']);
  array_push($selltype, $row['selltype']);
  array_push($halltype, $row['halltype']);
  array_push($heattype, $row['heattype']);
  array_push($numoftown, $row['numoftown']);
  array_push($numofgen, $row['numofgen']);
  array_push($constructer, $row['constructer']);
  array_push($dooer, $row['dooer']);
  array_push($area1, $row['under60']);
  array_push($area2, $row['bt60to85']);
  array_push($area85to135, $row['bt85to135']);
  array_push($areaover135 , $row['parking']);
  array_push($approvaltime, $row['approvaltime']);
  array_push($applytime, $row['applytime']);
  array_push($mngtype, $row['mngtype']);
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
    <div id='container'>
    <div id='box-left'>
    <table class="type09">
<thead>
<tr>
<th colspan="2" scope="cols"><h1><?php echo $aptname[0] ?></h1></th>
</tr>
</thead>
<tbody>
<tr>
  <th scope="row">주소</th>
  <td><?php echo $aptloc[0] ?></td>
</tr>
<tr>
  <th scope="row">동</th>
  <td><?php echo $aptdong[0] ?></td>
</tr>
<tr>
  <th scope="row">전화번호(02-)</th>
  <td><?php echo $aptnum[0] ?></td>
</tr>
<tr>
  <th scope="row">판매형태</th>
  <td><?php echo $selltype[0] ?></td>
</tr>
<tr>
  <th scope="row">관리형태</th>
  <td><?php echo $mngtype[0] ?></td>
</tr>
<tr>
  <th scope="row">복도형태</th>
  <td><?php echo $halltype[0] ?></td>
</tr>
<tr>
  <th scope="row">난방형태</th>
  <td><?php echo $heattype[0] ?></td>
</tr>
<tr>
  <th scope="row">단지수</th>
  <td><?php echo $numoftown[0] ?></td>
</tr>
<tr>
  <th scope="row">세대수</th>
  <td><?php echo $numofgen[0] ?></td>
</tr>
<tr>
  <th scope="row">건설사</th>
  <td><?php echo $constructer[0] ?></td>
</tr>
<tr>
  <th scope="row">시행사</th>
  <td><?php echo $dooer[0] ?></td>
</tr>
<tr>
  <th scope="row"> 18.2평(60㎡) 이하</th>
  <td><? echo $area1[0] ?> <a class="btnstyle" href="javascript:void(0);" onclick="window.open('monthgraph60.php?'+wantcode, '_blank','top=140, left=300, width=500, height=400, menubar=no, toolbar=no, location=no, directories=no, status=no,  scrollbars=no, copyhistory=no, resizable=no');">예측가격 보러가기</a></td>
</tr>
<tr>
  <th scope="row">18.2~25.7평(60~85㎡) 이하</th>
  <td><?php echo $area2[0] ?><a class="btnstyle" href="javascript:void(0);" onclick="window.open('monthgraph60to85.php?'+wantcode, '_blank','top=140, left=300, width=500, height=400, menubar=no, toolbar=no, location=no, directories=no, status=no,  scrollbars=no, copyhistory=no, resizable=no');">예측가격 보러가기</a></td>
</tr>
<tr>
  <th scope="row">25.7~40.8평(85~135㎡) 이하</th>
  <td><?php echo $area85to135[0] ?><a class="btnstyle" href="javascript:void(0);" onclick="window.open('monthgraph85to135.php?'+wantcode, '_blank','top=140, left=300, width=500, height=400, menubar=no, toolbar=no, location=no, directories=no, status=no,  scrollbars=no, copyhistory=no, resizable=no');">예측가격 보러가기</a></td>

</tr>
<tr>
  <th scope="row">40.8평(135㎡) 초과</th>
  <td><?php echo $areaover135[0] ?><a class="btnstyle" href="javascript:void(0);" onclick="window.open('monthgraph135.php?'+wantcode, '_blank','top=140, left=300, width=500, height=400, menubar=no, toolbar=no, location=no, directories=no, status=no,  scrollbars=no, copyhistory=no, resizable=no');">예측가격 보러가기</a></td>
</tr>
<tr>
  <th scope="row">단지승인일</th>
  <td><?php echo $approvaltime[0] ?></td>
</tr>
<tr>
  <th scope="row">단지신청일</th>
  <td><?php echo $applytime[0] ?></td>
</tr>
</tbody>
</table>
    </div>
    <div id='box-center'>
<div style="height:50%;">
<!--그래프1-->

<div class="row">
  <div class="col-md-12" style="padding-left:3px; padding-right:3px">
    <div id="barchart_div" style="width: 100%; height: 420px;"></div>
  </div>
</div> 

</div>
<div style="height:50%;">
<!--그래프2-->
<div class="row">
  <div class="col-md-4" style="margin-left:10px; padding-left:3px; padding-right:3px">
    <div id="linechart_div" style="width: 875px; height: 500px;"></div>
  </div>    
</div>

</div>
    
    </div>
    <div id='box-right'>
        
    </div>
</div>
        
    </body>
<script>
  var wantcode = "<?php echo $wantedcode ?>";
</script>
</html>