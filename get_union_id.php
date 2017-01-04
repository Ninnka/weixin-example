<?php
$openid = 'oNcA9w9aFHgLy8k1FR-drzB443EI';
$access_token = 'c9zvBpqurygHz2T3Cq-pue7Fr-3ehUnH_Su0EcXIPeQG3STsgF7vbgh9jrkyxFvuTYjCHq_z2uz7cfwwlYiFRxZ6QUcU0zCPUKf1Akxp6mzGMpos5ubX6TJY79x3e5vRTWBcAIAHKP';
$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";


$data = file_get_contents($url);
$str = json_encode($data);

echo $str;
