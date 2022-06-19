<?php /*a:1:{s:55:"F:\F1\website\iot\app\index\view\index\login.html";i:1644141308;}*/ ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zxx">
<!--<![endif]-->
<!-- Begin Head -->

<head>
    <title>意程智造物联网系统</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="MobileOptimized" content="320">
    <!--Start Style -->
    <link rel="stylesheet" type="text/css" href="public/static/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="public/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/static/css/auth.css">
    <style>
        [name = "tips"] {
            height: 0.5em;
            margin-left: 3em;
            font-size: 0.5em;
            padding-bottom: 0.5em;
        }
    </style>
    <!-- Favicon Link -->
    <!-- Script Label -->
    <script src="public/static/js/jquery.min.js"></script>
    <script type="text/javascript">
        GVariate = {

        }
        function prompt() {
            var no = arguments[0], color = arguments[1], text = arguments[2];
            /* no:
             *   0: account
             *   1: password
             *   2: captcha
             *
             * color:
             *   0: clear
             *   1: red
             *   2: green
             */
            no = document.getElementsByName("tips")[no];
            no.innerText = color == 0 ? "" : text;
            no.style.color = (["", "red", "green"])[color];
        }
        function receive(n) {
            /* 0: success
             * 1: captcha wrong
             * 2: account wrong
             *   2-0: account indefined
             *   2-1: account unavailable
             * 3: password wrong
             */
            console.log(n)
            switch (n) {
                case "1":
                    captc.click();
                    prompt(2, 1, "验证码错误！");
                    return;
                case "2-0":
                    prompt(0, 1, "账号未注册！");
                    return;
                case "2-1":
                    prompt(0, 1, "账号不可用！");
                    return;
                case "3":
                    prompt(1, 1, "密码错误！");
                    return;
                case "ok":
                    window.location.href = './';
            }
        }
        function sub() {
            var a = document.getElementsByName("formEle")
            $.ajax({
                type: "post",
                url: "./",
                data:
                    "&name=" + a[0].value
                    + "&password=" + a[1].value
                    + "&captcha=" + a[2].value,
                success: receive,
            });
        }
        document.onkeydown = function () {
            if (event.keyCode == 13) {
                sub();
            }
        }
    </script>
</head>

<body>
    <div class="ad-auth-wrapper">
        <div class="ad-auth-box">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="ad-auth-img">
                        <img src="public/static/images/auth-img1.png" alt="" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="ad-auth-content">
                        <form action="index.php" method="post">
                            <h2>物联网智能管理系统</h2>
                            <p>您<b><?php echo htmlentities($reason); ?></b>，请登录。</p>
                            <div class="ad-auth-form">
                                <div class="ad-auth-feilds mb-30">
                                    <input type="text" placeholder="用户名" class="ad-input" name="formEle" onfocus="prompt(0, 0)" />
                                    <div class="ad-auth-icon">
                                        <svg
										 xmlns="http://www.w3.org/2000/svg"
										 xmlns:xlink="http://www.w3.org/1999/xlink"
										 width="16px" height="16px">
										<path fill-rule="evenodd"  fill="rgb(154, 190, 237)"
										 d="M13.696,9.759 C12.876,8.942 11.901,8.337 10.837,7.971 C11.989,7.180 12.742,5.850 12.725,4.349 C12.698,1.961 10.713,0.031 8.318,0.062 C5.946,0.093 4.026,2.026 4.026,4.398 C4.026,5.879 4.774,7.189 5.914,7.971 C4.850,8.337 3.875,8.942 3.055,9.759 C1.786,11.025 1.026,12.663 0.878,14.426 C0.849,14.768 1.117,15.063 1.462,15.063 L1.466,15.063 C1.772,15.063 2.024,14.827 2.050,14.523 C2.325,11.285 5.057,8.734 8.375,8.734 C11.694,8.734 14.425,11.285 14.701,14.523 C14.727,14.827 14.979,15.063 15.285,15.063 L15.289,15.063 C15.634,15.063 15.902,14.768 15.873,14.426 C15.725,12.663 14.965,11.025 13.696,9.759 ZM8.375,7.562 C6.625,7.562 5.201,6.143 5.201,4.398 C5.201,2.653 6.625,1.234 8.375,1.234 C10.126,1.234 11.550,2.653 11.550,4.398 C11.550,6.143 10.126,7.562 8.375,7.562 Z"/>
										</svg>
                                    </div>
                                    <div name="tips"></div>
                                </div>
                                <div class="ad-auth-feilds mb-30">
                                    <input type="password" placeholder="密码" class="ad-input" name="formEle" onfocus="prompt(1, 0)" />
                                    <div class="ad-auth-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 482.8 482.8"><path d="M395.95,210.4h-7.1v-62.9c0-81.3-66.1-147.5-147.5-147.5c-81.3,0-147.5,66.1-147.5,147.5c0,7.5,6,13.5,13.5,13.5    s13.5-6,13.5-13.5c0-66.4,54-120.5,120.5-120.5c66.4,0,120.5,54,120.5,120.5v62.9h-275c-14.4,0-26.1,11.7-26.1,26.1v168.1    c0,43.1,35.1,78.2,78.2,78.2h204.9c43.1,0,78.2-35.1,78.2-78.2V236.5C422.05,222.1,410.35,210.4,395.95,210.4z M395.05,404.6    c0,28.2-22.9,51.2-51.2,51.2h-204.8c-28.2,0-51.2-22.9-51.2-51.2V237.4h307.2L395.05,404.6L395.05,404.6z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#9abeed"></path><path d="M241.45,399.1c27.9,0,50.5-22.7,50.5-50.5c0-27.9-22.7-50.5-50.5-50.5c-27.9,0-50.5,22.7-50.5,50.5    S213.55,399.1,241.45,399.1z M241.45,325c13,0,23.5,10.6,23.5,23.5s-10.5,23.6-23.5,23.6s-23.5-10.6-23.5-23.5    S228.45,325,241.45,325z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#9abeed"></path></svg>
                                    </div>
                                    <div name="tips"></div>
                                </div>
                                <div class="ad-auth-feilds">
                                    <input type="text" placeholder="验证码" class="ad-input" name="formEle" style="width: 60%;" onfocus="prompt(2, 0)" />
                                    <img id="captc" src="<?php echo captcha_src(); ?>" onclick='this.src="/captcha.html?"+Math.random();' style="height: 2em;position: absolute;top: 50%;transform: translateY(-50%);margin-left: 0.4cm;cursor: pointer;" title="再换一张">
                                    <div name="tips"></div>
                                </div>
                            </div>
                            <div class="ad-other-feilds">
                                <a class="forgot-pws-btn" href="register".html">没有账号？</a>
                                <a class="forgot-pws-btn" href="forgot-pws.html">忘记密码？</a>
                            </div>
                            <a href="javascript:sub();" class="ad-btn ad-login-membe" style="position: relative;top: 0.3cm;">登录</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
