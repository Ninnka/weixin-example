<?php
$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxe07d46a242f6c33d&secret=4e561fc046b0726e6ede200366e8239f

$fileCon = file_get_contents("saemc://access_token.txt");
$fileJson = json_decode($fileCon);
// time();
//判断access_token是否过期
if($fileJson->time < time()-7000){
  //  通过接口重新获取access_token
  $str = file_get_contents($url);
  $json = json_decode($str);
  $access_token = $json->access_token;

  $data = array("access_token" =>$access_token,"time"=>time());
  $json_str = json_encode(data);

  file_put_contents("saemc://access_token.txt",$json_str);
}
else{
  $access_token = $fileJson->access_token;
}


// 获取用户列表
$url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token;

$list = file_get_contents($url);
$listobj = json_decode($list);
var_dump($listobj);

$arr = $listobj->data->openid;
echo "<table>";
for($i=0;$i<count($arr);$i++){
  // 用户的openid
  $openid = $arr[$i];

  //获取用户信息地址

  $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

  $user = file_get_contents($url);

  $obj = json_decode($user);


  echo "<tr>
    <td><img style='width:50px' src='{$obj->headimgurl}'/></td>
    <td>{$obj->nickname}</td>
    <td>".($obj->sex==1?"男":"女")."</td>
    <td>{$obj->city}</td>
  </tr>";
}
  echo "</table>";
