<?php
// 获取code值
$code = $_GET["code"];

$appid = 'wx9e04810f0033f158';
$secret = 'ff165d3bba903801dd02712c5b57ec8f';

$url_get_token = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

$str = file_get_contents($url_get_token);

$json = json_decode($str);
// var_dump($json);
// echo "<br>";
$access_token = $json->access_token;
$openid = $json->openid;
// echo "access_token: ".$access_token."<br>";
// echo "openid: ".$openid."<br>";

$url_get_openid = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

$user = file_get_contents($url_get_openid);

$obj = json_decode($user);


require_once "jssdk.php";
$jssdk = new JSSDK("wx9e04810f0033f158", "ff165d3bba903801dd02712c5b57ec8f");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scaleble=no">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/game.css">
    </head>

    <body>
        <div class="root" id="root">
            <div class="game-wrapper">

                <!-- <img class="title-challenge-main" src="../public/imgs/challenge-title.png" /> -->
                <img class="title-challenge-top" src="../public/imgs/pt1.png" alt="">
                <img class="title-challenge-bottom" src="../public/imgs/pt2.png" alt="">

                <div class="game-start-btn-wrapper">
                    <div class="game-start-btn">
                        <img src="../public/imgs/start.png" alt="" class="expansion-animation ">
                    </div>
                    <img src="../public/imgs/game-start-finger.png" class="game-start-finger fade-animation" />
                </div>

                <div class="game-nav">
                    <div class="count-money game-nav-item"></div>
                    <div class="game-rule game-nav-item"></div>
                    <div class="game-award game-nav-item"></div>
                    <div class="awardticket-use game-nav-item"></div>
                </div>

                <div class="game-nav-content-wrapper item-hidden">
                    <div class="button-close item-hidden" id="btn_close"></div>
                    <div class="game-rank-wrapper nav-content-item item-hidden">
                        <img src="../public/imgs/rank-title.png" alt="">
                        <ul class="rank-list">
                            <li class="rank-listitem">
                                <img class="rank-award" src="../public/imgs/1.png" alt="">
                                <img class="rank-avatar" src="../public/imgs/avatar.png" alt="">
                                <span class="rank-username"></span>
                                <span class="rank-scope"></span>
                            </li>
                            <li class="rank-listitem">
                                <img class="rank-award" src="../public/imgs/2.png" alt="">
                                <img class="rank-avatar" src="../public/imgs/avatar.png" alt="">
                                <span class="rank-username"></span>
                                <span class="rank-scope"></span>

                            </li>
                            <li class="rank-listitem">
                                <img class="rank-award" src="../public/imgs/3.png" alt="">
                                <img class="rank-avatar" src="../public/imgs/avatar.png" alt="">
                                <span class="rank-username"></span>
                                <span class="rank-scope"></span>

                            </li>
                            <li class="rank-listitem">
                                <span class="rank-number">4</span>
                                <img class="rank-avatar" src="../public/imgs/avatar.png" alt="">
                                <span class="rank-username"></span>
                                <span class="rank-scope"></span>

                            </li>
                            <li class="rank-listitem">
                                <span class="rank-number">5</span>
                                <img class="rank-avatar" src="../public/imgs/avatar.png" alt="">
                                <span class="rank-username"></span>
                                <span class="rank-scope"></span>

                            </li>
                        </ul>
                    </div>

                    <div class="game-rule-wrapper nav-content-item item-hidden">
                        <p class="rule-title">活动规则</p>
                        <p class="rule-detail">
                            1、每人有多次游戏机会，但成绩只能提交一次，且提交之后不能更改！
                        </p>
                        <p class="rule-detail">
                            2、提交成绩时要提供姓名及手机号码作为兑奖凭证，因用户本人未在规定时间内提供正确的手机号码造成的奖品损失，由用户个人承担。
                        </p>
                        <p class="rule-detail">
                            3、活动时间为2016年5月11日-5月19日24:00，活动结束后将在“雾灵山庄”微信公布中奖名单。
                        </p>
                        <p class="rule-detail">
                            4、获奖规则：系统将根据大家提交的成绩，按照由多到少的规则进行排行，排名第1的网友将获得一等奖，排名第2-第21位的网友将分获二等奖，以此类推。
                        </p>
                        <p class="rule-detail">
                            5、奖品的发放：活动结束后，将由工作人员与您取得联系，并将相应的卡券编号发送到您提供的手机号码上。
                        </p>
                    </div>

                    <div class="game-award-wrapper nav-content-item item-hidden">
                        <p class="award-title">活动奖品</p>
                        <p class="award-detail">
                            一等奖1人：价值1488元7号楼1晚豪华标间免费房券1张，并可享康体项目3折优惠；
                        </p>
                        <p class="award-detail">
                            二等奖20人：100元订房代金券每人1张，并可享康体项目4折优惠；
                        </p>
                        <p class="award-detail">
                            三等奖50人：50元订房代金券每人1张，并可享康体项目5折优惠。
                        </p>
                    </div>

                    <div class="game-awardticket-wrapper nav-content-item item-hidden">
                        <p class="awardticket-title">奖券试用说明</p>
                        <p class="awardticket-detail">
                            1、奖品的使用：请务必至少提前一周致电010-81027788或81027799进行预约，并于入住时向前台服务人员出示您手机上收到的卡券编号即可使用（需同时验证获奖人姓名与手机号码）。
                        </p>
                        <p class="awardticket-detail">
                            2、代金券仅适用于线下门市价入住客房消费使用，不适用于通过携程或微信等其他线上渠道预定使用。
                        </p>
                        <p class="awardticket-detail">
                            3、免费房安排的房间将视当时酒店排房情况而定，如您所预约的时段预订已满，将与您协商调整入住时间。
                        </p>
                        <p class="awardticket-detail">
                            4、免费房券及代金券不得用于除订房外其他产品消费，不得与酒店其他优惠折扣或礼券同时使用，且不予退换、兑换现金或找赎。
                        </p>
                        <p class="awardticket-detail">
                            5、对于恶意刷奖者和作弊者，主办方有权取消其兑奖资格。
                        </p>
                    </div>
                </div>

                <div class="game-register item-hidden">
                    <div class="button-close item-hidden" id="btn_close_register"></div>
                    <div class="game-register-content">
                        <img src="../public/imgs/register-title.png" alt="" class="register-title">
                        <div class="empty"></div>
                        <div class="register-notification">
                            个人信息将作为领奖依据
                            <br> 请认真填写哦
                        </div>
                        <div class="input-wrapper">
                            <input type="text" name="name" class="register-input" placeholder="姓名">
                        </div>
                        <div class="input-wrapper">
                            <input type="text" name="tel" class="register-input" placeholder="电话">
                        </div>
                        <div class="register-gamestart">
                            提交并开始游戏
                        </div>
                    </div>
                </div>

            </div>

            <div class="gaming item-hidden">
                <div class="money-wrapper"></div>
                <div class="gaming-footer"></div>
                <div class="scopeandcountdown">
                    <span class="scope-hundreds">0</span>
                    <span class="scope-tens">0</span>
                    <span class="scope-units">0</span>
                    <span class="countdown">10</span>
                </div>
                <div class="gaming-title">
                    <img class="gaming-title-item" src="../public/imgs/手不听自己的.png" alt="">
                    <img class="gaming-title-item title-invisi" src="../public/imgs/刚刚开始.png" alt="">
                    <img class="gaming-title-item title-invisi" src="../public/imgs/一辈子.png" alt="">
                </div>

                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">
                <img src="../public/imgs/money.png" alt="" class="money">

                <div class="money-ctrl"></div>

                <img class="slash-hand" src="../public/imgs/slash-hand.png">

                <div class=""></div>
            </div>

            <div class="game-result item-hidden">
                <div class="result-scope">￥888</div>
                <div class="result-title">
                    <p class="result-title-1">你太客气了，这不是你的挑战极限吧</p>
                    <p class="result-title-2 item-hidden">没办法！你已经强到没有对手了</p>
                </div>
                <div class="scoperank-hint">
                    我的辉煌战绩￥999 当前排名：62位
                </div>

                <img class="result-again" src="../public/imgs/btn-again.png">
                <img class="result-share" src="../public/imgs/btn-share.png">
                <img class="result-floatmoney" src="../public/imgs/money-float.png" alt="">

                <img src="../public/imgs/share-bg.png" alt="" class="result-sharemask">
            </div>
        </div>

    </body>

    <script src="../js/jquery-3.1.1.min.js" charset="utf-8"></script>

    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'onMenuShareAppMessage'
            ]
        });

        wx.ready(function() {

        });

        // 添加分享事件
        var result_share = document.querySelector(".result-share");
        result_share.addEventListener("click", function () {
          // alert("share");
          var headimgurl = '<?php echo $obj->headimgurl;?>';
          alert("headimgurl: "+headimgurl);

          wx.onMenuShareAppMessage({
            title: '钱!钱!!钱!!!', // 分享标题
            desc: '我拿了 ￥ '+mountScope, // 分享描述
            link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx9e04810f0033f158&redirect_uri=http%3A%2F%2F1.ninnka.applinzi.com%2Fview%2Fgame.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect', // 分享链接
            imgUrl: headimgurl, // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
              //   console.log("success");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
              //   console.log("cancel");
            }
          });
        });

    </script>
    <script src="../js/game.js" charset="utf-8"></script>

</html>
