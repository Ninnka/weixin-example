<?php
$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

// 获取access_token地址
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$filepathsae = "saemc://access_token.txt";

// $filepath = "access_token.txt";

$str = file_get_contents($filepathsae);
echo $str;

// $str = file_get_contents($filepath);

$data = json_decode($str);


if($data->time < time() - 7000){
  $str = file_get_contents($url);
  $json = json_decode($str);
  $data->access_token = $json->access_token;
  $access_token = $json->access_token;
  $data->time = time()+7000;
  $str = json_encode($data);

  file_put_contents($filepathsae, $str);

  // file_put_contents($filepath, $str);
}else{
  $access_token = $data->access_token;
}

// 根据 openid 获取用户信息

$openid = 'oNcA9w7GJmypTW02EBXCDgbsEobE';
// $access_token = 'oHi7ur_WSlyrgEzLcbtZOuBV6W7G3dswmctb6t0nIVz8t_Q9yBTFcN-JyX7L0hqX-MIs4TnM-N0wFF9OiJauRIcBQ3jI3krqWE8Dv6ChLKQNXIeADAWGR';
$url_userinfo = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";

$user = file_get_contents($url_userinfo);
$obj = json_decode($user);
var_dump($obj);
echo "<br>";
// echo $str;
echo "<table>";
echo "<tr>
        <td><img src='{$obj->headimgurl}' style='width: 50px; height: 50px;'/></td>
        <td>{$obj->nickname}</td>
        <td>".($obj->sex == 1 ? "男" : "女")."</td>
        <td>{$obj->city}</td>
      </tr>";
echo "</table>";
