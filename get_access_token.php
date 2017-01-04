<?php
$access_token = "";
$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

// 获取access_token地址
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$filepathsae = "saemc://access_token.txt";

// $filepath = "access_token.txt";

$str = file_get_contents($filepathsae);
// echo $str;

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
}

// 根据 openid 获取用户信息

$openid = 'oNcA9w9aFHgLy8k1FR-drzB443EI';
// $access_token = 'c9zvBpqurygHz2T3Cq-pue7Fr-3ehUnH_Su0EcXIPeQG3STsgF7vbgh9jrkyxFvuTYjCHq_z2uz7cfwwlYiFRxZ6QUcU0zCPUKf1Akxp6mzGMpos5ubX6TJY79x3e5vRTWBcAIAHKP';
$url_userinfo = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";

$data = file_get_contents($url_userinfo);
$str = json_encode($data);

echo $str;
