<?php
echo "http://1.ninnka.applinzi.com/code.php";
echo "<br>";
$redirectUrl = urlencode("http://1.ninnka.applinzi.com/view/game.php");

echo $redirectUrl;

$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx9e04810f0033f158&redirect_uri=http%3A%2F%2F1.ninnka.applinzi.com%2Fview%2Fgame.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"

 ?>
