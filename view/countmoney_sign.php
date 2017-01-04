<?php
/**
 * Created by PhpStorm.
 * User: lan
 * Date: 2017/1/3
 * Time: 上午10:36
 */
$name = $_POST["name"];
$tel = $_POST["tel"];
// echo "ok";
$conn = @mysqli_connect("localhost", "root", "root", "countmoney", "8889");

$conn->query("set names uft8");
$queryUser = "select * from countmoney where username='{$name}'";
$sign = "insert into countmoney(username, usertel) VALUES ('{$name}','{$tel}')";

$res = $conn->query($queryUser);

if(mysqli_affected_rows($conn) > 0){
//    $conn->query($updateScope);
//    echo "success add";
    echo "登录成功";
}else{
    $conn->query($sign);
    echo "注册成功并登录";
}