<?php
$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

// 获取access_token地址
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";

$str = file_get_contents($url);
$json = json_decode($str);

$access_token = $json('access_token');
echo $access_token;
