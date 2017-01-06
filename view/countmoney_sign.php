<?php
/**
 * Created by PhpStorm.
 * User: lan
 * Date: 2017/1/3
 * Time: 上午10:36
 */

$name = $_POST["name"];
$tel = $_POST["tel"];
$avatar = $_POST["avatar"];
// echo "ok";
$conn = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);

$conn->query("set names uft8");
$queryUser = "select * from countmoney where username='{$name}'";
$sign = "insert into countmoney(username, usertel, useravatar) VALUES ('{$name}','{$tel}','{$avatar}')";

// $queryUser = "select * from countmoney";

$res = $conn->query($queryUser);

// var_dump($res);

if(mysqli_affected_rows($conn) > 0){
//    $conn->query($updateScope);
//    echo "success add";
    echo "登录成功";
}else{
    $conn->query($sign);
    echo "注册成功并登录";
}
