<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx9e04810f0033f158", "ff165d3bba903801dd02712c5b57ec8f");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      "startRecord", "stopRecord", "onVoiceRecordEnd"
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    // wx.onMenuShareAppMessage({
    //   title: '分享测试', // 分享标题
    //   desc: '分享测试', // 分享描述
    //   link: 'http://1.ninnka.applinzi.com/view/game.html', // 分享链接
    //   imgUrl: 'http://wx.qlogo.cn/mmopen/LF5wMia79of1PuMAfmuqApDvhdhXZ3wMFG6XeWM9S9zGSnZwkLXwMWrKoj6Kic2wlePODpakxyibL3nODlLb50S9StyQUdabDwI/0', // 分享图标
    //   type: '', // 分享类型,music、video或link，不填默认为link
    //   dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
    //   success: function () {
    //       // 用户确认分享后执行的回调函数
    //       console.log("success");
    //   },
    //   cancel: function () {
    //       // 用户取消分享后执行的回调函数
    //       console.log("cancel");
    //   }
    // });

    // wx.chooseImage({
    //   count: 1, // 默认9
    //   sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
    //   sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
    //   success: function (res) {
    //       var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
    //       alert("success");
    //   }
    // });

    // wx.getLocation({
    //   type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
    //   success: function (res) {
    //       var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
    //       var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
    //       var speed = res.speed; // 速度，以米/每秒计
    //       var accuracy = res.accuracy; // 位置精度
    //       alert(latitude,longitude,speed,accuracy);
    //   }
    // });

    // wx.showOptionMenu();

    // wx.getNetworkType({
    //   success: function (res) {
    //       var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
    //       alert(networkType);
    //   }
    // });

    wx.startRecord();

    wx.stopRecord({
      success: function (res) {
          var localId = res.localId;
          alert("stop record");
      }
    });

    wx.onVoiceRecordEnd({
    // 录音时间超过一分钟没有停止的时候会执行 complete 回调
        complete: function (res) {
            var localId = res.localId;
            alert("onVoiceRecordEnd complete");

        }
    });

    // wx.playVoice({
    //     localId: '' // 需要播放的音频的本地ID，由stopRecord接口获得
    // });
    //
    // wx.pauseVoice({
    //     localId: '' // 需要暂停的音频的本地ID，由stopRecord接口获得
    // });
    //
    // wx.stopVoice({
    //     localId: '' // 需要停止的音频的本地ID，由stopRecord接口获得
    // });
    //
    // wx.onVoicePlayEnd({
    //     success: function (res) {
    //         var localId = res.localId; // 返回音频的本地ID
    //         alert("onVoicePlayEnd success");
    //     }
    // });
  });
</script>
</html>
