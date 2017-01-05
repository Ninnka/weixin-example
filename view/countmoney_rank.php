<?php

$conn = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);

$conn->query("set names uft8");
$queryUser = "select * from countmoney order by userscope desc";

$res = $conn->query($queryUser);
$arr = [];
// $json = [];
if(mysqli_affected_rows($conn) > 0){
  for($i = 0; $i < 5; $i++){
    $arr[] = mysqli_fetch_assoc($res);
  }
  echo json_encode(array("data"=>$arr));
  // var_dump($arr);
}else {
  echo "fail";
}

 ?>
