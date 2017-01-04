window.addEventListener("load", function () {

  var addScope_url = "../countmoney_addscope.php";
  var signUp_url = "";

  // 保存用户信息
  var username;
  var usertel;
  var register_name = document.querySelector("input[name=name]");
  var register_tel = document.querySelector("input[name=tel]");

  // 三个主要容器
  var game_wrapper = document.querySelector(".game-wrapper");
  var gaming = document.querySelector(".gaming");
  var game_result = document.querySelector(".game-result");

  // 窗口改变事件
  var html = document.querySelector("html");

  function clientChange() {
    console.log("resize");
    var w = document.documentElement.clientWidth;
    var hfs = Math.round(w / 320 * 50);
    console.log("hfs", hfs);
    html.style.fontSize = hfs + "px";
    // if (hfs <= 100) {
    //   html.style.fontSize = hfs + "px";
    // }
  }
  window.addEventListener("resize", clientChange);

  clientChange();

  // 当前导航栏内容状态,-1表示没有
  var currentNav = -1;


  // 添加首页导航栏点击事件
  var gameNavWrapper = document.querySelector(".game-nav");
  var gameNavs = document.querySelectorAll(".game-nav-item");

  function addGameNavClick() {
    $(gameNavs)
      .on("touchstart", function () {
        console.log("click: ", $(this)
          .index());
        // 保存当前点击的导航栏按钮位置
        var nav_pos = $(this)
          .index();
        currentNav = nav_pos;
        try {
          nav_content_wrapper.classList.remove("item-hidden");
          btn_close.classList.remove("item-hidden");
        } catch (e) {
          console.log(e);
        }
        navContents[currentNav].classList.remove("item-hidden");
      });
  }
  addGameNavClick();

  // 获取导航栏内容容器

  var nav_content_wrapper = document.querySelector(".game-nav-content-wrapper");

  // 获取导航栏内容
  var navContents = document.querySelectorAll(".nav-content-item");

  // 添加关闭导航事件
  var btn_close = document.querySelector("#btn_close");
  btn_close.addEventListener("touchstart", function () {
    if (currentNav !== -1) {
      navContents[currentNav].classList.add("item-hidden");
      btn_close.classList.add("item-hidden");
      nav_content_wrapper.classList.add("item-hidden");
    }
  });

  // 添加进入注册页面事件
  var game_register = document.querySelector(".game-register");
  var register_gamestart = document.querySelector(".register-gamestart");
  var game_start_btn = document.querySelector(".game-start-btn>img");

  function addRegisterBtn() {
    game_start_btn.addEventListener("click", function () {
      game_register.classList.remove("item-hidden");
    });
  }
  addRegisterBtn();

  // 添加进入游戏界面事件
  function addStartBtn() {
    register_gamestart.addEventListener("click", function () {
      game_register.classList.add("item-hidden");
      game_wrapper.classList.add("item-hidden");
      gaming.classList.remove("item-hidden");
      username = register_name.value;
      usertel = register_tel.value;
      $.ajax({
        type: "POST",
        url: "http://localhost:8888/countmoney/view/countmoney_sign.php",
        data: {
          name: username,
          tel: usertel
        },
        // dataType: "json",
        success: function (res) {
          console.log("res", res);
        }
      });
      initTimeAndScope();

    });
  }
  addStartBtn();



  /**
   * ---------------------------------------------------------------------------
   * 游戏中部分
   */

  var mountScope = 0;

  // 分数位置
  var initScopeUnits = 0;
  var initScopeTens = 0;
  var initScopeHundreds = 0;

  var scopeUnits = document.querySelector(".scope-units");
  var scopeTens = document.querySelector(".scope-tens");
  var scopeHundreds = document.querySelector(".scope-hundreds");

  // 倒计时
  var countdown = document.querySelector(".countdown");

  function initTimeAndScope() {
    scopeUnits.innerHTML = "0";
    scopeTens.innerHTML = "0";
    scopeHundreds.innerHTML = "0";
    countdown.innerHTML = "10";
    initScopeUnits = 0;
    initScopeTens = 0;
    initScopeHundreds = 0;
  }

  function endCountdown() {
    isStart = false;
    console.log("end countdown");
    gaming.classList.add("item-hidden");
    game_result.classList.remove("item-hidden");
  }

  function startCountdown() {
    var countdownTimer = setInterval(function () {
      var countdownNumber = parseInt(countdown.innerHTML) - 1;
      countdownNumber = countdownNumber < 10 ? "0" + countdownNumber : countdownNumber;
      countdown.innerHTML = countdownNumber;
      if (countdown.innerHTML === "00") {
        clearInterval(countdownTimer);
        endCountdown();
        storeScope();
      }
    }, 1000);
  }

  function storeScope() {
    mountScope = scopeHundreds.innerHTML + scopeTens.innerHTML + scopeUnits.innerHTML;
    console.log("mountScope", mountScope);
    $.ajax({
      type: "POST",
      url: "countmoney_addscope.php",
      data: {
        name: username,
        scope: mountScope
      },
      // dataType: "json",
      success: function (res) {
        console.log("res", res);
      }
    });
  }


  // 加分
  function addScope() {
    var tmpUnit = Math.floor((initScopeUnits + 1) / 10);
    initScopeUnits = (initScopeUnits + 1) % 10;
    var tmpTen = Math.floor((initScopeTens + 1) / 10);
    initScopeTens = (initScopeTens + tmpUnit) % 10;
    initScopeHundreds = (initScopeHundreds + (tmpTen && tmpUnit)) % 10;
    if (scopeUnits.innerHTML != initScopeUnits) scopeUnits.innerHTML = initScopeUnits;
    if (scopeTens.innerHTML != initScopeTens) scopeTens.innerHTML = initScopeTens;
    if (scopeHundreds.innerHTML != initScopeHundreds) scopeHundreds.innerHTML = initScopeHundreds;
  }

  var slash_hand = document.querySelector(".slash-hand");
  var money_wrapper = document.querySelector(".money-wrapper");
  var moneys = document.querySelectorAll(".gaming .money");
  var money_ctrl = document.querySelector(".money-ctrl");

  var touchStartY;
  var touchEndY;

  var isStart = false;

  // 添加滑钱事件
  function addSlashMoney() {
    $(money_ctrl)
      .on("touchstart", function (ev) {
        if (!$(slash_hand)
          .hasClass("item-hidden")) slash_hand.classList.add("item-hidden");
        if (!isStart) {
          startCountdown();
          isStart = true;
        }
        var e = ev || event;
        touchStartY = e.changedTouches[0].clientY;
      });
    $(money_ctrl)
      .on("touchend", function (ev) {
        var e = ev || event;
        touchEndY = e.changedTouches[0].clientY;
        if (touchStartY - touchEndY > 20) {
          addScope();
          moneyFly();
        }
      });
  }
  addSlashMoney();

  // 控制钱飞的动画
  function moneyFly() {
    for (var i = moneys.length - 1; i >= 0; i--) {
      console.log("in moneyFly: ", i);
      if (!$(moneys[i])
        .hasClass("fly")) {
        moneys[i].classList.add("fly");
        moneys[i].timer = setTimeout((function (i) {
          return function () {
            moneys[i].classList.remove("fly");
            clearTimeout(moneys[i].timer);
          };
        }(i)), 1000);
        break;
      }
    }
  }

  // 退出分享遮罩
  var result_sharemask = document.querySelector(".result-sharemask");

  function addQuitShareMaskClickListener() {
    result_sharemask.addEventListener("click", function () {
      this.classList.add("item-hidden");
    });
  }
  addQuitShareMaskClickListener();

  // 添加再来一次按钮点击事件
  var result_again = document.querySelector(".result-again");

  function addAgainClickListener() {
    result_again.addEventListener("click", function () {
      game_result.classList.add("item-hidden");
      game_wrapper.classList.remove("item-hidden");
    });
  }
  addAgainClickListener();

});
