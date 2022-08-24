<?php
  $con=mysqli_connect("localhost", "root", "1234", "distancedb") or die("MySQL 접속 실패");
  $sql = " SELECT * FROM aptinfo ";
  $ret = mysqli_query($con, $sql);
  if($ret){
    $count = mysqli_num_rows($ret);
  }
  else{
    echo "aptinfo데이터 검색 실패!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
    exit();
  }
  while($row=mysqli_fetch_array($ret)){
  }
mysqli_close($con);
?>
<html>
    

</html>