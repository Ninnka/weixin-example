<?php
// $appid = 'wx9e04810f0033f158';

$code = $_GET["code"];

$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

// 根据code值获取token

// $redirectUrl = urlencode("http://1.ninnka.applinzi.com/code.php");

// $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx9e04810f0033f158&redirect_uri=http%3A%2F%2F1.ninnka.applinzi.com%2Fcode.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

$url_get_token = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

$str = file_get_contents($url_get_token);

$json = json_decode($str);
var_dump($json);
echo "<br>";
$access_token = $json->access_token;
$openid = $json->openid;
echo "access_token: ".$access_token."<br>";
echo "openid: ".$openid."<br>";

// $url_get_openid = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

$url_get_openid = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

$user = file_get_contents($url_get_openid);

$obj = json_decode($user);
var_dump($obj);
// echo "<table>";
// echo "<tr>
//   <td><img style='width:50px' src='{$obj->headimgurl}'/></td>
//   <td>{$obj->nickname}</td>
//   <td>".($obj->sex==1?"男":"女")."</td>
//   <td>{$obj->city}</td>
// </tr>";
// echo "</table>";
 ?>
