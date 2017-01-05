<?php
/**
 * Created by PhpStorm.
 * User: lan
 * Date: 2017/1/3
 * Time: 上午10:00
 */

$name = $_POST["name"];
$scope = $_POST["scope"];
// echo "ok";
// $conn = @mysqli_connect("SAE_MYSQL_HOST_M", "SAE_MYSQL_USER", "SAE_MYSQL_PASS", "SAE_MYSQL_DB", "SAE_MYSQL_PORT");

$conn->query("set names uft8");
$queryUser = "select * from countmoney where username='{$name}'";
$addScpoe = "insert into countmoney(username, userscope) VALUES ('{$name}','{$scope}')";
$updateScope = "update countmoney set userscope = '{$scope}' where username='{$name}'";

$res = $conn->query($queryUser);

if(mysqli_affected_rows($conn) > 0){
   $conn->query($updateScope);
   echo "success update";
}else{
   $conn->query($addScpoe);
   echo "success insert";
}
