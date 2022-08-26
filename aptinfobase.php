<!DOCTYPE html>
<html>
    <head>
    <style>
#container {
  display: flex;
}
#box-left {
  background: red;
  flex: 1;
}
#box-center {
  background: orange;
  flex: 1;
  text-align: center;
}
#box-right {
  background: yellow;
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

    </head>

    <body>
    <div id='container'>
    <div id='box-left'>
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
  }
  mysqli_close($con);

?>

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
<div style="background-color:#036; height:50%;">
<!--그래프1-->

</div>
<div style="background-color:#036; height:50%;">
<!--그래프2-->

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